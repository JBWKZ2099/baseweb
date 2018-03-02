<?php
    $production = false;
    $dot_info = false;

    if( $production ) {
    	define('SERVER','localhost');
         if( $dot_info ) {
        	define('DATABASE', 'exccomdb');
        	define('USER', 'exccomuser');
            define('PASSWORD', 'vl22kKC1');
         } else {
            define('DATABASE', 'exccomco_db');
            define('USER', 'exccomco_user');
            define('PASSWORD', '0K2fphyCbMjp');
         }
    } else {
        define('SERVER','localhost');
        define('DATABASE', 'base');
        define('USER', 'root');
        define('PASSWORD', 'root');
    }
?>