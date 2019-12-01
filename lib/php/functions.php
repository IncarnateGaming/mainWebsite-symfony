<?php

function publicFolder(){
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path = str_replace("\\","/",$path);
    return $path;
}
function loadNav(){
    $public = publicFolder();
    $navPath = str_replace("/public","",$public) . "lib/json/nav.json";
    //var_dump($navPath);
    $navJson = file_get_contents( $navPath);
    $navArray = json_decode($navJson);
    return $navArray;
}
function loadAbout(){
    $public = publicFolder();
    $aboutPath = str_replace("/public","",$public) . "lib/json/about.json";
    //var_dump($navPath);
    $aboutJson = file_get_contents( $aboutPath);
    $aboutArray = json_decode($aboutJson);
    return $aboutArray;
}
function genericParts(){
    $publicFolder = publicFolder();
    $navArray = loadNav();
    $aboutArray = loadAbout();
    return array(
        'publicFolder' => $publicFolder,
        'nav' => $navArray,
        'about' => $aboutArray,
    );
}