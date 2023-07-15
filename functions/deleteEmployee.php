<?php
    include_once('../config/dbcon.php');

    if(isset($_GET["id"]))
    {
        $id=$GET_["id"];
        $req=$db->prepare("DELETE FROM users WHERE id=?");
        $req->execute(array($id));
        if($req)
        {
            echo "Suppression du compte de l'employé";
        }
    }