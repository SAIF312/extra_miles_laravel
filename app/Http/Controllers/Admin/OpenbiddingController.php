<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{OpenBidding};
use Yajra\DataTables\Facades\DataTables;
class OpenbiddingController extends Controller
{
    public function index(){
       
        return view('admin.Openbidding.index');
    }

    public function index_data_table(){
        $unique_groups = OpenBidding::with('parent')->get();
        // return $unique_groups;
        if (request()->ajax()) {
            $index = 0;
            return DataTables::of($unique_groups)
                ->addIndexColumn()
                ->editColumn('created_at', function ($unique_group) {
                    
                    return !is_null($unique_group->created_at) ? $unique_group->created_at->diffForHumans() :' Not found';
                })
                ->editColumn('month', function ($unique_group) {
                    return $unique_group->parent->month;
                })
                ->editColumn('bidding_number', function ($unique_group) {
                    
                    return $unique_group->parent->bidding_number;
                })
                ->editColumn('end_date', function ($unique_group) {
                    
                    return $unique_group->parent->end_date;
                })
                ->editColumn('actions', function ($unique_group) {
                    return "<div class='btn-group-sm'>
                     <!--   <a onclick='StatusUpdate($unique_group->id)' class='btn btn-warning'><i class='fa fa-ban'></i></a> -->
                        <a onclick='UserModal($unique_group->id)' class='btn btn-success'><i class='fa fa-edit'></i></a>
                        <!-- <a onClick='UserDelete($unique_group)' class='btn btn-danger'><i class='fa fa-trash'></i></a> -->
                            </div>";
                })
                ->rawColumns(['actions','status'])
                ->toJson();
        }
        return view('admin.Openbidding.index');
        
    }
}
