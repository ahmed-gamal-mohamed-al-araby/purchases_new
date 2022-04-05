<?php

namespace App\Http\Controllers\Invoice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Imports\InvoicesImport;
use App\Models\BusinessNature;
use App\Models\Invoice;
use App\Models\Item;
use App\Models\NatureDealing;
use App\Models\Project;
use App\Models\Supplier;
use App\Traits\ToastrTrait;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class InvoiceController extends Controller
{

    use ToastrTrait;


    public function index()
    {
        $invoices = Invoice::with(['project', "supplier", "natureDealing"])->orderBy("id", "DESC")->get();
        return view('invoices.index', compact("invoices"));
    }

    public function show($id)
    {
        $invoice = Invoice::where('id', $id)->first();
        // return $invoice;

        return view('invoices.show', compact("invoice"));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $items = Item::all();
        $projects = Project::all();
        $businessNatures = BusinessNature::where("item_id", 2)->get();
        $natureDealings = NatureDealing::all();
        return view('invoices.create', compact("items", "projects", "businessNatures", "natureDealings" , "suppliers"));
    }

    public function getInvoiceData(Request $request)
    {
        $pro_id = $request->pro_id;
        return $project = Project::with("businessNature")->find($pro_id);
    }

    public function getInvoiceDataSupplier(Request $request)
    {
        $supplier_type = $request->supplier_type;
        return  $supplier = Supplier::where('type', $supplier_type)->get();
    }

    public function getInvoiceSupplierName(Request $request)
    {
        $supplier_id = $request->supplier_id;
        return  $supplier = Supplier::find($supplier_id);
    }

    public function getInvoicediscountType(Request $request)
    {

        $nature_dealing = $request->nature_dealing;
        return  $nature_dealing = NatureDealing::with("discountTypes")->find($nature_dealing);
    }
    public function store(Request $request)
    {
        //  return $request->all();
        // $supplier = Supplier::where("nat_tax_number",$request->nat_tax_number)->first();
        if ($request->restrained_type == null) {
            $request->restrained_type = "not_restrained";
        }
        if ($request->expense_type  == null) {
            $request->expense_type = "cashe";
        }

         $year = Carbon::now()->format("Y");
         $invoice = Invoice::where("supplier_id",$request->nat_tax_number)->whereYear("date_invoice", $year)->where("invoice_number",$request->invoice_number)->get();
        if($invoice->count() > 0 && $request->nat_tax_number != 1) {
              Toastr()->error(
                trans('site.invoice_number_already_exist'),
                trans("site.Error"),
                [
                    "closeButton" => true,
                    "progressBar" => true,
                    "positionClass" => app()->getLocale() == 'en' ? "toast-top-right" : "toast-top-left",
                    "timeOut" => "10000",
                    "extendedTimeOut" => "10000",
                ]
            );
            return redirect()->route("invoice.index")->with(['success' => "Invoice Added Successfully"]);
        } else {
            Invoice::create([
                "item_id" => $request->item_id,
                "project_id" => $request->project_id,
                "business_nature_id" => $request->business_nature,
                "covenant_type" => $request->covenant_type,
                "detection_number" => $request->detection_number,
                "supplier_id" => $request->nat_tax_number,
                "po_number" => $request->supply_order_number,
                "date_invoice" => $request->invoice_date,
                "invoice_number" => $request->invoice_number,
                "specifications" => $request->product,
                "price" => $request->unit_price,
                "amount" => $request->unit_quantity,
                "total" => $request->total,
                "value_tax_rate" => $request->value_tax_rate,
                "value_tax" => $request->value_tax,
                "overall_total" => $request->overall_total,
                "other_discount" => $request->other_discount,
                "total_after_discount" => $request->total_after_discount,
                "restrained_type" => $request->restrained_type,
                "nature_dealing_id" => $request->nature_dealing,
                "expense_type" => $request->expense_type,
                "tax_deduction" => $request->tax_deduction,
                "tax_deduction_value" => $request->tax_deduction_value,
                "net_total" => $request->net_total,
                "business_insurance_rate" => $request->business_insurance_rate,
                "business_insurance_value" => $request->business_insurance_value,
                "net_total_after_business_insurance" => $request->net_total_after_business_insurance,
                "notes" => $request->notes,
                "user_id" => \Auth::user()->id
            ]);
            Toastr()->success(
                trans('site.invoice_added_successfully'),
                trans("site.Success"),
                [
                    "closeButton" => true,
                    "progressBar" => true,
                    "positionClass" => app()->getLocale() == 'en' ? "toast-top-right" : "toast-top-left",
                    "timeOut" => "10000",
                    "extendedTimeOut" => "10000",
                ]


            );
            return redirect()->route("invoice.index")->with(['success' => "Invoice Added Successfully"]);
        }

    }

    public function edit(Request $request, $id)
    {
        $items = Item::all();
        $suppliers = Supplier::all();
        $businessNatures = BusinessNature::where("item_id", 2)->get();
        $natureDealings = NatureDealing::all();
        $invoice = Invoice::with(['project', "supplier", "businessNature", "natureDealing" => function ($q) {
            $q->with("discountTypes");
        }])->find($id);
        if (!$invoice)
            return redirect()->route("invoice.index")->with(['error' => "Not Found This invoice"]);
        $projects = Project::where("item_id", $invoice->item_id)->get();
        return view("invoices.edit", compact("invoice", "items", "projects", "businessNatures", "suppliers" , "natureDealings"));
    }

    public function update(Request $request, $id)
    {
      if($request->business_nature_id) {
        $bsiness_id = $request->business_nature_id;
      }else{
        $bsiness_id  = $request->business_nature;
      }
      $invoice = Invoice::find($id);
      $year = Carbon::now()->format("Y");
      $invoiceUpdate = Invoice::where("supplier_id",$request->nat_tax_number)->whereYear("date_invoice", $year)->where("invoice_number",$request->invoice_number)->first();
      $invoice_number_new = '';
      //if($request->nat_tax_number != 1){
        if($invoiceUpdate != NULL){
          $invoice_number_new = $invoice->invoice_number;
          Toastr()->error(
            trans('site.invoice_number_already_exist_update_successfully'),
            trans("site.Error"),
            [
                "closeButton" => true,
                "progressBar" => true,
                "positionClass" => app()->getLocale() == 'en' ? "toast-top-right" : "toast-top-left",
                "timeOut" => "10000",
                "extendedTimeOut" => "10000",
            ]
          );
        }else{
          $invoice_number_new = $request->invoice_number;
          Toastr()->success(
              trans('site.invoice_updated_successfully'),
              trans("site.Success"),
              [
                  "closeButton" => true,
                  "progressBar" => true,
                  "positionClass" => app()->getLocale() == 'en' ? "toast-top-right" : "toast-top-left",
                  "timeOut" => "10000",
                  "extendedTimeOut" => "10000",
              ]
          );
        }
      //}

      $invoiceNewUpdate = Invoice::where("id",$id)->update([
        "item_id" => $request->item_id,
        "project_id" => $request->project_id,
        "business_nature_id" => $bsiness_id,
        "covenant_type" => $request->covenant_type,
        "detection_number" => $request->detection_number,
        "supplier_id" => $request->nat_tax_number,
        "po_number" => $request->supply_order_number,
        "date_invoice" => $request->invoice_date,
        "invoice_number" => $invoice_number_new,
        "specifications" => $request->product,
        "price" => $request->unit_price,
        "amount" => $request->unit_quantity,
        "total" => $request->total,
        "value_tax_rate" => $request->value_tax_rate,
        "value_tax" => $request->value_tax,
        "overall_total" => $request->overall_total,
        "other_discount" => $request->other_discount,
        "total_after_discount" => $request->total_after_discount,
        "restrained_type" => $request->restrained_type,
        "nature_dealing_id" => $request->nature_dealing,
        "expense_type" => $request->expense_type,
        "tax_deduction" => $request->tax_deduction,
        "tax_deduction_value" => $request->tax_deduction_value,
        "net_total" => $request->net_total,
        "business_insurance_rate" => $request->business_insurance_rate,
        "business_insurance_value" => $request->business_insurance_value,
        "net_total_after_business_insurance" => $request->net_total_after_business_insurance,
        "notes" => $request->notes,
        "user_id" => $invoice->user_id
      ]);

      if($invoiceNewUpdate){
        return redirect()->route("invoice.index")->with(['success' => "Invoice Updated Successfully"]);
      }

        /*$invoice = Invoice::find($id);
        if($request->business_nature_id) {
          $bsiness_id = $request->business_nature_id;
        }else{
          $bsiness_id  = $request->business_nature;
        }
        $year = Carbon::now()->format("Y");
        $invoice_number_new = '';
        $invoiceUpdate = Invoice::where("supplier_id",$request->nat_tax_number)->whereYear("date_invoice", $year)->where("invoice_number",$request->invoice_number)->first();
        if($invoiceUpdate != NULL &&  $request->invoice_number === $invoiceUpdate->invoice_number){
          $invoice_number_new = $invoiceUpdate->invoice_number;
          Toastr()->error(
            trans('site.invoice_number_already_exist'),
            trans("site.Error"),
            [
                "closeButton" => true,
                "progressBar" => true,
                "positionClass" => app()->getLocale() == 'en' ? "toast-top-right" : "toast-top-left",
                "timeOut" => "10000",
                "extendedTimeOut" => "10000",
            ]
          );
        }else{
          $invoice_number_new = $request->invoice_number;
          Toastr()->success(
              trans('site.invoice_updated_successfully'),
              trans("site.Success"),
              [
                  "closeButton" => true,
                  "progressBar" => true,
                  "positionClass" => app()->getLocale() == 'en' ? "toast-top-right" : "toast-top-left",
                  "timeOut" => "10000",
                  "extendedTimeOut" => "10000",
              ]
          );
        }
        $invoiceNewUpdate = Invoice::where("id",$id)->update([
          "item_id" => $request->item_id,
          "project_id" => $request->project_id,
          "business_nature_id" => $bsiness_id,
          "covenant_type" => $request->covenant_type,
          "detection_number" => $request->detection_number,
          "supplier_id" => $request->nat_tax_number,
          "po_number" => $request->supply_order_number,
          "date_invoice" => $request->invoice_date,
          "invoice_number" => $invoice_number_new,
          "specifications" => $request->product,
          "price" => $request->unit_price,
          "amount" => $request->unit_quantity,
          "total" => $request->total,
          "value_tax_rate" => $request->value_tax_rate,
          "value_tax" => $request->value_tax,
          "overall_total" => $request->overall_total,
          "other_discount" => $request->other_discount,
          "total_after_discount" => $request->total_after_discount,
          "restrained_type" => $request->restrained_type,
          "nature_dealing_id" => $request->nature_dealing,
          "expense_type" => $request->expense_type,
          "tax_deduction" => $request->tax_deduction,
          "tax_deduction_value" => $request->tax_deduction_value,
          "net_total" => $request->net_total,
          "business_insurance_rate" => $request->business_insurance_rate,
          "business_insurance_value" => $request->business_insurance_value,
          "net_total_after_business_insurance" => $request->net_total_after_business_insurance,
          "notes" => $request->notes,
          "user_id" => $invoice->user_id
        ]);
        if($invoiceNewUpdate){
          return redirect()->route("invoice.index")->with(['success' => "Invoice Updated Successfully"]);
        }*/

    }
    public function approveInvoice($id)
    {

        // return $id;

        $payment = Invoice::where('id', $id)->update([
            "approved" => "1",
        ]);

        if (Auth::user()->id == 12 || Auth::user()->id == 13 || Auth::user()->id == 2) {
            return redirect()->route("invoice.reviewing")->with(['success' => "Invoice Updated Successfully"]);
        }
        return redirect()->route("invoice.index")->with(['success' => "Invoice Updated Successfully"]);
    }

    public function importinvoice(Request $request)
    {

        if (!$request->file) {
            return back()->with('error', 'Can not upload empty file.');

        }
        // return $request->file;
        Excel::import(new InvoicesImport, request()->file('file'));

        return back()->with('success', 'Supplier created successfully.');
    }

    public function delete(Request $request, $id)
    {
        $invoice = Invoice::find($id);
        if (!$invoice)
            return redirect()->route("invoice.index")->with(['error' => "Not Found This Invoice"]);
        $invoice->delete();
        return redirect()->route("invoice.index")->with(['success' => "Invoice Deleted Successfully"]);
    }

    public function reviewing()
    {
        $invoices = Invoice::where("approved", 0)->with(['project', "supplier", "natureDealing"])->orderBy("id", "DESC")->get();
        return view('invoices.index', compact("invoices"));
    }
    public function reviewed()
    {
        $invoices = Invoice::where("approved", 1)->with(['project', "supplier", "natureDealing"])->orderBy("id", "DESC")->get();
        return view('invoices.index', compact("invoices"));
    }
    public function invoiceNumberCheck(Request $request)
    {
        // return $request;
        $year = Carbon::now()->format("Y");
        $invoice = Invoice::where("supplier_id",$request->nat_tax_number)->whereYear("date_invoice", $year)->where("invoice_number",$request->invoice_number)->get();
       if($invoice->count() > 0 && $request->nat_tax_number != 1) {
           return trans('site.invoice_number_already_exist');
       } 
      
    }
}
