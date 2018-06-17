<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\Schedules;
use App\Channels;
use App\Windows;
use App\Breaks;
use App\SpotInsertion;
use App\Ads;
use Input;
use Redirect;
use Carbon\Carbon;
use Log;
use DB;

class SchedulingController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    //
    $schedules = Schedules::all();
    return View::make('dpi.scheduling.index')
    ->with('scheduling', $schedules);
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create(Request $request)
  {
    //
    $channels = Channels::all();
    return View::make('dpi.scheduling.create', compact('channels'));
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    //

  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    //

  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    //
    return View::make('dpi.scheduling.edit');
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id)
  {
    //
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    //
  }

  public function search(Request $request){
    $channelId = Input::get('channel');
    $initDate = Input::get('init_date');
    if($initDate){

      $freeWindows = DB::table('windows')->leftjoin('spot_insertion', 'windows.id','=','spot_insertion.window_id')->whereRaw('spot_insertion.id is null')->whereRaw('date(windows.init_date)=?',$initDate)->selectRaw('windows.*')->get();
    //  $populatedWindows = DB::table('windows')->leftjoin('spot_insertion', 'windows.id','=','spot_insertion.window_id')->whereRaw('date(windows.init_date)=?',$initDate)->whereRaw('spot_insertion.id is not null')->selectRaw('spot_insertion.*')->get();
    DB::connection()->enableQueryLog();
     $populatedWindows = SpotInsertion::whereIn('window_id',
     function($query) use ($initDate){
         $query->select('id')
         ->from('windows')
         ->whereDate('init_date', '=', $initDate);
       }
     )->get();
     $queries = DB::getQueryLog();
     foreach ($queries as $key => $value) {
       // code...
       Log::debug($value);
     }

    } else{
      $freeWindows = DB::table('windows')->leftjoin('spot_insertion', 'windows.id','=','spot_insertion.window_id')->whereRaw('spot_insertion.id is null')->selectRaw('windows.*')->get();
      $populatedWindows = SpotInsertion::all();
    }
    $channels = Channels::all();
    $spots = Ads::all();
    return View::make('dpi.scheduling.create', compact('channels'))->with('spots',$spots)->with('freeWindows',$freeWindows)->with('populatedWindows',$populatedWindows);
  }

  public function saveBreak(Request $request){
    //break_position_in_window
    $optimal_insertion_date =  $request->input('optimal_insertion_date');
    $windowId = $request->input('windowId');
    $spots = $request->input('spotSelect');
    try{
      DB::beginTransaction();
      $break = new Breaks;
      $break->optimal_insertion_date = $optimal_insertion_date;
      $break->save();
      $break_position_in_window = DB::table('spot_insertion')->where('window_id', $windowId)->max('break_position_in_window');
      if($break_position_in_window){
        $break_position_in_window++;
      }else{
        $break_position_in_window = 1;
      }
      foreach ($spots as $key => $spot) {
        $spot_insertion = new SpotInsertion;
        $spot_insertion->window_id = $windowId;
        $spot_insertion->break_id = $break->id;
        $ad_pos_in_break = DB::table('spot_insertion')->where('break_id', $break->id)->max('ad_pos_in_break');
        if($ad_pos_in_break){
          $ad_pos_in_break++;
        }else{
          $ad_pos_in_break = 1;
        }
        $spot_insertion->ad_id = $spot;
        $spot_insertion->ad_pos_in_break = $ad_pos_in_break;
        $spot_insertion->break_position_in_window = $break_position_in_window;
        $spot_insertion->save();
      }
      DB::commit();
      return response()->json(['windowId' => $windowId, 'breakId' => $break->id,'optimal_insertion_date' => $optimal_insertion_date, 'error' => 0]);

    } catch(\Exception $e){
      DB::rollback();
      return response()->json(['errormsg' => 'Error al guardar en BBDD el break: '.$e->getMessage(), 'error' => 1]);
    }

  }
}
