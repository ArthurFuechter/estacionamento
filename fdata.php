<?php

function datatimeFormat($data){
    $dia = date("d/m/Y",strtotime($data));
    $hora = date("H:i:s",strtotime($data));
    $diaehora = "<small>".$dia."</small> <b>".$hora."</b>";
    return $diaehora;
}

function dataDB($data){
    return date('Y/m/d H:i:s', strtotime($data));
}

function dataFormat($data){
    return date("d/m/Y",strtotime($data));
}
?>