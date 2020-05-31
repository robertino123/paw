<?php
session_start();
$pageTitle = 'Users';
if (isset($_SESSION['nume'])) {
    include 'init.php';

    $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

    if ($do == 'Manage') { //pagina USERI
        $stmt = $con->prepare("SELECT * FROM user WHERE nume NOT LIKE 'admin' ");
        $stmt->execute();
        $rows = $stmt->fetchAll();
        ?>
        <h1 class="display-3" align="center" style="padding: 2.5%">Useri</h1>
        <div class="container">
            <div class="table-responsive">
                <table class="table table-striped table-dark">
                    <thead class="thead-dark">
                    <tr align="center">
                        <th>Id user</th>
                        <th>Nume</th>
                        <th>Prenume</th>
                        <th>Email</th>
                        <th>Data inregistrarii</th>
                        <th>De cine a fost adaugat</th>
                        <td>Editeaza/Sterge</td>
                    </tr>

                    </thead>
                    <tbody>
                    <?php
                    foreach ($rows as $row) {
                        echo "<tr>";
                        echo "<th scope=\"row\">" . $row['id_user'] . "</th>";
                        echo "<td>" . $row['nume'] . "</td>";
                        echo "<td>" . $row['prenume'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['data_inregistrare'] . "</td>";
                        echo "<td>" . $row['session'] . "</td>";
                        echo "
                                    <td>
                                        <a href='members.php?do=Edit&id_user=" . $row['id_user'] . "' class=\"btn btn-success\"><i class=\"fa fa-pencil-square-o\" aria-hidden=\"true\"></i> Editeaza</a>
                                        <a href='members.php?do=Delete&id_user=" . $row['id_user'] . "' class=\"btn btn-danger confirm\" onclick='return confirm(\"Esti sigur ca vrei sa stergi userul ?\");'><i class=\"fa fa-trash\" aria-hidden=\"true\"></i> Sterge</a>
                                    </td>
                                ";
                        echo "</tr>";
                    }
                    ?>

                    </tr>

                    </tbody>
                </table>
            </div>
            <a href="members.php?do=Add" class="btn btn-primary"><i class="fa fa-plus"></i> Adauga un nou user</a>
        </div>


        <?php
    } elseif ($do == 'Add') { ?>

        <h1 class="display-3" align="center" style="padding: 2.5%">Adauga utilizator nou</h1>
        <div class="container">
            <form class="form-horizontal" action="?do=Insert" method="POST">
                <div class="form-group">
                    <label>Nume</label>
                    <input type="text" name="nume" class="form-control">
                </div>
                <div class="form-group">
                    <label>Prenume</label>
                    <input type="text" name="prenume" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="text" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Parola</label>
                    <input type="password" name="parola" class="password form-control" id="myInput">
                    <input type="checkbox" onclick="myFunction()" style="padding-top: 3%;"> Arata parola
                    <script>
                        function myFunction() {
                            var pw_ele = document.getElementById("myInput");
                            if (pw_ele.type === "password") {
                                pw_ele.type = "text";
                            } else {
                                pw_ele.type = "password";
                            }
                        }
                    </script>
                </div>
                <div class="form-group form-group-lg">
                    <div class="col-sm-offset-6 col-sm-12">
                        <button type="submit" value="Adauga" class="btn btn-primary btn-lg btn-block"><i
                                    class="fa fa-plus"></i> Adauga
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <?php
    } elseif ($do == 'Insert') {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo "<h1 class='text-center'>Actualizeaza user</h1>";
            echo "<div class='container'>";


            $nume = $_POST['nume'];
            $prenume = $_POST['prenume'];
            $email = $_POST['email'];
            $pass = sha1($_POST['parola']);


            $formErrors = array();

            if (empty($nume)) {
                $formErrors[] = '<div class="alert alert-danger">Campul <strong>nume</strong> nu poate fi gol.</div>';
            }
            if (empty($prenume)) {
                $formErrors[] = '<div class="alert alert-danger">Campul <strong>prenume</strong> nu poate fi gol.</div>';
            }
            if (empty($email)) {
                $formErrors[] = '<div class="alert alert-danger">Campul <strong>email</strong> nu poate fi gol.</div>';
            }
            foreach ($formErrors as $error) {
                echo "<div class='alert alert-danger'>$error</div> ";
            }

            if (empty($formErrors)) {
                $check = checkItem("nume", "user", $nume);
                if ($check == 1) {
                    $errorMsg =  "<br><div class='alert alert-warning'>Acest user deja exista ! :( </div>";
                    redirectHome($errorMsg,'back');
                } else {

                    $stmt = $con->prepare("INSERT INTO user(nume,prenume,email,parola,session) VALUES(:nnume,:nprenume,:nemail,:nparola,:sesiune)");
                    $stmt->execute(array(
                        'nnume' => $nume,
                        'nprenume' => $prenume,
                        'nemail' => $email,
                        'nparola' => $pass,
                        'sesiune' => $_SESSION['nume']
                    ));
                    $numberofupdts = $stmt->rowCount();
                    $errorMsg= "<div class='alert alert-success'>" . $numberofupdts . " User nou adugat </div>";
                    redirectHome($errorMsg,'back');
                }
            }
            } else {

                echo  "<br><div class='alert alert-warning'>Nu poti accesa direct aceasta pagina :( </div>";


            }


            echo "</div>";
         }elseif ($do == 'Edit') { //pagina EDITEAZA PROFIL

            $userid = isset($_GET['id_user']) && is_numeric($_GET['id_user']) ? intval($_GET['id_user']) : 0;

            $stmt = $con->prepare("SELECT *
                            FROM user
                            WHERE id_user = '$userid' LIMIT 1");
            $stmt->execute(array($userid));
            $row = $stmt->fetch();
            $count = $stmt->rowCount();

            if ($stmt->rowCount() > 0) {
                ?>
                <h1 class="display-3" align="center" style="padding: 2.5%">Editeaza contul</h1>
                <div class="container">
                    <form class="form-horizontal" action="?do=Update" method="POST">
                        <input type="hidden" name="userId" value="<?php echo $userid ?>"/>
                        <div class="form-group">
                            <label>Nume</label>
                            <input type="text" name="nume" class="form-control" value="<?php echo $row['nume'] ?>"
                                   required>
                        </div>
                        <div class="form-group">
                            <label>Prenume</label>
                            <input type="text" name="prenume" class="form-control"
                                   value="<?php echo $row['prenume'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="text" name="email" class="form-control" id="exampleInputEmail1"
                                   value="<?php echo $row['email'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Parola</label>
                            <input type="hidden" name="oldpassword" value=""/>
                            <input type="password" name="newpassword" class="form-control"
                                   placeholder="Nu completa daca nu vrei sa schimbi parola"
                                   value="<?php echo $row['parola'] ?>">
                        </div>
                        <div class="form-group form-group-lg">
                            <div class="col-sm-offset-6 col-sm-12">
                                <button type="submit" value="Editeaza" class="btn btn-primary btn-lg btn-block"><i
                                            class="fa fa-pencil-square-o" aria-hidden="true"></i> Editeaza
                                </button>
                            </div>
                        </div>
                    </form>
                </div>


            <?php } else {
                echo "<div class='container'>";
                $errorMsg= "<div class='alert alert-danger'>Niciun id</div>";
                redirectHome($errorMsg,'back');
                echo "</div>";
            }
        } elseif ($do == 'Update') {
            echo "<h1 class='text-center'>Actualizeaza user</h1>";
            echo "<div class='container'>";
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $id = $_POST['userId'];
                $nume = $_POST['nume'];
                $prenume = $_POST['prenume'];
                $email = $_POST['email'];

                $pass = empty($_POST['newpassword']) ? $_POST['oldpassword'] : sha1($_POST['newpassword']);

                $formErrors = array();

                if (empty($nume)) {
                    $formErrors[] = '<div class="alert alert-danger">Campul <strong>nume</strong> nu poate fi gol.</div>';
                }
                if (empty($prenume)) {
                    $formErrors[] = '<div class="alert alert-danger">Campul <strong>prenume</strong> nu poate fi gol.</div>';
                }
                if (empty($email)) {
                    $formErrors[] = '<div class="alert alert-danger">Campul <strong>email</strong> nu poate fi gol.</div>';
                }
                foreach ($formErrors as $error) {
                    echo "<div class='alert alert-danger'>'.$error.'</div> ";
                }
                if (empty($formErrors)) {
                    $stmt = $con->prepare("UPDATE user SET nume = ?, prenume = ?, email = ?, parola = ? WHERE id_user = ?");
                    $stmt->execute(array($nume, $prenume, $email, $pass, $id));
                    $numberofupdts = $stmt->rowCount();
                    $errorMsg = "<div class='alert alert-success'>" . $numberofupdts . " User(i) actualizat(i) </div>";
                    redirectHome($errorMsg,'back');
                }
            } else {
                echo "<div class='container'>";
                $errorMsg = '<div class="alert alert-danger">Nu poti accesa direct aceasta pagina ! </div>';
                redirectHome($errorMsg);
                echo "</div>";
            }
            echo "</div>";
        } elseif ($do == 'Delete') {
            echo "<h1 class=\"display-3\" align=\"center\" style=\"padding: 2.5%\">Sterge user</h1>";
            echo "<div class='container'>";
            $userid = isset($_GET['id_user']) && is_numeric($_GET['id_user']) ? intval($_GET['id_user']) : 0;

            $stmt = $con->prepare("SELECT *
                            FROM user
                            WHERE id_user = '$userid' LIMIT 1");
            $stmt->execute(array($userid));
            $row = $stmt->fetch();
            $count = $stmt->rowCount();

            if ($stmt->rowCount() > 0) {
                $stmt = $con->prepare("DELETE FROM user WHERE id_user= :userid");
                $stmt->bindParam(":userid", $userid);
                $stmt->execute();
                $errorMsg= "<div class='alert alert-success'>" . $stmt->rowCount() . " User sters</div>";
                redirectHome($errorMsg,'back');
            } else {
                $errorMsg = "<div class='alert alert-danger'>" . $stmt->rowCount() . " Acest user nu exista</div>";
                redirectHome($errorMsg);
            }
            echo "</div>";
            }
            include $tpl . 'footer.php';
        }

    else {
        header('Location: index.php');
    }
    exit();

?>

