<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VendorRequest;
use App\Models\MainCategory;
use App\Models\Vendor;
use App\Notifications\VendorCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class VendorsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:vendors_create'])->only('create');
        $this->middleware(['permission:vendors_read'])->only('read');
        $this->middleware(['permission:vendors_update'])->only('edit');
        $this->middleware(['permission:vendors_delete'])->only('destroy');
        $this->middleware(['permission:vendors_active'])->only('editactive');
    }

    public function index()
    {
        $vendors=Vendor::selection()->paginate(PAGINATION_COUNT);
        return view('admin.vendors.index',compact('vendors'));
    }


    public function create()
    {
        $categories=MainCategory::where('translation_of',0)->active()->get();
        return view('admin.vendors.create',compact('categories'));
    }


    public function store(VendorRequest $request)
    {

        try{
            if (!$request->has('active'))
                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);

            $request_data=$request->except(['logo','password']);
            $request_data['password']=bcrypt( $request->password);

            if($request->has('logo')){
                Image::make($request->logo)->resize(300,null,function($constraint){
                    $constraint->aspectRatio();
                })->save(public_path('uploads/vendors/'.$request->logo->hashName()));
                $request_data['logo'] = $request->logo->hashName();
            }

//           return $request_data;
            $vendor=Vendor::create($request_data);
            Notification::send($vendor,new VendorCreated($vendor));
             return redirect()->route('admin.vendors.index')->with(['success' => 'تم إضافة المتجر بنجاح']);
        } catch (\Exception $ex) {
            // return $ex;

            return redirect()->route('admin.vendors.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }

    public function show(Vendor $vendor)
    {
        $categories=MainCategory::where('translation_of',0)->active()->get();
        if (!$vendor) {
            return redirect()->route('admin.vendors.index')->with(['error' => 'هذا المتجر غير موجود']);
        }

        return view('admin.vendors.show', compact('vendor','categories'));
    }


    public function edit(Vendor $vendor)
    {
        $categories=MainCategory::where('translation_of',0)->active()->get();
        if (!$vendor) {
            return redirect()->route('admin.vendors.index')->with(['error' => 'هذا المتجر غير موجود']);
        }

        return view('admin.vendors.edit', compact('vendor','categories'));
    }


    public function update(VendorRequest $request, Vendor $vendor)
    {
        try{
            if (!$request->has('active'))
                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);


            $request_data=$request->except(['logo','password']);

            if($request->logo){
                if ($vendor->logo != 'default.png') {
                    Storage::disk('public_uploads')->delete('/vendors/' . $vendor->logo);
                }
                Image::make($request->logo)->resize(300,null,function($constraint){
                    $constraint->aspectRatio();
                })->save(public_path('uploads/vendors/'.$request->logo->hashName()));
                $request_data['logo'] = $request->logo->hashName();
            }

            if($request->password){
                $request_data['password']=bcrypt( $request->password);
            }

            return $request_data;

//            $vendor->update($request_data);
//
//            return redirect()->route('admin.vendors.index')->with(['success' => 'تم تحديث المتجر بنجاح']);

        } catch (\Exception $ex) {

            return redirect()->route('admin.vendors.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }


    public function editactive($vendor_id)
    {
        try{

            $vendor = Vendor::find($vendor_id);

            $status = $vendor->active == 0 ? 1 : 0;

            $vendor->update(['active' => $status]);

            return redirect()->route('admin.vendors.index')->with(['success' => 'تم تحديث الحالة بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.vendors.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
}
