<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>EECGroup | لوحة التحكم</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.min.css') }}">
  <link rel="stylesheet" href="{{asset('dist/css/loader.css') }}">

    <link href="https://fonts.googleapis.com/css?family=Cairo:400,700" rel="stylesheet">

    <style>
        body, h1, h2, h3, h4, h5, h6 {
            font-family: 'Cairo', sans-serif !important;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed accent-success" >
<div class="loader">
    <svg viewBox="0 0 1350 600">
        <text x="50%" y="50%" fill="transparent" text-anchor="middle">
            EEC  Group
        </text>

    </svg>
</div>




<div class="wrapper">

    @include('layouts.navbar')
    @include('layouts.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="overlay"></div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">@lang('site.dashboard')</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">@lang('site.dashboard')</li>
              <li class="breadcrumb-item"><a href="{{route('home')}}">@lang('site.home')</a></li>

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
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box  bg-success">
              <div class="inner">
                  @if($count)
                <h3>{{$count}}</h3>
                      <p>@lang('site.all_suppliers')</p>
                  @else
                      <h3 class="dashboard-alert"><i class="fa fa-exclamation"></i></h3>
                      <p>@lang('site.no_suppliers')</p>
                  @endif
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
              @if(auth()->user()->hasPermission("supplier_read"))
                 <a href="{{route('supplier')}}" class="small-box-footer">  @lang('site.details') <i class="fas fa-arrow-circle-right"></i></a>
            @else
            <a  class="small-box-footer" style="height: 33px"> </a>
            @endif
            </div>
          </div>

            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box  bg-warning">
                    <div class="inner">
                        @if($users_count)
                            <h3>{{$users_count}}</h3>
                            <p> @lang('site.all_users')</p>
                        @else
                            <h3 class="dashboard-alert"><i class="fa fa-exclamation"></i></h3>
                            <p> @lang('site.no_users')</p>
                        @endif
                    </div>
                    <div class="icon">
                        <i class="fa fa-users-cog"></i>
                    </div>
                    @if(auth()->user()->hasPermission("users_read"))
                    <a href="{{route('users.index')}}" class="small-box-footer">   @lang('site.details') <i class="fas fa-arrow-circle-right"></i></a>
                    @else
                    <a  class="small-box-footer" style="height: 33px"> </a>
                    @endif
                </div>
            </div>

        </div>
        <!-- /.row -->
        <!-- Info boxes -->
        <div class="row" >


          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3 boxes" dir="rtl">

            @if(auth()->user()->hasPermission("service_read"))
            <a href="{{ route('service.index') }}">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-cogs"></i></span>
              @if($ser_count)
              <div class="info-box-content">
                <span class="info-box-text"> @lang('site.services')</span>
                <span class="info-box-number">{{ $ser_count }}</span>
              </div>
                @else
                    <div class="info-box-content">
                        <span class="info-box-text"><i class="fa fa-exclamation"></i></span>
                        <span class="info-box-number no-item"> @lang('site.no_services')</span>
                      </div>
                @endif
              <!-- /.info-box-content -->
            </div>
        </a>
        @else

            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-cogs"></i></span>
              @if($ser_count)
              <div class="info-box-content">
                <span class="info-box-text"> @lang('site.services')</span>
                <span class="info-box-number">{{ $ser_count }}</span>
              </div>
                @else
                    <div class="info-box-content">
                        <span class="info-box-text"><i class="fa fa-exclamation"></i></span>
                        <span class="info-box-number no-item"> @lang('site.no_services')</span>
                      </div>
                @endif
              <!-- /.info-box-content -->
            </div>

        @endif


            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3 boxes" dir="rtl">

            @if(auth()->user()->hasPermission("product_read"))
            <a href="{{ route('product.index') }}">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-box-open"></i></span>
              @if($pros_count)

              <div class="info-box-content">
                <span class="info-box-text"> @lang('site.products')</span>
                <span class="info-box-number">{{ $pros_count }}</span>
              </div>
                @else
                    <div class="info-box-content">
                        <span class="info-box-text"><i class="fa fa-exclamation"></i></span>
                        <span class="info-box-number no-item" >@lang('site.no_products')</span>
                      </div>
                @endif
              <!-- /.info-box-content -->
            </div>
            </a>
            @else

                <div class="info-box mb-3">
                  <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-box-open"></i></span>
                  @if($pros_count)

                  <div class="info-box-content">
                    <span class="info-box-text"> @lang('site.products')</span>
                    <span class="info-box-number">{{ $pros_count }}</span>
                  </div>
                    @else
                        <div class="info-box-content">
                            <span class="info-box-text"><i class="fa fa-exclamation"></i></span>
                            <span class="info-box-number no-item" >@lang('site.no_products')</span>
                          </div>
                    @endif
                  <!-- /.info-box-content -->
                </div>

            @endif


            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@include('layouts.footer')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{ asset('plugins/sparklines/sparkline.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{ asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{--<script src="{{ asset('dist/js/pages/dashboard.js')}}"></script>--}}
</body>
</html>
