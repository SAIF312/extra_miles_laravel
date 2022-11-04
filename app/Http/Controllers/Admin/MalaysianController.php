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
        $unique_groups = MalysianFuelPrice::orderBy('id','DESC')->orderBy('created_at','ASC')->get();
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
                    return view('admin.malaysian.action',compact('unique_groups'));
                })
                ->rawColumns(['actions','status'])
                ->toJson();
        }
        return view('admin.malaysian.index');

    }

    public function edit($id){
        $malaysian = MalysianFuelPrice::where('id',$id)->first();
        return view('admin.malaysian.update',compact('malaysian'));
    }

    public function update(Request $request){
        $malaysian = MalysianFuelPrice::where('id',$request->id)->first();
        if($malaysian->price != $request->price){
            $malaysian->update(['price'=>$request->price]);
        }

        return redirect()->route('malaysian.price');
    }
}
