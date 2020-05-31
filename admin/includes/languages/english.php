<?php

function lang($phrase){
    static $lang = array(
        'PRODUCTS' => 'Produse',
        'HOME_ADMIN' => 'Administrator',
        'HOME' => 'Acasa',
        'ITEMS' => 'Itemi',
        'MEMBERS' => 'Useri',
        'STATITICS' => 'Statistici',
        'LOGS' => 'Log-uri',
        'EDIT_PROFILE' => 'Editeaza profilul',
        
    );
    return $lang[$phrase];
}