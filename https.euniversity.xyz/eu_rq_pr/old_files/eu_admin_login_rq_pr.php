<?php
    echo "You Are Connected Locally... [".$_SERVER['SERVER_ADDR']."].";
    echo "<hr>";
    //echo isset($_POST['lg_admin_email']);
    //echo isset($_POST['lg_admin_pw']);
    //echo isset($_POST['lg_admin_sbt']);

    $uemail = strtolower($_POST['lg_email']);
    $upw    = $_POST['lg_pw'];
    $utbn   = $_POST['lg_admin_sbt'];
    $user_type = $_POST['user_type'];
    if(isset($_POST['lg_email']) && isset($_POST['lg_pw']) && isset($_POST['lg_admin_sbt'])){
        echo "Welcome: ".$_POST['lg_email'];
    
        //INCLUDE CONNEXION
        include 'eu_db_connexion.php';

        // echo $sql;
        // echo "<hr>";
        // $execResult = $dbh->exec($sql);
        // echo $execResult;
        // if($execResult == 0){

        //SWITCH
        switch ($user_type) {
            case 'guest':
                include '';
                break;
            case 'student':
                include '';
                break;
            case 'teacher':
                include '';
                break;
            case 'admin':
                include '';
                break;
            
            default:
                header("Location: https://www.euniversity.xyz", TRUE, 302);
            break;
        }

        /*
            $sql : CONTAINS THE QUERY THAT WILL BE EXECUTED TO COMPARE THE LOGINS INFO IN THE STUDENT TABLE... 
        */
            $sql = "SELECT ADMIN_EMAIL, ADMIN_PASSWORD, ADMIN_NAME 
                FROM EU_ADMIN 
                WHERE ADMIN_EMAIL ='".$uemail."' AND ADMIN_PASSWORD ='".$upw."'";

            $flag = FALSE;
            foreach($dbh->query($sql) as $row){
                echo "<hr>";
                var_dump($row);
                echo "<hr>";
                echo strtolower($uemail);
                echo "<hr>";
                echo strtolower($row['ADMIN_EMAIL']);
                echo "<hr>";
                echo $upw; 
                echo "<hr>";   
                echo $row['ADMIN_PASSWORD'];
                echo "<hr>";   

                if($uemail == strtolower($row['ADMIN_EMAIL'])){
                    echo "E-Mail: Correct.";
                    echo "<hr>";  
                    if( $upw == $row['ADMIN_PASSWORD']){
                        echo "PASSWORD: Correct.";
                        echo "<hr>";
                        $flag = TRUE;
                    }else{
                        echo "PASSWORD: InCorrect.";
                        echo "<hr>";
                    }
                }
            }
            //FLAG
            if($flag){
                echo "Connection Successful";
            }else{
                echo "Connection Failed: ";
                echo "This Users Doesn't Exist";
            }
        // }else{
        //     echo "This Users Doesn't Exist";
        // }
        

    /* ************************ */
    }
    else{
        header("Location: https://www.euniversity.xyz/eu_ui/eu_admin/eu_admin_home.php", TRUE, 302);
    }
    echo "<hr>";
    echo "<a href=\"https://www.euniversity.xyz\" class=\"\">Return To Home</a>";
    //var_dump($_POST);

?>