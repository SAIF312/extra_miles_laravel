<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Subscriber};
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SubscriberController extends Controller
{
    public function index()
    {
        // $grade = Grade::latest()->value('unique_group_id');
        // $subscribers = Grade::where('unique_group_id' , $grade)->with('motorist_fuel_prices')->get();
        // return view('admin.subscriber.index' , compact('unique_groups'));
        // dd($latest_price_singapore[0]->motorist_fuel_prices[0]->pump);
        return view('admin.subscriber.index');
    }
    public function index_data_table()
    {
        $subscribers = Subscriber::orderBy('created_at', 'DESC')->get();
        if (request()->ajax()) {
            return DataTables::of($subscribers)
                ->addIndexColumn()
                ->editColumn('created_at', function ($subscriber) {

                    return !is_null($subscriber->created_at) ? $subscriber->created_at->diffForHumans() : ' Not found';
                })
                // ->editColumn('actions', function ($subscriber) {
                //     return view('admin.subscriber.action', compact('subscriber'));
                // })
                ->rawColumns(['actions'])
                ->toJson();
        }
        return view('admin.subscriber.index');
    }
}
