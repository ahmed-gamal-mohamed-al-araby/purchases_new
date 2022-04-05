@php
$currentLanguage = app()->getLocale();
@endphp

@extends("layouts.app")

{{-- Custom Title --}}
@section('title')
@lang('site.suppliers')
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('dist/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/tablesorter/css/theme.materialize.min.css') }}">

{{-- Loader --}}
<style>
    @keyframes bouncing-loader {
        from {
            opacity: 1;
            transform: translateY(0);
        }

        to {
            opacity: 0.1;
            transform: translateY(-1rem);
        }
    }

    .bouncing-loader {
        display: flex;
        justify-content: center;
    }

    .bouncing-loader>div {
        width: 1rem;
        height: 1rem;
        margin: 3rem 0.2rem;
        background: rgb(4, 182, 4);
        border-radius: 50%;
        animation: bouncing-loader 0.8s infinite alternate;
    }

    .bouncing-loader>div:nth-child(2) {
        animation-delay: 0.2s;
    }

    .bouncing-loader>div:nth-child(3) {
        animation-delay: 0.4s;
    }

    .bouncing-loader>div:nth-child(4) {
        animation-delay: 0.6s;
    }

    .bouncing-loader>div:nth-child(5) {
        animation-delay: 0.8s;
    }

    .loader-container {
        display: grid;
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        border: solid;
        background: rgba(0, 0, 0, 0.8);
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }
</style>

@if (Config::get('app.locale') == 'ar')
<style>
    .dataDirection {
        direction: rtl !important;
    }

    .textDirection {
        text-align: right;
    }

    label {
        float: unset;
        margin-right: unset;
    }

    .payment-method label {
        margin-right: 20px;
    }
</style>
@else
<style>
    .dataDirection {
        direction: ltr !important;
    }

    .textDirection {
        text-align: left;
    }
</style>
@endif

<style>
    #payment_method-error,
    #validate_documents-error {
        display: none !important;
    }

    .client_type_container div.select2-container,
    .client_name_container div.select2-container,
    .purchase_orders_container div.select2-container,
    .documents_container div.select2-container {
        margin: 10px;
        display: block;
        max-width: 60%;
    }

    .my-error {
        width: 100%;
        display: block;
        position: relative;
        text-align: center;
        font-size: 11px;
        color: #ff0000;
    }

    .document-container:nth-child(even) {
        background-color: aliceblue
    }

    #available-numbers {
        position: sticky;
        top: 65px;
        z-index: 10000;
        background-color: #DCDCDC;
    }
</style>

{{-- Custom Styles --}}
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
                <h1> @lang('site.suppliers')</h1>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"> @lang('site.Home')</a></li>
                    <li class="breadcrumb-item active"> @lang('site.suppliers')</li>
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

                        <form action="{{ route('importsupplier') }}" method="POST" enctype="multipart/form-data" class="d-flex">
                            @csrf
                            <input type="file" name="file" style="height: 30px !important">

                            <button class="btn btn-info" style="margin-left: -60px" title="Import supplier">
                                <i class="fas fa-cloud-upload-alt fa-2x"></i> </button>
                        </form>

                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12 d-flex justify-content-between">
                        <a href="{{ route('supplier.create') }}" class="btn btn-success header-btn ">
                            @lang('site.add_supplier')</a>
                    </div>

                </div>

                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">


                      {{-- Table content --}}
                      <div id="table-data" class="table-responsive">
                          @include('supplier.pagination_data', ['pageType' => 'index'])
                      </div>

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


{{-- <script src="{{ asset('dist/js/wysihtml5-0.3.0.min.js') }}"></script>
<script src="{{ asset('dist/js/bootstrap-wysihtml5.js') }}"></script>
<script src="{{ asset('dist/js/prettify.js') }}"></script> --}}
<script src="{{ asset('plugins/tablesorter/js/jquery.tablesorter.combined.js') }}"></script>

<script>
    // Start include pagination script


         $.extend($.tablesorter.defaults, {
            theme: 'materialize',
        });
        $(".sort-table").tablesorter();

        $(document).ready(function() {
    $('#example').DataTable();
} );
</script>
@endsection