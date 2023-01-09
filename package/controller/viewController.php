<?php
    require_once "./package/model/viewModel.php";

    class viewController extends viewModel {

        /*** [CONTROLLER GET TEMPLATE] ***/
        public function getTemplateController() {
            return require_once "./package/view/template.php";
        }

        /*** [CONTROLLER GET VIEW] ***/
        public function getViewController() {
            if(isset($_GET["views"])) {
                $ruta = explode("/", $_GET["views"]);
                $request = viewModel::getViewModel($ruta[0]);
            } else {
                $request = "login";
            }
            return $request;
        }
    }