<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VendorRequest;
use App\Models\Admin;
use App\Models\MainCategory;
use App\Models\Vendor;
use App\Notifications\AdminCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class AdminsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:admins_create'])->only('create');
        $this->middleware(['permission:admins_read'])->only('read');
        $this->middleware(['permission:admins_update'])->only('edit');
        $this->middleware(['permission:admins_delete'])->only('destroy');
        $this->middleware(['permission:admins_active'])->only('editactive');
    }

    public function index()
    {
        $admins=Admin::whereRoleIs('admin')->paginate(PAGINATION_COUNT);
        return view('admin.admins.index',compact('admins'));
    }


    public function create()
    {

        return view('admin.admins.create');
    }


    public function store(Request $request)
    {
        try{

            $request_data=$request->except(['photo','password','permissions']);
            $request_data['password']=bcrypt( $request->password);

            if($request->has('photo')){
                Image::make($request->photo)->resize(300,null,function($constraint){
                    $constraint->aspectRatio();
                })->save(public_path('uploads/users/'.$request->photo->hashName()));
                $request_data['photo'] = $request->photo->hashName();
            }
//           return $request->permissions;
            $admin=Admin::create($request_data);
            $admin->attachRole('admin');
            $admin->syncPermissions($request->permissions);
//            Notification::send($admin,new AdminCreated($admin));
             return redirect()->route('admin.admins.index')->with(['success' => 'تم إضافة المشرف بنجاح']);
        } catch (\Exception $ex) {
//             return $ex;

            return redirect()->route('admin.admins.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
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


            $request_data=$request->except(['photo','password']);

            if($request->photo){
                if ($vendor->photo != 'default.png') {
                    Storage::disk('public_uploads')->delete('/vendors/' . $vendor->photo);
                }
                Image::make($request->photo)->resize(300,null,function($constraint){
                    $constraint->aspectRatio();
                })->save(public_path('uploads/vendors/'.$request->photo->hashName()));
                $request_data['photo'] = $request->photo->hashName();
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


    public function destroy(Vendor $vendor)
    {
        //
    }

    public function editactive($vendor_id)
    {
        try{

            $admin = Admin::find($vendor_id);

            $status = $admin->active == 0 ? 1 : 0;

            $admin->update(['active' => $status]);

            return redirect()->route('admin.vendors.index')->with(['success' => 'تم تحديث الحالة بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.vendors.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
}
