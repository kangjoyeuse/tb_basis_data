<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

function check_access($required_level) {
    if ($_SESSION['level'] != $required_level) {
        header("Location: index.php");
        exit;
    }
}
?>