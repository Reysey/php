<?php
//INVOKE THE SESSION VARIABLES
session_start();

// print_r($_SESSION);

//EMPTY THE SESSION VARIABLES
session_unset();


//DESTROY THE SESSION
session_destroy();

// print_r($_SESSION);

//REDIRECT BACK TO HOME

header("Location: https://www.euniversity.xyz/", TRUE, 301);

?>