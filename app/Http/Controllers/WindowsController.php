<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Channels;
use App\Windows;
use View;
use Redirect;
use Session;
use Validator;
use Input;

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
         $validator = Validator::make(Input::all(), $rules);

         // process the login
         if ($validator->fails()) {
             return Redirect::to('windows/create')
                 ->withErrors($validator)
                 ->withInput(Input::except('password'));
         } else {
             // store
             $window = new Windows;
             $window->channel_id      = Input::get('name');
             $window->init_date    = Input::get('init_date');
             $window->duration =  Input::get('duration');
             $window->save();

             // redirect
             Session::flash('message',  __('dpi.ok_created', ['item' => __('dpi.window')]));
             return Redirect::to('windows');
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
                     // store
                     $window =  Windows::find($id);
                     $window->channel_id      = Input::get('name');
                     $window->init_date    = Input::get('init_date');
                     $window->duration =  Input::get('duration');
                     $window->save();

                     // redirect
                     Session::flash('message',  __('dpi.ok_updated', ['item' => __('dpi.window')]));
                     return Redirect::to('windows');
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
        $window = Windows::find($id);
        $window->delete();

        // redirect
        Session::flash('message',  __('dpi.ok_deleted', ['item' => __('dpi.window')]));
        return Redirect::to('windows');
    }
}
