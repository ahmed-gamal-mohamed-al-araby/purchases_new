<?php

namespace App\Http\Controllers\BusinessNature;

use App\Http\Controllers\Controller;
use App\Models\BusinessNature;
use App\Models\Item;
use App\User;
use Illuminate\Http\Request;

class BusinessNatureController extends Controller
{

    public function index()
    {
        $businessNatures = BusinessNature::all();
        return view('business_nature.index', compact('businessNatures'));
    }

    public function create()
    {
        $items = Item::all();
        return view('business_nature.create', compact('items'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name_ar' => 'required|unique:business_natures',
        ]);

        BusinessNature::create([
            "name_en" => $request->name_en,
            "name_ar" => $request->name_ar,
            "item_id" => $request->item_id,

        ]);
        return redirect()->route("businessNature.index")->with(['success' => "businessNature Updated Successfully"]);
    }

    public function edit(Request $request, $id)
    {
        $businessNature = BusinessNature::find($id);
        $items = Item::all();

        if (!$businessNature)
            return redirect()->route("businessNature.index")->with(['error' => "Not Found This businessNature"]);
        return view("business_nature.edit", compact("businessNature", "items"));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name_ar' => 'required|unique:business_natures,name_ar,' . $id,
        ]);

        $businessNature = BusinessNature::find($id);
        if (!$businessNature)
            return redirect()->route("businessNature.index")->with(['error' => "Not Found This businessNature"]);
        BusinessNature::where("id", $id)->update([
            "name_en" => $request->name_en,
            "name_ar" => $request->name_ar,
            "item_id" => $request->item_id,

        ]);
        return redirect()->route("businessNature.index")->with(['success' => "businessNature Updated Successfully"]);
    }

    public function delete(Request $request, $id)
    {
        $businessNature = BusinessNature::find($id);
        if (!$businessNature)
            return redirect()->route("businessNature.index")->with(['error' => "Not Found This businessNature"]);
        $businessNature->delete();
        return redirect()->route("businessNature.index")->with(['success' => "businessNature Deleted Successfully"]);
    }
}
