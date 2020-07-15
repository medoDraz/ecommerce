@extends('layouts.admin')
@section('title')
    <title>@lang('site.main_categories')</title>
@endsection
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    {{--                    <h3 class="content-header-title"> الاقسام الرئيسية </h3>--}}
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i
                                            class="la la-home"></i> @lang('site.dashboard') </a>
                                </li>
                                <li class="breadcrumb-item active">@lang('site.main_categories')
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">@lang('site.all_main_categories') </h3>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            {{-- <li><a data-action="close"><i class="ft-x"></i></a></li> --}}
                                        </ul>
                                    </div>
                                </div>

                                @include('admin.includes.alerts.success')
                                @include('admin.includes.alerts.errors')

                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <table
                                            class="table display nowrap table-striped table-bordered zero-configuration">
                                            <thead>
                                            <tr>
                                                <th>@lang('site.category')</th>
                                                <th>@lang('site.language')</th>
                                                <th>@lang('site.active')</th>
                                                <th>@lang('site.vendor_count')</th>
                                                <th>@lang('site.category_image')</th>
                                                <th>@lang('site.action')</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @isset($categories)
                                                @foreach($categories as $category)
                                                    <tr>
                                                        <td>{{$category -> name}}</td>
                                                        <td>{{get_default_lang()}}</td>
                                                        <td>{{$category -> getActive()}}</td>
                                                        <td>{{$category ->vendors->count()}}</td>
                                                        <td><img src="{{ $category->image_path}}" style="width: 150px"
                                                                 class="img-thumbnail" alt=""></td>
                                                        <td>
                                                            <div class="btn-group" role="group"
                                                                 aria-label="Basic example">
                                                                @if (auth()->user()->hasPermission('main_categories_update'))
                                                                    <a href="{{ route('admin.maincategories.edit',$category -> id) }}"
                                                                       class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">
                                                                        <i class="la la-edit"></i>
                                                                        @lang('site.edit')</a>
                                                                @endif

                                                                @if (auth()->user()->hasPermission('main_categories_delete'))
                                                                    <form
                                                                        action="{{ route('admin.maincategories.destroy',$category -> id) }}"
                                                                        method="post" style="display: inline-block;">
                                                                        {{ csrf_field() }}
                                                                        {{ method_field('delete') }}
                                                                        <button type="submit"
                                                                                class="btn btn-outline-danger delete btn-min-width box-shadow-3 mr-1 mb-1">
                                                                            <i class="la la-trash"></i>
                                                                            @lang('site.delete')
                                                                        </button>

                                                                    </form>
                                                                @endif

                                                                @if (auth()->user()->hasPermission('main_categories_active'))
                                                                    <a href="{{route('admin.maincategories.editactive',$category -> id)}}"
                                                                       class="btn btn-outline-warning btn-min-width box-shadow-3 mr-1 mb-1">

                                                                        {{$category -> active == 0 ? 'تفعيل'  : 'إلغاء تفعيل'}}
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endisset


                                            </tbody>
                                        </table>
                                        <div class="justify-content-center d-flex">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
