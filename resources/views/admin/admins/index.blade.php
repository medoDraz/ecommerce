@extends('layouts.admin')
@section('title')
    <title>@lang('site.admins')</title>
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
                                <li class="breadcrumb-item active"> @lang('site.admins')
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
                                    <h4 class="card-title">@lang('site.all_admins')</h4>
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
                                                <th>@lang('site.image')</th>
                                                <th>@lang('site.email')</th>
                                                <th>@lang('site.action')</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @isset($admins)
                                                @foreach($admins as $admin)
                                                    <tr class="text-center">
                                                        <td>{{$admin -> name}}</td>
                                                        <td><img src="{{ $admin->image_path}}" class="img-thumbnail"
                                                                 style="width: 200px;" alt=""></td>
                                                        <td>{{$admin->email}}</td>

                                                        <td>
                                                            <div class="btn-group" role="group"
                                                                 aria-label="Basic example">
                                                                @if (auth()->user()->hasPermission('admins_update'))
                                                                    <a href="{{ route('admin.admins.edit',$admin -> id) }}"
                                                                       class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">
                                                                        <i class="la la-edit"></i>
                                                                        @lang('site.edit')
                                                                    </a>
                                                                @endif

                                                                @if (auth()->user()->hasPermission('admins_read'))
                                                                    <a href="{{ route('admin.admins.show',$admin -> id) }}"
                                                                       class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">
                                                                        <i class="la la-eye"></i>
                                                                        @lang('site.show')
                                                                    </a>
                                                                @endif

                                                                @if (auth()->user()->hasPermission('admins_delete'))
                                                                    <a href=""
                                                                       class="btn btn-outline-warning btn-min-width box-shadow-3 mr-1 mb-1">
                                                                        <i class="la la-trash"></i>
                                                                        @lang('site.delete')
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
