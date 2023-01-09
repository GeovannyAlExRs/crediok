<?php

    require_once "./config/app.php";
    require_once "./package/controller/viewController.php";
    
    $template = new viewController();
    $template -> getTemplateController();