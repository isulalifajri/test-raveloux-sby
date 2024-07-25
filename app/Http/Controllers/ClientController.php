<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(){
        try {
            $clients = Client::orderBy('created_at','DESC')->paginate(10);
            return view('pages.clients.clients',compact(
                'clients'
            ));
        } catch (\Exception $th) {
            return back()->with('success-danger', 'Ada yang Error'. $th->getMessage());
        }
    }

    public function create(){
        $client = new Client();
        return view('pages.clients.create', compact('client'));
    }


    public function store(Request $request){
        $rules = [
            'contact_name' => ['required'],
            'contact_email' => ['required','unique:clients'],
            'contact_phone_number' => ['required','numeric'],
            'company_name' => ['required'],
            'company_address' => ['required'],
            'company_city' => ['required'],
            'company_zip' => ['required'],
            'company_vat' => ['required','numeric'],
        ];
        
        try {
            
            $validatedData = $request->validate($rules);
    
            Client::create($validatedData);
    
            return redirect()->route('clients')->with('success', 'Data Berhasil ditambahkan');
        } catch (\Exception $th) {
            return back()->with('success-danger', 'Ada yang Error'. $th->getMessage());
        }
    }

    public function edit(Client $client){
        try {
            return view('pages.clients.edit', compact('client'));
        } catch (\Exception $th) {
            return back()->with('success-danger', 'Ada yang Error'. $th->getMessage());
        }
    }

    public function update(Request $request, Client $client )
    {
        $validatedData = $request->validate([
            'contact_name' => ['required'],
            'contact_email' => ['required', 'email', 'max:250', 'unique:clients,contact_email,'.$client->id],
            'contact_phone_number' => ['required','numeric'],
            'company_name' => ['required'],
            'company_address' => ['required'],
            'company_city' => ['required'],
            'company_zip' => ['required'],
            'company_vat' => ['required','numeric'],
        ]);
        
        try {
            $client->update($validatedData);
    
            return redirect()->route('clients')->with('success', 'Data Berhasil di Edit');
        } catch (\Exception $th) {
            return back()->with('success-danger', 'Ada yang Error'. $th->getMessage());
        }
    }

    public function destroy(Client $client){

        try {
            $client->delete();
            return back()->with('success-danger', 'Data berhasil dihapus');
        } catch (\Exception $th) {
            return back()->with('success-danger', 'Ada yang Error'. $th->getMessage());
        }

    }

    public function softDelete(){
        try {
            $clients = Client::onlyTrashed()->orderBy('created_at','DESC')->paginate(10);
            return view('pages.clients.softdelets',compact(
                'clients'
            ));
        } catch (\Exception $th) {
            return back()->with('success-danger', 'Ada yang Error'. $th->getMessage());
        }
    }

    public function restoreData($id){
        try {
            Client::withTrashed()->find($id)->restore();
            return redirect()->route('softDeletes.clients')->with('success', "Data Recovered Successfully");
        } catch (\Exception $th) {
            return back()->with('success-danger', 'Ada yang Error'. $th->getMessage());
        }
    }

    public function forcedelete($id)
    {
        try {
            Client::onlyTrashed()->find($id)->forceDelete();
            return redirect()->route('softDeletes.clients')->with('success-danger', "Data Successfully Deleted Permanently");
        } catch (\Exception $th) {
            return back()->with('success-danger', 'Ada yang Error'. $th->getMessage());
        }
    }

}
