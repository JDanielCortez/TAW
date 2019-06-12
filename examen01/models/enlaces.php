<?php
    class EnlacesPaginas{
        public function enlacesPaginasModel($enlacesModel){
            if($enlacesModel == "proveedores" || 
            $enlacesModel == "contacto" ){
                $module = "views/modules/".$enlacesModel.".php";
            }
            else if($enlacesModel == "index"){
                $module = "views/modules/proveedores.php";
            }
            else{
                $module = "views/modules/proveedores.php";
            }

            return $module;
        }
    }
?>