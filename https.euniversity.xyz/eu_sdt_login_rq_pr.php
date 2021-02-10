<?php
    //echo isset($_POST['lg_sdt_email']);
    //echo isset($_POST['lg_sdt_pw']);
    //echo isset($_POST['lg_sdt_sbt']);
    
    if(isset($_POST['lg_sdt_email']) && isset($_POST['lg_sdt_pw']) && isset($_POST['lg_sdt_sbt'])){
        echo "Welcome: ".$_POST['lg_sdt_email'];
    /*
        CONNECTING TO THE DATABASE    
    */

        // $dsn : Data Source Name.
        $dsn    = "mysql:dbname=laeugcfb_db_euniversity;host=localhost";

        // $user : DATABASE USER NAME.
        $user   = " laeugcfb@localhost";

        //$pw : DATABASE USER PASSWORD.
        $pw     = "pw_euniversity.xyz";

        try{
            $dbh = new PDO($dsn, $user, $pw);
        }catch(PDOException $e){
            echo 'Connection Failed: '.$e->getMessage();
        }

        

    /* ************************ */
    }
    else{
        header("Location: euniversity.xyz/eu_ui/eu_sdt/eu_sdt_home.php", TRUE, 302);
    }

    var_dump($_POST);

?>