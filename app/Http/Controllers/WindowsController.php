<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Channels;
use App\Windows;
use View;
use Redirect;
use Session;
use Validator;
use Input;
use Carbon\Carbon;
use Log;

class WindowsController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    //
    //
    //
    $windows = Windows::all();

    // load the view and pass the nerds
    return View::make('dpi.windows.index')
    ->with('windows', $windows);
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    //
    $channels = Channels::all();
    return View::make('dpi.windows.create', compact('channels'));
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

    $rules = array(
      'name'       => 'required|numeric',
      'init_date'      => 'required|date',
      'duration' => 'required|size:5'
    );
    $input =  Input::all();
    foreach ($input as $key => $value) {
      // code...
      Log::debug($value);
    }
    $validator = Validator::make(Input::all(), $rules);

    // process the login
    if ($validator->fails()) {
      return Redirect::to('windows/create')
      ->withErrors($validator)
      ->withInput(Input::except('password'));
    } else if($this->isWindowInitDateOverlaping(Input::get('name'), Input::get('init_date'))){
      return Redirect::to('windows/create')
      ->withInput()
      ->withErrors(array('message' => __('dpi.window_init_date_error')));

    } else if($this->isWindowEndDateOverlaping(Input::get('name'), Input::get('init_date'),Input::get('duration'))){
      return Redirect::to('windows/create')
      ->withInput()
      ->withErrors(array('message' => __('dpi.window_duration_error')));

    } else{
        try {
          DB::beginTransaction();
          // store
          $window = new Windows;
          $window->channel_id      = Input::get('name');
          $window->init_date    = Input::get('init_date');
          $window->duration =  Input::get('duration');
          $window->save();
          DB::commit();
          // redirect
          Session::flash('message',  __('dpi.ok_created', ['item' => __('dpi.window')]));
          return Redirect::to('windows');
        } catch (\Exception $e) {
          DB::rollback();
          Redirect::back()
          ->withErrors(['msg','Error al guardar la ventana en BBDD: '.$e.getMessage()])
          ->withInput(Input::except('password'));
        }
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
    $window = Windows::find($id);

    // show the view and pass the nerd to it
    return View::make('dpi.windows.show')
    ->with('window', $window);
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
    $window = Windows::find($id);
    $channels = Channels::all();
    // show the edit form and pass the nerd
    return View::make('dpi.windows.edit')
    ->with('window', $window)
    ->with('channels', $channels);
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

    $rules = array(
      'name'       => 'required|numeric',
      'init_date'      => 'required|date',
      'duration' => 'required|size:5'
    );
    $validator = Validator::make(Input::all(), $rules);

    // process the login
    if ($validator->fails()) {
      return Redirect::to('windows/create')
      ->withErrors($validator)
      ->withInput(Input::except('password'));
    } else {
      try {
        DB::beginTransaction();
        // store
        $window =  Windows::find($id);
        $window->channel_id      = Input::get('name');
        $window->init_date    = Input::get('init_date');
        $window->duration =  Input::get('duration');
        $window->save();
        DB::commit();
        // redirect
        Session::flash('message',  __('dpi.ok_updated', ['item' => __('dpi.window')]));
        return Redirect::to('windows');
      } catch (\Exception $e) {
        DB::rollback();
        Redirect::back()
        ->withErrors(['msg','Error al modificar la ventana en BBDD: '.$e.getMessage()])
        ->withInput(Input::except('password'));
      }
    }
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
    try {
        DB::beginTransaction();
        $window = Windows::find($id);
        $window->delete();
        DB::commit();
        // redirect
        Session::flash('message',  __('dpi.ok_deleted', ['item' => __('dpi.window')]));
        return Redirect::to('windows');
    } catch (\Exception $e) {
      DB::rollback();
      Redirect::back()
      ->withErrors(['msg','Error al eliminar la ventana en BBDD: '.$e.getMessage()])
      ->withInput(Input::except('password'));
    }
  }

  private function isWindowInitDateOverlaping($channel_id, $initDate){
    $windows =  Windows::all();
    foreach ($windows as $key => $window) {
      // code...
      if($window->channel_id == $channel_id){
        $initDateDB =  Carbon::parse($window->init_date);
        $durationBD = Carbon::parse($window->duration);
        $endDateDB = $initDateDB->copy()->addHours($durationBD->hour)->addminutes($durationBD->minute);
        $initDateNew = Carbon::parse($initDate);
        $overlap =   $initDateNew->gte($initDateDB) && $initDateNew->lte($endDateDB);
        Log::debug('Init date : '.$initDateDB.' End Date: '.$endDateDB.' New Date: '.$initDateNew.' Overlap?: '.$overlap);
        if($overlap){
          return true;
        }
      }
    }
    return false;
  }

  private function isWindowEndDateOverlaping($channel_id, $initDate, $duration){
    $windows =  Windows::all();
    foreach ($windows as $key => $window) {
      // code...
      if($window->channel_id == $channel_id){
        $initDateDB =  Carbon::parse($window->init_date);
        $durationBD = Carbon::parse($window->duration);
        $endDateDB = $initDateDB->copy()->addHours($durationBD->hour)->addminutes($durationBD->minute);
        $initDateNew = Carbon::parse($initDate);
        $durationNew = Carbon::parse($duration);
        $endDateNew =  $initDateNew->copy()->addHours($durationNew->hour)->addminutes($durationNew->minute);

        $overlap =   $endDateNew->gte($initDateDB) && $endDateNew->lte($endDateDB);
        Log::debug('Init date : '.$initDateDB.' End Date: '.$endDateDB.' New End Date: '.$endDateNew.' Overlap?: '.$overlap);
        if($overlap){
          return true;
        }
      }
    }
    return false;
  }
}
