<?php
    session_start();

    $newlab = $_GET['newlab'];

    if($newlab == 'p' || $newlab == 'c' || $newlab == 'b'){
        $_SESSION['lab'] = $newlab;
    }

    if($newlab == 'p'){
        $_SESSION['labname'] = 'Phy';
    }if($newlab == 'c'){
        $_SESSION['labname'] = 'Chem';
    }if($newlab == 'b'){
        $_SESSION['labname'] = 'Bio';
    }
?>