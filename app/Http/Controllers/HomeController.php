<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\BusinessNature;
use App\Models\Cheque;
use App\Models\DiscountType;
use App\Models\Invoice;
use App\Models\Item;
use App\Models\NatureDealing;
use App\Models\PaymentInvoice;
use App\Models\Project;
use App\Models\Supplier;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(){

         $count['items'] = Item::count();
        $count['businessNatures'] = BusinessNature::count();
        $count['projects'] = Project::count();
        $count['natureDealings'] = NatureDealing::count();
        $count['suppliers'] = Supplier::count();
        $count['discountTypes'] = DiscountType::count();
        $count['banks'] = Bank::count();
        $count['invoices'] = Invoice::count();
        $count['invoices_reviewed'] = Invoice::where("approved","1")->count();
        $count['paymentInvoices'] = PaymentInvoice::count();
        $count['paymentInvoices_reviewed'] = PaymentInvoice::where("approved","1")->count();
        $count['users'] = User::count();

        return view('home',compact('count'));
    }
}
