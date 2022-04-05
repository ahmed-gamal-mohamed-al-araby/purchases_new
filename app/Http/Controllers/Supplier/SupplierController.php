<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Imports\ProjectsImport;
use App\Models\Supplier;
use App\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SupplierController extends Controller
{

    public function index(){
        $suppliers = Supplier::all();
        return view('supplier.index',compact('suppliers'));
    }

    public function create(){
        return view('supplier.create');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name_ar' => 'required',
            'type' => 'required',
            'nat_tax_number' => 'required|numeric|unique:suppliers',

        ]);

        Supplier::create([
            "name_en" => $request->name_en,
            "name_ar" => $request->name_ar,
            "type" => $request->type,
            "nat_tax_number" => $request->nat_tax_number
        ]);
        return redirect()->route("supplier.index")->with(['success' => "Supplier Created Successfully"]);
    }

    public function edit(Request $request , $id)
    {
       $supplier = Supplier::find($id);
       if(!$supplier)
            return redirect()->route("supplier.index")->with(['error' => "Not Found This supplier"]);
       return view("supplier.edit", compact("supplier"));
    }

    public function update(Request $request , $id)
    {
        $validated = $request->validate([
            'name_ar' => 'required',
            'type' => 'required',
            'nat_tax_number' => 'required|unique:suppliers,nat_tax_number,'.$id,

        ]);

        $supplier = Supplier::find($id);
        if(!$supplier)
             return redirect()->route("supplier.index")->with(['error' => "Not Found This supplier"]);
        Supplier::where("id",$id)->update([
            "name_en" => $request->name_en,
            "name_ar" => $request->name_ar,
            "type" => $request->type,
            "nat_tax_number" => $request->nat_tax_number
        ]);
        return redirect()->route("supplier.index")->with(['success' => "Supplier Updated Successfully"]);
    }

    public function delete(Request $request , $id)
    {
        $supplier = Supplier::find($id);
        if(!$supplier)
             return redirect()->route("supplier.index")->with(['error' => "Not Found This supplier"]);
        $supplier->delete();
        return redirect()->route("supplier.index")->with(['success' => "Supplier Deleted Successfully"]);
    }

    public function importsupplier(Request $request)
    {

        if (!$request->file) {
            return back()->with('error', 'Can not upload empty file.');

        }
        // return $request->file;
        Excel::import(new ProjectsImport, request()->file('file'));

        return back()->with('success', 'Supplier created successfully.');
    }

    public function show($id)
    {

    }

 public function approveSupplier($id)
    {

        $supplier = Supplier::where('id', $id)->update([
            "approved" => "1",
        ]);

        
        return redirect()->route("supplier.index")->with(['success' => "Supplier Updated Successfully"]);
    }    

}
