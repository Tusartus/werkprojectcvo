<?php


//include once all Classs van onze php 
$classes = [ 'Infogegeven', 'Partner', 'DB', 'History'];
foreach ($classes as $class){
     include_once "classes/{$class}.php";
}
