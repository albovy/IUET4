<?php

include '../Functions/Authentication.php';
include '../Views/Login_View.php';


if(!$_POST){
    new Login();
}   