<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helpers;
use View;
use Validator;
use Input;
use Redirect;
use File;
use Carbon\Carbon;

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
        return View::make('dpi.reports.create');
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

          if($reports == -1){
            return View::make('dpi.reports.create')
              ->withErrors(array('message' => 'El formato del fichero no es válido.'));
          } elseif ($fileDetail == -1) {
            return View::make('dpi.reports.create')
              ->withErrors(array('message' => 'El nombre del fichero no es válido.'));
          } else{
            return View::make('dpi.reports.index')->with('reports', $reports)
            ->with('fileDetail', $fileDetail);
          }
        //  File::get($request->verificationfile->getRealPath());
        //  return Redirect::to('reports')->with('reports', $reports);

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
        return View::make('dpi.reports.create');
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
        return View::make('dpi.reports.create');
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
        return View::make('dpi.reports.create');
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
      return View::make('dpi.reports.create');
    }

    private function parseVerFilename($filename){
      try {
        $parsedFilename = array();
        if( preg_match("/([1-9A-C])([0-3][0-9])([\d]{2})([\d]{3})\.ver/" , $filename, $matches)) {
          $parsedFilename["month"] = Helpers::decodeMonthCCMSStyle($matches[1]);
          $parsedFilename["day"] = $matches[2];
          $parsedFilename["network"] = $matches[3];
          $parsedFilename["zone"] = $matches[4];
        }else{
          return -1;
        }
        return $parsedFilename;
      } catch (\Exception $e) {
        return -1;
      }
}

  private function parseVerFile ($file){
    try {
      $filepath = $file->getRealPath();
      $contents = File::get($filepath);
      $lines = explode(PHP_EOL,trim($contents));
      $reports = array();
      $EOF = false;
      foreach ($lines as $index => $line) {
        if($EOF){
          throw new \Exception('Error Processing Verification File. Incorrect file format.', 1);
        }
        $members = explode(' ',trim($line));
        if($members[0] != 'END') {
          $report['airedSpotDate'] = Carbon::createFromFormat('md', $members[1])->format('j/m');
          $report['scheduledTime'] = Carbon::createFromFormat('His', $members[2])->format('H:i:s');
          $report['spotLenght'] = Carbon::createFromFormat('His', $members[7])->format('H:i:s');
          $report['actualAiredTime'] = Carbon::createFromFormat('His', $members[8])->format('H:i:s');
          $report['actualAiredLength'] = Carbon::createFromFormat('Hisu', $members[9].'0000')->format('H:i:s.v');
          $report['actualAiredPosition'] = $members[10];
          $report['spotId'] = $members[11];
          $report['statusCode'] =Helpers::getVerFileStatusCode($members[12]);
          $reports[] = $report;
        } else {
          $EOF = true;
        }
      }
      return $reports;
    } catch (\Exception $e) {
      return -1;
    }
  }

}
