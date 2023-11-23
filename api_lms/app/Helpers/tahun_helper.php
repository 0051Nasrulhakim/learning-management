<?php

function tahun($var){
    $tahun = date('Y', strtotime($var));
    return $tahun;
}

?>