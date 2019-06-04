<?php
    class EnlacesPaginas{
        public function enlacesPaginasModel($enlacesModel){
            if($enlacesModel == "login" || 
            $enlacesModel == "alumnos" ||
            $enlacesModel == "maestros" ||
            $enlacesModel == "grupos" ||
            $enlacesModel == "materias" ||
            $enlacesModel == "tutorias" ||
            $enlacesModel == "registro_tutoria" ||
            $enlacesModel == "editar_tutoria" ||
            $enlacesModel == "salir"){
                $module = "views/modules/".$enlacesModel.".php";
            }
            else if($enlacesModel == "index"){
                $module = "views/modules/alumnos.php";
            }
            else{
                $module = "views/modules/alumnos.php";
            }

            return $module;
        }
    }
?>