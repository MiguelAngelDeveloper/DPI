<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\Schedules;
use App\Channels;
use App\Windows;
use Input;
use Redirect;

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
        $channelId = Input::get('channel');
          $windows = Windows::whereHas('channel', function($q) {
            $q->where('id', 1);
          })->get();
$channels = Channels::all();
  return View::make('dpi.scheduling.create', compact('channels'))->with('windows',$windows)->with('id',$channelId);
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
}
