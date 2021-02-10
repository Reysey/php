<?php
    echo "File Guest";
    /*
        $sql : CONTAINS THE QUERY THAT WILL BE EXECUTED TO COMPARE THE LOGINS INFO IN THE STUDENT TABLE... 
    */
    $sql = "SELECT GUEST_EMAIL, GUEST_PASSWORD, GUEST_NAME 
            FROM EU_GUEST 
            WHERE GUEST_EMAIL ='".$uemail."' AND GUEST_PASSWORD ='".$upw."'";
    
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

?>