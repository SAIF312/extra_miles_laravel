<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{MalysianFuelPrice, Grade};
use Yajra\DataTables\Facades\DataTables;
class MalaysianController extends Controller
{
    public function index(){
      
        return view('admin.malaysian.index');
    }

    public function index_data_table(){
        $unique_groups = MalysianFuelPrice::all();
        //  $unique_groups = Grade::where('unique_group_id' , $grade)->with('motorist_fuel_prices')->get();
        // return view('admin.motorist.index' , compact('unique_groups'));
        // $users = User::whereHas(
        //     'roles', function($q){
        //         $q->where('name', 'Customer');
        //     }
        // )->get();

        // return $unique_groups;
        if (request()->ajax()) {
            return DataTables::of($unique_groups)
                ->addIndexColumn()
                ->editColumn('created_at', function ($unique_groups) {
                    
                    return !is_null($unique_groups->created_at) ? $unique_groups->created_at->diffForHumans() :' Not found';
                })
                ->editColumn('actions', function ($unique_groups) {
                    return "<div class='btn-group-sm'>
                        <a onclick='StatusUpdate($unique_groups->id)' class='btn btn-warning'><i class='fa fa-ban'></i></a>
                        <a onclick='UserModal($unique_groups->id)' class='btn btn-success'><i class='fa fa-edit'></i></a>
                        <a onClick='UserDelete($unique_groups)' class='btn btn-danger'><i class='fa fa-trash'></i></a>


                            </div>";
                })
                ->rawColumns(['actions','status'])
                ->toJson();
        }
        return view('admin.malaysian.index');
        
    }
}
