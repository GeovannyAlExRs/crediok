<?php

    class viewModel {
        
        /*** [MODEL GET VIEW] ***/
        
        protected static function getViewModel($view) {
            $list = ["home", "client-list", "client-new", "client-search", "client-update", 
                    "company", "item-list", "item-new", "item-search", "item-update", 
                    "reservation-list", "reservation-new", "reservation-pending", 
                    "reservation-reservation", "reservation-search", "reservation-update", 
                    "user-list", "user-new", "user-search", "user-update"];

            if(in_array($view, $list)) {
                if(is_file("./package/view/template/".$view."-view.php")) {
                    $template = "./package/view/template/".$view."-view.php";
                } else {
                    $template = "404";
                }
            } elseif($view == "login" || $view == "index") {
                $template = "login";
            } else {
                $template = "404";
            }
            return $template;
        }
    }