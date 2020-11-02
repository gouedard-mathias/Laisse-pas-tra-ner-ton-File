<?php
if (file_exists($_POST['name'])){
    unlink($_POST['name']);
    header('Location: index.php');
}
