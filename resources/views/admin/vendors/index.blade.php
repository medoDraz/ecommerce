@extends('layouts.admin')
@section('title')
    <title>@lang('site.vendors')</title>
@endsection
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    {{--                    <h3 class="content-header-title"> المتاجر </h3>--}}
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i
                                            class="la la-home"></i> @lang('site.dashboard') </a>
                                </li>
                                <li class="breadcrumb-item active"> @lang('site.vendors')
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
                                    <h3 class="card-title">@lang('site.all_vendors')</h3>
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
                                            class="table display nowrap table-striped table-bordered scroll-horizontal">
                                            <thead>
                                            <tr>
                                                <th>@lang('site.name')</th>
                                                <th>@lang('site.logo')</th>
                                                <th>@lang('site.mobile')</th>
                                                <th>@lang('site.main_category')</th>
                                                <th>@lang('site.active')</th>
                                                <th>@lang('site.action')</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @isset($vendors)
                                                @foreach($vendors as $vendor)
                                                    <tr>
                                                        <td>{{$vendor -> name}}</td>
                                                        <td><img src="{{ $vendor->image_path}}"
                                                                 style="width: 130px; height: 70px" alt=""></td>
                                                        <td>{{$vendor->mobile}}</td>
                                                        <td>{{$vendor->main_category->name}}</td>
                                                        <td>{{$vendor -> getActive()}}</td>
                                                        <td>
                                                            <div class="btn-group" role="group"
                                                                 aria-label="Basic example">
                                                                @if (auth()->user()->hasPermission('vendors_update'))
                                                                    <a href="{{ route('admin.vendors.edit',$vendor -> id) }}"
                                                                       class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">
                                                                        <i class="la la-edit"></i>
                                                                        @lang('site.edit')</a>
                                                                @endif

                                                                @if (auth()->user()->hasPermission('vendors_delete'))
                                                                    <a href="{{ route('admin.vendors.show',$vendor -> id) }}"
                                                                       class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">
                                                                        <i class="la la-eye"></i>
                                                                        @lang('site.show')</a>
                                                                @endif

                                                                @if (auth()->user()->hasPermission('vendors_active'))
                                                                    <a href="{{ route('admin.vendors.editactive',$vendor->id) }}"
                                                                       class="btn btn-outline-warning btn-min-width box-shadow-3 mr-1 mb-1">
                                                                        {{$vendor -> active == 0 ? 'تفعيل'  : 'إلغاء تفعيل'}}
                                                                    </a>
                                                                @endif
                                                            </div>

                                                            <div class="btn-group float-md-right" role="group"
                                                                 aria-label="Button group with nested dropdown">
                                                                <button
                                                                    class="btn btn-outline-primary dropdown-toggle dropdown-menu-right box-shadow-2 px-2"
                                                                    id="btnGroupDrop1" type="button"
                                                                    data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false"><i
                                                                        class="ft-settings icon-left"></i>
                                                                </button>
                                                                <div class="dropdown-menu"
                                                                     aria-labelledby="btnGroupDrop1">

                                                                    @if (auth()->user()->hasPermission('languages_update'))
                                                                        <a href="#"
                                                                           class="px-2 ">
                                                                            <i class="la la-edit"></i>
                                                                            @lang('site.edit')
                                                                        </a>
                                                                    @endif

                                                                    @if (auth()->user()->hasPermission('languages_delete'))
                                                                        <form
                                                                            action="{{ route('admin.languages.destroy',$language -> id) }}"
                                                                            method="post" style="display: inline-block;">
                                                                            {{ csrf_field() }}
                                                                            {{ method_field('delete') }}
                                                                            <a type="submit" href="#"
                                                                               class=" delete px-2 mr-1 mb-1">
                                                                                <i class="la la-trash"></i>
                                                                                @lang('site.delete')
                                                                            </a>

                                                                        </form>
                                                                    @endif
                                                                </div>
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
