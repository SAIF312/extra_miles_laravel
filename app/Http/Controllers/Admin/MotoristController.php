<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{MotoristFuelPrice, Grade};
use Yajra\DataTables\Facades\DataTables;

class MotoristController extends Controller
{
    public function index()
    {
        // $grade = Grade::latest()->value('unique_group_id');
        // $unique_groups = Grade::where('unique_group_id' , $grade)->with('motorist_fuel_prices')->get();
        // return view('admin.motorist.index' , compact('unique_groups'));
        $motor = Grade::orderBy('created_at', 'desc')->first();
        $latest_price_singapore = Grade::where('unique_group_id', $motor->unique_group_id)->with('motorist_fuel_prices')->get()->makeHidden(['unique_group_id']);
        // dd($latest_price_singapore[0]->motorist_fuel_prices[0]->pump);
        return view('admin.motorist.index', compact('latest_price_singapore'));
    }
    public function index_data_table()
    {
        $unique_groups = MotoristFuelPrice::orderBy('id', 'DESC')->orderBy('created_at', 'ASC')->get();
        //  $unique_groups = Grade::where('unique_group_id' , $grade)->with('motorist_fuel_prices')->get();
        // return view('admin.motorist.index' , compact('unique_groups'));
        // $users = User::whereHas(
        //     'roles', function($q){
        //         $q->where('name', 'Customer');
        //     }
        // )->get();

        // return $unique_groups;
        if (request()->ajax()) {
            $index = 0;
            return DataTables::of($unique_groups)
                ->addIndexColumn()
                ->editColumn('created_at', function ($unique_group) {

                    return !is_null($unique_group->created_at) ? $unique_group->created_at->diffForHumans() : ' Not found';
                })

                ->editColumn('price', function ($unique_group) {
                    if ($unique_group->price == null || $unique_group->price == 0.0 || $unique_group->price == 0) {
                        return "N/A";
                    } else {
                        return number_format((float)$unique_group->price, 2);
                    }
                })

                ->editColumn('change_in_price', function ($unique_group) {

                    return number_format((float)$unique_group->change_in_price, 2);
                })
                ->editColumn('pump', function ($unique_group) {

                    return '<img src="' . $unique_group->pump . '" height="50px" width="50px"/>';
                })
                ->editColumn('actions', function ($unique_group) {
                    return view('admin.motorist.action', compact('unique_group'));
                })
                ->rawColumns(['actions', 'pump', 'status'])
                ->toJson();
        }
        return view('admin.motorist.index');
    }

    public function edit($id)
    {
        $motorist = MotoristFuelPrice::where('id', $id)->first();
        return view('admin.motorist.update', compact('motorist'));
    }

    public function update(Request $request)
    {
        $motorist = MotoristFuelPrice::where('id', $request->id)->first();
        if ($motorist->price != $request->price) {
            $motorist->update(['price' => $request->price]);
        }
        return redirect()->route('motorist.price');
    }
}
