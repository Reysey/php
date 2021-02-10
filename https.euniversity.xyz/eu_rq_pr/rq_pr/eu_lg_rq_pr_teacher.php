<?php
    echo "Teacher";
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

?>