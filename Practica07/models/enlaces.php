<?php
    class EnlacesPaginas{
        public function enlacesPaginasModel($enlacesModel){
            if($enlacesModel == "login" || 
            $enlacesModel == "alumnos" ||
            $enlacesModel == "maestros" ||
            $enlacesModel == "grupos" ||
            $enlacesModel == "materias" ||
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