<?php 

require "Score.php";

$high_risk = file( "high_risk_phrases.txt");
$low_risk = file ( "low_risk_phrases.txt");

$score = new Score($high_risk, $low_risk, 2, 1);

$value =  $score->calculate('hi Voldemort. I can not be dark lord Yo ganGster');
print $value."\n";
assert($value == 5);

$value =  $score->calculate('hi Voldemort. I can not be mdark lording Yo ganGster');
print $value."\n";
assert($value == 3);

$value =  $score->calculate('hi Voldemort. I can not be dark lording Yo ganGster');
print $value."\n";
assert($value == 3);

$value =  $score->calculate('hi Voldemort. I can not be dark lording.');
print $value."\n";
assert($value == 2);

$value =  $score->calculate('hi Voldemort. I can not be dark lord.');
print $value."\n";
assert($value == 4);

$value =  $score->calculate('dark lord is me and I can not be voldemort.');
print $value."\n";
assert($value == 4);

$value =  $score->calculate('dark lord is me, dark lord is me and I can not be ganGster.');
print $value."\n";
assert($value == 5);

$value =  $score->calculate('ganGster is me, I can be ganGster.');
print $value."\n";
assert($value == 2);

$value =  $score->calculate('.');
print $value."\n";
assert($value == 0);

$value =  $score->calculate('ganGster.');
print $value."\n";
assert($value == 1);

exit;

// $dir = "./comments/";


// $outputfile = 'output.txt';
// file_put_contents($outputfile, '');

// $line = "";

// if ($dh = opendir($dir)) {
//     while (($file = readdir($dh)) !== false) {
//         if( is_file($dir . $file) ) {

//         	$comment = file($dir . $file);
//         	$line = $file.":".$score->calculate($comment[0])."\n";
//         	file_put_contents($outputfile, $line, FILE_APPEND );

//         }

//     }
//     closedir($dh);
// }












