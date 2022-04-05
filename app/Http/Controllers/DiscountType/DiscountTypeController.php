<?php

namespace App\Http\Controllers\DiscountType;

use App\Http\Controllers\Controller;
use App\Models\DiscountType;
use App\User;
use Illuminate\Http\Request;

class DiscountTypeController extends Controller
{
    public function index()
    {
        $discountTypes = DiscountType::all();
        return view('discount_type.index', compact('discountTypes'));
    }

    public function create()
    {
        return view('discount_type.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_ar' => 'required',
            'code' => 'required|unique:discount_types|numeric',
        ]);
        DiscountType::create([
            "name_en" => $request->name_en,
            "name_ar" => $request->name_ar,
            "code" => $request->code,
        ]);
        return redirect()->route("discountType.index")->with(['success' => "discountType Created Successfully"]);
    }

    public function edit(Request $request, $id)
    {
        $discountType = DiscountType::find($id);
        if (!$discountType)
            return redirect()->route("projects.index")->with(['error' => "Not Found This discountType"]);
        return view("discount_type.edit", compact("discountType"));
    }

    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'name_ar' => 'required',
            'code' => 'required|numeric|unique:discount_types,code,'.$id,
        ]);
        $discountType = DiscountType::find($id);
        if (!$discountType)
            return redirect()->route("discountType.index")->with(['error' => "Not Found This discountType"]);
        DiscountType::where("id", $id)->update([
            "name_en" => $request->name_en,
            "name_ar" => $request->name_ar,
            "code" => $request->code,
        ]);
        return redirect()->route("discountType.index")->with(['success' => "discountType Updated Successfully"]);
    }

    public function delete(Request $request, $id)
    {
        $project = DiscountType::find($id);
        if (!$project)
            return redirect()->route("discountType.index")->with(['error' => "Not Found This discountType"]);
        $project->delete();
        return redirect()->route("discountType.index")->with(['success' => "discountType Deleted Successfully"]);
    }
}
