<?php

    session_start();

    // echo "<hr>";
    // print_r($_SESSION);
    // echo "<hr>";

    //SQL QUERY TO RETRIEVE DATA.
    $sql = "SELECT `ADMIN_ID`, `ADMIN_EMAIL`, `ADMIN_NAME`, `ADMIN_PASSWORD`, `ADMIN_GSM`, `ADMIN_NID`, `ADMIN_BIRTHDAY`, `ADMIN_ADDRESS` 
    FROM `eu_admin`
    WHERE ADMIN_ID =".$_SESSION['sess_uid'];

    //ESTABLISHING CONNECTION TO THE DATABASE
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


    $rs = $dbh->query($sql, PDO::FETCH_ASSOC);
    // echo "<hr>";
    // print_r($rs); 
    // echo "<hr>";
    $row = $rs->fetch(PDO::FETCH_ASSOC);
    // echo "<hr>";
    // var_dump($row); 
    // echo "<hr>";
    // echo "<hr>";

    



    // PROFESSION
        // $profession     = $row[];
    // PROFILE PICTURE {PICTURE/GIF/SHORT-VIDEO}
        // $profile_pic    = $row['ADMIN_PROFILE_PIC'];
    // PROFILE COVER {VIDEO/PHOTO}
        // $profile_cover  = $row['ADMIN_PROFILE_COVER'];
    // IDENTIFICATION
        $id             = $row['ADMIN_ID'];
    // FIRST NAME
        // $first_name     = $row['ADMIN_FIRST_NAME'];
    // LAST NAME
        // $last_name      = $row['ADMIN_LAST_NAME'];
    // BIRTHDAY
        $birthday       = $row['ADMIN_BIRTHDAY'];
    // PASSWORD
        // $password       = "*************";
    // ADDRESS 
        $address        = $row['ADMIN_ADDRESS'];
    // Phone Number
        $phone_number   = $row['ADMIN_GSM'];
    // E-MAIL
        $email          = $row['ADMIN_EMAIL'];
    
    //QUERY TO SEND THE DATA TO THE DATABASE
    
?>

    <!-- // PROFESSION -->
        <label for="">PROFESSION</label>
        <input type="text" name="profession" id="" value="<?php echo "ADMINISTRATOR";?>" DISABLED>
        <hr>
    <!-- // PROFILE PICTURE {PICTURE/GIF/SHORT-VIDEO} -->
        <label for="">PROFILE PICTURE</label>
        <input type="text" name="pic_profile" id="" value="<?php //echo $row['ADMIN_PROFILE_PIC'];?>" DISABLED>
        <hr>
    <!-- // PROFILE COVER {VIDEO/PHOTO} -->
        <label for="">PROFILE COVER</label>
        <input type="text" name="pic_cover" id="" value="<?php //echo $row['ADMIN_PROFILE_COVER'];?>" DISABLED>
        <hr>
    <!-- // IDENTIFICATION -->
        <label for="">IDENTIFICATION</label>
        <input type="text" name="id" id="" value="<?php echo $row['ADMIN_ID'];?>" DISABLED>
        <hr>
    <!-- // FIRST NAME -->
        <label for="">FIRST NAME</label>
        <input type="text" name="fname" id="" value="<?php //echo $row['ADMIN_FIRST_NAME'];?>" DISABLED>
        <hr>
    <!-- // LAST NAME -->
        <label for="">LAST NAME</label>
        <input type="text" name="lname" id="" value="<?php //echo $row['ADMIN_LAST_NAME'];?>" DISABLED>
        <hr>
    <!-- // BIRTHDAY -->
        <label for="">BIRTHDAY</label>
        <input type="text" name="birthday" id="" value="<?php //echo $row['ADMIN_BIRTHDAY'];?>" DISABLED>
        <hr>
    <!-- // ADDRESS  -->
        <label for="">ADDRESS</label>
        <input type="text" name="address" id="" value="<?php echo $row['ADMIN_ADDRESS'];?>" DISABLED>
        <hr>
    <!-- // Phone Number -->
        <label for="">Phone Number</label>
        <input type="text" name="gsm" id="" value="<?php echo $row['ADMIN_GSM'];?>" DISABLED>
        <hr>
    <!-- // E-MAIL -->
        <label for="">E-MAIL</label>
        <input type="text" name="email" id="" value="<?php echo $row['ADMIN_EMAIL'];?>" DISABLED>
        <hr>
    <!-- // PASSWORD -->
        <label for="">PASSWORD</label>
        <input type="text" name="password" id="" value="***************" DISABLED>
        <hr>

    <!-- MODIFY -->
    <a href="https://www.euniversity.xyz/eu_ui/eu_admin/eu_admin_modify.php">Modify</a>

    <!-- BACK TO HOME -->
    <a href="https://www.euniversity.xyz/eu_ui/eu_admin/eu_admin_home.php">Back To Home</a>