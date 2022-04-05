@php
$currentLang = app()->getLocale();
@endphp


<div class="table-responsive">
    <button type="button" class="btn btn-success" onclick="ExportToExcel('xlsx')">Excel</button>
    <button type="button" class="btn btn-success" id="" onclick="printData()">Print</button>
    <button type="button" class="btn btn-success" id="ShowData">Show Data</button>
    <div class="data_content">
        <ul class="list-unstyled">
            <li data-item = "overall_total_row">
                <a href="#">@lang("site.overall_total")</a>
            </li>
            <li data-item = "tax_deduction_value_row">
                <a href="#">@lang("site.tax_deduction_value")</a>
            </li>
            <li data-item = "cashe_row">
                <a href="#">@lang("site.cashe")</a>
            </li>
            <li data-item = "okay_row">
                <a href="#">@lang("site.okay")</a>
            </li>
            <li data-item = "restrained_row">
                <a href="#">@lang("site.restrained")</a>
            </li>
            <li data-item = "not_restrained_row">
                <a href="#">@lang("site.not_restrained")</a>
            </li>
            @foreach ($businessNatures as $index => $business)
                <li data-item = "b_{{$business->id}}">
                    <a href="#">{{$business->name_ar}}</a>
                </li>
            @endforeach
        </ul>
    </div>
    <table id="general_conclusions_report" class="table table-bordered mt-4 table-striped text-center  date"
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
                    <td>يناير</td>
                    <td>فبراير</td>
                    <td>مارس</td>
                    <td>ابريل</td>
                    <td>مايو</td>
                    <td>يونيو</td>
                    <td>يوليو</td>
                    <td>اغسطس</td>
                    <td>سبتمبر</td>
                    <td>اكتوبر</td>
                    <td>نوفمبر</td>
                    <td>ديسمبر</td>
                    <td>الاجماليات</td>



                </thead>
            </tr>




        </thead>
        <tbody id="bodies">
            <tr class="overall_total_row">
                <td>@lang("site.overall_total")</td>
                @if (isset($all['Jan']))
                    <td class="overall_total"> {{ $all['Jan']['overall_total'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Feb']))
                    <td class="overall_total"> {{ $all['Feb']['overall_total'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Mar']))
                    <td class="overall_total"> {{ $all['Mar']['overall_total'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Apr']))
                    <td class="overall_total"> {{ $all['Apr']['overall_total'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['May']))
                    <td class="overall_total"> {{ $all['May']['overall_total'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Jun']))
                    <td class="overall_total"> {{ $all['Jun']['overall_total'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Jul']))
                    <td class="overall_total"> {{ $all['Jul']['overall_total'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Aug']))
                    <td class="overall_total"> {{ $all['Aug']['overall_total'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Sep']))
                    <td class="overall_total"> {{ $all['Sep']['overall_total'] }}</td>
                @else
                    <td>0</td>
                @endif
                @if (isset($all['Oct']))
                    <td class="overall_total"> {{ $all['Oct']['overall_total'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Nov']))
                    <td class="overall_total"> {{ $all['Nov']['overall_total'] }}</td>
                @else
                    <td>0</td>
                @endif
                @if (isset($all['Dec']))
                    <td class="overall_total"> {{ $all['Dec']['overall_total'] }}</td>
                @else
                    <td>0</td>
                @endif

                <td class="total_overall_total"></td>

            </tr>
            <tr class="tax_deduction_value_row">
                <td>@lang("site.tax_deduction_value")</td>
                @if (isset($all['Jan']))
                    <td class="tax_deduction_value"> {{ $all['Jan']['tax_deduction_value'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Feb']))
                    <td class="tax_deduction_value"> {{ $all['Feb']['tax_deduction_value'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Mar']))
                    <td class="tax_deduction_value"> {{ $all['Mar']['tax_deduction_value'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Apr']))
                    <td class="tax_deduction_value"> {{ $all['Apr']['tax_deduction_value'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['May']))
                    <td class="tax_deduction_value"> {{ $all['May']['tax_deduction_value'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Jun']))
                    <td class="tax_deduction_value"> {{ $all['Jun']['tax_deduction_value'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Jul']))
                    <td class="tax_deduction_value"> {{ $all['Jul']['tax_deduction_value'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Aug']))
                    <td class="tax_deduction_value"> {{ $all['Aug']['tax_deduction_value'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Sep']))
                    <td class="tax_deduction_value"> {{ $all['Sep']['tax_deduction_value'] }}</td>
                @else
                    <td>0</td>
                @endif
                @if (isset($all['Oct']))
                    <td class="tax_deduction_value"> {{ $all['Oct']['tax_deduction_value'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Nov']))
                    <td class="tax_deduction_value"> {{ $all['Nov']['tax_deduction_value'] }}</td>
                @else
                    <td>0</td>
                @endif
                @if (isset($all['Dec']))
                    <td class="tax_deduction_value"> {{ $all['Dec']['tax_deduction_value'] }}</td>
                @else
                    <td>0</td>
                @endif

                <td class="total_tax_deduction_value"></td>
            </tr>
            <tr class="cashe_row">
                <td>@lang("site.cashe")</td>
                @if (isset($all['Jan']))
                    <td class="cashe"> {{ $all['Jan']['cashe'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Feb']))
                    <td class="cashe"> {{ $all['Feb']['cashe'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Mar']))
                    <td class="cashe"> {{ $all['Mar']['cashe'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Apr']))
                    <td class="cashe"> {{ $all['Apr']['cashe'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['May']))
                    <td class="cashe"> {{ $all['May']['cashe'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Jun']))
                    <td class="cashe"> {{ $all['Jun']['cashe'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Jul']))
                    <td class="cashe"> {{ $all['Jul']['cashe'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Aug']))
                    <td class="cashe"> {{ $all['Aug']['cashe'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Sep']))
                    <td class="cashe"> {{ $all['Sep']['cashe'] }}</td>
                @else
                    <td>0</td>
                @endif
                @if (isset($all['Oct']))
                    <td class="cashe"> {{ $all['Oct']['cashe'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Nov']))
                    <td class="cashe"> {{ $all['Nov']['cashe'] }}</td>
                @else
                    <td>0</td>
                @endif
                @if (isset($all['Dec']))
                    <td class="cashe"> {{ $all['Dec']['cashe'] }}</td>
                @else
                    <td>0</td>
                @endif

                <td class="total_cashe"></td>
            </tr>
            <tr class="okay_row">
                <td>@lang("site.okay")</td>
                @if (isset($all['Jan']))
                    <td class="okay"> {{ $all['Jan']['okay'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Feb']))
                    <td class="okay"> {{ $all['Feb']['okay'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Mar']))
                    <td class="okay"> {{ $all['Mar']['okay'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Apr']))
                    <td class="okay"> {{ $all['Apr']['okay'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['May']))
                    <td class="okay"> {{ $all['May']['okay'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Jun']))
                    <td class="okay"> {{ $all['Jun']['okay'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Jul']))
                    <td class="okay"> {{ $all['Jul']['okay'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Aug']))
                    <td class="okay"> {{ $all['Aug']['okay'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Sep']))
                    <td class="okay"> {{ $all['Sep']['okay'] }}</td>
                @else
                    <td>0</td>
                @endif
                @if (isset($all['Oct']))
                    <td class="okay"> {{ $all['Oct']['okay'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Nov']))
                    <td class="okay"> {{ $all['Nov']['okay'] }}</td>
                @else
                    <td>0</td>
                @endif
                @if (isset($all['Dec']))
                    <td class="okay"> {{ $all['Dec']['okay'] }}</td>
                @else
                    <td>0</td>
                @endif

                <td class="total_okay"></td>
            </tr>
            <tr class="restrained_row">
                <td>@lang("site.restrained")</td>
                @if (isset($all['Jan']))
                    <td class="total_restrained"> {{ $all['Jan']['total_restrained'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Feb']))
                    <td class="total_restrained"> {{ $all['Feb']['total_restrained'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Mar']))
                    <td class="total_restrained"> {{ $all['Mar']['total_restrained'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Apr']))
                    <td class="total_restrained"> {{ $all['Apr']['total_restrained'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['May']))
                    <td class="total_restrained"> {{ $all['May']['total_restrained'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Jun']))
                    <td class="total_restrained"> {{ $all['Jun']['total_restrained'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Jul']))
                    <td class="total_restrained"> {{ $all['Jul']['total_restrained'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Aug']))
                    <td class="total_restrained"> {{ $all['Aug']['total_restrained'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Sep']))
                    <td class="total_restrained"> {{ $all['Sep']['total_restrained'] }}</td>
                @else
                    <td>0</td>
                @endif
                @if (isset($all['Oct']))
                    <td class="total_restrained"> {{ $all['Oct']['total_restrained'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Nov']))
                    <td class="total_restrained"> {{ $all['Nov']['total_restrained'] }}</td>
                @else
                    <td>0</td>
                @endif
                @if (isset($all['Dec']))
                    <td class="total_restrained"> {{ $all['Dec']['total_restrained'] }}</td>
                @else
                    <td>0</td>
                @endif

                <td class="total_total_restrained"></td>
            </tr>
            <tr class="not_restrained_row">
                <td>@lang("site.not_restrained")</td>
                @if (isset($all['Jan']))
                    <td class="total_not_restrained"> {{ $all['Jan']['total_not_restrained'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Feb']))
                    <td class="total_not_restrained"> {{ $all['Feb']['total_not_restrained'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Mar']))
                    <td class="total_not_restrained"> {{ $all['Mar']['total_not_restrained'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Apr']))
                    <td class="total_not_restrained"> {{ $all['Apr']['total_not_restrained'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['May']))
                    <td class="total_not_restrained"> {{ $all['May']['total_not_restrained'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Jun']))
                    <td class="total_not_restrained"> {{ $all['Jun']['total_not_restrained'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Jul']))
                    <td class="total_not_restrained"> {{ $all['Jul']['total_not_restrained'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Aug']))
                    <td class="total_not_restrained"> {{ $all['Aug']['total_not_restrained'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Sep']))
                    <td class="total_not_restrained"> {{ $all['Sep']['total_not_restrained'] }}</td>
                @else
                    <td>0</td>
                @endif
                @if (isset($all['Oct']))
                    <td class="total_not_restrained"> {{ $all['Oct']['total_not_restrained'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Nov']))
                    <td class="total_not_restrained"> {{ $all['Nov']['total_not_restrained'] }}</td>
                @else
                    <td>0</td>
                @endif
                @if (isset($all['Dec']))
                    <td class="total_not_restrained"> {{ $all['Dec']['total_not_restrained'] }}</td>
                @else
                    <td>0</td>
                @endif

                <td class="total_total_not_restrained"></td>
            </tr>
            @foreach ($businessNatures as $index => $business)
                <tr class="b_{{$business->id}}">
                    <td>
                        {{ $business->name_ar }}
                    </td>


                    @php
                        $overall_total = 0;
                    @endphp

                    @foreach ($business->invoices as $index => $invoice)

                        {{-- @if (isset($month[$index])) --}}
                        @if ($invoice->date_invoice->format('M') == 'Jan')
                            @php
                                 if($invoice->overall_total != null)
                               {
                                    $tot = $invoice->overall_total;
                               } else {
                                    $tot = $invoice->total;
                               }
                                $gtotal =  filter_var($tot,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
                                $overall_total = $overall_total + $gtotal;
                            @endphp
                        @endif
                        {{-- @endif --}}

                    @endforeach


                        <td>{{ $overall_total }}</td>



                    @php
                        $overall_total = 0;
                    @endphp

                    @foreach ($business->invoices as $index => $invoice)

                        {{-- @if (isset($month[$index])) --}}
                        @if ($invoice->date_invoice->format('M') == 'Feb')
                            @php
                             if($invoice->overall_total != null)
                               {
                                    $tot = $invoice->overall_total;
                               } else {
                                    $tot = $invoice->total;
                               }
                                $gtotal =  filter_var($tot,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
                                $overall_total += $gtotal;
                            @endphp
                        @endif
                        {{-- @endif --}}

                    @endforeach

                    <td>{{ $overall_total }}</td>

                    @php
                        $overall_total = 0;
                    @endphp

                    @foreach ($business->invoices as $index => $invoice)

                        {{-- @if (isset($month[$index])) --}}
                        @if ($invoice->date_invoice->format('M') == 'Mar')
                            @php
                            if($invoice->overall_total != null)
                               {
                                    $tot = $invoice->overall_total;
                               } else {
                                    $tot = $invoice->total;
                               }
                                $gtotal =  filter_var($tot,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
                                $overall_total += $gtotal;
                            @endphp
                        @endif
                        {{-- @endif --}}
                    @endforeach


                    <td>{{ $overall_total }}</td>

                    @php
                        $overall_total = 0;
                    @endphp

                    @foreach ($business->invoices as $index => $invoice)

                        {{-- @if (isset($month[$index])) --}}
                        @if ($invoice->date_invoice->format('M') == 'Apr')
                            @php
                            if($invoice->overall_total != null)
                               {
                                    $tot = $invoice->overall_total;
                               } else {
                                    $tot = $invoice->total;
                               }
                                $gtotal =  filter_var($tot,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
                                $overall_total += $gtotal;
                            @endphp
                        @endif
                        {{-- @endif --}}

                    @endforeach


                    <td>{{ $overall_total }}</td>

                    @php
                        $overall_total = 0;
                    @endphp

                    @foreach ($business->invoices as $index => $invoice)

                        {{-- @if (isset($month[$index])) --}}
                        @if ($invoice->date_invoice->format('M') == 'May')
                            @php
                            if($invoice->overall_total != null)
                               {
                                    $tot = $invoice->overall_total;
                               } else {
                                    $tot = $invoice->total;
                               }
                                $gtotal =  filter_var($tot,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
                                $overall_total += $gtotal;
                            @endphp
                        @endif
                        {{-- @endif --}}

                    @endforeach


                    <td>{{ $overall_total }}</td>

                    @php
                        $overall_total = 0;
                    @endphp

                    @foreach ($business->invoices as $index => $invoice)

                        {{-- @if (isset($month[$index])) --}}
                        @if ($invoice->date_invoice->format('M') == 'Jun')
                            @php
                            if($invoice->overall_total != null)
                               {
                                    $tot = $invoice->overall_total;
                               } else {
                                    $tot = $invoice->total;
                               }
                                $gtotal =  filter_var($tot,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
                                $overall_total += $gtotal;
                            @endphp
                        @endif
                        {{-- @endif --}}

                    @endforeach


                    <td>{{ $overall_total }}</td>

                    @php
                        $overall_total = 0;
                    @endphp

                    @foreach ($business->invoices as $index => $invoice)

                        {{-- @if (isset($month[$index])) --}}
                        @if ($invoice->date_invoice->format('M') == 'Jul')
                            @php
                            if($invoice->overall_total != null)
                               {
                                    $tot = $invoice->overall_total;
                               } else {
                                    $tot = $invoice->total;
                               }
                                $gtotal =  filter_var($tot,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
                                $overall_total += $gtotal;
                            @endphp
                        @endif
                        {{-- @endif --}}

                    @endforeach


                    <td>{{ $overall_total }}</td>

                    @php
                        $overall_total = 0;
                    @endphp

                    @foreach ($business->invoices as $index => $invoice)

                        {{-- @if (isset($month[$index])) --}}
                        @if ($invoice->date_invoice->format('M') == 'Aug')
                            @php
                            if($invoice->overall_total != null)
                               {
                                    $tot = $invoice->overall_total;
                               } else {
                                    $tot = $invoice->total;
                               }
                                $gtotal =  filter_var($tot,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
                                $overall_total += $gtotal;
                            @endphp
                        @endif
                        {{-- @endif --}}

                    @endforeach


                    <td>{{ $overall_total }}</td>

                    @php
                        $overall_total = 0;
                    @endphp

                    @foreach ($business->invoices as $index => $invoice)

                        {{-- @if (isset($month[$index])) --}}
                        @if ($invoice->date_invoice->format('M') == 'Sep')
                            @php
                            if($invoice->overall_total != null)
                               {
                                    $tot = $invoice->overall_total;
                               } else {
                                    $tot = $invoice->total;
                               }
                                $gtotal =  filter_var($tot,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
                                $overall_total += $gtotal;
                            @endphp
                        @endif
                        {{-- @endif --}}

                    @endforeach


                    <td>{{ $overall_total }}</td>



                    @php
                        $overall_total = 0;
                    @endphp

                    @foreach ($business->invoices as $index => $invoice)

                        {{-- @if (isset($month[$index])) --}}
                        @if ($invoice->date_invoice->format('M') == 'Oct')
                            @php
                            if($invoice->overall_total != null)
                               {
                                    $tot = $invoice->overall_total;
                               } else {
                                    $tot = $invoice->total;
                               }
                                $gtotal =  filter_var($tot,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
                                $overall_total += $gtotal;
                            @endphp
                        @endif
                        {{-- @endif --}}

                    @endforeach


                    <td>{{ $overall_total }}</td>

                    @php
                        $overall_total = 0;
                    @endphp

                    @foreach ($business->invoices as $index => $invoice)

                        {{-- @if (isset($month[$index])) --}}
                        @if ($invoice->date_invoice->format('M') == 'Nov')
                            @php
                            if($invoice->overall_total != null)
                               {
                                    $tot = $invoice->overall_total;
                               } else {
                                    $tot = $invoice->total;
                               }
                                $gtotal =  filter_var($tot,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
                                $overall_total += $gtotal;
                            @endphp
                        @endif
                        {{-- @endif --}}

                    @endforeach

                    <td>{{ $overall_total }}</td>

                    @php
                        $overall_total = 0;
                    @endphp

                    @foreach ($business->invoices as $index => $invoice)

                        {{-- @if (isset($month[$index])) --}}
                        @if ($invoice->date_invoice->format('M') == 'Dec')
                            @php

                            if($invoice->overall_total != null)
                               {
                                    $tot = $invoice->overall_total;
                               } else {
                                    $tot = $invoice->total;
                               }
                                $gtotal =  filter_var($tot,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
                                $overall_total += $gtotal;
                            @endphp
                        @endif
                        {{-- @endif --}}

                    @endforeach

                    <td>{{ $overall_total }}</td>
                    @php
                        $overall_total = 0;
                        $total_left_all = 0;

                    @endphp
                    @foreach ($business->invoices as $index => $invoice)

                        @php
                               if($invoice->overall_total != null)
                               {
                                    $tot = $invoice->overall_total;
                               } else {
                                    $tot = $invoice->total;
                               }
                            $gtotal =  filter_var($tot,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
                            $overall_total += $gtotal;

                        @endphp
                        @php
                            $total_left_all = $overall_total;
                        @endphp

                    @endforeach
                    <td>{{ $total_left_all }}</td>
                </tr>

            @endforeach

            {{-- <tr>
                <td>المجموع</td>
                @if (isset($all['Jan']))
                    <td class="total_left_not_rest"> {{ $all['Jan']['total_not_restrained'] }}</td>
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

                @if (isset($all['Jun']))
                    <td class="total_left_rest"> {{ $all['Jun']['total_restrained'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['Aug']))
                    <td class="total_left_not_rest"> {{ $all['Aug']['total_not_restrained'] }}</td>
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

                <td class="total_not_rest_left"></td>

                <td class="total_rest_left"> </td>
                <td class="total_all_left_result"> </td>

            </tr> --}}

            {{-- <tr>
                <td>الاجمالي</td>

                @if (isset($all['Jan']))
                    <td  class="total_all_left"> {{ $all['Jan']['total_all'] }}</td>
                @else
                    <td >0</td>
                @endif

                @if (isset($all['Feb']))
                    <td  class="total_all_left">{{ $all['Feb']['total_all'] }}</td>
                @else
                    <td >0</td>
                @endif
                @if (isset($all['Mar']))
                    <td class="total_all_left">{{ $all['Mar']['total_all'] }}</td>
                @else
                    <td >0</td>
                @endif

                @if (isset($all['Apr']))
                    <td  class="total_all_left"> {{ $all['Apr']['total_all'] }}</td>
                @else
                    <td>0</td>
                @endif

                @if (isset($all['May']))
                    <td class="total_all_left"> {{ $all['May']['total_all'] }}</td>
                @else
                    <td >0</td>
                @endif

                @if (isset($all['Jun']))
                    <td  class="total_all_left"> {{ $all['Jun']['total_all'] }}</td>
                @else
                    <td >0</td>
                @endif
                @if (isset($all['Jul']))
                    <td class="total_all_left"> {{ $all['Jul']['total_all'] }}</td>
                @else
                    <td >0</td>
                @endif

                @if (isset($all['Aug']))
                    <td class="total_all_left"> {{ $all['Aug']['total_all'] }}</td>
                @else
                    <td >0</td>
                @endif

                @if (isset($all['Sep']))
                    <td  class="total_all_left"> {{ $all['Sep']['total_all'] }}</td>
                @else
                    <td >0</td>
                @endif

                @if (isset($all['Oct']))
                    <td  class="total_all_left">{{ $all['Oct']['total_all'] }}</td>
                @else
                    <td >0</td>
                @endif

                @if (isset($all['Nov']))
                    <td class="total_all_left"> {{ $all['Nov']['total_all'] }}</td>
                @else
                    <td >0</td>
                @endif
                @if (isset($all['Dec']))
                    <td  class="total_all_left"> {{ $all['Dec']['total_all'] }}</td>
                @else
                    <td >0</td>
                @endif

                <td  class="total_all_left_result"> </td>
                <td class="total_all_left_result"> </td>



            </tr> --}}
        </tbody>
    </table>

</div>
