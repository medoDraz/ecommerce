@extends('layouts.admin')
@section('title')
    <title>@lang('site.add_admin')</title>
@endsection
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i
                                            class="la la-home"></i> @lang('site.dashboard') </a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('admin.vendors.index')}}"> @lang('site.admins') </a>
                                </li>
                                <li class="breadcrumb-item active">@lang('site.add_admin')
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
                                    <h3 class="card-title" id="basic-layout-form"> @lang('site.add_admin') </h3>
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
                                        <form class="form" action="{{route('admin.admins.store')}}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label> @lang('site.image') </label>
                                                        <label id="projectinput7" class="file center-block">
                                                            <input type="file" id="file" name="photo" class="photo">
                                                            <span class="file-custom"></span>
                                                        </label>
                                                        @error('photo')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <img src="{{asset('public/uploads/users/default.png')}}"
                                                             style="width: 150px"
                                                             class="img-thumbnail image-preview" alt="">
                                                    </div>
                                                </div>

                                            </div>


                                            <div class="form-body">

                                                <h4 class="form-section"><i class="ft-home"></i> @lang('site.admin_detail') </h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">@lang('site.name')</label>
                                                            <input type="text" id="name"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   name="name"
                                                                   value="{{old('name')}}">

                                                            @error("name")
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">@lang('site.email')</label>
                                                            <input type="email" id="email"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   name="email"
                                                                   value="{{old('email')}}">

                                                            @error("email")
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    {{--                                                    <div class="col-md-6">--}}
                                                    {{--                                                        <div class="form-group">--}}
                                                    {{--                                                            <label for="projectinput1">البريد الالكترونى</label>--}}
                                                    {{--                                                            <input type="email" id="email"--}}
                                                    {{--                                                                   class="form-control"--}}
                                                    {{--                                                                   placeholder="  "--}}
                                                    {{--                                                                   name="email"--}}
                                                    {{--                                                                   value="{{old('email')}}">--}}

                                                    {{--                                                            @error("email")--}}
                                                    {{--                                                            <span class="text-danger">{{ $message }}</span>--}}
                                                    {{--                                                            @enderror--}}
                                                    {{--                                                        </div>--}}
                                                    {{--                                                    </div>--}}

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

                                                    {{--                                                    <div class="col-md-6">--}}
                                                    {{--                                                        <div class="form-group mt-1">--}}
                                                    {{--                                                                                                                <input type="checkbox" value="1"--}}
                                                    {{--                                                                                                                       name="active"--}}
                                                    {{--                                                                                                                       id="switcheryColor4"--}}
                                                    {{--                                                                                                                       class="switchery" data-color="success"--}}
                                                    {{--                                                                                                                       checked/>--}}
                                                    {{--                                                                                                                <label for="switcheryColor4"--}}
                                                    {{--                                                                                                                       class="card-title ml-1">الحالة</label>--}}

                                                    {{--                                                            @error("category.active")--}}
                                                    {{--                                                            <span class="text-danger"> </span>--}}
                                                    {{--                                                            @enderror--}}
                                                    {{--                                                        </div>--}}
                                                    {{--                                                    </div>--}}


                                                </div>

                                            </div>

                                            {{--                                            <div class="row">--}}
                                            {{--                                            	<div class="col-md-6">--}}
                                            {{--                                                        <div class="form-group">--}}
                                            {{--                                                            <label for="projectinput1">العنوان </label>--}}
                                            {{--                                                            <input type="text" id="pac-input"--}}
                                            {{--                                                                   class="form-control"--}}
                                            {{--                                                                   placeholder="  "--}}
                                            {{--                                                                   name="address"--}}
                                            {{--                                                                   value="{{old('address')}}">--}}

                                            {{--                                                            @error("address")--}}
                                            {{--                                                            <span class="text-danger">{{ $message }}</span>--}}
                                            {{--                                                            @enderror--}}
                                            {{--                                                        </div>--}}
                                            {{--                                                    </div>--}}
                                            {{--                                            </div>--}}

                                            {{--                                            <div id="map" style="height: 500px;width: 1000px;"></div>--}}

                                            @php
                                                $models = ['admins','languages', 'main_categories','vendors'];
                                                $maps = ['create', 'read', 'update', 'delete'];
                                            @endphp

                                            <h4 class="form-section"><i class="la la-list-alt"></i>@lang('site.permissions')</h4>
                                            <ul class="nav nav-tabs">
                                                @foreach($models   as $index =>  $model)
                                                    <li class="nav-item">
                                                        <a class="nav-link {{ $index == 0 ? 'active' : '' }}"
                                                           id="homeLable-tab" data-toggle="tab"
                                                           href="#homeLable{{$index}}" aria-controls="homeLable"
                                                           aria-expanded="{{$index ==  0 ? 'true' : 'false'}}">
                                                            @lang('site.' . $model)</a>
                                                    </li>
                                                @endforeach
                                            </ul>

                                            <div class="tab-content px-1 pt-1">
                                                @foreach($models as $index=>$model)
                                                    <div role="tabpanel"
                                                         class="tab-pane {{ $index == 0 ? 'active' : '' }}"
                                                         id="homeLable{{$index}}"
                                                         aria-labelledby="homeLable-tab"
                                                         aria-expanded="{{$index ==  0 ? 'true' : 'false'}}">
                                                        @foreach ($maps as $map)

                                                            <fieldset class="checkboxsas">
                                                                <label>
                                                                    <input type="checkbox"
                                                                           name="permissions[]"
                                                                           value="{{ $model . '_' . $map }}"> @lang('site.' . $map)
                                                                </label>
                                                            </fieldset>

                                                        @endforeach

                                                    </div>
                                                @endforeach


                                            </div>

                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="ft-x"></i> @lang('site.cancel')
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> @lang('site.save')
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
    <script>
        $('.photo').change(function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.image-preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });

    </script>
@endsection

