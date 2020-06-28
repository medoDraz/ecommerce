<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainCategoryRequest;
use App\Models\MainCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class MainCategoriesController extends Controller
{

    public function index()
    {
        $default_lang = get_default_lang();
           $categories = MainCategory::where('translation_lang',$default_lang) ->selection()->paginate(PAGINATION_COUNT);

           return view('admin.maincategories.index',compact('categories'));
    }


    public function create()
    {
       return view('admin.maincategories.create');
    }


    public function store(MainCategoryRequest $request)
    {
        try {

            // return $request;
            $request_data=$request->except(['photo']);
            $filePath="";
            if($request->has('photo')){
                Image::make($request->photo)->resize(300,null,function($constraint){
                    $constraint->aspectRatio();
                })->save(public_path('uploads/maincategory/'.$request->photo->hashName()));
                $request_data['photo'] = $request->photo->hashName();
                $filePath=$request_data['photo'];
            }
    // return $filePath;
            $main_categories = collect($request->category);

            $filter = $main_categories->filter(function ($value, $key) {
                return $value['abbr'] == get_default_lang();
            });

            $default_category = array_values($filter->all())[0];

            DB::beginTransaction();

            $default_category_id = MainCategory::insertGetId([
                'translation_lang' => $default_category['abbr'],
                'translation_of' => 0,
                'name' => $default_category['name'],
                'slug' => $default_category['name'],
                'photo' => $filePath
            ]);

            $categories = $main_categories->filter(function ($value, $key) {
                return $value['abbr'] != get_default_lang();
            });

            if(isset($categories) && $categories -> count())
            {

                $categories_arr=[];
                foreach ($categories as $category){
                    $categories_arr[] = [
                        'translation_lang' => $category['abbr'] ,
                        'translation_of' => $default_category_id,
                        'name' => $category['name'] ,
                        'slug' => $category['name'] ,
                        'photo' => $filePath
                    ];
                }

                MainCategory::insert($categories_arr);

            }

            DB::commit();

                return redirect()->route('admin.maincategories.index')->with(['success' => 'تم الحفظ بنجاح']);

        } catch (\Exception $ex) {
            // return $ex;
            DB::rollback();
            return redirect()->route('admin.maincategories.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }


    public function show(MainCategory $mainCategory)
    {
        //
    }


    public function edit($mainCat_id)
    {
    //get specific categories and its translations
             $mainCategory = MainCategory::with('categories')
              ->selection()
              ->find($mainCat_id);
            //   dd($mainCategory);
      if (!$mainCategory) {
            return redirect()->route('admin.maincategories.index')->with(['error' => 'هذا القسم غير موجود']);
        }

        return view('admin.maincategories.edit' ,compact('mainCategory'));
    }


    public function update(MainCategoryRequest $request, $mainCat_id)
    {
        try {

            $mainCategory = MainCategory::find($mainCat_id);
            $request_data=$request->except(['photo']);

            $category = array_values($request->category) [0];

            if (!$request->has('category.0.active'))
                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);
            $filePath=$mainCategory->photo;

            if($request->photo){
                if ($mainCategory->photo != 'default.png') {
                    Storage::disk('public_uploads')->delete('/maincategory/' . $mainCategory->photo);
                }
                Image::make($request->photo)->resize(300,null,function($constraint){
                    $constraint->aspectRatio();
                })->save(public_path('uploads/maincategory/'.$request->photo->hashName()));
                $request_data['photo'] = $request->photo->hashName();
                $filePath=$request_data['photo'];
            }
            $mainCategory
                ->update([
                    'name' => $category['name'],
                    'active' => $request->active,
                    'photo' => $filePath

                ]);

            return redirect()->route('admin.maincategories.index')->with(['success' => 'تم تحديث القسم بنجاح']);

        } catch (\Exception $ex) {
            // return $ex;

            return redirect()->route('admin.maincategories.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }


    public function destroy($mainCat_id)
    {

        try{

            $mainCategory = MainCategory::find($mainCat_id);

            if ($mainCategory->photo != 'default.png') {
                Storage::disk('public_uploads')->delete('/maincategory/' . $mainCategory->photo);
            }
            DB::beginTransaction();
            $mainCategory->delete();
            $categoryTranslations=MainCategory::where('translation_of',$mainCat_id)->get();
            foreach($categoryTranslations as $categoryTranslation){
                $categoryTranslation->delete();
            }
            DB::commit();
            return redirect()->route('admin.maincategories.index')->with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.maincategories.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }

    public function editactive(MainCategoryRequest $request, $mainCat_id){

        try{

            $mainCategory = MainCategory::find($mainCat_id);
            if($request->active == 1){
                $mainCategory
                ->update([
                    'active' => 0,
                ]);
            }else{
                $mainCategory
                ->update([
                    'active' => 1,
                ]);
            }

            return redirect()->route('admin.maincategories.index')->with(['success' => 'تم تحديث القسم بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.maincategories.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }
}
