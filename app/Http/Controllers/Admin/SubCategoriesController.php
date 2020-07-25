<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoriesController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:sub_categories_create'])->only('create');
        $this->middleware(['permission:sub_categories_read'])->only('read');
        $this->middleware(['permission:sub_categories_update'])->only('edit');
        $this->middleware(['permission:sub_categories_delete'])->only('destroy');
        $this->middleware(['permission:sub_categories_active'])->only('editactive');
    }

    public function index()
    {
        //
    }


    public function create()
    {
        return view('admin.subcategories.create');
    }


    public function store(Request $request)
    {
        //
    }


    public function show(SubCategory $subCategory)
    {
        //
    }


    public function edit(SubCategory $subCategory)
    {
        //
    }


    public function update(Request $request, SubCategory $subCategory)
    {
        //
    }


    public function destroy(SubCategory $subCategory)
    {
        //
    }
}
