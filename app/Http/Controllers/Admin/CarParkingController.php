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
                ->editColumn('created_at', function ($unique_group) {

                    return !is_null($unique_group->created_at) ? $unique_group->created_at->diffForHumans() :' Not found';
                })
                ->editColumn('location', function ($unique_group) {
                    return view('admin.carparking.location_button',compact('unique_group'));
                })

                ->editColumn('actions', function ($unique_group) {
                    return "<div class='btn-group-sm'>
                        <a onclick='CarParkingModal($unique_group->id)' class='btn btn-warning'><i class='fa fa-eye'></i></a>
                        <!-- <a onclick='UserModal($unique_group->id)' class='btn btn-success'><i class='fa fa-edit'></i></a>-->
                       <!-- <a onClick='UserDelete($unique_group)' class='btn btn-danger'><i class='fa fa-trash'></i></a> -->
                            </div>";
                })
                ->rawColumns(['actions','status' , 'location'])
                ->toJson();
        }
        return view('admin.carparking.index');

    }



    public function Modal($id){


        $unique_groups = CarParkingDaysPrice::where('car_parking_id' , $id)->get();

        if (request()->ajax()) {
            return DataTables::of($unique_groups)
                ->addIndexColumn()
                ->editColumn('actions', function ($unique_group) {
                    return view('admin.carparking.action',compact('unique_group'));
                })
                ->rawColumns(['actions'])
                ->toJson();
        }
        return view('admin.carparking.index');


    }

    public function edit($id){
        $parking_price = CarParkingDaysPrice::where('id',$id)->with('car_parking')->first();
        // dd($parking_price);
        return view('admin.carparking.update',compact('parking_price'));
    }

    public function update(Request $request){
        $parking_price = CarParkingDaysPrice::where('id',$request->id)->first();
        if(isset($request->days)){
            if($parking_price->days != $request->days){
                $parking_price->update(['days'=>$request->days]);
            }
        }
        if(isset($request->timing)){
            if($parking_price->timing != $request->timing){
                $parking_price->update(['timing'=>$request->timing]);
            }
        }
        if(isset($request->price)){
            if($parking_price->price != $request->price){
                $parking_price->update(['price'=>$request->price]);
            }
        }
        return redirect()->route('carparking.price');
    }
}
