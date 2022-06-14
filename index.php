<?php

require "core/controler.php";

try {
    $page = isset($_GET['page']) ? $_GET['page'] : "dashboard";
    if (isset($page) && !isset($_GET['q'])) {
        switch ($page) {
            case '':
            case 'dashboard': 
                dashboard(); break;
            case 'consultation':
                if(isset($_GET['add'])) form();
                else consultation();
                    break;
            case "medecin":
                if(isset($_GET['add']) || isset($_GET['update'])) form();
                else if(isset($_GET['show'])) show();
                else medecin();
                break;
            case "patient": 
                if(isset($_GET['add']) || isset($_GET['update'])) form();
                else if(isset($_GET['show'])) show();
                else patient();
                break;
            default: throw new Exception("Cette Page N'Existe pas !!!");
        }
    } else {
        if(isset($_GET['q']))
            search();
        else
            dashboard();
    }
} catch (Exception $th) {
    error($th->getMessage());
}
