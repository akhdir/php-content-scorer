<?php  

require "Score.php";

$high_risk = file( "large.txt");
$low_risk = file ( "large.txt");

$score = new Score($high_risk, $low_risk, 2, 1);

$score->calculate("hello this is me aboud");

// $score->calculateFast("hello this is me aboud");

?> 