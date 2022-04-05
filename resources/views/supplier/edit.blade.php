@php
$currentLanguage = app()->getLocale();
@endphp

@extends("layouts.app")

{{-- Custom Title --}}
@section('title')
@lang('site.Add') @lang('site.supplier')
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
                <h1> @lang('site.edit_supplier')</h1>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"> @lang('site.Home')</a></li>
                    <li class="breadcrumb-item"><a href="">
                            @lang('site.suppliers')</a>
                    </li>
                    <li class="breadcrumb-item active"> @lang('site.edit_supplier')</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content service-content purchase-order
        @if ($currentLanguage == " ar") text-right @else text-left @endif">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="form-layout mb-3">



                    {{-- Items per purchase request --}}
                    <div class="card mt-3">
                        <div class="card-header">
                            <h5>@lang('site.info_supplier')</h5>
                        </div>
                        <div class="card-body">
                            <div id="items_table" class="table">
                                <form action="{{route("supplier.update",$supplier->id)}}" id="" class="form" autocomplete="off" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">
                                                    @lang("site.name_supplier") @lang("site.en")
                                                </label>
                                                <input type="text" value="{{$supplier->name_en}}" name="name_en" class="form-control" id="">
                                                @error('name_en')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">
                                                    @lang("site.name_supplier") @lang("site.ar")
                                                </label>
                                                <input type="text" value="{{$supplier->name_ar}}" name="name_ar" class="form-control" id="">
                                                @error('name_ar')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">
                                                    @lang("site.type")
                                                </label>
                                                <select name="type" id="" class="form-control supplier_type">
                                                    <option value="">@lang("site.choose")</option>
                                                    <option value="company" @if ($supplier->type == "company")
                                                        selected
                                                        @endif>شركه</option>
                                                    <option value="person" @if ($supplier->type == "person")
                                                        selected
                                                        @endif>فرد</option>

                                                        <option value="import" @if ($supplier->type == "import")
                                                        selected
                                                        @endif>استيراد</option>

                                                </select>
                                                @error('type')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">
                                                    @lang("site.nat_tax_number")
                                                </label>
                                                <input type="text" value="{{$supplier->nat_tax_number}}" name="nat_tax_number" class="form-control nat_tax_number" id="">
                                                @error('nat_tax_number')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <button type="submit" class="btn btn-success btn-sm">@lang("site.save")</button>
                                </form>
                            </div>
                        </div>
                    </div>



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

        window.onload = function() {
            $supplier_type = $(".supplier_type").val();
            if($supplier_type == "company") {
            $(".nat_tax_number").attr("maxlength" , 9);
        }  else if($supplier_type == "person") {
            $(".nat_tax_number").attr("maxlength" , 14);
        } else {
            $(".nat_tax_number").attr("maxlength" , '');
        }
        };

    $(".supplier_type").on("change", function() {
        $supplier_type = $(".supplier_type").val();
        if($supplier_type == "company") {
            $(".nat_tax_number").attr("maxlength" , 9);
        }  else if($supplier_type == "person") {
            $(".nat_tax_number").attr("maxlength" , 14);
        } else {
            $(".nat_tax_number").attr("maxlength" , '');
        }
    });
</script>
@endsection