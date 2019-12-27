<?php
    require_once 'checksession.php';

    $newlab = $_GET['labname'];

    if($newlab == 'p' || $newlab == 'c' || $newlab == 'b'){
        $_SESSION['lab'] = $newlab;
    }

    if($newlab == 'p'){
        $_SESSION['labname'] = 'Phy';
    } if($newlab == 'c'){
        $_SESSION['labname'] = 'Chem';
    } if($newlab == 'b'){
        $_SESSION['labname'] = 'Bio';
    }

    echo '<script>window.history.back();</script>';
?>