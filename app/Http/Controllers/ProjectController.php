<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(){
        try {
            $projects = Project::with(['user:id,first_name','client:id,contact_name'])->orderBy('created_at','DESC')->paginate(10);
            return view('pages.projects.projects',compact(
                'projects'
            ));
        } catch (\Exception $th) {
            return back()->with('success-danger', 'Ada yang Error'. $th->getMessage());
        }
    }

    public function create(){
        try {
            $project = new Project();
            $users = User::all();
            $clients = Client::all();
            return view('pages.projects.create', compact(
                'project','clients','users'
            ));
        } catch (\Exception $th) {
            return back()->with('success-danger', 'Ada yang Error'. $th->getMessage());
        }
    }

    public function store(Request $request){
        try {
            $rules = [
                'title' => ['required'],
                'description' => ['required'],
                'deadline' => ['required'],
                'user_id' => ['required'],
                'client_id' => ['required'],
                'status' => ['required','string'],
            ];
     
            $validatedData = $request->validate($rules);
            Project::create($validatedData);
    
            return redirect()->route('projects')->with('success', 'Data Berhasil ditambahkan');
        } catch (\Exception $th) {
            return back()->with('success-danger', 'Ada yang Error'. $th->getMessage());
        }
    }

    public function edit(Project $project){
        try {
            $users = User::all();
            $clients = Client::all();
            return view('pages.projects.edit', compact('project','users','clients'));
        } catch (\Exception $th) {
            return back()->with('success-danger', 'Ada yang Error'. $th->getMessage());
        }
    }

    public function update(Request $request, Project $project )
    {
        try {
            $validatedData = $request->validate([
                'title' => ['required'],
                'description' => ['required'],
                'deadline' => ['required'],
                'user_id' => ['required'],
                'client_id' => ['required'],
                'status' => ['required','string'],
            ]);
    
            $project->update($validatedData);
    
            return redirect()->route('projects')->with('success', 'Data Berhasil di Edit');
        } catch (\Exception $th) {
            return back()->with('success-danger', 'Ada yang Error'. $th->getMessage());
        }
    }

    public function destroy(Project $project){
        try {
            $project->delete();
            return back()->with('success-danger', 'Data berhasil dihapus');
        } catch (\Exception $th) {
            return back()->with('success-danger', 'Ada yang Error'. $th->getMessage());
        }

    }

    public function softDelete(){
        try {
            $projects = Project::onlyTrashed()->orderBy('created_at','DESC')->paginate(10);
            return view('pages.projects.softdelets',compact(
                'projects'
            ));
        } catch (\Exception $th) {
            return back()->with('success-danger', 'Ada yang Error'. $th->getMessage());
        }
    }

    public function restoreData($id){
        try {
            Project::withTrashed()->find($id)->restore();
            return redirect()->route('softDeletes.projects')->with('success', "Data Recovered Successfully");
        } catch (\Exception $th) {
            return back()->with('success-danger', 'Ada yang Error'. $th->getMessage());
        }
    }

    public function forcedelete($id)
    {
       try {
           Project::onlyTrashed()->find($id)->forceDelete();
           return redirect()->route('softDeletes.projects')->with('success-danger', "Data Successfully Deleted Permanently");
       } catch (\Exception $th) {
          return back()->with('success-danger', 'Ada yang Error'. $th->getMessage());
       }
    }
}
