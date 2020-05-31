<?php

ob_start();

session_start();

$pageTitle = 'Categorii';

if (isset($_SESSION['nume'])) {
    include 'init.php';
    $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

    if ($do == 'Manage') {
        echo "
        <h1 class=\"display-3\" align=\"center\" style=\"padding: 2.5%\">Categorii, subcategorii, produse</h1>
                <div class=\"accordion\" id=\"accordionExample\" style='margin-left: 4%; margin-right: 4%; margin-top: 2%;'>
                      <div class=\"card\">
                        <div class=\"card-header\" id=\"headingOne\">
                          <h2 class=\"mb-0\">
                            <button class=\"btn btn-link btn-block text-left\" type=\"button\" data-toggle=\"collapse\" data-target=\"#collapseOne\" aria-expanded=\"true\" aria-controls=\"collapseOne\" style='text-decoration: none; color: black'>
                              Categorii <i class=\"fa fa-caret-square-o-down\" aria-hidden=\"true\"></i>
                            </button>
                          </h2>
                        </div>
                        <div id=\"collapseOne\" class=\"collapse show\" aria-labelledby=\"headingOne\" data-parent=\"#accordionExample\">
                          <div class=\"card-body\">
                                <table class=\"table\">
                                  <thead class=\"thead-dark\">
                                    <tr>
                                      <th scope=\"col\">Id categorie</th>
                                      <th scope=\"col\">Nume</th>
                                      <th scope=\"col\">Data adaugarii</th>
                                      <th scope=\"col\">Sterge</th>
                                    </tr>
                                  </thead>
                                  <tbody>";
                                    $stmt = $con->prepare("SELECT * FROM categorii ");
                                    $stmt->execute();
                                    $rows = $stmt->fetchAll();
                                    foreach ($rows as $row) {
                                        echo "<tr>";
                                        echo "<th scope=\"row\">" . $row['id_categorie'] . "</th>";
                                        echo "<td>" . $row['categorie'] . "</td>";
                                        echo "<td>" . $row['data_adaugare'] . "</td>";
                                        echo "
                                                                <td>
                                                                    <a href='products.php?do=DeleteCat&id_categorie=" . $row['id_categorie'] . "' class=\"btn btn-danger confirm\" onclick='return confirm(\"Esti sigur ca vrei sa stergi categoria ?\");'><i class=\"fa fa-trash\" aria-hidden=\"true\"></i> Sterge</a>
                                                                </td>
                                                            ";
                                        echo "</tr>";
                                    }
                                    echo "</tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                      <div class=\"card\">
                        <div class=\"card-header\" id=\"headingTwo\">
                          <h2 class=\"mb-0\">
                            <button class=\"btn btn-link btn-block text-left collapsed\" type=\"button\" data-toggle=\"collapse\" data-target=\"#collapseTwo\" aria-expanded=\"false\" aria-controls=\"collapseTwo\" style='text-decoration: none; color: black'>
                              Subcategorii <i class=\"fa fa-caret-square-o-down\" aria-hidden=\"true\"></i>
                            </button>
                          </h2>
                        </div>
                        <div id=\"collapseTwo\" class=\"collapse\" aria-labelledby=\"headingTwo\" data-parent=\"#accordionExample\">
                          <div class=\"card-body\">
                                  <table class=\"table\">
                                  <thead class=\"thead-dark\">
                                    <tr>
                                      <th scope=\"col\">Id subcategorie</th>
                                      <th scope=\"col\">Nume</th>
                                      <th scope=\"col\">Data adaugarii</th>
                                      <th scope=\"col\">Sterge</th>
                                    </tr>
                                  </thead>
                                  <tbody>";
                                    $stmt = $con->prepare("SELECT * FROM subcategorii s, categorii c WHERE c.id_categorie=s.id_categorie ");
                                    $stmt->execute();
                                    $rows = $stmt->fetchAll();
                                    foreach ($rows as $row) {
                                        echo "<tr>";
                                        echo "<th scope=\"row\">" . $row['id_subcategorie'] . "</th>";
                                        echo "<td>" . $row['nume_subcategorie'] . " - " . $row['categorie'] . "</td>";
                                        echo "<td>" . $row['data_adaugare'] . "</td>";
                                        echo "
                                                                <td>
                                                                    <a href='products.php?do=DeleteSubcat&id_subcategorie=" . $row['id_subcategorie'] . "' class=\"btn btn-danger confirm\" onclick='return confirm(\"Esti sigur ca vrei sa stergi subcategoria ?\");'><i class=\"fa fa-trash\" aria-hidden=\"true\"></i> Sterge</a>
                                                                </td>
                                                            ";
                                        echo "</tr>";
                                    }
                                    echo "</tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                      <div class=\"card\">
                        <div class=\"card-header\" id=\"headingThree\">
                          <h2 class=\"mb-0\">
                            <button class=\"btn btn-link btn-block text-left collapsed\" type=\"button\" data-toggle=\"collapse\" data-target=\"#collapseThree\" aria-expanded=\"false\" aria-controls=\"collapseThree\" style='text-decoration: none; color: black'>
                              Produse <i class=\"fa fa-caret-square-o-down\" aria-hidden=\"true\"></i>
                            </button>
                          </h2>
                        </div>
                        <div id=\"collapseThree\" class=\"collapse\" aria-labelledby=\"headingThree\" data-parent=\"#accordionExample\">
                          <div class=\"card-body\">
                                <table class=\"table\">
                                  <thead class=\"thead-dark\">
                                    <tr>
                                      <th scope=\"col\">Id produs</th>
                                      <th scope=\"col\">Nume</th>
                                      <th scope=\"col\">Categorie - Subcategorie</th>
                                      <th scope=\"col\">Imagine</th>
                                      <th scope=\"col\">Pret</th>
                                      <th scope=\"col\">Cantitate</th>
                                      <th scope=\"col\">Keyword</th>
                                      <th scope=\"col\">Data adaugare</th>
                                      <th scope=\"col\">Descriere</th>
                                      <th scope=\"col\">Sterge</th>
                                      
                                    </tr>
                                  </thead>
                                  <tbody>";
                                    $stmt = $con->prepare("SELECT * FROM produs p, categorii c, subcategorii s WHERE p.id_categorie=c.id_categorie AND p.id_subcategorie=s.id_subcategorie ");
                                    $stmt->execute();
                                    $rows = $stmt->fetchAll();
                                    foreach ($rows as $row) {
                                        echo "<tr>";
                                        echo "<th scope=\"row\">" . $row['id_produs'] . "</th>";
                                        echo "<td style='width: 100px;' scope=\"row\">" . $row['nume_produs'] . "</td>";
                                        echo "<td>" . $row['categorie'] . " - " . $row['nume_subcategorie'] . "</td>";
                                        echo "
                                        <td>
                                        <img src='imgs/imagini_produs/" . $row['imagine'] . "' style='height: 50px; width: 50px' />
                                        </td>";
                                        echo "<td>" . $row['pret'] . "</td>";
                                        echo "<td>" . $row['cantitate'] . "</td>";
                                        echo "<td>" . $row['keyword'] . "</td>";
                                        echo "<td>" . $row['data_adaugare'] . "</td>";
                                        echo "<td >" . $row['descriere'] . "</td>";
                                        echo "
                                                                <td style='width: 150px'>
                                                                    <a href='products.php?do=DeleteProd&id_produs=" . $row['id_produs'] . "' class=\"btn btn-danger confirm\" onclick='return confirm(\"Esti sigur ca vrei sa stergi produsul ? \");'><i class=\"fa fa-trash\" aria-hidden=\"true\"></i> Sterge</a>
                                                                </td>
                                                            ";
                                        echo "</tr>";
                                    }
                                    echo "</tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
        ";
    } elseif ($do == 'AddProd') {
        echo "       
        <h1 class=\"display-3\" align=\"center\" style=\"padding: 2.5%\">Adauga produs nou</h1>
        <div class=\"container\">
            <form class=\"form-horizontal\" action=\"?do=InsertProd\" method=\"POST\" enctype=\"multipart/form-data\">
                <div class=\"form-group\">
                    <label>Nume produs</label>
                    <input type=\"text\" name=\"numeProd\" class=\"form-control\">
                </div>
                <div class=\"form-group\">
                    <label for=\"exampleFormControlSelect1\">Categorie - Subcategorie :</label>
                        <select class=\"form-control\" id=\"categorie\" name='id_categorie'>";
        $smt = $con->prepare('SELECT * FROM subcategorii s, categorii c WHERE s.id_categorie = c.id_categorie ORDER BY categorie ASC');
        $smt->execute();
        $data = $smt->fetchAll();
        foreach ($data as $row):
            echo "<option value=" . $row['id_categorie'] . ">" . $row['categorie'] . " - " . $row['nume_subcategorie'] . " </option>";
        endforeach;
        echo "  </select>
                </div>
                <div class=\"form-group\">
                      <form>
                          <div class=\"form-group\">
                            <label for=\"exampleFormControlFile1\">Adauga imagine produs</label>
                            <input type=\"file\" class=\"form-control-file\" name='imagineProd'>
                          </div>
                       </form>
                <div class=\"form-group\">
                    <label>Pret produs(LEI)</label>
                    <input type=\"number\" name=\"pretProd\" class=\"form-control\">
                </div>
                <div class=\"form-group\">
                    <label>Cantitate(cutii/flacoane - 1,2,3...)</label>
                    <input type=\"number\" name=\"cantitateProd\" class=\"form-control\">
                </div>
                <div class=\"form-group\">
                    <label for=\"exampleFormControlTextarea1\">Descriere produs</label>
                    <textarea class=\"form-control\" id=\"exampleFormControlTextarea1\" rows=\"5\" name='descriereProd'></textarea>
                </div>
                <div class=\"form-group\">
                    <label for=\"formGroupExampleInput\">Cuvant cheie</label>
                    <input type=\"text\" class=\"form-control\" id=\"formGroupExampleInput\" placeholder=\"Keyword\" name='keyowrdProd'>
                 </div>
                <div class=\"form -group form-group -lg\">
                    <div class=\"col-sm-offset-6 col-sm-12\">
                        <button type=\"submit\" value=\"AdaugaProdus\" class=\"btn btn-primary btn-lg btn-block\"><i class=\"fa fa-plus\"></i
                        > Adauga produs
                        </button>
                    </div>
                </div>
            </form>
        </div>
    ";
    } elseif ($do == 'AddCat') {
        echo "
        <h1 class=\"display-3\" align=\"center\" style=\"padding: 2.5%\">Adauga categorie noua</h1>
        <div class=\"container\">
            <form class=\"form-horizontal\" action=\"?do=InsertCat\" method=\"POST\">
                <div class=\"form-group\">
                    <label>Categorie : </label>
                    <input type=\"text\" name=\"numeCat\" class=\"form-control\">
                </div>
                <div class=\"form-group form-group-lg\">
                    <div class=\"col-sm-offset-6 col-sm-12\">
                        <button type=\"submit\" value=\"Adauga\" class=\"btn btn-primary btn-lg btn-block\"><i
                                    class=\"fa fa-plus\"></i> Adauga categorie
                        </button>
                    </div>
                </div>
            </form>
        </div>
    ";
    } elseif ($do == 'AddSubcat') {
        echo "
        <h1 class=\"display-3\" align=\"center\" style=\"padding: 2.5%\">Adauga subcategorie noua</h1>
        <div class=\"container\">
            <form class=\"form-horizontal\" action=\"?do=InsertSubcat\" method=\"POST\">
                <div class=\"form-group\">
                    <label for=\"exampleFormControlSelect1\">Categorie :</label>
                        <select class=\"form-control\" id=\"categorie\" name='categorie_post'>";
        $smt = $con->prepare('SELECT * FROM categorii');
        $smt->execute();
        $data = $smt->fetchAll();
        foreach ($data as $row):
            echo "<option value=" . $row['id_categorie'] . ">" . $row['categorie'] . "</option>";
        endforeach;
        echo "</select>
                </div>
                <div class=\"form-group\">
                    <label>Subcategorie : </label>
                    <input type=\"text\" name=\"numeSubcat\" class=\"form-control\">
                </div>
                <div class=\"form-group form-group-lg\">
                    <div class=\"col-sm-offset-6 col-sm-12\">
                        <button type=\"submit\" value=\"Adauga\" class=\"btn btn-primary btn-lg btn-block\"><i
                                    class=\"fa fa-plus\"></i> Adauga subcategorie
                        </button>
                    </div>
                </div>
            </form>
        </div>
    ";
    } elseif ($do == 'InsertProd') {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nume_produs = $_POST['numeProd'];
            $cat_id = $_POST['id_categorie'];

            $stmt = $con->prepare("SELECT id_subcategorie FROM produs WHERE id_categorie = '$cat_id'");
            $stmt->execute();

            while ($row = $stmt->fetch()) {
                $subcatId = $row['id_subcategorie'];
            }

            $imagine = $_FILES['imagineProd']['name'];
            $imagine_tmp = $_FILES['imagineProd']['tmp_name'];
            move_uploaded_file($imagine_tmp, "imgs/imagini_produs/$imagine");

            $pret = $_POST['pretProd'];
            $cantitate = $_POST['cantitateProd'];
            $keyword = $_POST['keyowrdProd'];

            if (empty($nume_produs)) {
                $formErrors[] = '<br><div class="alert alert-danger">Campul <strong>nume produs</strong> nu poate fi gol.</div>';

                foreach ($formErrors as $error) {
                    $errorMsg = $error;
                    redirectHome($errorMsg, 'back');
                }
            }
            if (empty($formErrors)) {
                $check = checkItem("nume_produs", "produs", $nume_produs);
                if ($check == 1) {
                    $errorMsg = "<br><div class='alert alert-warning'>Ecest produs deja exista ! :( </div>";
                    redirectHome($errorMsg, 'back');
                } else {
                    try {
                        $stmt = $con->prepare("INSERT INTO produs(nume_produs, id_categorie, id_subcategorie, imagine, pret, cantitate, keyword, data_adaugare)
                                                                VALUES(:numeProd, :idCat, :idSubcat, :imagine, :pret, :cantitate, :keyword , now())");

                        $stmt->execute(array(
                            ':numeProd' => $nume_produs,
                            ':idCat' => (int)$cat_id,
                            ':idSubcat' => (int)$subcatId,
                            ':imagine' => $imagine,
                            ':pret' => (double)$pret,
                            ':cantitate' => (int)$cantitate,
                            ':keyword' => $keyword
                        ));

                        $numberofupdts = $stmt->rowCount();
                        $errorMsg = "<div class='alert alert-success'>" . $numberofupdts . " Produs nou adugat cu succes ! :) </div>";
                        redirectHome($errorMsg, 'back');

                    } catch (Exception $e) {
                        echo "<div class='alert alert-danger'>" . $e->getMessage() . "</div>";
                    }
                    if ($stmt->execute()) {
                        $errorMsg = "<div class='alert alert-success'>" . $numberofupdts . " Produs nou adugat</div>";
                        redirectHome($errorMsg, 'back');
                    } else {
                        $errorMsg = "<div class='alert alert-danger'>" . $numberofupdts . " Produsul nu a fost adaugat</div>";
                        redirectHome($errorMsg, 'back');
                    }
                }
            } else
                echo "<br><div class='alert alert-warning'>Nu poti accesa direct aceasta pagina :( </div>";
        }
    } elseif ($do == 'InsertCat') {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $numeCat = $_POST['numeCat'];

            $formErrors = array();

            if ($numeCat == '') {
                $formErrors[] = '<div class="alert alert-danger">Campul <strong>categorie</strong> nu poate fi gol.</div>';
            }
            foreach ($formErrors as $error) {
                $errorMsg = $error;
                redirectHome($errorMsg, 'back');
            }

            if (empty($formErrors)) {
                $check = checkItem("categorie", "categorii", $numeCat);
                if ($check == 1) {
                    $errorMsg = "<br><div class='alert alert-warning'>Aceasta categorie deja exista ! :( </div>";
                    redirectHome($errorMsg, 'back');
                } else {
                    $stmt = $con->prepare("INSERT INTO categorii(categorie,data_adaugare) VALUES(:numeCat , now())");
                    $stmt->execute(array(
                        ':numeCat' => $numeCat,
                    ));
                    $numberofupdts = $stmt->rowCount();
                    $errorMsg = "<div class='alert alert-success'>" . $numberofupdts . " Categorie noua adugata </div>";
                    redirectHome($errorMsg, 'back');
                }
            }
        } else {
            echo "<br><div class='alert alert-warning'>Nu poti accesa direct aceasta pagina :( </div>";
        }
    } elseif ($do == 'InsertSubcat') {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $numeSubcat = $_POST['numeSubcat'];
            $idCat = $_POST['categorie_post'];
            $formErrors = array();

            if (empty($numeSubcat)) {
                $formErrors[] = '<div class="alert alert-danger">Campul <strong>subcategorie</strong> nu poate fi gol.</div>';
            }
            foreach ($formErrors as $error) {
                $errorMsg = $error;
                redirectHome($errorMsg, 'back');
            }
            if (empty($formErrors)) {
                $check = checkItem("nume_subcategorie", "subcategorii", $numeSubcat);
                if ($check == 1) {
                    $errorMsg = "<br><div class='alert alert-warning'>Aceasta subcategorie deja exista ! :( </div>";
                    redirectHome($errorMsg, 'back');
                } else {
                    $stmt = $con->prepare("INSERT INTO subcategorii(nume_subcategorie,id_categorie,data_adaugare) VALUES(:numeSubcat, :idCat , now())");
                    $stmt->execute(array(
                        ':numeSubcat' => $numeSubcat,
                        ':idCat' => $idCat
                    ));
                    $numberofupdts = $stmt->rowCount();
                    $errorMsg = "<div class='alert alert-success'>" . $numberofupdts . " Sucategorie noua adugata </div>";
                    redirectHome($errorMsg, 'back');
                }
            }
        } else {
            echo "<br><div class='alert alert-warning'>Nu poti accesa direct aceasta pagina :( </div>";
        }
    } elseif ($do == 'Edit') {

    } elseif ($do == 'Update') {

    } elseif ($do == 'DeleteCat') {


        echo "<h1 class=\"display-3\" align=\"center\" style=\"padding: 2.5%\">Sterge categorie</h1>";
        echo "<div class='container'>";
        $catid = isset($_GET['id_categorie']) && is_numeric($_GET['id_categorie']) ? intval($_GET['id_categorie']) : 0;

        $stmt = $con->prepare("SELECT *
                            FROM categorii
                            WHERE id_categorie = '$catid' LIMIT 1");
        $stmt->execute(array($catid));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();

        if ($stmt->rowCount() > 0) {
            $stmt = $con->prepare("DELETE FROM categorii WHERE id_categorie= :catid");
            $stmt->bindParam(":catid", $catid);
            $stmt->execute();
            $errorMsg= "<div class='alert alert-success'>" . $stmt->rowCount() . " Categorie stearsa</div>";
            redirectHome($errorMsg,'back');
        } else {
            $errorMsg = "<div class='alert alert-danger'>" . $stmt->rowCount() . " Aceasta categorie nu exista</div>";
            redirectHome($errorMsg);
        }
        echo "</div>";

    } elseif ($do == 'DeleteSubcat') {

        echo "<h1 class=\"display-3\" align=\"center\" style=\"padding: 2.5%\">Sterge subcategorie</h1>";
        echo "<div class='container'>";
        $subcatid = isset($_GET['id_subcategorie']) && is_numeric($_GET['id_subcategorie']) ? intval($_GET['id_subcategorie']) : 0;

        $stmt = $con->prepare("SELECT *
                            FROM subcategorii
                            WHERE id_subcategorie = '$subcatid' LIMIT 1");
        $stmt->execute(array($subcatid));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();

        if ($stmt->rowCount() > 0) {
            $stmt = $con->prepare("DELETE FROM subcategorii WHERE id_subcategorie= :id_subcategorie");
            $stmt->bindParam(":id_subcategorie", $subcatid);
            $stmt->execute();
            $errorMsg= "<div class='alert alert-success'>" . $stmt->rowCount() . " Subcategorie stearsa</div>";
            redirectHome($errorMsg,'back');
        } else {
            $errorMsg = "<div class='alert alert-danger'>" . $stmt->rowCount() . " Aceasta subcategorie nu exista</div>";
            redirectHome($errorMsg);
        }
        echo "</div>";


    } elseif ($do == 'DeleteProd') {
        echo "<h1 class=\"display-3\" align=\"center\" style=\"padding: 2.5%\">Sterge produs</h1>";
        echo "<div class='container'>";
        $prodid = isset($_GET['id_produs']) && is_numeric($_GET['id_produs']) ? intval($_GET['id_produs']) : 0;

        $stmt = $con->prepare("SELECT *
                            FROM produs
                            WHERE id_produs = '$prodid' LIMIT 1");
        $stmt->execute(array($prodid));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();

        if ($stmt->rowCount() > 0) {
            $stmt = $con->prepare("DELETE FROM produs WHERE id_produs= :id_produs");
            $stmt->bindParam(":id_produs", $prodid);
            $stmt->execute();
            $errorMsg= "<div class='alert alert-success'>" . $stmt->rowCount() . " Produs sters</div>";
            redirectHome($errorMsg,'back');
        } else {
            $errorMsg = "<div class='alert alert-danger'>" . $stmt->rowCount() . " Acest produs nu exista</div>";
            redirectHome($errorMsg);
        }
        echo "</div>";
    }

    include $tpl . 'footer.php';
} else {
    header('Location : index.php');
    exit();
}
ob_end_flush();
?>