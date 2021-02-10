<?php
    echo "You Are Connected Locally... [".$_SERVER['SERVER_ADDR']."].";
    echo "<hr>";
    echo $_POST['user_type'];
    echo "<hr>";

    //echo isset($_POST['lg_guest_email']);
    //echo isset($_POST['lg_guest_pw']);
    //echo isset($_POST['lg_guest_sbt']);

    $uemail = strtolower($_POST['lg_email']);
    $upw    = $_POST['lg_pw'];
    $utbn   = $_POST['lg_guest_sbt'];
    if(isset($_POST['lg_email']) && isset($_POST['lg_pw']) && isset($_POST['lg_guest_sbt'])){
        echo "Welcome: ".$_POST['lg_email'];
    //INCLUDE CONNEXION
        include 'eu_db_connexion.php';

        /*
            $sql : CONTAINS THE QUERY THAT WILL BE EXECUTED TO COMPARE THE LOGINS INFO IN THE STUDENT TABLE... 
        */
        $sql = "SELECT GUEST_EMAIL, GUEST_PASSWORD, GUEST_NAME 
                FROM EU_GUEST 
                WHERE GUEST_EMAIL ='".$uemail."' AND GUEST_PASSWORD ='".$upw."'";
        // echo "<hr>";
        // echo $sql;
        // echo "<hr>";
        // if($dbh->exec($sql) > 0){
            $flag = FALSE;
            foreach($dbh->query($sql) as $row){
                echo "<hr>";
                echo strtolower($uemail);
                echo "<hr>";
                echo strtolower($row['GUEST_EMAIL']);
                echo "<hr>";
                echo $upw; 
                echo "<hr>";   
                echo $row['GUEST_PASSWORD'];
                echo "<hr>";   

                if($uemail == strtolower($row['GUEST_EMAIL'])){
                    echo "E-Mail: Correct.";
                    echo "<hr>";  
                    if( $upw == $row['GUEST_PASSWORD']){
                        echo "PASSWORD: Correct.";
                        echo "<hr>";
                        $flag = TRUE;
                    }else{
                        echo "PASSWORD: InCorrect.";
                        echo "<hr>";
                    }
                }else{
                    echo "E-Mail: InCorrect.";
                    echo "<hr>";
                }
            }

            //FLAG
                if($flag){
                    echo "Connection Successful";
                }else{
                    echo "<hr>";
                    echo "Connection Failed: ";
                    echo "This Users Doesn't Exist";
                }
        // }else{
        //     echo "This Users Doesn't Exist";
        // }

    /* ************************ */
    }
    else{
        header("Location: https://www.euniversity.xyz/eu_ui/eu_guest/eu_guest_home.php", TRUE, 302);
    }
    echo "<hr>";
    echo "<a href=\"https://www.euniversity.xyz\" class=\"\">Return To Home</a>";
    //var_dump($_POST);

?>