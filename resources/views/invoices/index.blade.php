@php
$currentLanguage = app()->getLocale();
@endphp

@extends("layouts.app")

{{-- Custom Title --}}
@section('title')
@lang('site.invoices')
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
                <h1> @lang('site.invoices')</h1>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"> @lang('site.Home')</a></li>
                    <li class="breadcrumb-item active"> @lang('site.invoices')</li>
                </ol>
            </div>
        </div>
    </div>
</section>

@if (count($errors) > 0)
<div class="row">
    <div class="col-md-8 col-md-offset-1">
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> Error!</h4>
            @foreach($errors->all() as $error)
            {{ $error }} <br>
            @endforeach
        </div>
    </div>
</div>
@endif

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

                <div class="row mb-4">
                    <div class="position-relative">

                        <form action="{{ route('importinvoice') }}" method="POST" enctype="multipart/form-data" class="d-flex">
                            @csrf
                            <input type="file" name="file" style="height: 30px !important">

                            <button class="btn btn-info" style="margin-left: -60px" title="Import supplier">
                                <i class="fas fa-cloud-upload-alt fa-2x"></i> </button>
                        </form>

                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12 d-flex justify-content-between">
                        <a href="{{ route('invoice.create') }}" class="btn btn-success header-btn ">
                            @lang('site.add_invoice')</a>
                    </div>
                </div>

                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr style="text-align:center;">
                                    <th> @lang('site.id')</th>
                                    <th> @lang('site.name_supplier') </th>
                                    <th> @lang('site.name_project') </th>
                                    <th> @lang('site.invoice_number') </th>
                                    <th> @lang('site.detection_number') </th>
                                    <th> @lang('site.restrained_type') </th>
                                    <th> @lang('site.expense_type') </th>
                                    <th> @lang('site.nature_dealing') </th>
                                    <th> @lang('site.date_invoice') </th>
                                    <th> @lang('site.net_total_after_business_insurance') </th>
                                    <th> @lang('site.status') </th>
                                    <th> @lang("site.actions")</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($invoices as $index => $invoice)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$invoice->supplier['name_'.$currentLanguage]}}</td>
                                    @if ($invoice->project_id )


                                    <td>{{$invoice->project['name_'.$currentLanguage]}}</td>
                                    @else
                                    <td></td>
                                    @endif

                                    <td>{{$invoice->invoice_number}}</td>
                                    <td>{{$invoice->detection_number}}</td>
                                    <td>@lang("site.$invoice->restrained_type")</td>
                                    <td>@lang("site.$invoice->expense_type")</td>

                                    @if ($invoice->nature_dealing_id )
                                    <td>{{$invoice->natureDealing['name_'.$currentLanguage]}}</td>
                                    @else
                                    <td></td>
                                    @endif
                                    <td>{{\Carbon\Carbon::parse($invoice->date_invoice)->format('d/m/Y')}}</td>
                                    @if ($invoice->net_total )
                                    <td>{{$invoice->net_total_after_business_insurance}}</td>
                                    @else
                                    <td>{{$invoice->total}}</td>
                                    @endif
                                    <td>
                                        @if ($invoice->approved == 0)
                                        <span class="text-danger"> @lang('site.reviewing')</span>
                                        @else
                                        <span class="text-success"> @lang('site.reviewed')</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route("invoice.show",$invoice->id)}}" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        @if ($invoice->approved == 0 || $invoice->user_id == Auth::user()->id || Auth::user()->id == 12 || Auth::user()->id == 13)
                                        <a href="{{route("invoice.edit",$invoice->id)}}" class="btn btn-sm btn-success">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        @endif

                                        @if(Auth::user()->id == 12 || Auth::user()->id == 13 || Auth::user()->id == 2)

                                        <a href="{{route("invoice.delete",$invoice->id)}}" class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash"></i></a>
                                        @endif

                                        @if(Auth::user()->id == 12 || Auth::user()->id == 13 )
                                        @if($invoice->approved==0)
                                       <a class="btn btn-success" href="{{route("approve_invoice",$invoice->id)}}" role="button">Approve</a>
                                       @endif
                                       @endif

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
<script>
    $(document).ready(function() {
        $('#example1').DataTable();
    });
</script>
@endsection
