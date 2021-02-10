<?php
    // `TEACHER_ID`
        // ID IS GENERATED AUTO-MATICALLY
    // `TEACHER_EMAIL`
        $email = $_POST['email'];
    // `TEACHER_NAME`
        $name  = $_POST['name'];
    // `TEACHER_PASSWORD`
        $pw    = $_POST['pw'];
    // `TEACHER_GSM`
        $gsm   = $_POST['gsm']; 
    // `TEACHER_NID`
        $nid   = $_POST['nid'];

//ESTABLISH CONNEXION WITH THE DATABASE
//INCLUDE CONNEXION
    include $_SERVER['DOCUMENT_ROOT'].'/eu_rq_pr/eu_db/eu_db_connexion.php';

//SET SQL QUERY
        $sql = "INSERT INTO `eu_teacher`(`TEACHER_ID`,
                                         `TEACHER_EMAIL`,
                                         `TEACHER_NAME`,
                                         `TEACHER_PASSWORD`,
                                         `TEACHER_GSM`,
                                         `TEACHER_NID`) 
                VALUES (NULL,
                        '$email',
                        '$name',
                        '$pw',
                        '$gsm',
                        '$nid')";
    echo "<hr>";
    echo $sql;
    
//EXECUTE THE QUERY
        try{
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->beginTransaction();
            $dbh->exec($sql);
            $dbh->commit();
            header("Location: https://www.euniversity.xyz/eu_ui/eu_admin/eu_admin_home.php");
        }catch(Exception $ex){
            $dbh->rollBack();
            echo "Failed: ".$ex->getMessage();
        }

    echo "<hr>";
    echo "<a href=\"https://www.euniversity.xyz\" class=\"\">Return To Home</a>";
?>