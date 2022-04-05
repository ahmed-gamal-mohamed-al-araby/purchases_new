@php
$currentLanguage = app()->getLocale();
@endphp

@extends("layouts.app")

{{-- Custom Title --}}
@section('title')
@lang('site.projects')
@endsection

{{-- Custom Styles --}}
@section('styles')
{{-- select 2 --}}
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('dist/css/bootstrap-wysihtml5.css') }}">
<link rel="stylesheet" href="{{ asset('dist/css/prettify.css') }}">
<link rel="stylesheet" href="{{ asset('dist/lib/css/wysiwyg-color.css') }}"> --}}
<link rel="stylesheet" href="http://bank-branche.herokuapp.com/assets/plugins/html5-editor/bootstrap-wysihtml5.css" />


{{-- <link rel="stylesheet" href= "http://bank-branche.herokuapp.com/assets/plugins/html5-editor/bootstrap-wysihtml5.css" /> --}}
<style>
    .comment_reason {
        display: none;
    }

    .select2-container {
        width: 100% !important;
    }

    #sectors,
    #projects {
        background-color: #EEE;
        /* padding: 10px 30px; */
        width: 100%;
        height: 40px;
        line-height: 40px;
        padding-right: 20px;
        font-size: 14px;
    }
</style>
@endsection

{{-- Page content --}}
@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <h1> @lang('site.projects')</h1>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"> @lang('site.Home')</a></li>
                    <li class="breadcrumb-item active"> @lang('site.projects')</li>
                </ol>
            </div>
        </div>
    </div>
</section>

@if (session('success'))
<div class="col-sm-12">
    <div class="alert  alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endif

@if (session('error'))
<div class="col-sm-12">
    <div class="alert  alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endif

<section class="content service-content purchase-order @if ($currentLanguage == " ar") text-right @else text-left @endif">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row mb-3">
                    <div class="col-12 d-flex justify-content-between">
                        <a href="{{ route('projects.create') }}" class="btn btn-success header-btn ">
                            @lang('site.add_project')</a>
                    </div>
                </div>
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr style="text-align:center;">
                                    <th> @lang('site.id')</th>
                                    <th> @lang('site.name_project') @lang('site.en') </th>
                                    <th> @lang('site.name_project') @lang('site.ar') </th>
                                    <th> @lang('site.items') </th>
                                    <th> @lang('site.business_nature') </th>

                                    <th> @lang('site.type') </th>
                                    <th> @lang('site.code') </th>
                                    <th> @lang('site.actions') </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                ?>
                                @foreach($projects as $project)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$project->name_en}}</td>
                                    <td>{{$project->name_ar}}</td>
                                    <td>{{$project->item->name_ar}}</td>
                                    <td>{{$project->businessNature->name_ar}}</td>

                                    <td>@lang("site.$project->type")</td>
                                    <td>{{$project->code}}</td>
                                    <td>
                                        {{-- <a href="{{route("projects.edit",$project->id)}}" class="btn btn-sm btn-info">
                                        <i class="fa fa-eye"></i>
                                        </a> --}}
                                        <a href="{{route("projects.edit",$project->id)}}" class="btn btn-sm btn-success">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <!-- <a href="{{route("projects.delete",$project->id)}}" class="btn btn-sm btn-danger">
                                            <i class="fa fa-trash"></i></a> -->
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</section>


@endsection

{{-- Custom scripts --}}
@section('scripts')
{{-- select 2 --}}
<script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
<script src="{{ asset('plugins/jquery/shake.js') }}"></script>
{{-- <script src="{{ asset('dist/js/wysihtml5-0.3.0.min.js') }}"></script>
<script src="{{ asset('dist/js/bootstrap-wysihtml5.js') }}"></script>
<script src="{{ asset('dist/js/prettify.js') }}"></script> --}}

<script src="http://bank-branche.herokuapp.com/assets/plugins/html5-editor/wysihtml5-0.3.0.js"></script>
<script src="http://bank-branche.herokuapp.com/assets/plugins/html5-editor/bootstrap-wysihtml5.js"></script>

@endsection