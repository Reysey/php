<?php

    //SESSION START
    session_start();

    // PROFESSION
        $profession     = $_POST['profession'];
    // PROFILE PICTURE {PICTURE/GIF/SHORT-VIDEO}
        $profile_pic    = $_POST['pic_profile'];
    // PROFILE COVER {VIDEO/PHOTO}
        $profile_cover  = $_POST['pic_cover'];
    // IDENTIFICATION
        // $id          = $_POST[''];
    // FIRST NAME
        $first_name     = $_POST['fname'];
    // LAST NAME
        $last_name      = $_POST['lname'];
    // BIRTHDAY
        $birthday       = $_POST['birthday'];
    // NATIONAL ID
        $nid            = $_POST['nid'];
    // PASSWORD
        // $password       = $_POST['pw'];
    // ADDRESS 
        $address        = $_POST['address'];
    // Phone Number
        $phone_number   = $_POST['gsm'];
    // E-MAIL
        $email          = $_POST['email'];

//ESTABLISH CONNEXION WITH THE DATABASE
//INCLUDE CONNEXION
     include $_SERVER['DOCUMENT_ROOT'].'/eu_rq_pr/eu_db/eu_db_connexion.php';
//SET SQL QUERY
        $sql = "UPDATE `eu_admin` SET 
        `ADMIN_EMAIL`       = '$email', 
        `ADMIN_NAME`        = '$first_name $last_name', 
        `ADMIN_GSM`         = '$phone_number', 
        `ADMIN_NID`         = '$nid', 
        `ADMIN_BIRTHDAY`    = '$birthday',
        `ADMIN_ADDRESS`     = '$address'
        WHERE ADMIN_ID =".$_SESSION['sess_uid'];

        // $sql = "UPDATE `eu_admin` SET `ADMIN_NAME` = 'REYSEY'";
    echo "<hr>";
    echo $sql;
    echo "<hr>";
//EXECUTE THE QUERY
        try{

            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->beginTransaction();
            $dbh->exec($sql);
            $dbh->commit();
            
            //Edit SESSION NAME
            $_SESSION["sess_name"] = $_POST['fname']." ".$_POST['lname'];
            header("Location: https://www.euniversity.xyz/eu_ui/eu_admin/eu_admin_profile.php",TRUE, 307);
        }catch(Exception $ex){
            $dbh->rollBack();
            echo "Failed: ".$ex->getMessage();
        }

    echo "<hr>";
    echo "<a href=\"https://www.euniversity.xyz\" class=\"\">Return To Home</a>";
?>