<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{CarParking, CarParkingDaysPrice};
use Yajra\DataTables\Facades\DataTables;

class CarParkingController extends Controller
{
    public function index(){

        return view('admin.carparking.index');
    }

    public function index_data_table(){
        $unique_groups = CarParking::all();
        if (request()->ajax()) {
            return DataTables::of($unique_groups)
                ->addIndexColumn()
                ->editColumn('created_at', function ($unique_groups) {

                    return !is_null($unique_groups->created_at) ? $unique_groups->created_at->diffForHumans() :' Not found';
                })
                ->editColumn('location', function ($unique_groups) {

                    return '<a target="_blank" href="http://maps.google.com/?q='.$unique_groups->latitude.','.$unique_groups->longitude.'"><span class="btn badge badge-success">Location</span></a>';
                })






                ->editColumn('actions', function ($unique_groups) {
                    return "<div class='btn-group-sm'>
                        <a onclick='CarParkingModal($unique_groups->id)' class='btn btn-warning'><i class='fa fa-eye'></i></a>
                        <a onclick='UserModal($unique_groups->id)' class='btn btn-success'><i class='fa fa-edit'></i></a>
                       <!-- <a onClick='UserDelete($unique_groups)' class='btn btn-danger'><i class='fa fa-trash'></i></a> -->
                            </div>";
                })
                ->rawColumns(['actions','status' , 'location'])
                ->toJson();
        }
        return view('admin.carParking.index');

    }



    public function Modal($id){


        $unique_groups = CarParkingDaysPrice::where('car_parking_id' , $id)->get();

        if (request()->ajax()) {
            return DataTables::of($unique_groups)
                ->addIndexColumn()
                ->editColumn('actions', function ($unique_groups) {
                    return "<div class='btn-group-sm'>
                        <!-- <a onclick='CarParkingModal($unique_groups->id)' class='btn btn-warning'><i class='fa fa-eye'></i></a> -->
                        <!-- <a onclick='UserModal($unique_groups->id)' class='btn btn-success'><i class='fa fa-edit'></i></a>      -->
                        <!--  <a onClick='UserDelete($unique_groups)' class='btn btn-danger'><i class='fa fa-trash'></i></a>        -->
                            </div>";
                })
                ->rawColumns(['actions'])
                ->toJson();
        }
        return view('admin.carParking.index');


    }

    public function edit($id){
        $motorist = MotoristFuelPrice::where('id',$id)->first();
        return view('admin.motorist.update',compact('motorist'));
    }

    public function update(Request $request){
        $motorist = MotoristFuelPrice::where('id',$request->id)->first();
        if($motorist->price != $request->price){
            $motorist->update(['price'=>$request->price]);
        }
        return redirect()->route('motorist.price');
    }
}
