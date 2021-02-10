<?php
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
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //$dbh->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);
    }catch(PDOException $e){
        echo 'Connection Failed: '.$e->getMessage();
    }
?>