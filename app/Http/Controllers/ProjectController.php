<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{
    public function index(Request $request){
        try {
            $search = $request->query('search');
            $status = $request->query('status');
            $user = auth()->user();

            $query = Project::with(['user:id,first_name', 'client:id,contact_name'])
                ->orderBy('created_at', 'DESC');

            if (!$user->hasRole('admin')) {
                // Jika bukan admin, hanya ambil proyek yang ditugaskan ke pengguna atau klien yang terkait
                $query->where(function($query) use ($user) {
                    $query->where('user_id', $user->id)
                            ->orWhere('client_id', $user->client_id); // Asumsi pengguna memiliki client_id
                });

            }

            if ($search) {
                $query->where('title', 'LIKE', "%{$search}%"); // Ubah ke LIKE untuk pencarian yang lebih fleksibel
            }

            if ($status) {
                $query->where('status', $status);
            }

            $projects = $query->paginate(10);
            $titles = Project::select('title')
            ->distinct()
            ->pluck('title');
            return view('pages.projects.projects',compact(
                'projects','titles'
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

        $rules = [
            'title' => ['required'],
            'description' => ['required'],
            'deadline' => ['required'],
            'user_id' => ['required'],
            'client_id' => ['required'],
            'status' => ['required','string'],
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp,avif|max:10048', // validasi untuk gambar
        ];
        try {
     
            $validatedData = $request->validate($rules);

            $project = Project::create($validatedData);

            // Jika ada gambar dalam request
            if ($request->hasFile('images')) {
                // Tambahkan media baru ke koleksi 'images/projects'
                // $project->addMedia($request->file('image'))->toMediaCollection('images/projects'); // add image 
                $project->addMultipleMediaFromRequest(['images'])
                    ->each(function ($fileAdder) {
                        $fileAdder->toMediaCollection('images/projects');
                    }); // add multiple image
            }
    
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

        $validatedData = $request->validate([
            'title' => ['required'],
            'description' => ['required'],
            'deadline' => ['required'],
            'user_id' => ['required'],
            'client_id' => ['required'],
            'status' => ['required','string'],
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp,avif|max:10048', // validasi untuk gambar
        ]);
        
        try {
            if ($request->hasFile('images')) {
                // Hapus media lama jika ada
                // if ($project->hasMedia('images/projects')) {
                //     $project->clearMediaCollection('images/projects');
                // }
               // Add new media to the collection 'images/projects'
                foreach ($request->file('images') as $file) {
                    $project->addMedia($file)->toMediaCollection('images/projects');
                }// add multiple image
            }

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

    public function destroyImage(Project $project, $id){
       $media = $project->getMedia('images/projects');

       $image = $media->where('id', $id)->first();
       $image->delete();

       return redirect()->back()->with('success-danger', 'Image berhasil di hapus');
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
           $project = Project::onlyTrashed()->find($id);
            if ($project->hasMedia('images/projects')) {
                 $project->clearMediaCollection('images/projects'); //hapus image
            }
           $project->forceDelete();
           return redirect()->route('softDeletes.projects')->with('success-danger', "Data Successfully Deleted Permanently");
       } catch (\Exception $th) {
          return back()->with('success-danger', 'Ada yang Error'. $th->getMessage());
       }
    }
}
