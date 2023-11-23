<?php

    function tahun($var){
        $tahun = date('Y', strtotime($var));
        return $tahun;
    }

    function semester($var){
        if($var == 1){
            return $var = $var . " ( Ganjil )";
        }else{
            return $var = $var . " ( Genap )";
        }
    }

?>