<?php 

include 'connect.php';

$tpl = 'includes/templates/';
$lang = 'includes/languages/';
$func = 'includes/functions/';
$css = 'layout/css/';
$js = 'layout/js/';



//include files

include $func.'functions.php';
include $lang.'english.php';
include $tpl.'header.php';

if (!isset($noNavbar)){ include $tpl.'navbar.php'; }