@extends('layouts.admin')
@section('title')
    <title>@lang('site.edit_vendor')</title>
@endsection
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="la la-home"></i> @lang('site.dashboard') </a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('admin.vendors.index')}}"> @lang('site.vendors') </a>
                                </li>
                                <li class="breadcrumb-item active">@lang('site.edit_vendor')
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title" id="basic-layout-form"> @lang('site.edit_vendor') </h3>
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
                                    <div class="card-body">
                                        <form class="form" action="{{route('admin.vendors.update',$vendor->id)}}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            {{ method_field('put') }}

                                            <input type="hidden" name="id" value="{{$vendor->id}}">

                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label> @lang('site.logo') </label>
                                                        <label id="projectinput7" class="file center-block">
                                                            <input type="file" id="file" name="logo" class="logo">
                                                            <span class="file-custom"></span>
                                                        </label>
                                                        @error('logo')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <img src="{{$vendor->image_path}}" style="width: 150px"
                                                             class="img-thumbnail image-preview" alt="">
                                                    </div>
                                                </div>

                                            </div>


                                            <div class="form-body">

                                                <h4 class="form-section"><i class="ft-home"></i> @lang('site.vendor_detail') </h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">@lang('site.vendor_name')</label>
                                                            <input type="text" id="name"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   name="name"
                                                                   value="{{$vendor->name}}">

                                                            @error("name")
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">@lang('site.category_name')</label>
                                                            <select name="category_id" class="select2 form-control">
                                                                <optgroup label="@lang('site.choose_category')">
                                                                    @if($categories && $categories->count() >0)
                                                                        @foreach($categories as $category)
                                                                            <option value="{{$category->id}}"{{ $vendor->category_id == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </optgroup>
                                                            </select>

                                                            @error("category_id")
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">@lang('site.mobile')</label>
                                                            <input type="number" id="mobile"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   name="mobile"
                                                                   value="{{$vendor->mobile}}">

                                                            @error("name")
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">@lang('site.email')</label>
                                                            <input type="email" id="email"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   name="email"
                                                                   value="{{$vendor->email}}">

                                                            @error("email")
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">@lang('site.password')</label>
                                                            <input type="password" id="password"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   name="password"
                                                                   min="6">

                                                            @error("password")
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox" value="1"
                                                                   name="active"
                                                                   id="switcheryColor4"
                                                                   class="switchery" data-color="success"
                                                                   @if($vendor -> active == 1)checked @endif/>
                                                            <label for="switcheryColor4"
                                                                   class="card-title ml-1">@lang('site.active')</label>

                                                            @error("category.active")
                                                            <span class="text-danger"> </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">@lang('site.address') </label>
                                                        <input type="text" id="pac-input"
                                                               class="form-control"
                                                               placeholder="  "
                                                               name="address"
                                                               value="{{$vendor->address}}">

                                                        @error("address")
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="map" style="height: 500px;width: 1000px;"></div>

                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="ft-x"></i> @lang('site.cancel')
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> @lang('site.update')
                                                </button>
                                            </div>
                                        </form>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>

@endsection
@section('script')

@endsection

