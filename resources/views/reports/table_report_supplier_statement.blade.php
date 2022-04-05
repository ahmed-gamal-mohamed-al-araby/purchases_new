@php
$currentLang = app()->getLocale();
$x=1;
@endphp


<table id="example" class="table table-bordered mt-4 table-striped text-center date display" style="width:100%">
    <thead>
        <tr>
            <th>#</th>
            <th>@lang("site.statement")</th>
            <th>@lang("site.date")</th>
            <th>@lang("site.invoice_value")</th>
            <th>@lang("site.value_added_tax")</th>
            <th>@lang("site.tax_deduction_value")</th>
            <th>@lang("site.other_discount")</th>
            <th>@lang("site.business_insurance_value")</th>
            <th>@lang("site.value_payment")</th>
            <th>@lang("site.balance")</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> </td>
            <td>الرصيد الافتتاحى</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td> {{number_format($total_Opening_balance,2)}}</td>

        </tr>
        @foreach($all_data as $signal_data)

        <tr>

            <td>{{$x++}}</td>
            @if(!isset($signal_data["value"]))
            <td>فاتوره رقم {{$signal_data["invoice_number"]}}</td>
            <td>{{ Carbon\Carbon::parse($signal_data["date_invoice"])->format('Y-m-d') }}</td>
            <td>{{$signal_data["total"]}}</td>
            <td>{{$signal_data["value_tax"]}}</td>
            <td>{{$signal_data["tax_deduction_value"]}}</td>
            <td>{{$signal_data["other_discount"]}}</td>
            <td>{{$signal_data["business_insurance_value"]}}</td>


            @if($signal_data["expense_type"]=="cashe")
            <td>{{$signal_data["net_total"]}}</td>

            @php
            $total=$total-((filter_var($signal_data["total"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION)
            -(filter_var($signal_data["value_tax"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION)
            +filter_var($signal_data["tax_deduction_value"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION)
            +filter_var($signal_data["other_discount"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION)))
            +filter_var($signal_data["net_total"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));

            @endphp
            <td> {{number_format($total,2)}}</td>
            @else
            <td>0</td>

            @php
            $total=$total-filter_var($signal_data["total"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION)
            -filter_var($signal_data["value_tax"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION)
            +filter_var($signal_data["tax_deduction_value"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION)
            +filter_var($signal_data["other_discount"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            @endphp
            <td> {{number_format($total,2)}}</td>

            @endif

            @else
            @if($signal_data["payment_method"]=="cheque")
            <td> شيك رقم {{$signal_data["cheque_number"]}}</td>
            @elseif($signal_data["payment_method"]=="bank_transfer")
            <td>تحويل بنكى </td>

            @elseif($signal_data["payment_method"]=="cashe")
            <td> دفع نقدى</td>

            @endif

            <td>{{ Carbon\Carbon::parse($signal_data["date_invoice"])->format('Y-m-d') }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>{{$signal_data["value"]}}</td>
            @php
            $total+=$signal_data["value"];
            @endphp
            <td> {{number_format($total,2)}}</td>

            @endif

        </tr>
        @endforeach



    </tbody>
    <tfoot>

        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>{{number_format($sum_invoice_value,2)}}</td>
            <td>{{number_format($sum_value_tax,2)}}</td>
            <td>{{number_format($sum_tax_deduction_value,2)}}</td>
            <td>{{number_format($sum_other_discount,2)}}</td>
            <td>{{number_format($sum_business_insurance_value,2)}}</td>
            <td> {{number_format($sum_net_total,2)}}</td>
            <td></td>
        </tr>
        <caption>Total : {{number_format($total,2)}}</caption>
    </tfoot>
</table>

<script>
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        "bPaginate": false,
        buttons: [
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [ 0, ':visible' ]
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 5 ]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            },
            'colvis'
        ]
    } );
} );
</script>
