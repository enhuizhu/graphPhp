<?php
spl_autoload_register(function ($class_name) {
    try {
    	$file = $class_name . ".php";

    	if (file_exists($file)) {
    		include $file;
    	}
    } catch (Exception $e) {
    	
    }
});