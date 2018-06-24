<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ads;
use View;
use Redirect;
use Session;
use Validator;
use Input;

class AdsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $ads = Ads::all();

        // load the view and pass the nerds
        return View::make('dpi.ads.index')
       ->with('ads', $ads);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $ads = Ads::all();
        return View::make('dpi.ads.create', compact('ads'));
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
           'name'       => 'required|unique:ads|max:20',
           'code'      => 'required|max:11|unique:ads|regex:/^[\dA-Z\-\_]+$/',
           'duration' => 'required|size:8',
           'tipo' => 'required',
           'announcer' => 'required|max:32'
       );
       $validator = Validator::make(Input::all(), $rules);

       // process the login
       if ($validator->fails()) {
           return Redirect::to('ads/create')
               ->withErrors($validator)
               ->withInput(Input::except('password'));
       } else {
           // store
           $ad = new Ads;
           $ad->name      = Input::get('name');
           $ad->tipo    = Input::get('tipo');
           $ad->duration    = Input::get('duration');
           $ad->code    = Input::get('code');
           $ad->announcer =  Input::get('announcer');
           $ad->save();

           // redirect

           Session::flash('message', __('dpi.ok_created', ['item' => __('dpi.ad')]));
           return Redirect::to('ads');
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
        $ad = Ads::find($id);

        // show the view and pass the nerd to it
        return View::make('dpi.ads.show')
            ->with('ad', $ad);
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
        $ad = Ads::find($id);
        // show the edit form and pass the nerd
       return View::make('dpi.ads.edit')
       ->with('ad', $ad);
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
          'name'       => 'required|unique:ads|max:20',
          'code'      => 'required|max:11|unique:ads|regex:/^[\dA-Z\-\_]+$/',
          'duration' => 'required|size:8',
          'tipo' => 'required',
          'announcer' => 'required|max:32'
         );
         $validator = Validator::make(Input::all(), $rules);

         // process the login
         if ($validator->fails()) {
             return Redirect::to('ads/create')
                 ->withErrors($validator)
                 ->withInput(Input::except('password'));
         } else {
             // store
             $ad = Ads::find($id);
             $ad->name      = Input::get('name');
             $ad->tipo    = Input::get('tipo');
             $ad->duration    = Input::get('duration');
             $ad->code    = Input::get('code');
             $ad->announcer =  Input::get('announcer');
             $ad->save();

             // redirect
             Session::flash('message',  __('dpi.ok_updated', ['item' => __('dpi.ad')]));
             return Redirect::to('ads');
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
        $ad = Ads::find($id);
        $ad->delete();

        // redirect
        Session::flash('message',  __('dpi.ok_deleted', ['item' => __('dpi.ad')]));
        return Redirect::to('ads');
    }
}
