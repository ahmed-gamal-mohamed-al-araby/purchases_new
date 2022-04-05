@php
$currentLanguage = app()->getLocale();
@endphp
@extends("layouts.app")
@php
$currentLang = Config::get('app.locale');
@endphp
@section('title')
    @lang('site.report_discount_taxes')
@endsection

@section('styles')
    {{-- select 2 --}}
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

@section('content')
    <section class="content-header prequestHeader">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-12 d-flex justify-content-between">
                    <h1>
                        @lang('site.report_discount_taxes')
                    </h1>

                    {{-- </div>
                <div class="col-md-6"> --}}
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">
                            @lang('site.report_discount_taxes')
                        </li>
                        <li class="breadcrumb-item active"> <a href="{{ route('reports.index') }}">@lang('site.reports')
                            </a> </li>
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"> @lang('site.Home')</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="card">
        <h5 class="card-header bg-success text-center">
            @lang('site.report_discount_taxes') <span id="total-number"></span>
        </h5>
        <div class="card-body">
            {{-- Date section --}}
            <div class="row date">
                <div class="col-md-6 mb-3 textDirection">
                    <label for="type" class="form-label">@lang('site.from_date')</label>
                    <input type="date" name="from_date" id="from_date" class="d-block w-100 form-control"
                        placeholder="@lang('site.date')" data-date-format="DD/MM/YYYY"
                        oninvalid="this.setCustomValidity('@lang('site.please') @lang('site.enter') @lang('site.from_date')')"
                        oninput="setCustomValidity('')" required>
                    <div class="col-12 text-center text-danger d-none date-overflow">
                        @lang('site.date_overflow')</div>
                    <div class="text-center text-danger d-none from_date_error">
                        @lang('site.data-required')</div>
                </div>

                <div class="col-md-6 mb-3 textDirection">
                    <label for="type" class="form-label">@lang('site.to_date')</label>
                    <input type="date" name="to_date" id="to_date" class="d-block w-100 form-control"
                        placeholder="@lang('site.date')" data-date-format="DD/MM/YYYY"
                        oninvalid="this.setCustomValidity('@lang('site.please') @lang('site.enter') @lang('site.to_date')')"
                        oninput="setCustomValidity('')" required>
                    <div class="col-12 text-center text-danger d-none date-overflow">
                        @lang('site.date_overflow')</div>
                    <div class="text-center text-danger d-none to_date_error">
                        @lang('site.data-required')</div>
                </div>

                <div class="col-md-6 mb-3 textDirection m-auto">
                    <label for="type" class="form-label">@lang('site.up_to_date')</label>
                    <input type="date" name="up_to_date" id="up_to_date" class="d-block w-100 form-control"
                        placeholder="@lang('site.up_to_date')" data-date-format="DD/MM/YYYY"
                        oninvalid="this.setCustomValidity('@lang('site.please') @lang('site.enter') @lang('site.to_date')')"
                        oninput="setCustomValidity('')" required>
                    <div class="col-12 text-center text-danger d-none date-overflow">
                        @lang('site.date_overflow')</div>
                    <div class="text-center text-danger d-none to_date_error">
                        @lang('site.data-required')</div>
                </div>
                <div class="col-12 text-center text-danger d-none" id="from-date-greater-than-to-date">
                    @lang('site.from_date_greater_than_to_date')</div>
            </div>

            {{-- Client section --}} {{-- d-none as check kareem --}}
            <div class="row mb-3 date d-none">
                {{-- Purchase Order Client Type --}}
                <div class="col-md-3 col-12 textDirection">
                    <div class="input-group mb-3">
                        <label class="form-label d-block w-100 textDirection"
                            id="order_label">@lang('site.client_type')</label>
                        <select id='client_type' name="client_type" class="form-control require">
                            <option selected disabled>@lang('site.select') @lang('site.client_type')
                            </option>
                            <option value="b" data-label="@lang('site.tax_id_number_only')"
                                data-validate="@lang('site.validate_Tax_id_number')">
                                @lang('site.the_businessClient')</option>
                            <option value="p" data-label="@lang('site.national_id')"
                                data-validate="@lang('site.validate_national_id')">
                                @lang('site.person_client')</option>
                            <option value="f" data-label="@lang('site.vat_id')"
                                data-validate="@lang('site.validate_vat_id')">
                                @lang('site.foreigner_client')</option>
                        </select>
                    </div>
                    @error('client_type')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Foreiner Client --}}
                <div class="col-md-9 col-12 textDirection">

                    <div class="card-body p-0 client-details d-none">
                        <div class="row">
                            <div class="col-md-9 col-12 no-gutters">
                                {{-- tax_id_number for business client Or national ID person client --}}
                                <div class="row no-gutters">
                                    <div class="col-md-11 col-12 input-group">
                                        <label
                                            class="form-label d-block w-100 textDirection">@lang('site.client_name')</label>
                                        <select id='client_name' style="width: 100%" class="form-control rounded require"
                                            disabled>
                                            <option selected disabled>@lang('site.select')
                                                @lang('site.client_name')
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-1 bank-spinner pl-0" style="padding:32px 0 0 10px">
                                        <div class="search-bank spinner-border spinner-border-sm text-success"
                                            role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- name --}}
                            <div class="col-md-3 col-12 mb-1">
                                <label for="tax_id_number_or_national_id_or_vat_id" class="form-label w-100 textDirection"
                                    id="min_payment_label">@lang('site.tax_id_number_only') </label>
                                <input type="text" id="tax_id_number_or_national_id_or_vat_id" class="display w-100"
                                    readonly>
                            </div>

                            <input type="hidden" name="client_id" id="client_id">

                            <p class="col-12 text-danger font-weight-bolder d-none pl-2"></p>

                        </div> <!-- End Of First Row-->

                    </div> <!-- End Of Card Body-->

                </div>
            </div>

            <div class="row date justify-content-center">
                <div class="col-md-6 textDirection" style="margin-top: 29px">

                    <a class="btn btn-success w-100 mb-2 eventBtu" type="button">@lang('site.create_report')</a>
                </div>
            </div>

            {{-- Client Analysis Report --}}
            <div class="card date textDirection table-card ">
                <div class="card-body" id="Table_se">

                </div>
            </div>

            {{-- Currency Table --}}
            <div class="card date textDirection table-card d-none">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="currencyTable" class="table table-bordered table-striped text-center date"
                            @if ($currentLang == 'ar') style="direction: rtl; text-align: right" @endif>
                            <thead>
                                <tr>
                                    <th>
                                        @lang('site.currency')
                                    </th>
                                    <th>
                                        @lang('site.total')
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Loader for loading purchase order items from excel sheet --}}
    <div class="loader-container" style="display: none">
        <div class="bouncing-loader">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

