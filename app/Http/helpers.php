<?php
namespace App\Http;
class Helpers {
  /*
  Añade ceros a un string numérico para adecuarse al tamaño indicado
  por $maxharNum.
  Ej. $data = 1
      $maxCharNum = 3
      Return 001
  */

  public static function addZerosPreffix($data, $maxCharNum){
      $zerosToAdd = $maxCharNum-strlen($data);
      for($i = 0; $i < $zerosToAdd; $i++){
        $data = '0'.$data;
      }
      return $data;
  }
  public static function getMonthFromVerFilename($month){
    switch ($month) {
      case 'A':
        return '10';
        break;
      case 'B':
        return '11';
        break;
      case 'C':
        return '11';
        break;
      default:
        return $month;
        break;
    }
  }
}
