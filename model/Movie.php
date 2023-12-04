<?php 
include __DIR__ ."/Genre.php";
class Movie {
    public $id;
    public $title;
    public $overview;
    public float $vote_average;
    public $original_language;
    public $poster_path;
    public string $genre;

    function __construct($id,$title,$overview,$original_language,$vote_average,$poster_path, $genre) {
        $this->id = $id;
        $this->title = $title;
        $this->overview = $overview;
        $this->original_language = $original_language;
        $this->vote_average = $vote_average;
        $this->poster_path = $poster_path;
        $this->genre = $genre;
    }

    function cardPrinter() {
        $poster = $this->poster_path;
        $title = $this->title;
        $plot = substr($this->overview, 0, 150) . "...";
        $rate = $this->starPrinter();
        $flag = $this->flagPrinter();
        $genre = $this->genre;
        include __DIR__ ."/../views/partials/card.php";
    }

    function starPrinter() {
        $rating = ceil($this -> vote_average / 2);
        $paragraph = '<p style="color: orange">';
        for ($i = 1; $i <= 5; $i++) {
            $paragraph .= $i <= $rating ? '<i class= "fa-solid fa-star"></i>':'<i class= "fa-regular fa-star"></i>';
        }
        $paragraph .= '</p>';
        return $paragraph;
    }

    function flagPrinter() {
        $flags =['ca','de','es','fr','gb','it','ja','kr','us'];
        $flag = "img/".$this->original_language .".svg";
        if(!in_array($this->original_language,$flags)) {
            $flag = "img/imagemissing_92832.png";
        }
        return $flag;
    }
    
}

//prendo dal json i dati che mi servono
$movieInfo = file_get_contents(__DIR__."/movie_db.json");
//trasformo il json in un array php
$movieInfoList = json_decode($movieInfo, true);
//creo un array in cui inserire i dati che ciclerò
$movies = [];

function rngGen($array) {
    $rngNumber = rand(1,3);
    $rngGenreString = "";
    for($i=0; $i < $rngNumber; $i++) {
        $rngValue = $array[rand(0, count($array) -1)]->name; 
        if(!str_contains($rngGenreString, $rngValue)) {
            $rngGenreString .= $rngValue . ' ';
        };
    }
    return $rngGenreString;
}

//ciclo sugli el in array associandolo alla classe new Movie prendendo le info che mi servono ed associandole alle variabili in array della funzione all'interno della classe
foreach($movieInfoList as $info) {
    $rngGenreValue = rngGen($gender);
    // $rngGenre = $gender[rand(0, count($gender) -1)];
    $movies[]= new Movie ($info['id'], $info['title'], $info['overview'], $info['original_language'], $info['vote_average'], $info['poster_path'], $rngGenreValue);
};

//lo stampo
// var_dump($movies);

?>