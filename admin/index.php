<?php
session_start();

$noNavbar = '';
$pageTitle='Login';
if(isset($_SESSION['nume'])){
    header('Location: dashboard.php');
}

include 'init.php'; 

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['user'];
    $password = $_POST['pass'];
    $hashedPass = sha1($password);
    
    $stmt = $con->prepare("SELECT
                                id_user,nume,parola 
                            FROM user 
                            WHERE nume = ? 
                            AND parola = ?
                            LIMIT 1");
    $stmt->execute(array($username,$hashedPass));
    $row = $stmt->fetch();
    $count = $stmt->rowCount();
    
    if($count > 0){
        $_SESSION['nume']= $username;
        $_SESSION['ID'] = $row['id_user'];
        header('Location: dashboard.php');
        exit();  
    }
}

?>

<form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
   <h3 class="text-center">Admin login</h3>
    <input class="form-control " type="text" name="user" placeholder="Username" autocomplete="off" />
    <input class="form-control " type="password" name="pass" placeholder="Password" autocomplete="off"/>
    <button class="btn btn-primary btn-block" type="submit" value="Login"><i class="fa fa-sign-in" aria-hidden="true"></i> Sign in</button>
</form>

<?php
include $tpl.'footer.php'; 
?> 
<script>
    $(function () {
        'use strict';

        $('[placeholder]').focus(function () {
            $(this).attr('data-text', $(this).attr('placeholder'));
            $(this).attr('placeholer', '');
        }).blur(function () {
            $(this).attr('placeholder', $(this).attr('data-text'));
        });
    });
</script>
