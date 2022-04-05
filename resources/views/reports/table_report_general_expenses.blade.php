@php
$currentLang = app()->getLocale();
@endphp


<div class="table-responsive">
    <button type="button" class="btn btn-success" onclick="ExportToExcel('xlsx')">Excel</button>
    <button type="button" class="btn btn-success" id="" onclick="printData()">Print</button>
    <table id="general_expenses_report" class="table table-bordered mt-4 table-striped text-center  date"
        @if ($currentLang == 'ar') style="direction: rtl; text-align: right" @endif>
        <thead>
            <tr>
                <thead class="tableItem" id="headers">

                    <td>
                        @lang("site.item")
                    </td>
                    {{-- @foreach ($month as $ar)
                            <td colspan="2"> {{ $ar }}</td>
                        @endforeach --}}
                    <td colspan="2">يناير</td>
                    <td colspan="2">فبراير</td>
                    <td colspan="2">مارس</td>
                    <td colspan="2">ابريل</td>
                    <td colspan="2">مايو</td>
                    <td colspan="2">يونيو</td>
                    <td colspan="2">يوليو</td>
                    <td colspan="2">اغسطس</td>
                    <td colspan="2">سبتمبر</td>
                    <td colspan="2">اكتوبر</td>
                    <td colspan="2">نوفمبر</td>
                    <td colspan="2">ديسمبر</td>
                    <td colspan="2">الاجماليات</td>
                    <td></td>


                </thead>
            </tr>
            <tr>
                <td></td>
                <td class="size_rest"> غير مقيد </td>
                <td class="size_rest">مقيد</td>
                <td class="size_rest"> غير مقيد </td>
                <td class="size_rest">مقيد</td>
                <td class="size_rest"> غير مقيد </td>
                <td class="size_rest">مقيد</td>
                <td class="size_rest"> غير مقيد </td>
                <td class="size_rest">مقيد</td>
                <td class="size_rest"> غير مقيد </td>
                <td class="size_rest">مقيد</td>
                <td class="size_rest"> غير مقيد </td>
                <td class="size_rest">مقيد</td>
                <td class="size_rest"> غير مقيد </td>
                <td class="size_rest">مقيد</td>
                <td class="size_rest"> غير مقيد </td>
                <td class="size_rest">مقيد</td>
                <td class="size_rest"> غير مقيد </td>
                <td class="size_rest">مقيد</td>
                <td class="size_rest"> غير مقيد </td>
                <td class="size_rest">مقيد</td>
                <td class="size_rest"> غير مقيد </td>
                <td class="size_rest">مقيد</td>
                <td class="size_rest"> غير مقيد </td>
                <td class="size_rest">مقيد</td>
                <td class="size_rest"> غير مقيد </td>
                <td class="size_rest">مقيد</td>


                <td class="size_rest">الاجماليات البنود</td>

            </tr>



        </thead>
        <tbody id="bodies">
            @foreach ($businessNatures as $index => $business)
                <tr class="first{{ $index }}">
                    <td>
                        {{ $business->name_ar }}
                    </td>


                    @php
                        $total_not_restrained = 0;
                        $total_restrained = 0;
                    @endphp

                    @foreach ($business->invoices as $index => $invoice)
                        {{-- @if (isset($month[$index])) --}}
                        @if ($invoice->date_invoice->format('M') == 'Jan')
                            @php

                                if ($invoice->restrained_type == 'not_restrained') {
                                    if($invoice->overall_total != null)
                               {
                                    $tot = $invoice->overall_total;
                               } else {
                                    $tot = $invoice->total;
                               }
                                        $gtotal = filter_var($tot, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                                        $total_not_restrained += $gtotal;

                                }

                                if ($invoice->restrained_type == 'restrained') {
                                    if($invoice->overall_total != null)
                               {
                                    $tot = $invoice->overall_total;
                               } else {
                                    $tot = $invoice->total;
                               }
                                        $gtotal = filter_var($tot, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                                        $total_restrained += $gtotal;
                                    }

                            @endphp
                        @endif
                        {{-- @endif --}}
                    @endforeach


                    <td>{{ $total_not_restrained }}</td>
                    <td class="total_res">{{ $total_restrained }}</td>


                    @php
                        $total_not_restrained = 0;
                        $total_restrained = 0;
                    @endphp

                    @foreach ($business->invoices as $index => $invoice)
                        {{-- @if (isset($month[$index])) --}}
                        @if ($invoice->date_invoice->format('M') == 'Feb')
                            @php
                                if ($invoice->restrained_type == 'not_restrained') {
                                    if($invoice->overall_total != null)
                               {
                                    $tot = $invoice->overall_total;
                               } else {
                                    $tot = $invoice->total;
                               }
                                        $gtotal = filter_var($tot, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                                        $total_not_restrained += $gtotal;

                                }

                                if ($invoice->restrained_type == 'restrained') {
                                    if($invoice->overall_total != null)
                                       {
                                            $tot = $invoice->overall_total;
                                       } else {
                                            $tot = $invoice->total;
                                       }
                                        $gtotal = filter_var($tot, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                                        $total_restrained += $gtotal;

                                }
                            @endphp
                        @endif
                        {{-- @endif --}}
                    @endforeach

                    <td>{{ $total_not_restrained }}</td>
                    <td class="total_res">{{ $total_restrained }}</td>

                    @php
                        $total_not_restrained = 0;
                        $total_restrained = 0;
                    @endphp

                    @foreach ($business->invoices as $index => $invoice)
                        {{-- @if (isset($month[$index])) --}}
                        @if ($invoice->date_invoice->format('M') == 'Mar')
                            @php

                                if ($invoice->restrained_type == 'not_restrained') {
                                    if($invoice->overall_total != null)
                                       {
                                            $tot = $invoice->overall_total;
                                       } else {
                                            $tot = $invoice->total;
                                       }
                                        $gtotal = filter_var($tot, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                                        $total_not_restrained += $gtotal;

                                }

                                if ($invoice->restrained_type == 'restrained') {
                                    if($invoice->overall_total != null)
                                   {
                                        $tot = $invoice->overall_total;
                                   } else {
                                            $tot = $invoice->total;
                                   }
                                        $gtotal = filter_var($tot, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                                        $total_restrained += $gtotal;
                                    }

                            @endphp
                        @endif
                        {{-- @endif --}}
                    @endforeach


                    <td>{{ $total_not_restrained }}</td>
                    <td class="total_res">{{ $total_restrained }}</td>

                    @php
                        $total_not_restrained = 0;
                        $total_restrained = 0;
                    @endphp

                    @foreach ($business->invoices as $index => $invoice)
                        {{-- @if (isset($month[$index])) --}}
                        @if ($invoice->date_invoice->format('M') == 'Apr')
                            @php

                                if ($invoice->restrained_type == 'not_restrained') {
                                    if($invoice->overall_total != null)
                               {
                                    $tot = $invoice->overall_total;
                               } else {
                                    $tot = $invoice->total;
                               }
                                        $gtotal = filter_var($tot, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                                        $total_not_restrained += $gtotal;

                                }

                                if ($invoice->restrained_type == 'restrained') {
                                    if($invoice->overall_total != null)
                               {
                                    $tot = $invoice->overall_total;
                               } else {
                                    $tot = $invoice->total;
                               }
                                        $gtotal = filter_var($tot, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                                        $total_restrained += $gtotal;

                                }
                            @endphp
                        @endif
                        {{-- @endif --}}
                    @endforeach


                    <td>{{ $total_not_restrained }}</td>
                    <td class="total_res">{{ $total_restrained }}</td>

                    @php
                        $total_not_restrained = 0;
                        $total_restrained = 0;
                    @endphp

                    @foreach ($business->invoices as $index => $invoice)
                        {{-- @if (isset($month[$index])) --}}
                        @if ($invoice->date_invoice->format('M') == 'May')
                            @php

                                if ($invoice->restrained_type == 'not_restrained') {
                                    if($invoice->overall_total != null)
                               {
                                    $tot = $invoice->overall_total;
                               } else {
                                    $tot = $invoice->total;
                               }
                                        $gtotal = filter_var($tot, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                                        $total_not_restrained += $gtotal;

                                }

                                if ($invoice->restrained_type == 'restrained') {
                                    if($invoice->overall_total != null)
                                       {
                                            $tot = $invoice->overall_total;
                                       } else {
                                            $tot = $invoice->total;
                                       }
                                        $gtotal = filter_var($tot, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                                        $total_restrained += $gtotal;

                                }
                            @endphp
                        @endif
                        {{-- @endif --}}
                    @endforeach


                    <td>{{ $total_not_restrained }}</td>
                    <td class="total_res">{{ $total_restrained }}</td>

                    @php
                        $total_not_restrained = 0;
                        $total_restrained = 0;
                    @endphp

                    @foreach ($business->invoices as $index => $invoice)
                        {{-- @if (isset($month[$index])) --}}
                        @if ($invoice->date_invoice->format('M') == 'Jun')
                            @php

                                if ($invoice->restrained_type == 'not_restrained') {
                                    if($invoice->overall_total != null)
                                       {
                                            $tot = $invoice->overall_total;
                                       } else {
                                            $tot = $invoice->total;
                                       }
                                        $gtotal = filter_var($tot, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                                        $total_not_restrained += $gtotal;
                                    }


                                if ($invoice->restrained_type == 'restrained') {
                                    if($invoice->overall_total != null)
                                       {
                                            $tot = $invoice->overall_total;
                                       } else {
                                            $tot = $invoice->total;
                                       }
                                        $gtotal = filter_var($tot, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                                        $total_restrained += $gtotal;

                                }
                            @endphp
                        @endif
                        {{-- @endif --}}
                    @endforeach


                    <td>{{ $total_not_restrained }}</td>
                    <td class="total_res">{{ $total_restrained }}</td>

                    @php
                        $total_not_restrained = 0;
                        $total_restrained = 0;
                    @endphp

                    @foreach ($business->invoices as $index => $invoice)
                        {{-- @if (isset($month[$index])) --}}
                        @if ($invoice->date_invoice->format('M') == 'Jul')
                            @php

                                if ($invoice->restrained_type == 'not_restrained') {
                                    if($invoice->overall_total != null)
                               {
                                    $tot = $invoice->overall_total;
                               } else {
                                    $tot = $invoice->total;
                               }
                                        $gtotal = filter_var($tot, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                                        $total_not_restrained += $gtotal;

                                }

                                if ($invoice->restrained_type == 'restrained') {
                                    if($invoice->overall_total != null)
                               {
                                    $tot = $invoice->overall_total;
                               } else {
                                    $tot = $invoice->total;
                               }
                                        $gtotal = filter_var($tot, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                                        $total_restrained += $gtotal;
                                    }

                            @endphp
                        @endif
                        {{-- @endif --}}
                    @endforeach


                    <td>{{ $total_not_restrained }}</td>
                    <td class="total_res">{{ $total_restrained }}</td>

                    @php
                        $total_not_restrained = 0;
                        $total_restrained = 0;
                    @endphp

                    @foreach ($business->invoices as $index => $invoice)
                        {{-- @if (isset($month[$index])) --}}
                        @if ($invoice->date_invoice->format('M') == 'Aug')
                            @php

                                if ($invoice->restrained_type == 'not_restrained') {
                                    if($invoice->overall_total != null)
                               {
                                    $tot = $invoice->overall_total;
                               } else {
                                    $tot = $invoice->total;
                               }
                                        $gtotal = filter_var($tot, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                                        $total_not_restrained += $gtotal;

                                }

                                if ($invoice->restrained_type == 'restrained') {
                                    if($invoice->overall_total != null)
                               {
                                    $tot = $invoice->overall_total;
                               } else {
                                    $tot = $invoice->total;
                               }
                                        $gtotal = filter_var($tot, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                                        $total_restrained += $gtotal;

                                }
                            @endphp
                        @endif
                        {{-- @endif --}}
                    @endforeach


                    <td>{{ $total_not_restrained }}</td>
                    <td class="total_res">{{ $total_restrained }}</td>

                    @php
                        $total_not_restrained = 0;
                        $total_restrained = 0;
                    @endphp

                    @foreach ($business->invoices as $index => $invoice)
                        {{-- @if (isset($month[$index])) --}}
                        @if ($invoice->date_invoice->format('M') == 'Sep')
                            @php

                                if ($invoice->restrained_type == 'not_restrained') {
                                    if($invoice->overall_total != null)
                               {
                                    $tot = $invoice->overall_total;
                               } else {
                                    $tot = $invoice->total;
                               }
                                        $gtotal = filter_var($tot, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                                        $total_not_restrained += $gtotal;

                                }

                                if ($invoice->restrained_type == 'restrained') {
                                    if($invoice->overall_total != null)
                                       {
                                            $tot = $invoice->overall_total;
                                       } else {
                                            $tot = $invoice->total;
                                       }
                                        $gtotal = filter_var($tot, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                                        $total_restrained += $gtotal;

                                }
                            @endphp
                        @endif
                        {{-- @endif --}}
                    @endforeach


                    <td>{{ $total_not_restrained }}</td>
                    <td class="total_res">{{ $total_restrained }}</td>



                    @php
                        $total_not_restrained = 0;
                        $total_restrained = 0;
                    @endphp

                    @foreach ($business->invoices as $index => $invoice)
                        {{-- @if (isset($month[$index])) --}}
                        @if ($invoice->date_invoice->format('M') == 'Oct')
                            @php

                                if ($invoice->restrained_type == 'not_restrained') {
                                    if($invoice->overall_total != null)
                               {
                                    $tot = $invoice->overall_total;
                               } else {
                                    $tot = $invoice->total;
                               }
                                        $gtotal = filter_var($tot, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                                        $total_not_restrained += $gtotal;

                                }

                                if ($invoice->restrained_type == 'restrained') {
                                    if($invoice->overall_total != null)
                                   {
                                        $tot = $invoice->overall_total;
                                   } else {
                                                $tot = $invoice->total;
                                       }
                                        $gtotal = filter_var($tot, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                                        $total_restrained += $gtotal;

                                }
                            @endphp
                        @endif
                        {{-- @endif --}}
                    @endforeach


                    <td>{{ $total_not_restrained }}</td>
                    <td class="total_res">{{ $total_restrained }}</td>

                    @php
                        $total_not_restrained = 0;
                        $total_restrained = 0;
                    @endphp

                    @foreach ($business->invoices as $index => $invoice)
                        {{-- @if (isset($month[$index])) --}}
                        @if ($invoice->date_invoice->format('M') == 'Nov')
                            @php

                                if ($invoice->restrained_type == 'not_restrained') {
                                    if($invoice->overall_total != null)
                               {
                                    $tot = $invoice->overall_total;
                               } else {
                                    $tot = $invoice->total;
                               }
                                        $gtotal = filter_var($tot, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                                        $total_not_restrained += $gtotal;

                                }

                                if ($invoice->restrained_type == 'restrained') {
                                    if($invoice->overall_total != null)
                               {
                                    $tot = $invoice->overall_total;
                               } else {
                                    $tot = $invoice->total;
                               }
                                        $gtotal = filter_var($tot, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                                        $total_restrained += $gtotal;

                                }
                            @endphp
                        @endif
                        {{-- @endif --}}
                    @endforeach

                    <td>{{ $total_not_restrained }}</td>
                    <td class="total_res">{{ $total_restrained }}</td>

                    @php
                        $total_not_restrained = 0;
                        $total_restrained = 0;
                    @endphp

                    @foreach ($business->invoices as $index => $invoice)
                        {{-- @if (isset($month[$index])) --}}
                        @if ($invoice->date_invoice->format('M') == 'Dec')
                            @php

                                if ($invoice->restrained_type == 'not_restrained') {
                                    if($invoice->overall_total != null)
                               {
                                    $tot = $invoice->overall_total;
                               } else {
                                    $tot = $invoice->total;
                               }
                                        $gtotal = filter_var($tot, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                                        $total_not_restrained += $gtotal;

                                }

                                if ($invoice->restrained_type == 'restrained') {
                                    if($invoice->overall_total != null)
                               {
                                    $tot = $invoice->overall_total;
                               } else {
                                    $tot = $invoice->total;
                               }
                                        $gtotal = filter_var($tot, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                                        $total_restrained += $gtotal;

                                }
                            @endphp
                        @endif
                        {{-- @endif --}}
                    @endforeach

                    <td>{{ $total_not_restrained }}</td>
                    <td class="total_res">{{ $total_restrained }}</td>
                    @php
                        $total_not_restrained = 0;
                        $total_restrained = 0;
                        $total_left_all = 0;
                    @endphp

                    @foreach ($business->invoices as $index => $invoice)
                        @php
                            if ($invoice->restrained_type == 'not_restrained') {
                                if($invoice->overall_total != null)
                               {
                                    $tot = $invoice->overall_total;
                               } else {
                                    $tot = $invoice->total;
                               }
                                    $gtotal = filter_var($tot, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                                    $total_not_restrained += $gtotal;

                            }

                            if ($invoice->restrained_type == 'restrained') {
                                if($invoice->overall_total != null)
                               {
                                    $tot = $invoice->overall_total;
                               } else {
                                    $tot = $invoice->total;
                               }
                                    $gtotal = filter_var($tot, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                                    $total_restrained += $gtotal;

                            }
                        @endphp
                        @php

                            $total_left_all = $total_not_restrained + $total_restrained;
                        @endphp
                    @endforeach

                    <td>{{ $total_not_restrained }}</td>
                    <td class="total_res">{{ $total_restrained }}</td>
                    <td>{{ $total_left_all }}</td>
                </tr>
            @endforeach

            <tr>
                <td>المجموع</td>
                @if (isset($all['Jan']))
                    <td class="total_left_not_rest"> {{ $all['Jan']['total_not_restrained'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Jan']))
                    <td class="total_left_rest"> {{ $all['Jan']['total_restrained'] }}</td>
                @else
                    <td>0</td>
                @endif
                @if (isset($all['Feb']))
                    <td class="total_left_not_rest"> {{ $all['Feb']['total_not_restrained'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Feb']))
                    <td class="total_left_rest"> {{ $all['Feb']['total_restrained'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Mar']))
                    <td class="total_left_not_rest"> {{ $all['Mar']['total_not_restrained'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Mar']))
                    <td class="total_left_rest"> {{ $all['Mar']['total_restrained'] }}</td>
                @else
                    <td>0</td>
                @endif
                @if (isset($all['Apr']))
                    <td class="total_left_not_rest"> {{ $all['Apr']['total_not_restrained'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Apr']))
                    <td class="total_left_rest"> {{ $all['Apr']['total_restrained'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['May']))
                    <td class="total_left_not_rest"> {{ $all['May']['total_not_restrained'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['May']))
                    <td class="total_left_rest"> {{ $all['May']['total_restrained'] }}</td>
                @else
                    <td>0</td>
                @endif
                @if (isset($all['Jun']))
                    <td class="total_left_not_rest"> {{ $all['Jun']['total_not_restrained'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Jun']))
                    <td class="total_left_rest"> {{ $all['Jun']['total_restrained'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Jul']))
                    <td class="total_left_not_rest"> {{ $all['Jul']['total_not_restrained'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Jul']))
                    <td class="total_left_rest"> {{ $all['Jul']['total_restrained'] }}</td>
                @else
                    <td>0</td>
                @endif
                @if (isset($all['Aug']))
                    <td class="total_left_not_rest"> {{ $all['Aug']['total_not_restrained'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Aug']))
                    <td class="total_left_rest"> {{ $all['Aug']['total_restrained'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Sep']))
                    <td class="total_left_not_rest"> {{ $all['Sep']['total_not_restrained'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Sep']))
                    <td class="total_left_rest"> {{ $all['Sep']['total_restrained'] }}</td>
                @else
                    <td>0</td>
                @endif
                @if (isset($all['Oct']))
                    <td class="total_left_not_rest"> {{ $all['Oct']['total_not_restrained'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Oct']))
                    <td class="total_left_rest"> {{ $all['Oct']['total_restrained'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Nov']))
                    <td class="total_left_not_rest"> {{ $all['Nov']['total_not_restrained'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Nov']))
                    <td class="total_left_rest"> {{ $all['Nov']['total_restrained'] }}</td>
                @else
                    <td>0</td>
                @endif
                @if (isset($all['Dec']))
                    <td class="total_left_not_rest"> {{ $all['Dec']['total_not_restrained'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Dec']))
                    <td class="total_left_rest"> {{ $all['Dec']['total_restrained'] }}</td>
                @else
                    <td>0</td>
                @endif
                <td class="total_not_rest_left"></td>

                <td class="total_rest_left"> </td>
                <td class="total_all_left_result"> </td>

            </tr>

            <tr>
                <td>الاجمالي</td>

                @if (isset($all['Jan']))
                    <td colspan="2" class="total_all_left"> {{ $all['Jan']['total_all'] }}</td>
                @else
                    <td colspan="2">0</td>
                @endif

                @if (isset($all['Feb']))
                    <td colspan="2" class="total_all_left">{{ $all['Feb']['total_all'] }}</td>
                @else
                    <td colspan="2">0</td>
                @endif
                @if (isset($all['Mar']))
                    <td colspan="2" class="total_all_left">{{ $all['Mar']['total_all'] }}</td>
                @else
                    <td colspan="2">0</td>
                @endif

                @if (isset($all['Apr']))
                    <td colspan="2" class="total_all_left"> {{ $all['Apr']['total_all'] }}</td>
                @else
                    <td colspan="2">0</td>
                @endif

                @if (isset($all['May']))
                    <td colspan="2" class="total_all_left"> {{ $all['May']['total_all'] }}</td>
                @else
                    <td colspan="2">0</td>
                @endif

                @if (isset($all['Jun']))
                    <td colspan="2" class="total_all_left"> {{ $all['Jun']['total_all'] }}</td>
                @else
                    <td colspan="2">0</td>
                @endif
                @if (isset($all['Jul']))
                    <td colspan="2" class="total_all_left"> {{ $all['Jul']['total_all'] }}</td>
                @else
                    <td colspan="2">0</td>
                @endif

                @if (isset($all['Aug']))
                    <td colspan="2" class="total_all_left"> {{ $all['Aug']['total_all'] }}</td>
                @else
                    <td colspan="2">0</td>
                @endif

                @if (isset($all['Sep']))
                    <td colspan="2" class="total_all_left"> {{ $all['Sep']['total_all'] }}</td>
                @else
                    <td colspan="2">0</td>
                @endif

                @if (isset($all['Oct']))
                    <td colspan="2" class="total_all_left">{{ $all['Oct']['total_all'] }}</td>
                @else
                    <td colspan="2">0</td>
                @endif

                @if (isset($all['Nov']))
                    <td colspan="2" class="total_all_left"> {{ $all['Nov']['total_all'] }}</td>
                @else
                    <td colspan="2">0</td>
                @endif
                @if (isset($all['Dec']))
                    <td colspan="2" class="total_all_left"> {{ $all['Dec']['total_all'] }}</td>
                @else
                    <td colspan="2">0</td>
                @endif

                <td colspan="2" class="total_all_left_result"> </td>
                <td class="total_all_left_result"> </td>



            </tr>
        </tbody>
    </table>

</div>
