<?php
    //echo "Admin File";
    /*
        $sql : CONTAINS THE QUERY THAT WILL BE EXECUTED TO COMPARE THE LOGINS INFO IN THE STUDENT TABLE... 
    */
        $sql = "SELECT ADMIN_ID, ADMIN_EMAIL, ADMIN_PASSWORD, ADMIN_NAME 
            FROM EU_ADMIN 
            WHERE ADMIN_EMAIL ='".$uemail."' AND ADMIN_PASSWORD ='".$upw."'";

        $sess_uname = "";
        $sess_Token = "5WDCpu9ElEdOSiwG0FTp";
        $sess_uid   = "";
        $flag = FALSE;
        foreach($dbh->query($sql) as $row){
            // echo "<hr>";
            // var_dump($row);
            // echo "<hr>";
            // echo strtolower($uemail);
            // echo "<hr>";
            // echo strtolower($row['ADMIN_EMAIL']);
            // echo "<hr>";
            // echo $upw; 
            // echo "<hr>";   
            // echo $row['ADMIN_PASSWORD'];
            // echo "<hr>";   

            if($uemail == strtolower($row['ADMIN_EMAIL'])){
                //echo "E-Mail: Correct.";
                //echo "<hr>";  
                if( $upw == $row['ADMIN_PASSWORD']){
                    // echo "PASSWORD: Correct.";
                    // echo "<hr>";
                    $flag = TRUE;
                    $sess_uname = $row['ADMIN_NAME'];
                    $sess_uid   = $row['ADMIN_ID'];
                    // print_r($row);
                    // die();
                }else{
                    // echo "PASSWORD: InCorrect.";
                    // echo "<hr>";
                }
            }
        }
        //FLAG
        if($flag){
            // echo "Connection Successful";
            // CONNEXION SECCESSFUL STARTING  SESSION
            session_start();
            $_SESSION["sess_name"] = $sess_uname;
            $_SESSION["sess_token"] = $sess_Token;
            $_SESSION["sess_uid"] = $sess_uid;

            // print_r($_SESSION);
            header("Location:https://www.euniversity.xyz/eu_ui/eu_admin/eu_admin_home.php",TRUE,307);
        }else{
            echo "Connection Failed: ";
            echo "This Users Doesn't Exist";
        }
?>