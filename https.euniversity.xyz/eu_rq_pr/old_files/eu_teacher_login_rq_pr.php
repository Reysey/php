<?php
    echo "You Are Connected Locally... [".$_SERVER['SERVER_ADDR']."].";
    echo "<hr>";
    //echo isset($_POST['lg_teacher_email']);
    //echo isset($_POST['lg_teacher_pw']);
    //echo isset($_POST['lg_teacher_sbt']);

    $uemail = strtolower($_POST['lg_email']);
    $upw    = $_POST['lg_pw'];
    $utbn   = $_POST['lg_teacher_sbt'];
    if(isset($_POST['lg_email']) && isset($_POST['lg_pw']) && isset($_POST['lg_teacher_sbt'])){
        echo "Welcome: ".$_POST['lg_email'];
    
        //INCLUDE CONNEXION
        include 'eu_db_connexion.php';

        /*
            $sql : CONTAINS THE QUERY THAT WILL BE EXECUTED TO COMPARE THE LOGINS INFO IN THE STUDENT TABLE... 
        */
        $sql = "SELECT TEACHER_EMAIL, TEACHER_PASSWORD, TEACHER_NAME 
        FROM EU_TEACHER
        WHERE TEACHER_EMAIL ='".$uemail."' AND TEACHER_PASSWORD ='".$upw."'";
        
        // if($dbh->exec($sql) > 0){
            $flag = FALSE;
            foreach($dbh->query($sql) as $row){
                echo "<hr>";
                echo strtolower($uemail);
                echo "<hr>";
                echo strtolower($row['TEACHER_EMAIL']);
                echo "<hr>";
                echo $upw; 
                echo "<hr>";   
                echo $row['TEACHER_PASSWORD'];
                echo "<hr>";   

                if($uemail == strtolower($row['TEACHER_EMAIL'])){
                    echo "E-Mail: Correct.";
                    echo "<hr>";  
                    if( $upw == $row['TEACHER_PASSWORD']){
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
        header("Location: https://www.euniversity.xyz/eu_ui/eu_teacher/eu_teacher_home.php", TRUE, 302);
    }

    echo "<hr>";
    echo "<a href=\"https://www.euniversity.xyz\" class=\"\">Return To Home</a>";
    //var_dump($_POST);

?>