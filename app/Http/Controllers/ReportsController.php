<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helpers;
use View;
use Validator;
use Input;
use Redirect;
use File;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $reports = array();
        $fileDetail = array();
        return View::make('dpi.reports.index')->with('reports', $reports)
        ->with('fileDetail', $fileDetail);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return View::make('dpi.reports.create');
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
        $file = $request->verificationfile;
        $filename =$file->getClientOriginalName();
        $allInput = Input::all();
        $allInput['filename'] = $filename;
        $rules = array(
          'verificationfile'=>'file|max:2048',
          'filename' => 'regex:/^[1-9A-C][0-3][0-9][\d]{2}[\d]{3}\.ver$/'
        );
        $validator = Validator::make($allInput, $rules);
        if ($validator->fails()) {
          return Redirect::to('reports/create')
          ->withErrors($validator)
          ->withInput(Input::except('password'));
        } else {

          $reports = $this->parseVerFile($file);
          $fileDetail = $this->parseVerFilename($filename);
        //  File::get($request->verificationfile->getRealPath());
        //  return Redirect::to('reports')->with('reports', $reports);
        return View::make('dpi.reports.index')->with('reports', $reports)
        ->with('fileDetail', $fileDetail);
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

    private function parseVerFilename($filename){
    $parsedFilename = array();
    if( preg_match("/([1-9A-C])([0-3][0-9])([\d]{2})([\d]{3})\.ver/" , $filename, $matches)) {
      $parsedFilename["month"] = Helpers::getMonthFromVerFilename($matches[1]);
      $parsedFilename["day"] = $matches[2];
      $parsedFilename["network"] = $matches[3];
      $parsedFilename["zone"] = $matches[4];
    }
    return $parsedFilename;
}

  private function parseVerFile ($file){
      $filepath = $file->getRealPath();
      $contents = File::get($filepath);
      $lines = explode('\r\n',trim($contents));
      foreach ($lines as $index => $line) {
        $members = explode(' ',trim($line));
        $report['airedSportDate'] = $members[1];
        $report['scheduledTime'] = $members[2];
        $report['spotLenght'] = $members[7];
        $report['actualAiredTime'] = $members[8];
        $report['actualAiredLength'] = $members[9];
        $report['actualAiredPosition'] = $members[10];
        $report['spotId'] = $members[11];
        $report['statusCode'] = $members[11];
        $reports[] = $report;
      }
      return $reports;
    }

}
