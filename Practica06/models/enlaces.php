<?php
    class EnlacesPaginas{
        public function enlacesPaginasModel($enlacesModel){
            if($enlacesModel == "productos" || 
            $enlacesModel == "ventas" ||
            $enlacesModel == "usuarios" ||
            $enlacesModel == "productos" || 
            $enlacesModel == "registrarUsuario" ||
            $enlacesModel == "salir"){
                $module = "views/modules/".$enlacesModel.".php";
            }
            else if($enlacesModel == "index"){
                $module = "views/modules/inicio.php";
            }
            else{
                $module = "views/modules/inicio.php";
            }

            return $module;
        }
    }
?>