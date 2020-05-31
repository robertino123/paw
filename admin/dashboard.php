<?php
ob_start();
session_start();

if(isset($_SESSION['nume'])){
    $pageTitle='Dashboard';
    include 'init.php';

    ?>
<!--Start dashboard -->
    <div class="home-stats">
        <div class="container text-center">
            <h1 class="display-3" align="center" style="padding: 2.5%; margin-top: -60; ">Dashboard</h1>
            <div class="row">
                <div class="col-md-3">
                    <div class="stat st">
                        <i class="fa fa-user" aria-hidden="true" style="height: 30px; width: 30px"></i>
                        <div class="info">
                        Total useri
                        <span><?php echo countItems('id_user','user') ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat stt">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                        <div class="info">
                            Total categorii
                        <span><?php echo countItems('id_categorie','categorii') ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat stttt">
                        <i class="fa fa-tag" aria-hidden="true"></i>
                        <div class="info">
                            Total produse
                        <span><?php echo countItems('id_produs','produs') ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3" >
                    <div class="stat sttt">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        <div class="info">
                            Total comenzi
                            <span><?php echo countItems('id_subcategorie','subcategorii') ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="latest">
        <div class="container" style="margin-top: -40">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fa fa-users"></i> Ultimii useri inregistrati</h5>
                            <div class="panel-body">
                                <ul class="list-unstyled latest-users">
                            <?php
                            $latestUsers =  getLatest("*","user",'data_inregistrare',3);
                            foreach ($latestUsers as $user){
                                echo '<li>'. $user['nume']," ",$user['prenume'].'<span class="btn btn-success pull-right"><i class="fa fa-edit"></i> <a href="members.php?do=Edit&id_user='.$user['id_user'].'" style="text-decoration: none; color: white">Editeaza</a></span></li>';
                            }
                            ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fa fa-users"></i> Ultimele produse adaugate</h5>
                            <div class="panel-body">
                                <ul class="list-unstyled latest-users">
                                    <?php
                                    $latestUsers =  getLatest("*","produs",'data_adaugare',3);
                                    foreach ($latestUsers as $user){
                                        echo '<li>'. $user['nume_produs']," ","<strong>".$user['pret'].' lei</strong><span class="btn btn-success pull-right"><i class="fa fa-edit"></i> <a href="#" style="text-decoration: none; color: white">Editeaza</a></span></li>';
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Sfatsit dashboard   -->

<?php
    include $tpl.'footer.php';
} else {
    header('Location: index.php');
    exit();
}

ob_end_flush();