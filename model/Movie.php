<?php 
class Movie {
    private $id;
    private $title;
    private $overview;
    private float $vote_average;
    private $original_language;
    private $poster_path;

    function __construct($id,$title,$overview,$original_language,$vote_average,$poster_path) {
        $this->id = $id;
        $this->title = $title;
        $this->overview = $overview;
        $this->original_language = $original_language;
        $this->vote_average = $vote_average;
        $this->poster_path = $poster_path;
    }

}

//prendo dal json i dati che mi servono
$movieInfo = file_get_contents(__DIR__."/movie_db.json");
//trasformo il json in un array php
$movieInfoList = json_decode($movieInfo, true);
//creo un array in cui inserire i dati che ciclerò
$movies = [];

//ciclo sugli el in array associandolo alla classe new Movie prendendo le info che mi servono ed associandole alle variabili in array della funzione all'interno della classe
foreach($movieInfoList as $info) {
    $movies[]= new Movie ($info['id'], $info['title'], $info['overview'], $info['original_language'], $info['vote_average'], $info['poster_path']);
};

?>