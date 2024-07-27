<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Notifications\NewTaskNotification;
use Illuminate\Support\Facades\Notification;

class TaskController extends Controller
{
    public function index(){
        try {
            $tasks = Task::with(['user:id,first_name', 'client:id,contact_name'])
            ->where('status', '!=', 'done') // Pastikan hanya mengambil task yang belum selesai
            ->orderBy('deadline', 'ASC') // Urutkan berdasarkan deadline dari yang terdekat
            ->paginate(10);
            return view('pages.tasks.tasks',compact(
                'tasks'
            ));
        } catch (\Exception $th) {
            return back()->with('success-danger', 'Ada yang Error'. $th->getMessage());
        }
    }

    public function create(){
        try {
            $task = new Task();
            $users = User::all();
            $clients = Client::all();
            $projects = Project::all();
            return view('pages.tasks.create', compact(
                'task','clients','users','projects'
            ));
        } catch (\Exception $th) {
            return back()->with('success-danger', 'Ada yang Error'. $th->getMessage());
        }
    }

    public function store(Request $request){
        $rules = [
            'title' => ['required'],
            'description' => ['required'],
            'deadline' => ['required'],
            'user_id' => ['required'],
            'client_id' => ['required'],
            'project_id' => ['required'],
            'status' => ['required','string'],
        ];
        try {
        
            $validatedData = $request->validate($rules);
            $task = Task::create($validatedData);
            $user = User::where('first_name', 'admin')->get();
            Notification::send($user, new NewTaskNotification($task));
    
            return redirect()->route('tasks')->with('success', 'Data Berhasil ditambahkan');
        } catch (\Exception $th) {
            return back()->with('success-danger', 'Ada yang Error'. $th->getMessage());
        }
    }

    public function edit(Task $task){
        try {
            $users = User::all();
            $clients = Client::all();
            $projects = Project::all();
            return view('pages.tasks.edit', compact('task','users','clients','projects'));
        } catch (\Exception $th) {
            return back()->with('success-danger', 'Ada yang Error'. $th->getMessage());
        }
    }

    public function update(Request $request, Task $task )
    {
        $validatedData = $request->validate([
            'title' => ['required'],
            'description' => ['required'],
            'deadline' => ['required'],
            'user_id' => ['required'],
            'client_id' => ['required'],
            'project_id' => ['required'],
            'status' => ['required','string'],
        ]);
        try {
    
            $task->update($validatedData);
    
            return redirect()->route('tasks')->with('success', 'Data Berhasil di Edit');
        } catch (\Exception $th) {
            return back()->with('success-danger', 'Ada yang Error'. $th->getMessage());
        }
    }

    public function detail(Task $task){
        try {
            return view('pages.tasks.task_detail', compact('task'));
        } catch (\Exception $th) {
            return back()->with('success-danger', 'Ada yang Error'. $th->getMessage());
        }
    }

    public function destroy(Task $task){
        try {
            $task->delete();
            return back()->with('success-danger', 'Data berhasil dihapus');
        } catch (\Exception $th) {
            return back()->with('success-danger', 'Ada yang Error'. $th->getMessage());
        }

    }

    public function softDelete(){
        try {
            $tasks = Task::onlyTrashed()->orderBy('created_at','DESC')->paginate(10);
            return view('pages.tasks.softdelets',compact(
                'tasks'
            ));
        } catch (\Exception $th) {
            return back()->with('success-danger', 'Ada yang Error'. $th->getMessage());
        }
    }

    public function restoreData($id){
        try {
            Task::withTrashed()->find($id)->restore();
            return redirect()->route('softDeletes.tasks')->with('success', "Data Recovered Successfully");
        } catch (\Exception $th) {
            return back()->with('success-danger', 'Ada yang Error'. $th->getMessage());
        }
    }

    public function forcedelete($id)
    {
        try {
            Task::onlyTrashed()->find($id)->forceDelete();
            return redirect()->route('softDeletes.tasks')->with('success-danger', "Data Successfully Deleted Permanently");
        } catch (\Exception $th) {
            return back()->with('success-danger', 'Ada yang Error'. $th->getMessage());
        }
    }
}
