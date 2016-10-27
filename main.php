<?php 

require "Scorer.php";

$high_risk = file( "high_risk_phrases.txt");
$low_risk = file ( "low_risk_phrases.txt");

$score = new Scorer($high_risk, $low_risk, 2, 1);

$dir = "./input/";


$outputfile = './output/output.txt';
file_put_contents($outputfile, '');

$line = "";

if ($dh = opendir($dir)) {
    while (($file = readdir($dh)) !== false) {
        if( is_file($dir . $file) ) {

        	$comment = file($dir . $file);
        	$line = $file.":".$score->score($comment[0])."\n";
        	file_put_contents($outputfile, $line, FILE_APPEND );

        }

    }
    closedir($dh);
}












