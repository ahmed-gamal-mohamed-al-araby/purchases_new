@php
$currentLanguage = app()->getLocale();
@endphp

@extends("layouts.app")

{{-- Custom Title --}}
@section('title')
@lang('site.payment')
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
                <h1> @lang('site.payment')</h1>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"> @lang('site.Home')</a></li>
                    <li class="breadcrumb-item active"> @lang('site.payment')</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content service-content purchase-order @if ($currentLanguage == " ar") text-right @else text-left @endif">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row mb-3">
                    <div class="col-12 d-flex justify-content-between">
                        <a href="{{ route('paymentInvoice.create') }}" class="btn btn-success header-btn ">
                            @lang('site.add_payment')</a>
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
                                    <th> @lang('site.value_payment') </th>
                                    <th> @lang('site.payment_date') </th>
                                    <th> @lang('site.payment_method') </th>
                                    <th> @lang('site.cheque_number') </th>
                                    <th> @lang('site.status') </th>
                                    <th> @lang("site.actions")</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($paymentInvoices as $index => $paymentInvoice)
                                <tr>
                                    <td>{{$index+1}}</td>

                                    <td>{{$paymentInvoice->supplier['name_'.$currentLanguage]}}</td>
                                  
                                    @if ($paymentInvoice->project_id )
                                    <td>{{$paymentInvoice->project['name_'.$currentLanguage]}}</td>
                                    @else
                                    <td></td>
                                    @endif
                                    <td>{{number_format($paymentInvoice->value, 2)}}</td>
                                    <td>{{$paymentInvoice->date_payment}}</td>

                                    <td>@lang("site.$paymentInvoice->payment_method")</td>
                                    <td>{{$paymentInvoice->cheque_number}}</td>                                   
                                     @if(Auth::user()->id == 11)
                                    <td>
                                        @if (!$paymentInvoice->date_delivery_out && !$paymentInvoice->recipient_name_out )
                                        <span class="text-danger">@lang('site.wait_receive') </span>
                                        @else
                                        <span class="text-success">@lang('site.receive')</span>
                                        @endif
                                    </td>
                                    @else
                                    <td>
                                        @if ($paymentInvoice->approved == 0 )
                                        <span class="text-danger">@lang('site.reviewing') </span>
                                        @else
                                        <span class="text-success">@lang('site.reviewed')</span>
                                        @endif
                                    </td>
                                    @endif
                                    <td>
                                        <a href="{{route("paymentInvoice.show",$paymentInvoice->id)}}" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        @if ($paymentInvoice->approved == 0 || $paymentInvoice->user_id == Auth::user()->id)
                                        <a href="{{route("paymentInvoice.edit",$paymentInvoice->id)}}" class="btn btn-sm btn-success">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        @endif
                                       
                                        @if(Auth::user()->id == 2 || Auth::user()->id == 12 || Auth::user()->id == 13)

                                        <a href="{{route("payment.delete",$paymentInvoice->id)}}" class="btn btn-sm btn-danger">
                                            <i class="fa fa-trash"></i></a>
                                        @endif

                                        @if(Auth::user()->id == 12 || Auth::user()->id == 13 )
                                        @if($paymentInvoice->approved==0)

                                        <a class="btn btn-success" href="{{route("approve_payment",$paymentInvoice->id)}}" role="button">Approve</a>
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