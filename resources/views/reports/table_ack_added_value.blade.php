@php
$currentLang = app()->getLocale();

@endphp

<div class="row text-info">

<div class="col-4">@lang("site.total_ack") : {{number_format($total_sum,2)}}</div>
<div class="col-4">@lang("site.tax_deduction_value_ack") : {{number_format($value_tax_sum,2)}}</div>
<div class="col-4">@lang("site.net_total_ack") : {{number_format($total_ack_sum,2)}}</div>

</div>
   
<br>
    <div class="table-responsive">
   
    <table id="example" class="table table-bordered mt-4 table-striped text-center date display" style="width:100%">


            <thead class="tableItem" id="headers">

                <td>
                    @lang("site.document_type")
                </td>
                {{-- @foreach ($month as $ar)
                    <td > {{ $ar }}</td>
                @endforeach --}}
                <td>
                    @lang("site.tax_type")
                </td>
                <td>
                    @lang("site.table_item_type")
                </td>
                <td>
                    @lang("site.invoice_number")
                </td>
                <td>
                    @lang("site.name_supplier")
                </td>
                <td>
                    @lang("site.name_project")
                </td>
                <td>
                    @lang("site.nat_tax_number")
                </td>
                <td>
                    @lang("site.tax_file_number")
                </td>
                <td>
                    @lang("site.address")
                </td>
                <td>
                    @lang("site.nat_passport_number")
                </td>
                <td>
                    @lang("site.phone_number")
                </td>
                <td>
                    @lang("site.date_invoice")
                </td>
                <td>
                    @lang("site.product")
                </td>
                <td>
                    @lang("site.code")  @lang("site.product")
                </td>
                <td>
                    @lang("site.statement_type")
                </td>
                <td>
                    @lang("site.item_type")
                </td>
                <td>
                    @lang("site.product_unit_measure")
                </td>
                <td>
                    @lang("site.unit_price")
                </td>
                <td>
                    @lang("site.category_tax")
                </td>
                <td>
                    @lang("site.unit_quantity")
                </td>
                <td>
                    @lang("site.total_ack")
                </td>

                <td>
                    @lang("site.other_discount_value")
                </td>
                <td>
                    @lang("site.total_after_discount_ack")
                </td>
                <td>
                    @lang("site.tax_deduction_value_ack")
                </td>
                <td>
                    @lang("site.net_total_ack")
                </td>




            </thead>

            <tbody>
              @foreach ($invoices as $invoice )
              @if($invoice->value_tax_rate=="14")
                  <tr>
                    <td>
                        1
                    </td>
                    <td>
                        1
                    </td>
                    <td>
                        0
                    </td>
                    <td>
                        {{$invoice->invoice_number}}
                    </td>
                    <td>
                        {{$invoice->supplier->name_ar}}
                    </td>
                    @if($invoice->project_id)
                    <td>
                       {{$invoice->project->name_ar}}
                    </td>
                    @else
                    <td></td>
                    @endif
                    <td>
                        {{$invoice->supplier->nat_tax_number}}
                    </td>
                    <td>
                        -
                    </td>
                    <td>
                        -
                    </td>
                    <td>
                        -
                    </td>
                    <td>
                        -
                    </td>
                    <td>
                        {{$invoice->date_invoice->format("d-m-Y")}}
                    </td>
                    <td>
                        {{$invoice->specifications}}
                    </td>
                    <td>
                        -
                    </td>
                    <td>
                        1
                    </td>
                    <td>
                        3
                    </td>
                    <td>
                        -
                    </td>
                    <td>
                        {{$invoice->price}}
                    </td>
                    <td>
                        {{$invoice->value_tax_rate}} %
                    </td>
                    <td>
                        {{$invoice->amount}}
                    </td>
                    <td>
                        {{$invoice->total}}
                    </td>

                    <td>
                        {{$invoice->other_discount}}
                    </td>
                    <td>
                        @php
                           $net_amount = filter_var($invoice->total,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION) - filter_var($invoice->other_discount,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
                        @endphp
                        {{$net_amount}}
                    </td>

                    <td>
                        {{$invoice->value_tax}}
                    </td>
                    <td>
                        @php
                           $total_ack = $net_amount + filter_var($invoice->value_tax,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
                        @endphp
                        {{$total_ack}}
                    </td>

                </tr>
              
                @endif
              @endforeach
            
            </tbody>
        </table>

    </div>


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