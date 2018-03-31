<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Channels;
use App\Breaks;
use View;
use Redirect;
use Session;
use Validator;
use Input;

class BreaksController extends Controller
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
        $breaks = Breaks::all();

        // load the view and pass the nerds
        return View::make('dpi.breaks.index')
       ->with('breaks', $breaks);
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
        return View::make('dpi.breaks.create', compact('channels'));
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
         $validator = Validator::make(Input::all(), $rules);

         // process the login
         if ($validator->fails()) {
             return Redirect::to('breaks/create')
                 ->withErrors($validator)
                 ->withInput(Input::except('password'));
         } else {
             // store
             $break = new Breaks;
             $break->channel_id      = Input::get('name');
             $break->init_date    = Input::get('init_date');
             $break->duration =  Input::get('duration');
             $break->save();

             // redirect
             Session::flash('message',  __('dpi.ok_created', ['item' => __('dpi.break')]));
             return Redirect::to('breaks');
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
        $break = Breaks::find($id);

        // show the view and pass the nerd to it
        return View::make('dpi.breaks.show')
            ->with('break', $break);
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
        $break = Breaks::find($id);
        $channels = Channels::all();
        // show the edit form and pass the nerd
       return View::make('dpi.breaks.edit')
       ->with('break', $break)
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
                     return Redirect::to('breaks/create')
                         ->withErrors($validator)
                         ->withInput(Input::except('password'));
                 } else {
                     // store
                     $break =  Breaks::find($id);
                     $break->channel_id      = Input::get('name');
                     $break->init_date    = Input::get('init_date');
                     $break->duration =  Input::get('duration');
                     $break->save();

                     // redirect
                     Session::flash('message',  __('dpi.ok_updated', ['item' => __('dpi.break')]));
                     return Redirect::to('breaks');
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
        $break = Breaks::find($id);
        $break->delete();

        // redirect
        Session::flash('message',  __('dpi.ok_deleted', ['item' => __('dpi.break')]));
        return Redirect::to('breaks');
    }
}
