@extends('layouts.admin')
@section('title')
    <title> @lang('site.edit_category') {{$subCategory->name}} </title>
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
                                <li class="breadcrumb-item"><a href="{{route('admin.subcategories.index')}}"> @lang('site.sub_categories') </a>
                                </li>
                                <li class="breadcrumb-item active"> @lang('site.edit_category') {{$subCategory->name}}
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
                                    <h4 class="card-title" id="basic-layout-form"> @lang('site.edit_category') {{$subCategory->name}} </h4>
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
                                        <form class="form" action="{{route('admin.subcategories.update',$subCategory -> id)}}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            {{ method_field('put') }}
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label> @lang('site.category_image') </label>
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
                                                    <img src="{{$subCategory->image_path}}"  style="width: 150px" class="img-thumbnail image-preview" alt="">
                                                    </div>
                                                </div>

                                            </div>


                                            <div class="form-body">

                                                <h4 class="form-section"><i class="ft-home"></i> @lang('site.category_detail') </h4>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">@lang('site.' . $subCategory -> translation_lang . '.name') </label>
                                                                    <input type="text"  id="name"
                                                                           class="form-control"
                                                                           placeholder="  "
                                                                           value="{{$subCategory->name}}"
                                                                           name="category[0][name]">
                                                                    @error("category.0.name")
                                                                    <span class="text-danger">@lang('site.required')</span>
                                                                    @enderror
                                                                </div>
                                                            </div>


                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">@lang('site.' . $subCategory -> translation_lang . '.abbr') </label>
                                                                    <input type="text" id="abbr"
                                                                           class="form-control"
                                                                           placeholder="  "
                                                                           value="{{$subCategory->translation_lang}}"
                                                                           name="category[0][abbr]" readonly>

                                                                    @error("category.0.abbr")
                                                                    <span class="text-danger"> </span>
                                                                    @enderror
                                                                </div>
                                                            </div>


                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group mt-1">
                                                                    <input type="checkbox" value="1"
                                                                           name="category[0][active]"
                                                                           id="switcheryColor4"
                                                                           class="switchery" data-color="success"
                                                                           @if($subCategory -> active == 1)checked @endif/>
                                                                    <label for="switcheryColor4"
                                                                           class="card-title ml-1">@lang('site.' . $subCategory -> translation_lang . '.active')</label>

                                                                    @error("category.0.active")
                                                                    <span class="text-danger"> </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                            </div>


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

                                        <ul class="nav nav-tabs">
                                            @isset($subCategory -> categories)
                                                @foreach($subCategory -> categories   as $index =>  $translation)
                                                    <li class="nav-item">
                                                        <a class="nav-link {{ $index == 0 ? 'active' : '' }}" id="homeLable-tab"  data-toggle="tab"
                                                           href="#homeLable{{$index}}" aria-controls="homeLable"
                                                            aria-expanded="{{$index ==  0 ? 'true' : 'false'}}">
                                                            {{$translation -> translation_lang}}</a>
                                                    </li>
                                                @endforeach
                                            @endisset
                                        </ul>

                                        <div class="tab-content px-1 pt-1">
                                            @foreach($subCategory -> categories   as $index =>  $translation)
                                                <div role="tabpanel" class="tab-pane {{ $index == 0 ? 'active' : '' }}" id="homeLable{{$index}}"
                                                    aria-labelledby="homeLable-tab"
                                                    aria-expanded="{{$index ==  0 ? 'true' : 'false'}}">

                                                    <form class="form"
                                                        action="{{route('admin.subcategories.update',$translation -> id)}}"
                                                        method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        {{ method_field('put') }}
                                                        <input name="id" value="{{$translation -> id}}" type="hidden">


                                                        <div class="form-body">

                                                            <h4 class="form-section"><i class="ft-home"></i> @lang('site.category_detail') </h4>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="projectinput1">@lang('site.' . $translation -> translation_lang . '.name')</label>
                                                                        <input type="text" id="name"
                                                                            class="form-control"
                                                                            placeholder="  "
                                                                            value="{{$translation -> name}}"
                                                                            name="category[0][name]">
                                                                        @error("category.0.name")
                                                                        <span class="text-danger">@lang('site.required')</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>


                                                                <div class="col-md-6 hidden">
                                                                    <div class="form-group">
                                                                        <label for="projectinput1"> @lang('site.' . $translation -> translation_lang . '.abbr')</label>
                                                                        <input type="text" id="abbr"
                                                                            class="form-control"
                                                                            placeholder="  "
                                                                            value="{{$translation -> translation_lang}}"
                                                                            name="category[0][abbr]">

                                                                        @error("category.0.abbr")
                                                                        <span class="text-danger"></span>
                                                                        @enderror
                                                                    </div>
                                                                </div>


                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group mt-1">
                                                                        <input type="checkbox" value="1"
                                                                            name="category[0][active]"
                                                                            id="switcheryColor4"
                                                                            class="switchery" data-color="success"
                                                                            @if($translation -> active == 1)checked @endif/>
                                                                        <label for="switcheryColor4"
                                                                            class="card-title ml-1">@lang('site.' . $translation -> translation_lang . '.active') </label>

                                                                        @error("category.0.active")
                                                                        <span class="text-danger"> </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


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
                                            @endforeach


                                        </div>

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

