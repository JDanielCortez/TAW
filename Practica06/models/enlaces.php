<?php
    class EnlacesPaginas{
        public function enlacesPaginasModel($enlacesModel){
            if($enlacesModel == "login" || 
            $enlacesModel == "habitaciones" ||
            $enlacesModel == "clientes" ||
            $enlacesModel == "ganancias" || 
            $enlacesModel == "usuarios" ||
            $enlacesModel == "salir"){
                $module = "views/modules/".$enlacesModel.".php";
            }
            else if($enlacesModel == "index"){
                $module = "views/modules/habitaciones.php";
            }
            else{
                $module = "views/modules/habitaciones.php";
            }

            return $module;
        }
    }
?>