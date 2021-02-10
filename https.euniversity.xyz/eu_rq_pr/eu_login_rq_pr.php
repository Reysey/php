<?php
    //GETTING VALUES FROM FORMS
    // GET E-MAIL
    $uemail = strtolower($_POST['lg_email']);
    // GET PASSWORD
    $upw    = $_POST['lg_pw'];
    // GET SUBMIT BUTTON VALUE
    $utbn   = $_POST['lg_sbt'];
    // GET USER TYPE
    $user_type = $_POST['user_type'];

    //CHECK IF ALL VALUES ARE FULL
    if(isset($_POST['lg_email']) && isset($_POST['lg_pw']) && isset($_POST['lg_sbt'])){
        
        //ESTABLISHING CONNEXION WITH THE DATABASE IN ORDER TO START THE VERIFICATIONS
        //INCLUDE CONNEXION
        include 'eu_db/eu_db_connexion.php';


        // START THE VERIFICATION BASED ON THE USER TYPE
        /*
            THE SWITCH WILL COMPARE THE USER TYPE VARIABLE WITH THE TYPES 
            AND WILL INVOKE THE NEEDED CODE.
        */
        
        switch ($user_type) {
            case 'guest':
                require_once ('rq_pr/eu_lg_rq_pr_guest.php');
                break;
            case 'student':
                require_once ('rq_pr/eu_lg_rq_pr_student.php');
                break;
            case 'teacher':
                require_once ('rq_pr/eu_lg_rq_pr_teacher.php');
                break;
            case 'admin':
                require_once ('rq_pr/eu_lg_rq_pr_admin.php');
                break;
            
            default:
                header("Location: https://www.euniversity.xyz", TRUE, 302);
            break;
        }
    }
?>