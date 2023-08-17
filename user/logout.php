<?php
    session_start();
    session_destroy();
    echo "<script>location.replace('../loginRegister.php');</script>";
?>