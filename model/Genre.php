<?php

class Genre {
    public $name;

    function __construct($name) {
        $this->name = $name;
    }
}

//prendo dal json i dati che mi servono
$genreInfo = file_get_contents(__DIR__."/genre_db.json");
//trasformo il json in un array php
$genreInfoList = json_decode($genreInfo, true);
$gender = [];

foreach ($genreInfoList as $info) {
    $gender[] = new Genre($info);
}

// //stampo
// var_dump($genre);


?>