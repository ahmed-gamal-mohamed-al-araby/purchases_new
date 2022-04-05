@php
$currentLanguage = app()->getLocale();
@endphp
@extends("layouts.app-new")
@php
$currentLang = Config::get('app.locale');
@endphp
@section('title')
    @lang('site.account_statement')
@endsection

@section('styles')
    {{-- select 2 --}}

    <link rel="stylesheet" href="{{ asset('plugins/tablesorter/css/theme.materialize.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">


<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.dataTables.min.css') }}">

    <link rel="stylesheet" href="http://bank-branche.herokuapp.com/assets/plugins/html5-editor/bootstrap-wysihtml5.css" />
    @if (Config::get('app.locale') == 'ar')
    <style>
        .date {
            direction: rtl !important;
        }


        .textDirection {
            text-align: right !important;
        }
        .flex_dir {
            flex-direction: row-reverse;
        }
        .select2-container {
            text-align: right !important;
        }
        div.dataTables_wrapper div.dataTables_filter {
            float: left;
        }

        .data_content {
            width: 29%;
            position: absolute;
            top: 61px;
            right: 142px;
            display: none;
        }

        #ShowData {
        position: relative;}

        .data_content ul li {
            background-color: #226130!important;
            border-bottom: 1px solid #ffffff38;
            padding: 5px 8px;
            cursor: pointer;
        }

        .data_content ul li  a {
            text-decoration: none;
            color: #FFF !important;
        }

        .data_content ul li.active {
            background-color: #FFF !important;
            border-bottom: 1px solid #226130;
        }

        .data_content ul li.active a {
            color: #000 !important;
        }

    </style>
@endif
@endsection

{{-- Page content --}}
@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <h1>@lang('site.account_statement')</h1>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"> @lang('site.Home')</a></li>
                    <li class="breadcrumb-item active"> @lang('site.account_statement')</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content service-content purchase-order
        @if ($currentLanguage == 'ar') text-right @else text-left @endif">

    {{-- Date section --}}
    <div class="row date">
        <div class="col-md-6 mb-3 textDirection">
            <label for="type" class="form-label">@lang('site.from_date')</label>
            <input type="date" name="from_date" id="from_date" class="d-block w-100 form-control" placeholder="@lang('site.date')" data-date-format="DD/MM/YYYY" oninvalid="this.setCustomValidity('@lang(" site.please") @lang("site.enter") @lang("site.from_date")')" oninput="setCustomValidity('')" required>
            <div class="col-12 text-center text-danger d-none date-overflow">
                @lang('site.date_overflow')</div>
            <div class="text-center text-danger d-none from_date_error">
                @lang('site.data-required')</div>
        </div>

        <div class="col-md-6 mb-3 textDirection">
            <label for="type" class="form-label">@lang('site.to_date')</label>
            <input type="date" name="to_date" id="to_date" class="d-block w-100 form-control" placeholder="@lang('site.date')" data-date-format="DD/MM/YYYY" oninvalid="this.setCustomValidity('@lang('site.please') @lang('site.enter') @lang('site.to_date')')" oninput="setCustomValidity('')" required>
            <div class="col-12 text-center text-danger d-none date-overflow">
                @lang('site.date_overflow')</div>
            <div class="text-center text-danger d-none to_date_error">
                @lang('site.data-required')</div>
        </div>

        <div class="col-md-6 mb-3 textDirection m-auto">
            <div class="form-group">
                <label for="">
                    @lang("site.supplier")
                </label>
                <select name="supplier_id" class="custom-select supplier_name" id="supplier">
                    <option></option>
                    @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" data-toggle="tooltip" data-placement="top" title="Supplier Name" @if (old('supplier_id')==$supplier->id) {{ 'selected' }} @endif>
                        {{ $supplier['name_' . $currentLanguage] }}
                    </option>
                    @endforeach
                </select>

                @error('supplier_id')
                <div class="text-danger">{{ $message }}
                </div>
                @enderror

            </div>
        </div>

    </div>

    <div class="row date justify-content-center">
        <div class="col-md-6 textDirection" style="margin-top: 29px">

            <a class="btn btn-success w-100 mb-2 eventBtu" type="button">@lang('site.create_report')</a>
        </div>
    </div>

    {{-- supplier Analysis Report --}}
    <div class="card date textDirection table-card ">
        <div class="card-body" id="Table_se">

        </div>
    </div>

</section>

@endsection
@section('scripts')

<script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>


<script>
    $('.supplier_name').select2({
        placeholder: "@lang('site.choose') @lang('site.supplier')"
    });

</script>

<script>
    $(".eventBtu").click(function(e) {
        var from_date = $("#from_date").val();
        var to_date = $("#to_date").val();
        var supplier_id = $("#supplier").val();
        console.log("123")
        $.ajax({
            url: "{{ route('report_supplier_statment_ajax') }}",
            type: "post",
            data: {
                _token: '{{ csrf_token() }}',
                from_date: from_date,
                to_date: to_date,
                supplier_id: supplier_id

            },
            success: function(data) {
                $("#Table_se").html(data);



            }
        });
    });
</script>

<script src="{{ asset('plugins/datatables-buttons/js/jquery-3.5.1.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/1.11.5/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/2.2.2/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/2.2.2/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/2.2.2/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/2.2.2/buttons.print.min.js') }}"></script>

@endsection
