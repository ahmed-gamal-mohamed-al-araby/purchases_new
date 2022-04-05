<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\BusinessNature;
use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\Project;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("reports.report_general_expenses");
    }

    public function reportsGeneralConclusions()
    {
        return view("reports.report_general_conclusions");
    }

    public function ackAddedValue()
    {
        return view("reports.report_ack_added_value");
    }

    public function discountTaxes()
    {
        return view("reports.report_discount_taxes");
    }

  public function ackAddedValueGSH()
    {
        return view("reports.report_ack_added_value_G_SH");
    }

    public function ackAddedValueGSHAjax(Request $request)
    {
        $startDate = $request->from_date;
        $endDate = $request->to_date;
        $projectsID = Project::where("type", "Excl")->pluck("id");
         $invoices = Invoice::where("item_id",1)->whereNotNull("tax_deduction")->whereIn("project_id",$projectsID)
        ->where("date_invoice", "<=" , $request->up_to_date)
        ->whereDate("created_at" , ">=" , $startDate)
        ->whereDate("created_at" , "<=" , $endDate)
        ->orderBy("date_invoice","ASC")->get();
        return view("reports.table_ack_added_value" , compact("invoices"))->render();
    }

    public function report(Request $request) {

       $invoices = Invoice::where("item_id",2)->whereBetween("date_invoice", [$request->from_date,$request->to_date])->orderBy("date_invoice","ASC")->get();

        $total_not_restrained = 0;
        $total_restrained = 0;
        $jun = [];
        $all = [];
        $month = [];
        foreach($invoices as $index => $invo) {
            $month[] = $invo->date_invoice->format("M");
        }

        $month = array_unique($month);
        // $business_id = $invoices->pluck("business_nature_id")->toArray();
        //  $businessID = array_unique($business_id);

         $businessNatures = BusinessNature::with(["invoices" => function($q) use($request) {
            $q->where("item_id",2)->whereBetween("date_invoice", [$request->from_date,$request->to_date]);
         }])->where("item_id",2)->get();

        foreach($invoices as $index => $invo) {
            if( in_array($invo->date_invoice->format("M") , $month ) ) {
                $jun [$invo->date_invoice->format("M")][]   =  $invo ;
            }
        }


        foreach($jun as  $index => $data ) {
        // return $data;
            $total_restrained = 0;
            $total_not_restrained = 0;
            $all[$index]['total_restrained'] = 0;
            $all[$index]['total_not_restrained'] = 0;
            $all[$index]['total_all'] = 0;
            foreach($data as $juns) {
                if($juns->restrained_type == "not_restrained") {
                    if($juns->overall_total != null)
                    {
                         $tot = $juns->overall_total;
                    } else {
                         $tot = $juns->total;
                    }
                    $gtotal = filter_var($tot,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
                    $total_not_restrained += $gtotal;
                    $all[$index]['total_not_restrained'] = $total_not_restrained;

            }

                if($juns->restrained_type == "restrained") {
                    if($juns->overall_total != null)
                    {
                         $tot = $juns->overall_total;
                    } else {
                         $tot = $juns->total;
                    }
                    $gtotal = filter_var($tot,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
                    $total_restrained += $gtotal;
                    $all[$index]['total_restrained'] = $total_restrained;

            }
                $all[$index]['total_all'] = $total_not_restrained + $total_restrained;
            }
        }



        return view("reports.table_report_general_expenses" , compact("invoices","businessNatures", "month" , "all"))->render();
    }

    public function generalConclusionsAjax(Request $request) {
        $invoices = Invoice::where("item_id",2)->whereBetween("date_invoice", [$request->from_date,$request->to_date])->orderBy("date_invoice","ASC")->get();
        $jun = [];
        $all = [];
        $month = [];
        foreach($invoices as $index => $invo) {
            $month[] = $invo->date_invoice->format("M");
        }

        $month = array_unique($month);
        // $business_id = $invoices->pluck("business_nature_id")->toArray();
        //  $businessID = array_unique($business_id);

         $businessNatures = BusinessNature::with(["invoices" => function($q) use($request) {
            $q->where("item_id",2)->whereBetween("date_invoice", [$request->from_date,$request->to_date]);
         }])->where("item_id",2)->get();

        foreach($invoices as $index => $invo) {
            if( in_array($invo->date_invoice->format("M") , $month ) ) {
                $jun [$invo->date_invoice->format("M")][]   =  $invo ;
            }
        }


        foreach($jun as  $index => $data ) {
            // return $data;
                $all[$index]['total_restrained'] = 0;
                $all[$index]['total_not_restrained'] = 0;
                $all[$index]['overall_total'] = 0;
                $all[$index]['cashe'] = 0;
                $all[$index]['okay'] = 0;
                $all[$index]['tax_deduction_value'] = 0;
                $total_not_restrained = 0;
                $total_restrained = 0;
                $okay = 0;
                $cashe = 0;
                $overall_total = 0;
                $tax_deduction_value = 0;
                foreach($data as $juns) {
                    if($juns->restrained_type == "not_restrained") {

                    if($juns->overall_total != null)
                       {
                            $tot = $juns->overall_total;
                       } else {
                            $tot = $juns->total;
                       }
                        $gtotal = filter_var($tot,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
                        $total_not_restrained += $gtotal;
                        $all[$index]['total_not_restrained'] = $total_not_restrained;

                    }

                    if($juns->restrained_type == "restrained") {
                        if($juns->overall_total != null)
                       {
                            $tot = $juns->overall_total;
                       } else {
                            $tot = $juns->total;
                       }
                        $gtotal = filter_var($tot,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
                        $total_restrained += $gtotal;
                        $all[$index]['total_restrained'] = $total_restrained;

                }

                    if($juns->expense_type == "okay") {
                        if($juns->overall_total != null)
                        {
                             $tot = $juns->overall_total;
                        } else {
                             $tot = $juns->total;
                        }

                        $gtotal = filter_var($tot,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
                        $okay += $gtotal;
                        $all[$index]['okay'] = $okay;

                }

                    if($juns->expense_type == "cashe") {
                        if($juns->overall_total != null)
                        {
                             $tot = $juns->overall_total;
                        } else {
                             $tot = $juns->total;
                        }
                        $gtotal = filter_var($tot,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
                        $cashe += $gtotal;
                        $all[$index]['cashe'] = $cashe;

                }
                if($juns->overall_total != null)
                    {
                         $tot = $juns->overall_total;
                    } else {
                         $tot = $juns->total;
                    }
                    $gtotal = filter_var($tot,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
                    $overall_total += $gtotal;
                    $all[$index]['overall_total'] = $overall_total;
                    if($juns->tax_deduction_value == null) {
                        $juns->tax_deduction_value = 0;
                    }
                    $gtotal = filter_var($juns->tax_deduction_value,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
                    $tax_deduction_value += $gtotal;
                    $all[$index]['tax_deduction_value'] = $tax_deduction_value;
                }
            }


        return view("reports.table_report_general_conclusions" , compact("invoices","businessNatures", "month" , "all"))->render();
    }

    public function ackAddedValueAjax(Request $request) {

        $startDate = $request->from_date;
        $endDate = $request->to_date;
        $total_sum=0;
        $value_tax_sum=0;
        $total_ack_sum=0;
         $invoices = Invoice::where("item_id",1)->whereNotNull("tax_deduction")
        ->where("date_invoice", "<=" , $request->up_to_date)
        ->whereDate("created_at" , ">=" , $startDate)
        ->whereDate("created_at" , "<=" , $endDate)
        ->orderBy("date_invoice","ASC")->get();


              foreach ($invoices as $invoice) {
                  if ($invoice->value_tax_rate=="14") {
                    $total_sum+=filter_var($invoice->total,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
                    $value_tax_sum+=filter_var($invoice->value_tax,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
                    $total_ack_sum+=filter_var($invoice->total,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION) - filter_var($invoice->other_discount,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION)+filter_var($invoice->value_tax,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
                  }
              }
        return view("reports.table_ack_added_value" , compact("invoices","total_sum","value_tax_sum","total_ack_sum"))->render();
    }

    public function discountTaxesAjax(Request $request) {

        $startDate = $request->from_date;
        $endDate = $request->to_date;
        $tax_deduction_sum_0=0;
        $tax_deduction_sum_1=0;
        $tax_deduction_sum_3=0;
        $tax_deduction_sum_5=0;
        $tax_deduction_sum_advance_payments=0;
        $total_sum=0;
         $invoices = Invoice::where("tax_deduction", "!=" , 0)
        ->where("date_invoice", "<=" , $request->up_to_date)
        ->whereDate("created_at" , ">=" , $startDate)
        ->whereDate("created_at" , "<=" , $endDate)
        ->orderBy("date_invoice","ASC")->get();

        foreach ($invoices as $invoice) {
            if ($invoice->tax_deduction == 0) {
                $tax_deduction_sum_0+= filter_var($invoice->tax_deduction_value,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
            }
            if ($invoice->tax_deduction == 1) {
                $tax_deduction_sum_1+= filter_var($invoice->tax_deduction_value,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
            }
            if ($invoice->tax_deduction == 3) {
                $tax_deduction_sum_3+= filter_var($invoice->tax_deduction_value,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
            }
            if ($invoice->tax_deduction == 5) {
                $tax_deduction_sum_5+= filter_var($invoice->tax_deduction_value,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
            }
            if ($invoice->tax_deduction == 2) {
                $tax_deduction_sum_advance_payments+= filter_var($invoice->tax_deduction_value,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
            }
            $total_sum+= filter_var($invoice->total,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);

        }
        return view("reports.table_discount_taxes" , compact("invoices","tax_deduction_sum_0","tax_deduction_sum_1","tax_deduction_sum_3","tax_deduction_sum_5","tax_deduction_sum_advance_payments","total_sum"))->render();
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
