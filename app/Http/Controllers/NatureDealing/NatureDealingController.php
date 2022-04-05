<?php

namespace App\Http\Controllers\NatureDealing;
use App\Http\Controllers\Controller;
use App\Models\DiscountType;
use App\Models\NatureDealing;
use App\User;
use Illuminate\Http\Request;

class NatureDealingController extends Controller
{
    public function index(){
        $NatureDealings = NatureDealing::with("discountTypes")->get();
        return view('nature_dealing.index',compact('NatureDealings'));
    }
    
    public function create(){
        $discountTypes = DiscountType::all();
        return view('nature_dealing.create', compact("discountTypes"));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_ar' => 'required|unique:nature_dealings',
            'code' => 'required|unique:nature_dealings|numeric',
            'discount_type_id' => 'required',

        ]);

        NatureDealing::create([
            "name_en" => $request->name_en,
            "name_ar" => $request->name_ar,
            "code" => $request->code,
            "discount_type_id" => $request->discount_type_id
        ]);
        return redirect()->route("natureDealing.index")->with(['success' => "natureDealing Created Successfully"]); 
    }
    
    public function edit(Request $request , $id)
    {
       $discountTypes = DiscountType::all();
       $NatureDealing = NatureDealing::find($id);
       if(!$NatureDealing)
            return redirect()->route("natureDealing.index")->with(['error' => "Not Found This natureDealing"]);
       return view("nature_dealing.edit", compact("NatureDealing","discountTypes"));
    }
    
    public function update(Request $request , $id)
    {
        // return 123;
        $validated = $request->validate([
            'name_ar' => 'required|unique:nature_dealings,name_ar,'.$id,
            'code' => 'required|unique:nature_dealings,code,'.$id,
            'discount_type_id' => 'required',

        ]);

        $NatureDealing = NatureDealing::find($id);
       if(!$NatureDealing)
            return redirect()->route("natureDealing.index")->with(['error' => "Not Found This natureDealing"]);

         NatureDealing::where("id",$id)->update([
            "name_en" => $request->name_en,
            "name_ar" => $request->name_ar,
            "code" => $request->code,
            "discount_type_id" => $request->discount_type_id
        ]);
        return redirect()->route("natureDealing.index")->with(['success' => "natureDealing Updated Successfully"]); 
    }
    
    public function delete(Request $request , $id)
    {
        $NatureDealing = NatureDealing::find($id);
        if(!$NatureDealing)
             return redirect()->route("natureDealing.index")->with(['error' => "Not Found This natureDealing"]);
        $NatureDealing->delete();
        return redirect()->route("natureDealing.index")->with(['success' => "natureDealing Deleted Successfully"]); 
    }
}
