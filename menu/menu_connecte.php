<html>



<div id="menu">

    <ul class="nav justify-content-end">

    <li class="nav-item">
            <a class="nav-link" href="../profil/profil.php?nomArtist=<?php echo $_SESSION['nomArtist'] ?>"> <?php echo $_SESSION['nomArtist'] ?></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../timeLine/timeLine.php"><i class="material-icons">home</i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../uploads/upload.php"> <i class="material-icons">edit</i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../search/search.php"><i class="material-icons">search</i></a>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                aria-expanded="false"> Manage account</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="../gerer_compte/gerer_compte.php">Profil <i class="fa fa-cog" aria-hidden="true"></i></a>
                <a class="dropdown-item" href="#"></a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Se déconnecter <i class="fa fa-sign-in fa-lg"></i></a>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="../deconnexion/deconnexion.php"><i class="fa fa-sign-out fa-2x"></i> </a>
        </li>


    </ul>
    </nav>
</div>