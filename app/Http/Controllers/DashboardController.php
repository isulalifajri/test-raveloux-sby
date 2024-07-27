<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $userCount = User::all()->count();
        $clientCount = Client::all()->count();
        $projectCount = Project::all()->count();
        $taskCount = Task::all()->count();
        $projects = Project::with(['user:id,first_name','client:id,contact_name'])->orderBy('created_at','DESC')->paginate(7);
        $projectInProgress = Project::where('status','in progress')->count();
        $overdueProjects = Project::where('status', '!=', 'done')
        ->where('deadline', '<', now())
        ->count();
        return view('dashboard',[
            'users' => $userCount,
            'clients' => $clientCount,
            'projectsCount' => $projectCount,
            'tasks' => $taskCount,
            'projects' => $projects,
            'projectInProgress' => $projectInProgress,
            'overdueProjects' => $overdueProjects,
        ]);
    }
}
