<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; 
use Carbon\Carbon;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $start = Carbon::parse(Carbon::today()->toDateString().' 00:00:00');
        $end = Carbon::parse(Carbon::today()->toDateString().' 23:59:59');

        $views = DB::table('views')->whereBetween('viewed_at',[$start, $end])->get();
        $orders = DB::table('orders')->whereBetween('created_at',[$start, $end])->get();
        $data = [];
        $order_data = [];
        $categories = ['12:00 am','01:00 am','02:00 am','03:00 am','04:00 am','05:00 am','06:00 am','07:00 am','08:00 am','09:00 am','10:00 am','11:00 am',
                        '12:00 pm','01:00 pm','02:00 pm','03:00 pm','04:00 pm','05:00 pm','06:00 pm','07:00 pm','08:00 pm','09:00 pm','10:00 pm','11:00 pm'];

    
        $views_data = $views->groupBy(function($views){
            return date('H',strtotime($views->viewed_at));
        });
        $orders_data = $orders->groupBy(function($orders){
            return date('H',strtotime($orders->created_at));
        });

        foreach($categories as $key => $category){
            if(isset($views_data[$key])){
                array_push($data, count($views_data[$key]));
            }else{
                array_push($data, 0);
            }

            if(isset($orders_data[$key])){
                array_push($order_data, count($orders_data[$key]));
            }else{
                array_push($order_data, 0);
            }
        }
                            
        return view('home',compact('views','categories','data','order_data'));
    }
    public function chart_filter(Request $request) {
        $date = explode(' to ',$request->date);
        
        $start = Carbon::parse($date[0].' 00:00:00');
        
        if(isset($date[1])){
            $end = Carbon::parse($date[1].' 23:59:59');
            $views = DB::table('views')->whereBetween('viewed_at',[$start, $end])->get();
            $data = [];
            $categories = [];

        
            $views_data = $views->groupBy(function($views){
                return date('d-m-Y',strtotime($views->viewed_at));
            });
            
            foreach($views_data as $key => $c_data){
                // $hours = ['00','01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23'];
                    array_push($categories, date('d-M-Y', strtotime($key)));
                    array_push($data, count($c_data));
            }
        }else {
            $end = Carbon::parse($date[0].' 23:59:59');
            $views = DB::table('views')->whereBetween('viewed_at',[$start, $end])->get();
            $data = [];
            $categories = ['12:00 am','01:00 am','02:00 am','03:00 am','04:00 am','05:00 am','06:00 am','07:00 am','08:00 am','09:00 am','10:00 am','11:00 am',
                            '12:00 pm','01:00 pm','02:00 pm','03:00 pm','04:00 pm','05:00 pm','06:00 pm','07:00 pm','08:00 pm','09:00 pm','10:00 pm','11:00 pm'];

        
            $views_data = $views->groupBy(function($views){
                return date('H',strtotime($views->viewed_at));
            });

            foreach($categories as $key => $category){
                // $hours = ['00','01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23'];
                if(isset($views_data[$key])){
                    array_push($data, count($views_data[$key]));
                }else{
                    array_push($data, 0);
                }
            }
        }

        return [$categories, $data];
    }
    public function chart_filter_2(Request $request) {
        $date = explode(' to ',$request->date);
        
        $start = Carbon::parse($date[0].' 00:00:00');
        
        if(isset($date[1])){
            $end = Carbon::parse($date[1].' 23:59:59');
            $orders = DB::table('orders')->whereBetween('created_at',[$start, $end])->get();
            $order_data = [];
            $categories = [];

        
            $orders_data = $orders->groupBy(function($orders){
                return date('d-m-Y',strtotime($orders->created_at));
            });
            
            foreach($orders_data as $key => $c_data){
                // $hours = ['00','01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23'];
                array_push($categories, date('d-M-Y', strtotime($key)));
                array_push($order_data, count($c_data));
            }
        }else {
            $end = Carbon::parse($date[0].' 23:59:59');

            $orders = DB::table('orders')->whereBetween('created_at',[$start, $end])->get();

            $categories = ['12:00 am','01:00 am','02:00 am','03:00 am','04:00 am','05:00 am','06:00 am','07:00 am','08:00 am','09:00 am','10:00 am','11:00 am',
                            '12:00 pm','01:00 pm','02:00 pm','03:00 pm','04:00 pm','05:00 pm','06:00 pm','07:00 pm','08:00 pm','09:00 pm','10:00 pm','11:00 pm'];

            $order_data = [];

            $orders_data = $orders->groupBy(function($orders){
                return date('H',strtotime($orders->created_at));
            });

            foreach($categories as $key => $category){
                if(isset($orders_data[$key])){
                    array_push($order_data, count($orders_data[$key]));
                }else{
                    array_push($order_data, 0);
                }
            }
        }

        return [$categories, $order_data];
    }
}
