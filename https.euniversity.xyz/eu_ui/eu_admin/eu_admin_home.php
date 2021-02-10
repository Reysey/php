<?php
    session_start();
    echo "Welcome: ".$_SESSION["sess_name"];
    echo "<hr>";
    echo "Original Referer: ".$_SERVER['HTTP_REFERER'];
    echo "<hr>";
?>

<hr>
    <!-- REDIRECT TO PROFILE PAGE -->
    <a href="https://www.euniversity.xyz/eu_ui/eu_admin/eu_admin_profile.php">Profile Page</a>
<hr>
    <!-- AJOUTER PROFESSEUR -->
    <a href="https://www.euniversity.xyz/eu_ui/eu_admin/eu_admin_services/eu_admin_add_prof.php">AJOUTER PROFESSEUR</a>
<hr>
    <!-- DECONNECTION -->
    <a href="https://www.euniversity.xyz/eu_rq_pr/eu_admin_logout_rq_pr.php">Deconnection</a>