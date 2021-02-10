<?php
    //echo isset($_POST['lg_sdt_email']);
    //echo isset($_POST['lg_sdt_pw']);
    //echo isset($_POST['lg_sdt_sbt']);

    $uemail = strtolower($_POST['lg_sdt_email']);
    $upw    = $_POST['lg_sdt_pw'];
    $utbn   = $_POST['lg_student_sbt'];
    if(isset($_POST['lg_sdt_email']) && isset($_POST['lg_sdt_pw']) && isset($_POST['lg_student_sbt'])){
        echo "Welcome: ".$_POST['lg_sdt_email'];
    //INCLUDE CONNEXION
        include 'eu_db_connexion.php';

        /*
            $sql : CONTAINS THE QUERY THAT WILL BE EXECUTED TO COMPARE THE LOGINS INFO IN THE STUDENT TABLE... 
        */
        $sql = "SELECT SDT_EMAIL, SDT_PASSWORD, SDT_NAME 
                FROM EU_SDT 
                WHERE SDT_EMAIL ='".$uemail."' AND SDT_PASSWORD ='".$upw."'";
        
        // if($dbh->exec($sql) > 0){
            $flag = FALSE;
            foreach($dbh->query($sql) as $row){
                echo "<hr>";
                echo strtolower($uemail);
                echo "<hr>";
                echo strtolower($row['SDT_EMAIL']);
                echo "<hr>";
                echo $upw; 
                echo "<hr>";   
                echo $row['SDT_PASSWORD'];
                echo "<hr>";   

                if($uemail == strtolower($row['SDT_EMAIL'])){
                    echo "E-Mail: Correct.";
                    echo "<hr>";  
                    if( $upw == $row['SDT_PASSWORD']){
                        echo "PASSWORD: Correct.";
                        echo "<hr>";
                        $flag = TRUE;
                        //header("Location: https://www.euniversity.xyz/eu_ui/eu_sdt/eu_sdt_home.php", TRUE, 302);
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
        header("Location: euniversity.xyz/eu_ui/eu_sdt/eu_sdt_home.php", TRUE, 302);
    }
    echo "<hr>";
    echo "<a href=\"https://www.euniversity.xyz\" class=\"\">Return To Home</a>";
    //var_dump($_POST);

?>