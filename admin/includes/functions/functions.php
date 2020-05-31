<?php

    function getTitle(){
        global $pageTitle;
        
        if(isset($pageTitle)){
            echo $pageTitle;
        } else{
            echo "Default";
        }
        
    }

    function redirectHome($errorMsg, $url = null, $seconds = 3){

        if($url==null){
            $url = 'index.php';
            $link = 'acasa';
        } else {
            if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== '') {
                $url = $_SERVER['HTTP_REFERER'];
                    $link = 'pagina anterioara';
            } else {
                $url ='index.php';
                $link = 'acasa';
            }

        }

        echo $errorMsg;
        echo "<div class='alert alert-info'>Veti fi redirectionat catre $link in $seconds secunde.</div>";
        header("refresh:$seconds;url=$url");
        exit();
    }

    function checkItem($select, $from, $value){
        global $con;
        $statement = $con->prepare("SELECT  $select FROM $from WHERE $select =?");
        $statement->execute(array($value));
        $count = $statement->rowCount();
        return $count;
    }

    function countItems($item, $table){
        global $con;

        $stmt = $con->prepare("SELECT COUNT($item) FROM $table");
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    function getLatest($select, $table,$order ,$limit){
        global $con;
        $getStmt=$con->prepare("SELECT $select FROM $table ORDER BY $order DESC LIMIT $limit");
        $getStmt->execute();
        $rows = $getStmt->fetchAll();
        return $rows;
    }