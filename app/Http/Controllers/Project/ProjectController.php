<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Models\BusinessNature;
use App\Models\Item;
use App\Models\Project;
use App\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    
    public function index(){
        $projects = Project::all();
        return view('projects.index',compact('projects'));
    }
    
    public function create(){
        $businessNatures = BusinessNature::all();
        $items = Item::all();

        return view('projects.create', compact("businessNatures","items"));
    }
    
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name_ar' => 'required|unique:projects',
            'code' => 'required|numeric|unique:projects',
            'type' => 'required',

        ]);

        Project::create([
            "name_en" => $request->name_en,
            "name_ar" => $request->name_ar,
            "code" => $request->code,
            "type" => $request->type,
            "item_id" => $request->item_id,
            "business_nature_id" => $request->business_nature_id,


        ]);
        return redirect()->route("projects.index")->with(['success' => "project Created Successfully"]); 
    }
    
    public function edit(Request $request , $id)
    {
       $businessNatures = BusinessNature::all();
       $items = Item::all();

       $project = Project::find($id);
       if(!$project)
            return redirect()->route("projects.index")->with(['error' => "Not Found This project"]);
       return view("projects.edit", compact("project","businessNatures","items"));
    }
    
    public function update(Request $request , $id)
    {
        $validated = $request->validate([
            'name_ar' => 'required|unique:projects,name_ar,'.$id,
            'code' => 'required|numeric|unique:projects,code,'.$id,
            'type' => 'required',

        ]);

        $project = Project::find($id);
       if(!$project)
            return redirect()->route("projects.index")->with(['error' => "Not Found This project"]);
        Project::where("id",$id)->update([
            "name_en" => $request->name_en,
            "name_ar" => $request->name_ar,
            "code" => $request->code,
            "type" => $request->type,
            "item_id" => $request->item_id,
            "business_nature_id" => $request->business_nature_id,

        ]);
        return redirect()->route("projects.index")->with(['success' => "project Updated Successfully"]); 
    }
    
    public function delete(Request $request , $id)
    {
        $project = Project::find($id);
       if(!$project)
            return redirect()->route("projects.index")->with(['error' => "Not Found This project"]);
        $project->delete();
        return redirect()->route("projects.index")->with(['success' => "project Deleted Successfully"]); 
    }
    
}
