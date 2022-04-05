@extends('layouts.app')
{{-- Custom Title --}}
@section('title')
@lang('site.dashboard')
@endsection
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">@lang('site.dashboard')</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    {{-- <li class="breadcrumb-item"><a href="{{ route('home') }}"> @lang('site.Home')</a></li> --}}
                    <li class="breadcrumb-item active">@lang('site.dashboard')</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            {{-- items --}}
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $count['items'] }}</h3>

                        <p>@lang('site.items')</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fas fa-border-all"></i>
                    </div>
                    <a href="{{ route('items.index') }}" class="small-box-footer">@lang('site.more_info') <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            {{-- businessNatures --}}
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $count['businessNatures'] }}</h3>

                        <p>@lang('site.business_nature')</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fas fa-border-all"></i>
                    </div>
                    <a href="{{ route('businessNature.index') }}" class="small-box-footer">@lang('site.more_info') <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            {{-- projects --}}
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $count['projects'] }}</h3>

                        <p>@lang('site.projects')</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fas fa-border-all"></i>
                    </div>
                    <a href="{{ route('projects.index') }}" class="small-box-footer">@lang('site.more_info') <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            {{-- natureDealings --}}
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $count['natureDealings'] }}</h3>

                        <p>@lang('site.nature_dealing')</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fas fa-border-all"></i>
                    </div>
                    <a href="{{ route('natureDealing.index') }}" class="small-box-footer">@lang('site.more_info') <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            {{-- suppliers --}}
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $count['suppliers'] }}</h3>

                        <p>@lang('site.suppliers')</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fas fa-border-all"></i>
                    </div>
                    <a href="{{ route('supplier.index') }}" class="small-box-footer">@lang('site.more_info') <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            {{-- discountTypes --}}
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $count['discountTypes'] }}</h3>

                        <p>@lang('site.discount_type')</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fas fa-border-all"></i>
                    </div>
                    <a href="{{ route('discountType.index') }}" class="small-box-footer">@lang('site.more_info') <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            {{-- banks --}}
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $count['banks'] }}</h3>

                        <p>@lang('site.banks')</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fas fa-border-all"></i>
                    </div>
                    <a href="{{ route('bank.index') }}" class="small-box-footer">@lang('site.more_info') <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            {{-- users --}}
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $count['users'] }}</h3>

                        <p>@lang('site.users')</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fas fa-border-all"></i>
                    </div>
                    <a href="" class="small-box-footer">@lang('site.more_info') <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            {{-- invoices --}}
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $count['invoices'] }}</h3>

                        <p>@lang('site.invoices')</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fas fa-border-all"></i>
                    </div>
                    <a href="{{ route('invoice.index') }}" class="small-box-footer">@lang('site.more_info') <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            {{-- invoices reviewed --}}
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $count['invoices_reviewed'] }}</h3>

                        <p>@lang('site.invoices') @lang('site.reviewed')</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fas fa-border-all"></i>
                    </div>
                    <a href="{{ route('invoice.index') }}" class="small-box-footer">@lang('site.more_info') <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            
            {{-- paymentInvoices --}}
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $count['paymentInvoices'] }}</h3>

                        <p>@lang('site.payment')</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fas fa-border-all"></i>
                    </div>
                    <a href="{{ route('paymentInvoice.index') }}" class="small-box-footer">@lang('site.more_info') <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

           
            {{-- paymentInvoices reviewed --}}
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $count['paymentInvoices_reviewed'] }}</h3>

                        <p>@lang('site.payment') @lang('site.reviewed')</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fas fa-border-all"></i>
                    </div>
                    <a href="{{ route('paymentInvoice.index') }}" class="small-box-footer">@lang('site.more_info') <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
           
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
@endsection
