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
}
