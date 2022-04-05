<?php

namespace App\Http\Controllers\Item;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\User;
use Illuminate\Http\Request;

class ItemController extends Controller
{

    public function index(){
        $items = Item::paginate(5);
        return view('items.index',compact('items'));
    }

    public function create()
    {
        return view("items.create");
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_ar' => 'required|unique:items',
        ]);

        Item::create([
            "name_en" => $request->name_en,
            "name_ar" => $request->name_ar,
        ]);
        return redirect()->route("items.index")->with(['success' => "Item Created Successfully"]); 
    }
    
    public function edit(Request $request , $id)
    {
       $item = Item::find($id);
       if(!$item)
            return redirect()->route("items.index")->with(['error' => "Not Found This Item"]);
       return view("items.edit", compact("item"));
    }
    
    public function update(Request $request , $id)
    {
        $validated = $request->validate([
            'name_ar' => 'required|unique:items,name_ar,'.$id,
        ]);
       $item = Item::find($id);
           if(!$item)
                return redirect()->route("items.index")->with(['error' => "Not Found This Item"]);
       Item::where("id",$id)->update([
            "name_en" => $request->name_en,
            "name_ar" => $request->name_ar,
        ]);
        return redirect()->route("items.index")->with(['success' => "Item Updated Successfully"]); 
    }
    
    public function delete(Request $request , $id)
    {
       $item = Item::find($id);
           if(!$item)
                return redirect()->route("items.index")->with(['error' => "Not Found This Item"]);
        $item->delete();
        return redirect()->route("items.index")->with(['success' => "Item Deleted Successfully"]); 
    }
}
