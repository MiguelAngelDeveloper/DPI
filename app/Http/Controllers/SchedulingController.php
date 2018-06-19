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

  public function fileGeneration(Request $request){
    $schDate = Input::get('schDate');
    $channelId = Input::get('channelId');
    $spotInsertions = SpotInsertion::whereIn('window_id',
    function($query) use ($schDate, $channelId){
        $query->select('id')
        ->from('windows')
        ->whereDate('init_date', '=', $schDate)
        ->where('channel_id',$channelId);
      }
    )->get();

    $content = '';
    foreach ($spotInsertions as $key => $spotInsertion) {
      // code...
      $eventType = 'LOI';
      $scheduledDate = Carbon::parse($spotInsertion->window->init_date)->format('md');
      $scheduledTime = Carbon::parse($spotInsertion->break->optimal_insertion_date)->format('his');
      $windowStartTime = Carbon::parse($spotInsertion->window->init_date)->format('hi');
      $windowDuration = Carbon::parse($spotInsertion->window->duration)->format('hi');
      $breakNumberWithinWindow = Helpers::addZerosPreffix($spotInsertion->break_position_in_window,3);
      $spotPosition = Helpers::addZerosPreffix($spotInsertion->ad_pos_in_break,3);
      $spotLength = Carbon::parse($spotInsertion->ad->duration)->format('his');
      $zeroFilled1 = '000000 00000000 000';
      $spotId = Helpers::addZerosPreffix($spotInsertion->ad->code,11);
      $zeroFilled2 = '0000';
      $advertiserName = Helpers::addSpacesSuffix($spotInsertion->ad->announcer, 32);
      $spotName = Helpers::addSpacesSuffix($spotInsertion->ad->name, 20);
      Log::debug($spotInsertion->ad->name.': '.iconv_strlen($spotInsertion->ad->name));
      Log::debug($spotName.': '.iconv_strlen($spotName));
      $comment = 'Fill';
      $content.= $eventType.' '.$scheduledDate.' '.$scheduledTime
      .' '.$windowStartTime.' '.$windowDuration.' '.$breakNumberWithinWindow
      .' '.$spotPosition.' '.$spotLength.' '.$zeroFilled1.' '.$spotId.' '.$zeroFilled2
      .' '.$advertiserName.' '.$spotName.' '.$comment."\r\n";
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

      $freeWindows = DB::table('windows')->leftjoin('spot_insertion', 'windows.id','=','spot_insertion.window_id')->whereRaw('spot_insertion.id is null')->whereRaw('date(windows.init_date)=?',$initDate)->where('windows.channel_id', $channelId)->selectRaw('windows.*')->get();
    //  $populatedWindows = DB::table('windows')->leftjoin('spot_insertion', 'windows.id','=','spot_insertion.window_id')->whereRaw('date(windows.init_date)=?',$initDate)->whereRaw('spot_insertion.id is not null')->selectRaw('spot_insertion.*')->get();
    DB::connection()->enableQueryLog();
     $populatedWindows = SpotInsertion::whereIn('window_id',
     function($query) use ($initDate, $channelId){
         $query->select('id')
         ->from('windows')
         ->whereDate('init_date', '=', $initDate)
         ->where('channel_id', $channelId);
       }
     )->get();

     $queries = DB::getQueryLog();
     foreach ($queries as $key => $value) {
       // code...
       Log::debug($value);
     }

    } else {
      $freeWindows = DB::table('windows')->leftjoin('spot_insertion', 'windows.id','=','spot_insertion.window_id')->whereRaw('spot_insertion.id is null')->where('windows.channel_id', $channelId)->selectRaw('windows.*')->get();
      $populatedWindows = SpotInsertion::whereIn('window_id',
      function($query) use ($channelId){
          $query->select('id')
          ->from('windows')
          ->where('channel_id', $channelId);
        }
      )->get();;
    }
    $channels = Channels::all();
    $spots = Ads::all();
    if($screen){
      return View::make('dpi.scheduling.index', compact('channels'))->with('spots',$spots)->with('populatedWindows',$populatedWindows);
    }
    return View::make('dpi.scheduling.create', compact('channels'))->with('spots',$spots)->with('freeWindows',$freeWindows)->with('populatedWindows',$populatedWindows);
  }

  public function saveBreak(Request $request){
    //break_position_in_window
    $optimal_insertion_date =  $request->input('optimal_insertion_date');
    $windowId = $request->input('windowId');
    $spots = $request->input('spotSelect');
  if(!$optimal_insertion_date){
      return response()->json(['errormsg' => 'Error: No se ha definido la hora de inserción óptima.', 'error' => 1]);
  }
  if(!$spots){
      return response()->json(['errormsg' => 'Error: No se ha insertado ningún anuncio.', 'error' => 1]);
  }
  if(!$this->optimalInsertionDateIsInsideWindow($optimal_insertion_date, $windowId)) {
    return response()->json(['errormsg' => 'Error: La hora de inserción óptima no está dentro de la ventana.', 'error' => 1]);
  }
  if(!$this->spotsFitsInWindow($spots, $windowId)){
    return response()->json(['errormsg' => 'Error: La duración de todos los anuncios sobrepasa la de la ventana.', 'error' => 1]);
  }

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


  private function optimalInsertionDateIsInsideWindow($optimal_insertion_date, $windowId){
    return true;
  }
  private function spotsFitsInWindow($spots, $windowId){
    return true;
  }

}
