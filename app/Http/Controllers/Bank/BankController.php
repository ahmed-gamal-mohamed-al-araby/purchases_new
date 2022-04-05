<?php

namespace App\Http\Controllers\Bank;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\User;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function index()
    {
        $banks = Bank::all();
        return view('bank.index', compact('banks'));
    }

    public function create()
    {
        return view('bank.create');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'bank_name' => 'required',
            'currency' => 'required',
            'bank_code' => 'required|unique:banks|numeric',
            'bank_account_number' => 'required|unique:banks',


        ]);

        Bank::create([
            "bank_name" => $request->bank_name,
            "currency" => $request->currency,
            "bank_code" => $request->bank_code,
            "bank_account_number" => $request->bank_account_number
        ]);
        return redirect()->route("bank.index")->with(['success' => "bank Created Successfully"]);
    }

    public function edit(Request $request, $id)
    {
        $bank = Bank::find($id);
        if (!$bank)
            return redirect()->route("natureDealing.index")->with(['error' => "Not Found This bank"]);
        return view("bank.edit", compact("bank"));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'bank_name' => 'required',
            'currency' => 'required',
            'bank_code' => 'required|numeric|unique:banks,bank_code,'.$id,
            'bank_account_number' => 'required|unique:banks,bank_account_number,'.$id,


        ]);

        $bank = Bank::find($id);
        if (!$bank)
            return redirect()->route("bank.index")->with(['error' => "Not Found This bank"]);
        Bank::where("id", $id)->update([
            "bank_name" => $request->bank_name,
            "currency" => $request->currency,
            "bank_code" => $request->bank_code,
            "bank_account_number" => $request->bank_account_number
        ]);
        return redirect()->route("bank.index")->with(['success' => "bank Updated Successfully"]);
    }

    public function delete(Request $request, $id)
    {
        $bank = Bank::find($id);
        if (!$bank)
            return redirect()->route("bank.index")->with(['error' => "Not Found This bank"]);
        $bank->delete();
        return redirect()->route("bank.index")->with(['success' => "bank Deleted Successfully"]);
    }
    
    public function approveBank($id)
    {

        // return $id;

        $bank = Bank::where('id', $id)->update([
            "approved" => "1",
        ]);

        
        return redirect()->route("bank.index")->with(['success' => "Bank Updated Successfully"]);
    }
}
