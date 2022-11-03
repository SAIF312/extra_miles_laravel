<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{TraficImage};
use Yajra\DataTables\Facades\DataTables;

class TraficImageController extends Controller
{
    public function index(){
       
        return view('admin.TraficImage.index');
    }

    public function index_data_table(){
        $unique_groups = TraficImage::all();
   
        if (request()->ajax()) {
            return DataTables::of($unique_groups)
                ->addIndexColumn()
                ->editColumn('created_at', function ($unique_groups) {
                    
                    return !is_null($unique_groups->created_at) ? $unique_groups->created_at->diffForHumans() :' Not found';
                })
                ->editColumn('image', function ($unique_groups) {
                    
                    return '<a href="'.$unique_groups->image.'" target="_blank"><img src="'.$unique_groups->image.'" height="60px" width="60px" alt="No Image"/></a>';
                    
                })
                ->editColumn('actions', function ($unique_groups) {
                    return "<div class='btn-group-sm'>
                      <!--   <a onclick='StatusUpdate($unique_groups->id)' class='btn btn-warning'><i class='fa fa-ban'></i></a> -->
                        <a onclick='UserModal($unique_groups->id)' class='btn btn-success'><i class='fa fa-edit'></i></a>
                      <!--  <a onClick='UserDelete($unique_groups)' class='btn btn-danger'><i class='fa fa-trash'></i></a> -->
                            </div>";
                })
                ->rawColumns(['actions','status','image'])
                ->toJson();
        }
        return view('admin.TraficImage.index');
        
    } 
}