@endsection
@section('scripts')
    {{-- select 2 --}}
    <script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery/shake.js') }}"></script>

    <script src="{{ asset('plugins/datatables-buttons/js/jquery-3.5.1.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/1.11.5/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/2.2.2/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/2.2.2/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/2.2.2/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/2.2.2/buttons.print.min.js') }}"></script>

    <script src="http://bank-branche.herokuapp.com/assets/plugins/html5-editor/wysihtml5-0.3.0.js"></script>
    <script src="http://bank-branche.herokuapp.com/assets/plugins/html5-editor/bootstrap-wysihtml5.js"></script>
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>

    

    <script>
        $(".eventBtu").click(function(e) {
            var from_date = $("#from_date").val();
            var to_date = $("#to_date").val();
            var up_to_date = $("#up_to_date").val();

            $.ajax({
                url: "{{ route('reports.discount_taxes.ajax') }}",
                type: "post",
                data: {
                    _token: '{{ csrf_token() }}',
                    from_date: from_date,
                    to_date: to_date,
                    up_to_date: up_to_date
                },
                success: function(data) {
                    $("#Table_se").html(data);
                }
            });
        });
    </script>


   

    <script>
        let language = [];
        language['send_data'] = "@lang('site.send_data')";
        language['create_report'] = "@lang('site.create') @lang('site.report')";
    </script>

