@php
$currentLang = app()->getLocale();
@endphp

<div class="row text-info">

<div class="col-4">@lang("site.discount") 0% : {{number_format($tax_deduction_sum_0,2)}}</div>
<div class="col-4">@lang("site.discount") 1% : {{number_format($tax_deduction_sum_1,2)}}</div>
<div class="col-4">@lang("site.discount") 3% : {{number_format($tax_deduction_sum_3,2)}}</div>
<div class="col-4">@lang("site.discount") 5% : {{number_format($tax_deduction_sum_5,2)}}</div>
<div class="col-4">@lang("site.discount") @lang("site.advance_payments") : {{number_format($tax_deduction_sum_0,2)}}</div>
<div class="col-4">@lang("site.total") : {{number_format($total_sum,2)}}</div>

</div>

<br>

    <div class="table-responsive">
    <table id="example" class="table table-bordered mt-4 table-striped text-center date display" style="width:100%">


                    <thead class="tableItem" id="headers">

                        <td>
                            @lang("site.name_project")
                        </td>
                        <td>
                            @lang("site.nature_dealing")
                        </td>
                        <td>
                            @lang("site.discount")
                        </td>
                        <td>
                            @lang("site.discount_perc")
                        </td>
                        <td>
                            @lang("site.total")
                        </td>
                        <td>
                            @lang("site.nat_number")
                        </td>
                        <td>
                            @lang("site.tax_number")
                        </td>
                        <td>
                            @lang("site.supplier_name")
                        </td>

                        <td>
                            @lang("site.invoice_number")
                        </td>
                        <td>
                            @lang("site.date_invoice")
                        </td>






                    </thead>

            <tbody>
              @foreach ($invoices as $invoice )
                  <tr>
                    <td>
                        @if($invoice->project)
                        {{$invoice->project->name_ar}}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                    @if($invoice->natureDealing)
                        {{$invoice->natureDealing->name_ar}}
                        @else
                            -
                        @endif

                    </td>
                    <td>
                          {{$invoice->tax_deduction_value}}
                    </td>
                    <td>
                         @if ($invoice->tax_deduction == 2)
                         @lang("site.advance_payments")

                        @else
                        % {{$invoice->tax_deduction}}
                         @endif
                    </td>
                    <td>
                        {{$invoice->total}}
                    </td>
                    <td>
                        @if($invoice->supplier)
                            @if ($invoice->supplier->type == "person")
                                {{$invoice->supplier->nat_tax_number}}
                            @else
                                -
                            @endif
                        @else
                            -
                        @endif

                    </td>
                    <td>
                        @if($invoice->supplier)
                            @if ($invoice->supplier->type == "company")
                                {{$invoice->supplier->nat_tax_number}}
                            @else
                                -
                            @endif
                        @else
                            -
                        @endif

                    </td>
                    <td>
                    @if($invoice->supplier)
                        {{$invoice->supplier->name_ar}}
                        @else
                            -
                        @endif

                    </td>
                    <td>
                        {{$invoice->invoice_number}}
                    </td>
                    <td>
                        {{$invoice->date_invoice->format("d-m-Y")}}
                    </td>


                </tr>
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