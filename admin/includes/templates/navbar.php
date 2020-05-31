<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
    <a class="navbar-brand" href="dashboard.php"><i class="fa fa-user" ></i> <?php echo lang('HOME_ADMIN') ?></a>
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="dashboard.php"><i class="fa fa-home" aria-hidden="true"></i> <?php echo lang('HOME') ?> <span class="sr-only">(current)</span></a>
      </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-tag" aria-hidden="true"></i> Produse
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="products.php?do=AddProd"><i class="fa fa-plus" aria-hidden="true"></i> Adauga produs</a>
                <a class="dropdown-item" href="products.php?do=AddCat"><i class="fa fa-plus" aria-hidden="true"></i> Adauga categorie</a>
                <a class="dropdown-item" href="products.php?do=AddSubcat"><i class="fa fa-plus" aria-hidden="true"></i> Adauga subcategorie</a>
                <a class="dropdown-item" href="products.php"><i class="fa fa-eye" aria-hidden="true"></i> Detalii categorii, subcategeorii, produse</a>
            </div>
        </li>
<!--      <li class="nav-item">-->
<!--        <a class="nav-link" href="products.php?do=Add"><i class="fa fa-bars" aria-hidden="true"></i> --><?php //echo lang('PRODUCTS') ?><!--</a>-->
<!--      </li>-->
      <li class="nav-item">
        <a class="nav-link" href="members.php?do=Manage"><i class="fa fa-users" aria-hidden="true"></i> <?php echo lang('MEMBERS') ?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="members.php?do=Edit&id_user=<?php echo $_SESSION['ID'] ?>"><i class="fa fa-pencil" aria-hidden="true"></i> <?php echo lang('EDIT_PROFILE') ?></a>
        
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"><i class="fa fa-bars" aria-hidden="true"></i> <?php echo lang('LOGS')?></a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" action="logout.php">
      <button class="btn btn-outline-danger my-2 my-sm-0" type="submit"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</button>
    </form>
  </div>
</nav>