{{-- Date section --}}
    <script>
        // Validate the entered date not greater than today
        (function() {
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth() + 1; //January is 0 so need to add 1 to make it 1!
            var yyyy = today.getFullYear();
            if (dd < 10) {
                dd = '0' + dd
            }
            if (mm < 10) {
                mm = '0' + mm
            }
            today = yyyy + '-' + mm + '-' + dd;
            $("#to_date").attr("max", today);
            $("#from_date").attr("max", today);
        }());
        $("#to_date").on('change', function() {
            $('#to_date').val() ? $('.to_date_error').addClass('d-none') : $('.to_date_error').removeClass(
                'd-none');
            const toDate = $(this).val();
            if ($(this).val() && ($(this).val() > $(this).attr('max') || ($(this).attr('min') && $(this).val() < $(
                    this).attr('min')))) {
                $(this).val('');
                $(this).addClass('is-invalid').next().removeClass('d-none');
                return;
            } else {
                $(this).removeClass('is-invalid').next().addClass('d-none');
            }
            // Validate another
            $("#from_date").attr("max", toDate);
            if ($("#from_date").val() && $("#from_date").val() > $(this).val()) {
                $("#from_date").val('');
                // $("#from_date").addClass('is-invalid');
                $('#from-date-greater-than-to-date').removeClass('d-none');
            } else {
                $('#from-date-greater-than-to-date').addClass('d-none');
            }
        })
        $('#from_date').on('change', function() {
            $('#from_date').val() ? $('.from_date_error').addClass('d-none') : $('.from_date_error').removeClass(
                'd-none');
            const fromDate = $(this).val();
            if ($(this).val() && ($(this).val() > $(this).attr('max') || ($(this).attr('min') && $(this).val() < $(
                    this).attr('min')))) {
                $(this).val('');
                $(this).addClass('is-invalid').next().removeClass('d-none');
                return;
            } else {
                $(this).removeClass('is-invalid').next().addClass('d-none');
            }
            // Validate another
            $("#to_date").attr("min", fromDate);
            if ($("#to_date").val() && $("#to_date").val() < $(this).val()) {
                $("#to_date").val('');
                // $("#to_date").addClass('is-invalid');
                $('#from-date-greater-than-to-date').removeClass('d-none');
            } else {
                $('#from-date-greater-than-to-date').addClass('d-none');
            }
        })
    </script>


    {{-- Submit section --}}
    <script>
        $('#deduction_id').on('change', function() {
            $('.deduction_id_error').addClass('d-none');
        })
        $('[type="submit"]').on('click', function() {
            if (validate()) {
                submit();
            }
        })
        function validate() {
            $('#from_date').val() ? $('.from_date_error').addClass('d-none') : $('.from_date_error').removeClass('d-none');
            $('#to_date').val() ? $('.to_date_error').addClass('d-none') : $('.to_date_error').removeClass('d-none');
            return $('#from_date').val() && $('#to_date').val();
        }
        function prepareDataToSubmit() {
            return {
                'fromDate': $('#from_date').val() || null,
                'toDate': $('#to_date').val() || null,
                // 'clientType': $('#client_type').val() || null,
                // 'clientId': $('#client_id').val() || null,
            }
        }
        function submit() {
            $('[type="submit"]').text(language['send_data']);
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var data = prepareDataToSubmit();
            let ajaxURL = `${subFolderURL}/${urlLang}/reports/client-analysis`;
            let ajaxMethod = 'post';
            // $('[type="submit"]').css("pointer-events", "none");
            // $('.loader-container').fadeIn();
            $.ajax({
                url: ajaxURL,
                type: ajaxMethod,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: JSON.stringify(data),
                contentType: 'application/json; charset=utf-8',
                dataType: 'json',
                success: function(clients) {
                    resetTable();
                    $('[type="submit"]').text(language['create_report']);
                    $('[type="submit"]').css("pointer-events", "auto");
                    let summationMap = new Map();
                    summationMap.set('EGP', 0);
                    clients.forEach((client, index) => {
                        const newRow = $('<tr></tr>');
                        newRow.append($(`<td>${index+1}</td>`));
                        newRow.append($(`<td>${client.name}</td>`));
                        newRow.append($(`<td>${client.taxId_NId_VId}</td>`));
                        newRow.append($(`<td>${client.documents}</td>`));
                        newRow.append($(
                            `<td>${client.currency == 'EGP' ? client.documentTotalwithoutTaxes.toLocaleString('us', { minimumFractionDigits: 2, maximumFractionDigits: 20 }) : '_'}</td>`
                        ));
                        newRow.append($(
                            `<td>${client.currency == 'EGP' ? client.documentTaxes.toLocaleString('us', { minimumFractionDigits: 2, maximumFractionDigits: 20 }) : '_'}</td>`
                        ));
                        newRow.append($(
                            `<td>${client.currency == 'EGP' ? client.documentTotalwithTaxes.toLocaleString('us', { minimumFractionDigits: 2, maximumFractionDigits: 20 }) : '_'}</td>`
                        ));
                        newRow.append($(`<td>${client.currency}</td>`));
                        newRow.append($(
                            `<td>${client.currency != 'EGP' ?client.documentTotalwithoutTaxes.toLocaleString('us', { minimumFractionDigits: 2, maximumFractionDigits: 20 }) : '_'}</td>`
                        ));
                        if (!summationMap.has(client.currency))
                            summationMap.set(client.currency, 0); // initialize new currency
                        summationMap.set(client.currency, (+(Number(summationMap.get(client.currency) +
                            client.documentTotalwithoutTaxes)))); // update summation
                        $("#clientAnalysis_report tbody").append(newRow);
                    });
                    $('#total-number').text(
                        `( ${summationMap.get('EGP').toLocaleString('us', { minimumFractionDigits: 2, maximumFractionDigits: 20 })} )`
                    );
                    $('.table-card').removeClass('d-none');
                    runDataTable();
                    $('.loader-container').fadeOut(250);
                    // Currency table
                    $("#currencyTable tbody").html('');
                    summationMap.forEach(function(value, key) {
                        if (key == 'EGP' && value == 0) {
                            if (summationMap.size == 1) {
                                $('#currencyTable').parents('.table-card').addClass('d-none');
                            }
                            return;
                        }
                        const newCurrencyRow = $('<tr></tr>');
                        newCurrencyRow.append($(`<td>${key}</td>`));
                        newCurrencyRow.append($(
                            `<td>${value.toLocaleString('us', { minimumFractionDigits: 2, maximumFractionDigits: 20 })}</td>`
                        ));
                        $("#currencyTable tbody").append(newCurrencyRow);
                    });
                },
            });
        }
        // Add Arabic Font To Data Tables
        pdfMake.fonts = {
            Cairo: {
                normal: "{{ asset('plugins/fonts/Cairo/Cairo-Regular.ttf') }}",
                bold: "{{ asset('plugins/fonts/Cairo/Cairo-SemiBold.ttf') }}",
                italics: "{{ asset('plugins/fonts/Cairo/Cairo-Light.ttf') }}",
                bolditalics: "{{ asset('plugins/fonts/Cairo/Cairo-ExtraLight.ttf') }}"
            },
            // download default Roboto font from cdnjs.com
            Roboto: {
                normal: 'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/fonts/Roboto/Roboto-Regular.ttf',
                bold: 'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/fonts/Roboto/Roboto-Medium.ttf',
                italics: 'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/fonts/Roboto/Roboto-Italic.ttf',
                bolditalics: 'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/fonts/Roboto/Roboto-MediumItalic.ttf'
            },
        }
    </script>
@endsection
