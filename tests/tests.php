<?php 
include "Scorer.php";

$high_risk = file( "high_risk_phrases.txt");
$low_risk = file ( "low_risk_phrases.txt");

$scorer = new Scorer($high_risk, $low_risk, 2, 1);

$value =  $scorer->score('hi Voldemort. I can not be dark lord Yo ganGster');
print $value."\n";
assert($value == 5);

$value =  $scorer->score('hi Voldemort. I can not be mdark lording Yo ganGster');
print $value."\n";
assert($value == 3);

$value =  $scorer->score('hi Voldemort. I can not be dark lording Yo ganGster');
print $value."\n";
assert($value == 3);

$value =  $scorer->score('hi Voldemort. I can not be dark lording.');
print $value."\n";
assert($value == 2);

$value =  $scorer->score('hi Voldemort. I can not be dark lord.');
print $value."\n";
assert($value == 4);

$value =  $scorer->score('dark lord is me and I can not be voldemort.');
print $value."\n";
assert($value == 4);

$value =  $scorer->score('dark lord is me, dark lord is me and I can not be ganGster.');
print $value."\n";
assert($value == 5);

$value =  $scorer->score('ganGster is me, I can be ganGster.');
print $value."\n";
assert($value == 2);

$value =  $scorer->score('.');
print $value."\n";
assert($value == 0);

$value =  $scorer->score('ganGster.');
print $value."\n";
assert($value == 1);


 ?>