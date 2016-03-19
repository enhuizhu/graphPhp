<?php
require_once "autoload.php";
$usCall = new usCall();
$usCall->generateMap();
$usCall->generateTaxMap();

print_r("------ state tax -------\n");
print_r(json_encode($usCall->taxMap));
print_r("\n\n");


print_r("------ solutions -------\n");

$solutions = $usCall->getPaths();

foreach ($solutions as $key => $value) {
	print_r("path:" . json_encode($value["path"]));	
	print_r("\ncost:" . $value["cost"]);
	print_r("\n");
}







