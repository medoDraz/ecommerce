<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LanguageRequest;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguagesController extends Controller
{

    public function index()
    {
        $languages = Language::select()->paginate(PAGINATION_COUNT);
        return view('admin.languages.index', compact('languages'));
    }


    public function create()
    {
        return view('admin.languages.create');
    }


    public function store(LanguageRequest $request)
    {
        try {
        	if (!$request->has('active'))
                $request->request->add(['active' => 0]);

            Language::create($request->except(['_token']));
            return redirect()->route('admin.languages.index')->with(['success' => 'تم حفظ اللغة بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.languages.index')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }


    public function show(Language $language)
    {
        //
    }


    public function edit(Language $language)
    {

        // dd($language);
        if (!$language) {
            return redirect()->route('admin.languages.index')->with(['error' => 'هذه اللغة غير موجوده']);
        }

        return view('admin.languages.edit', compact('language'));
    }


    public function update(LanguageRequest $request, Language $language)
    {
        try {

// dd($request);
        	if (!$request->has('active'))
                $request->request->add(['active' => 0]);

            $language -> update($request -> except('_token'));

            return redirect()->route('admin.languages.index')->with(['success' => 'تم تحديث اللغة بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.languages.index')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }


    public function destroy(Language $language)
    {
        try {

            if (!$language) {
                return redirect()->route('admin.languages.index')->with(['error' => 'هذه اللغة غير موجوده']);
            }
            $language -> delete();

            return redirect()->route('admin.languages.index')->with(['success' => 'تم حذف اللغة بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.languages.index')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }
}
