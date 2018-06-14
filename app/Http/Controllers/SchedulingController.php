<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\Schedules;
use App\Channels;
use App\Windows;
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
    $freeWindows = DB::table('windows')->leftjoin('spot_insertion', 'windows.id','=','spot_insertion.window_id')->whereRaw('spot_insertion.id is null')->whereRaw('date(windows.init_date)=?',$initDate)->selectRaw('windows.*')->get();
    $populatedWindows = DB::table('windows')->leftjoin('spot_insertion', 'windows.id','=','spot_insertion.window_id')->whereRaw('spot_insertion.id is not null')->get();
    $channels = Channels::all();
    return View::make('dpi.scheduling.create', compact('channels'))->with('freeWindows',$freeWindows)->with('populatedWindows',$populatedWindows);
  }
}
