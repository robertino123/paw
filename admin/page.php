<?php

$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

if(isset($_GET['do'])){
    $do = $_GET['do'];
} else {
    $do = 'Add';
}

if($do == 'Manage'){
    echo "Bine ai venit in pagina de management";
    echo '<a href="?do=Add">Adauga categorie noua </a>';
} elseif($do == 'Add'){
    echo "Bine ai venit in pagina de adaugare categorie";
} elseif($do == 'Insert'){
    echo "Bine ai venit in pagina de adaugare subcategorie";    
} else{
    echo "EROARE! Nicio pagina cu acest nume!";
}