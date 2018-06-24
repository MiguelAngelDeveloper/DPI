<?php
namespace App\Http;
use Carbon\Carbon;

class Helpers {
  /*
  Añade ceros a un string numérico para adecuarse al tamaño indicado
  por $maxharNum.
  Ej. $data = 1
  $maxCharNum = 3
  Return 001
  */

  public static function addZerosPreffix($data, $maxCharNum){
    $zerosToAdd = $maxCharNum-iconv_strlen($data);
    for($i = 0; $i < $zerosToAdd; $i++){
      $data = '0'.$data;
    }
    return $data;
  }

  public static function addSpacesSuffix($data, $maxCharNum){
    $zerosToAdd = $maxCharNum-iconv_strlen($data);
    for($i = 0; $i < $zerosToAdd; $i++){
      $data = $data.' ';
    }
    return $data;
  }
  public static function decodeMonthCCMSStyle($month){
    switch ($month) {
      case 'A':
      return '10';
      break;
      case 'B':
      return '11';
      break;
      case 'C':
      return '12';
      break;
      default:
      return $month;
      break;
    }
  }
  public static function encodeMonthCCMSStyle($month){
    switch ($month) {
      case '10':
      return 'A';
      break;
      case '11':
      return 'B';
      break;
      case '12':
      return 'C';
      break;
      default:
      return $month;
      break;
    }
  }
  public static function getSchFilename($date, $network, $zone){
    $dateParsed = Carbon::parse($date);
    $month = Helpers::encodeMonthCCMSStyle($dateParsed->month);
    $day = Helpers::addZerosPreffix($dateParsed->day, 2);
    return $month.$day.$network.$zone.'.SCH';
  }
  public static function getVerFileStatusCode($status){
    switch ($status) {
      case '0001':
      return __('dpi.code0001');
      break;
      case '0002':
      return __('dpi.code0002');
      break;
      case '0004':
      return __('dpi.code0004');
      break;
      case '0005':
      return __('dpi.code0005');
      break;
      case '0006':
      return __('dpi.code0006');
      break;
      case '0008':
      return __('dpi.code0008');
      break;
      case '0009':
      return __('dpi.code0009');
      break;
      case '0010':
      return __('dpi.code0010');
      break;
      case '0012':
      return __('dpi.code0012');
      break;
      case '0013':
      return __('dpi.code0013');
      break;
      case '0014':
      return __('dpi.code0014');
      break;
      case '0015':
      return __('dpi.code0015');
      break;
      case '0016':
      return __('dpi.code0016');
      break;
      case '0017':
      return __('dpi.code0017');
      break;
      case '0018':
      return __('dpi.code0018');
      break;
      case '0019':
      return __('dpi.code0019');
      break;
      case '0020':
      return __('dpi.code0020');
      break;
      case '0021':
      return __('dpi.code0021');
      break;
      case '0022':
      return __('dpi.code0022');
      break;
      case '0023':
      return __('dpi.code0023');
      break;
      default:
      $status;
      break;
    }
  }
}
