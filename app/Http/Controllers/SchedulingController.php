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
use Session;
use Carbon\Carbon;
use Log;
use DB;
use App\Http\Helpers;

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
    $channels = Channels::all();
    return View::make('dpi.scheduling.index', compact('channels'));
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

      //break_position_in_window
      $optimal_insertion_date =  $request->input('optimal_insertion_date');
      $windowId = $request->input('windowId');
      $spots = $request->input('spotSelect');
      $event_type = $request->input('event_type');

    if(!$optimal_insertion_date){
        return response()->json(['errormsg' => __('dpi.no_optimal_insertion_time_selected'), 'error' => 1]);
    }
    if(!$spots){
        return response()->json(['errormsg' => __('dpi.no_spots_seleted'), 'error' => 1]);
    }

    if(!$this->spotsFitsInWindow($optimal_insertion_date, $spots, $windowId)){
      return response()->json(['errormsg' => __('dpi.error_break_fit_in_window'), 'error' => 1]);
    }
      try{
        DB::beginTransaction();
        $break = new Breaks;
        $break->optimal_insertion_date = $optimal_insertion_date;
        $break->save();
        $break_position_in_window = DB::table('spot_insertion')->where('windows_id', $windowId)->max('break_position_in_window');
        if($break_position_in_window){
          $break_position_in_window++;
        }else{
          $break_position_in_window = 1;
        }
        foreach ($spots as $key => $spot) {
          $spot_insertion = new SpotInsertion;
          $spot_insertion->windows_id = $windowId;
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
          $spot_insertion->event_type = $event_type;
          $spot_insertion->save();
        }

        DB::commit();
        return response()->json(['windowId' => $windowId,
        'str_break_position_in_window' => __('dpi.break_position_in_window'),
         'break_position_in_window' => $spot_insertion->break_position_in_window,
        'str_optimal_insertion_date' => __('dpi.hoi'),
         'optimal_insertion_date' => $spot_insertion->break->optimal_insertion_date,
        'str_ad_pos_in_break' =>__('dpi.ad_pos_in_break'),
         'ad_pos_in_break' => $spot_insertion->ad_pos_in_break,
        'str_ad_name' => __('dpi.ad_name'),
         'ad_name' => $spot_insertion->ad->name,
        'str_ad_duration' => __('dpi.ad_duration'),
         'ad_duration' => $spot_insertion->ad->duration,
        'error' => 0]);

      } catch(\Exception $e){
        DB::rollback();
        return response()->json(['errormsg' => 'Error al guardar en BBDD el break: '.$e->getMessage(), 'error' => 1]);
      }
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
    $channels = Channels::all();
    return View::make('dpi.scheduling.index', compact('channels'));
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
    $channels = Channels::all();
    return View::make('dpi.scheduling.index', compact('channels'));
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
    $channels = Channels::all();
    return View::make('dpi.scheduling.index', compact('channels'));
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
    $channels = Channels::all();
    return View::make('dpi.scheduling.index', compact('channels'));
  }

  public function fileGeneration(Request $request){
    $schDate = Input::get('schDate');
    $channelId = Input::get('channelId');
    $spotInsertions = SpotInsertion::whereIn('windows_id',
    function($query) use ($schDate, $channelId){
        $query->select('id')
        ->from('windows')
        ->whereDate('init_date', '=', $schDate)
        ->where('channel_id',$channelId);
      }
    )->get();
    $content = '';
    $windows = Windows::whereDate('init_date', '=', $schDate)->get();
    foreach ($windows as $key => $window) {
      foreach ($window->SpotInsertion as $key => $spotInsertion) {
        // code...
        $eventType = $spotInsertion->event_type;
        $scheduledDate = Carbon::parse($window->init_date)->format('md');
        $scheduledTime = Carbon::parse($spotInsertion->break->optimal_insertion_date)->format('His');
        $windowStartTime = Carbon::parse($window->init_date)->format('Hi');
        $windowDuration = Carbon::parse($window->duration)->format('Hi');
        $breakNumberWithinWindow = Helpers::addZerosPreffix($spotInsertion->break_position_in_window,3);
        $spotPosition = Helpers::addZerosPreffix($spotInsertion->ad_pos_in_break,3);
        $spotLength = Carbon::parse($spotInsertion->ad->duration)->format('His');
        $zeroFilled1 = '000000 00000000 000';
        $spotId = Helpers::addZerosPreffix($spotInsertion->ad->code,11);
        $zeroFilled2 = '0000';
        $advertiserName = Helpers::addSpacesSuffix($spotInsertion->ad->announcer, 32);
        $spotName = Helpers::addSpacesSuffix($spotInsertion->ad->name, 20);
        $comment = $spotInsertion->ad->tipo;
        $content.= $eventType.' '.$scheduledDate.' '.$scheduledTime
        .' '.$windowStartTime.' '.$windowDuration.' '.$breakNumberWithinWindow
        .' '.$spotPosition.' '.$spotLength.' '.$zeroFilled1.' '.$spotId.' '.$zeroFilled2
        .' '.$advertiserName.' '.$spotName.' '.$comment."\r\n";
      }
    }

    $content.="END\r\n";
    $channel = Channels::find($channelId);
    return response()->streamDownload(function () use ($content){
        echo $content;
    }, Helpers::getSchFilename($schDate, $channel->code, $channel->zone));
  }

  public function search(Request $request){
    $screen = Input::get('screen');
    $channelId = Input::get('channel');
    $initDate = Input::get('init_date');
    Session::flash('channel', $channelId );
    Session::flash('schDate', $initDate);
    if($initDate){

      $freeWindows = DB::table('windows')->leftjoin('spot_insertion', 'windows.id','=','spot_insertion.windows_id')->whereRaw('spot_insertion.id is null')->whereRaw('date(windows.init_date)=?',$initDate)->where('windows.channel_id', $channelId)->selectRaw('windows.*')->get();
    //  $populatedWindows = DB::table('windows')->leftjoin('spot_insertion', 'windows.id','=','spot_insertion.windows_id')->whereRaw('date(windows.init_date)=?',$initDate)->whereRaw('spot_insertion.id is not null')->selectRaw('spot_insertion.*')->get();
    DB::connection()->enableQueryLog();
     $populatedWindows = Windows::where('channel_id',$channelId)->where('init_date', $initDate)->where('channel_id',$channelId)->whereIn('id',
     function($query) {
         $query->select('windows_id')
         ->from('spot_insertion');
       }
     )->get();

    } else {
      $freeWindows = DB::table('windows')->leftjoin('spot_insertion', 'windows.id','=','spot_insertion.windows_id')->whereRaw('spot_insertion.id is null')->where('windows.channel_id', $channelId)->selectRaw('windows.*')->get();
      $populatedWindows = Windows::where('channel_id',$channelId)->whereIn('id',
      function($query) {
          $query->select('windows_id')
          ->from('spot_insertion');
        }
      )->get();
    }
    $channels = Channels::all();
    $spots = Ads::all();
    if($screen){
      return View::make('dpi.scheduling.index', compact('channels'))->with('spots',$spots)->with('populatedWindows',$populatedWindows);
    }
    return View::make('dpi.scheduling.create', compact('channels'))->with('spots',$spots)->with('freeWindows',$freeWindows)->with('populatedWindows',$populatedWindows);
  }

  private function spotsFitsInWindow($optimal_insertion_date, $spots, $windowId){
    $window = Windows::find($windowId);

    $initDateDB = Carbon::parse($window->init_date);
    $durationBD = Carbon::parse($window->duration);
    $optimal_insertion_date_pr = Carbon::parse($optimal_insertion_date);
    $endDateDB = $initDateDB->copy()->addHours($durationBD->hour)->addminutes($durationBD->minute);
    $sumSpotsDuration = $initDateDB->copy()->startOfDay()->addHours($optimal_insertion_date_pr->hour)->addminutes($optimal_insertion_date_pr->minute)->addSeconds($optimal_insertion_date_pr->second);
    $optimal_insertion_date_start = $initDateDB->copy()->startOfDay()->addHours($optimal_insertion_date_pr->hour)->addminutes($optimal_insertion_date_pr->minute)->addSeconds($optimal_insertion_date_pr->second);

    foreach ($spots as $key => $spot) {
      $spotDB = Ads::find($spot);
      $spot_pr = Carbon::parse($spotDB->duration);
      $sumSpotsDuration->addHours($spot_pr->hour)->addminutes($spot_pr->minute)->addSeconds($spot_pr->second);
    }
    $lastBreakDuration = $this->getLastBreakDuration($windowId);
    return $optimal_insertion_date_start->gte($lastBreakDuration) && $sumSpotsDuration->lte($endDateDB);
  }

  private function getLastBreakDuration($windowId){
    $maxBreakPosition =  SpotInsertion::where('windows_id', $windowId)->max('break_position_in_window');
    $breakId = SpotInsertion::where('windows_id', $windowId)->where('break_position_in_window', $maxBreakPosition)->max('break_id');
    $break = Breaks::find($breakId);
    $window = Windows::find($windowId);
    $initDateDB = Carbon::parse($window->init_date);
    if($break){
      $optimal_insertion_date = $break->optimal_insertion_date;
      $optimal_insertion_date_pr = Carbon::parse($optimal_insertion_date);
      $endOfLastBreak = $initDateDB->copy()->startOfDay()->addHours($optimal_insertion_date_pr->hour)->addminutes($optimal_insertion_date_pr->minute)->addSeconds($optimal_insertion_date_pr->second);
      $spot_insertions = SpotInsertion::where('windows_id', $windowId)->where('break_id', $breakId)->get();
      foreach ($spot_insertions as $key => $spot_insertion) {
        $spot_pr = Carbon::parse($spot_insertion->ad->duration);
        $endOfLastBreak->addHours($spot_pr->hour)->addminutes($spot_pr->minute)->addSeconds($spot_pr->second);
      }
      return $endOfLastBreak;
    } else {
      return $initDateDB;
    }

  }


}
