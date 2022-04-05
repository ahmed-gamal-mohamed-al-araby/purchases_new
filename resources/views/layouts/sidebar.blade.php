<!-- Main Sidebar Container -->
@php
$parent = request()->segment(count(request()->segments())) ?? null;
$child = $child ?? null;
@endphp
<aside class="main-sidebar elevation-4 sidebar-light-success">
    <div class="overlay"></div>
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link navbar-success">
        {{-- <img src="../../dist/img/eecgroup-logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
        {{-- <span class="brand-text font-weight-light"></span> --}}
        <h3>EEC <sub> Group </sub></h3>

    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->

        <!-- Sidebar Menu -->

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link ">
                        <i class="fa fa-tachometer-alt nav-icon"></i>
                        <p> @lang('site.dashboard')</p>
                    </a>
                </li>

                <li class="nav-item {{$parent == "paymentInvoice" || $parent == "invoice" ? "menu-is-opening menu-open" : ""}} ">


                    <a href="#" class="nav-link {{$parent == "paymentInvoice" || $parent == "invoice" ? "active" : ""}} ">
                        <i class="nav-icon fas fa-layer-group"></i>
                        <p>
                            @lang("site.invoices")
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>


                    <ul class="nav nav-treeview ">

                        <li class="nav-item">
                            <a href="{{route("paymentInvoice.index")}}" class="nav-link  {{ (request()->routeIs('paymentInvoice.index')) ? 'active' : '' }}">
                                <i class="fa fa-layer-group nav-icon"></i>
                                <p> @lang("site.payment")</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route("invoice.index")}}" class="nav-link  {{ (request()->routeIs('invoice.index')) ? 'active' : '' }}">
                                <i class="fa fa-layer-group nav-icon"></i>
                                <p> @lang("site.invoice")</p>
                            </a>
                        </li>

                        @if(Auth::user()->id == 12 || Auth::user()->id == 13 || Auth::user()->id == 2)

                        <li class="nav-item">
                            <a href="{{route("payment.reviewing")}}" class="nav-link  {{ (request()->routeIs('payment.reviewing')) ? 'active' : '' }}">
                                <i class="fa fa-layer-group nav-icon"></i>
                                <p> @lang("site.payment") @lang('site.reviewing')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route("payment.reviewed")}}" class="nav-link  {{ (request()->routeIs('payment.reviewed')) ? 'active' : '' }}">
                                <i class="fa fa-layer-group nav-icon"></i>
                                <p> @lang("site.payment") @lang('site.reviewed')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route("invoice.reviewing")}}" class="nav-link  {{ (request()->routeIs('invoice.reviewing')) ? 'active' : '' }}">
                                <i class="fa fa-layer-group nav-icon"></i>
                                <p> @lang("site.invoice") @lang('site.reviewing')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route("invoice.reviewed")}}" class="nav-link  {{ (request()->routeIs('invoice.reviewed')) ? 'active' : '' }}">
                                <i class="fa fa-layer-group nav-icon"></i>
                                <p> @lang("site.invoice") @lang('site.reviewed')</p>
                            </a>
                        </li>
                        @endif
                        @if(Auth::user()->id == 11)

                        <li class="nav-item">
                            <a href="{{route("payment.with_receive")}}" class="nav-link  {{ (request()->routeIs('payment.with_receive')) ? 'active' : '' }}">
                                <i class="fa fa-layer-group nav-icon"></i>
                                <p> @lang("site.payment") @lang("site.to_receive")</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route("payment.without_receiving")}}" class="nav-link  {{ (request()->routeIs('payment.without_receiving')) ? 'active' : '' }}">
                                <i class="fa fa-layer-group nav-icon"></i>
                                <p> @lang("site.payment") @lang("site.without_receiving")</p>
                            </a>
                        </li>

                        @endif


                    </ul>



                </li>

                <li class="nav-item {{$parent == "items" || $parent == "businessNature" || $parent == "projects" || $parent == "supplier" || $parent == "discountType" || $parent == "natureDealing" || $parent == "bank" ? "menu-is-opening menu-open" : ""}} ">


                    <a href="#" class="nav-link {{$parent == "items" || $parent == "businessNature" || $parent == "projects" || $parent == "supplier" || $parent == "discountType" || $parent == "natureDealing" || $parent == "bank" ? "active" : ""}} ">
                        <i class="nav-icon fas fa-layer-group"></i>
                        <p>
                            @lang("site.constant")
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>


                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{route("items.index")}}" class="nav-link  {{ (request()->routeIs('items.index')) ? 'active' : '' }}">
                                <i class="fa fa-layer-group nav-icon"></i>
                                <p>@lang("site.items")</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route("businessNature.index")}}" class="nav-link  {{ (request()->routeIs('businessNature.index')) ? 'active' : '' }}">
                                <i class="fa fa-box-open  nav-icon"></i>
                                <p>@lang("site.business_nature")</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route("projects.index")}}" class="nav-link  {{ (request()->routeIs('projects.index')) ? 'active' : '' }}">
                                <i class="fa fa-box-open  nav-icon"></i>
                                <p>@lang("site.projects")</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route("supplier.index")}}" class="nav-link  {{ (request()->routeIs('supplier.index')) ? 'active' : '' }}">
                                <i class="fa fa-box-open  nav-icon"></i>
                                <p>@lang("site.suppliers")</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route("discountType.index")}}" class="nav-link  {{ (request()->routeIs('discountType.index')) ? 'active' : '' }}">
                                <i class="fa fa-box-open  nav-icon"></i>
                                <p>@lang("site.discount_type")</p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="{{route("natureDealing.index")}}" class="nav-link  {{ (request()->routeIs('natureDealing.index')) ? 'active' : '' }}">
                                <i class="fa fa-box-open  nav-icon"></i>
                                <p>@lang("site.nature_dealing")</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route("bank.index")}}" class="nav-link  {{ (request()->routeIs('bank.index')) ? 'active' : '' }}">
                                <i class="fa fa-box-open  nav-icon"></i>
                                <p>@lang("site.banks")</p>
                            </a>
                        </li>


                    </ul>



                </li>

                    <li class="nav-item ">


                    <li class="nav-item {{$parent == "reports" || $parent == "get_supplier_statment" || $parent == "reports_ack_added_value_G_SH" || $parent == "reports_general_conclusions" || $parent == "reports_ack_added_value" || $parent == "reports_discount_taxes"? "menu-is-opening menu-open" : ""}} " >


                        <a href="#" class="nav-link {{$parent == "reports" || $parent == "get_supplier_statment" || $parent == "reports_ack_added_value_G_SH" || $parent == "reports_general_conclusions" || $parent == "reports_ack_added_value" || $parent == "reports_discount_taxes"? "active" : ""}} ">
                            <i class="nav-icon fas fa-layer-group"></i>
                            <p>
                                @lang("site.reports")
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview ">

                            <li class="nav-item">
                                <a href="{{route("reports.index")}}" class="nav-link  {{ (request()->routeIs('reports.index')) ? 'active' : '' }}">
                                    <i class="fa fa-layer-group nav-icon"></i>
                                    <p> @lang("site.reports_general_expenses")</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{route("reports.reports_general_conclusions")}}" class="nav-link  {{ (request()->routeIs('reports.reports_general_conclusions')) ? 'active' : '' }}">
                                    <i class="fa fa-layer-group nav-icon"></i>
                                    <p> @lang("site.reports_general_conclusions")</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{route("reports.ack_added_value")}}" class="nav-link  {{ (request()->routeIs('reports.ack_added_value')) ? 'active' : '' }}">
                                    <i class="fa fa-layer-group nav-icon"></i>
                                    <p> @lang("site.ack_added_value")</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{route("reports.discount_taxes")}}" class="nav-link  {{ (request()->routeIs('reports.discount_taxes')) ? 'active' : '' }}">
                                    <i class="fa fa-layer-group nav-icon"></i>
                                    <p> @lang("site.report_discount_taxes")</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{route("reports.ack_added_value_G_SH")}}" class="nav-link  {{ (request()->routeIs('reports.ack_added_value_G_SH')) ? 'active' : '' }}">
                                    <i class="fa fa-layer-group nav-icon"></i>
                                    <p> @lang("site.ack_added_value_G_SH")</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route("report_get_supplier_statment")}}" class="nav-link  {{ (request()->routeIs('report_get_supplier_statment')) ? 'active' : '' }}">
                                    <i class="fa fa-layer-group nav-icon"></i>
                                    <p> @lang("site.account_statement")</p>
                                </a>
                            </li>


{{--
                            <li class="nav-item">
                                <a href="{{route("invoice.index")}}" class="nav-link  {{ (request()->routeIs('invoice.index')) ? 'active' : '' }}">
                                    <i class="fa fa-layer-group nav-icon"></i>
                                    <p> @lang("site.invoice")</p>
                                </a>
                            </li> --}}

                        </ul>



                    </li>


            <ul class="nav nav-treeview">


            </ul>

            {{-- {{ request()->is('*sub_categories') ? 'active' : '' }} --}}

            </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>