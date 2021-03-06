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
                                            class="table display nowrap table-striped text-center table-bordered zero-configuration">
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
                                                    <tr >
                                                        <td style="vertical-align: middle;">{{$category -> name}}</td>
                                                        <td style="vertical-align: middle;">{{get_default_lang()}}</td>
                                                        <td style="vertical-align: middle;">{{$category -> getActive()}}</td>
                                                        <td style="vertical-align: middle;">{{$category ->vendors->count()}}</td>
                                                        <td style="vertical-align: middle;"><img src="{{ $category->image_path}}" style="width: 110px"
                                                                 class="img-thumbnail" alt=""></td>
                                                        <td style="vertical-align: middle;">
                                                            <div class="btn-group " role="group"
                                                                 aria-label="Button group with nested dropdown">
                                                                <button
                                                                    class="btn btn-outline-primary dropdown-toggle dropdown-menu-right box-shadow-2 "
                                                                    id="btnGroupDrop1" type="button"
                                                                    data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false"><i
                                                                        class="ft-settings icon-left"></i>
                                                                </button>
                                                                <div class="dropdown-menu"
                                                                     aria-labelledby="btnGroupDrop1">

                                                                    <div>
                                                                    @if (auth()->user()->hasPermission('main_categories_update'))
                                                                        <a href="{{route('admin.maincategories.edit',$category -> id)}}"
                                                                           class="px-2 py-2">
                                                                            <i class="la la-edit"></i>
                                                                            @lang('site.edit')
                                                                        </a>
                                                                    @endif
                                                                </div>

                                                                    <div>
                                                                        @if (auth()->user()->hasPermission('main_categories_active'))
                                                                            <a href="{{route('admin.maincategories.editactive',$category -> id)}}"
                                                                               class="px-2">
                                                                               <i class="la la-eye"></i>
                                                                                {{$category -> active == 0 ? 'تفعيل'  : 'إلغاء تفعيل'}}
                                                                            </a>
                                                                        @endif
                                                                    </div>

                                                                    <div>
                                                                        @if (auth()->user()->hasPermission('main_categories_delete'))
                                                                        <form
                                                                        action="{{ route('admin.maincategories.destroy',$category -> id) }}"
                                                                        method="post">
                                                                        {{ csrf_field() }}
                                                                        {{ method_field('delete') }}
                                                                            <button type="submit" style="color: #1E9FF2;" 
                                                                                class="btn btn-link delete mr-1 px-2">
                                                                                <i class="la la-trash"></i>
                                                                                @lang('site.delete')
                                                                            </button>

                                                                        </form>
                                                                         @endif
                                                                    </div>


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

@section('script')
<script type="text/javascript">
    
</script>
@endsection
