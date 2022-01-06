<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use App\Sites;
use DataTables,Auth;


class SitesController extends Controller
{
            /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the roles page
     *
     */
    public function index()
    {
        try{
            $sites  = Sites::get();
            return view('create-site', ['list' => $sites]);
        }catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);

        }
    }

    /**
     * Store new roles with assigned permission
     * Associate permissions will be stored in table
     */

    public function create(Request $request)
    {
        // laravel default validator
        $validator = Validator::make($request->all(), [
            'siteid' => 'required',
            'sname' => 'required'
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->messages()->first());
        }
        try{

            $site = Sites::create(['site_id' => $request->siteid, 'site_name' => $request->sname]);

            if($site){ 
                return redirect('sites')->with('success', 'Site created succesfully!');
            }else{
                return redirect('sites')->with('error', 'Failed to create site! Try again.');
            }
        }catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }


    public function delete($id)
    {
        $site   = Sites::find($id);
        if($site){
            $site = $site->delete();
            return redirect('sites')->with('success', 'Site deleted!');
        }else{
            return redirect('404');
        }
    }
}
