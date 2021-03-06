<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Channels;
use App\Breaks;
use View;
use Redirect;
use Session;
use Validator;
use Input;
use App\Http\Helpers;
class ChannelsController extends Controller
{

    /**
  * Display a listing of the resource.
  *
  * @return Response
  */
 public function index()
 {
     //
     $channels = Channels::all();

     // load the view and pass the nerds
     return View::make('dpi.channels.index')
    ->with('channels', $channels);

 }

 /**
  * Show the form for creating a new resource.
  *
  * @return Response
  */
 public function create()
 {
     //
        return View::make('dpi.channels.create');
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
     // validate
       // read more on validation at http://laravel.com/docs/validation
      $rules = array(
           'name'       => 'required|max:100|unique:channels',
           'code'      => 'required|numeric',
           'zone' => 'required|numeric'
       );
       $validator = Validator::make(Input::all(), $rules);

       // process the login
       if ($validator->fails()) {
           return Redirect::to('channels/create')
               ->withErrors($validator)
               ->withInput(Input::except('password'));
       } else {
         try {
           DB::beginTransaction();
           // store
           $channel = new Channels;
           $channel->name       = Input::get('name');
           $channel->code      = Helpers::addZerosPreffix(Input::get('code'), 2);
           $channel->zone =  Helpers::addZerosPreffix(Input::get('zone'),3);
           $channel->save();
           DB::commit();
           // redirect
           Session::flash('message',  __('dpi.ok_created', ['item' => __('dpi.channel')]));
           return Redirect::to('channels');
         } catch (\Exception $e) {
           DB::rollback();
           Redirect::back()
           ->withErrors(['msg','Error al insertar el anuncio en BBDD: '.$e.getMessage()])
          ->withInput(Input::except('password'));
         }           
       }
 }

 /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return Response
  */
 public function show($id)
 {
     //
     // get the nerd
   $channel = Channels::find($id);

   // show the view and pass the nerd to it
   return View::make('dpi.channels.show')
       ->with('channel', $channel);
 }

 /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return Response
  */
 public function edit($id)
 {
     //
     $channel = Channels::find($id);

     // show the edit form and pass the nerd
    return View::make('dpi.channels.edit')
    ->with('channel', $channel);
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
     // validate
    // read more on validation at http://laravel.com/docs/validation
    $rules = array(
         'name'       => 'required|max:100',
         'code'      => 'required|numeric',
         'zone' => 'required|numeric'
     );
     $validator = Validator::make(Input::all(), $rules);

    // process the login
    if ($validator->fails()) {
        return Redirect::to('channels/' . $id . '/edit')
            ->withErrors($validator)
            ->withInput(Input::except('password'));
    } else {
      try {
        DB::beginTransaction();
        // store
        $channel = Channels::find($id);
        $channel->name       = Input::get('name');
        $channel->code      = Helpers::addZerosPreffix(Input::get('code'), 2);
        $channel->zone =  Helpers::addZerosPreffix(Input::get('zone'),3);
        $channel->save();
        DB::commit();
        // redirect
        Session::flash('message',  __('dpi.ok_updated', ['item' => __('dpi.channel')]));
        return Redirect::to('channels');
      } catch (\Exception $e) {
        DB::rollback();
        Redirect::back()
        ->withErrors(['msg','Error al modificar el anuncio en BBDD: '.$e.getMessage()])
        ->withInput(Input::except('password'));
      }


    }
 }

 /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return Response
  */
 public function destroy($id)
 {
     //
     try {
        DB::beginTransaction();
         // delete
        $channel = Channels::find($id);
        $channel->delete();
        DB::commit();
        // redirect
        Session::flash('message',  __('dpi.ok_deleted', ['item' => __('dpi.channel')]));
        return Redirect::to('channels');
     } catch (\Exception $e) {
       DB::rollback();
       Redirect::back()
       ->withErrors(['msg','Error al eliminar el anuncio en BBDD: '.$e.getMessage()])
      ->withInput(Input::except('password'));
     }


 }

}
