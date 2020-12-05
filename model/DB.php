<?php

  class DB {
    private static  function connect () {
        $pdo = new pdo('mysql:host=127.0.0.1;dbname=fabe;charset=utf8;' , 'root' ,'');
        $pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } 
    public static function query ($query , $params)   {
       
        $stmt = self::connect()->prepare($query);
        $stmt->execute($params);

        if (explode(' ' , $query)[0] == 'SELECT') {
            $DATA = $stmt->fetchAll();
            return $DATA;
        }

    }
  }
  
?>