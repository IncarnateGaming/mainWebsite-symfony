<?php

function publicFolder(){
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path = str_replace("\\","/",$path);
    return $path;
}
function loadNav(){
    $public = publicFolder();
    $navPath = str_replace("/public","",$public);
    if (substr($navPath,-1)!=='/'){
        $navPath .= '/';
    }
    $navPath .= 'lib/json/nav.json';
    $navJson = file_get_contents( $navPath);
    $navArray = json_decode($navJson);
    return $navArray;
}
function loadAbout(){
    $public = publicFolder();
    $aboutPath = str_replace("/public","",$public) . "lib/json/about.json";
    $aboutJson = file_get_contents( $aboutPath);
    $aboutArray = json_decode($aboutJson);
    return $aboutArray;
}
function findMobile(){
    $public = publicFolder();
    $mobilePath = str_replace("/public","",$public) . "vendor/mobiledetect/mobiledetectlib/Mobile_Detect.php";
    require_once $mobilePath;
    $detect = new Mobile_Detect;
    $isMobile = $detect->isMobile();
    $isTablet = $detect->isTablet();
    $mobileArray = array(
        'mobile' => $isMobile,
        'tablet' => $isTablet,
    );
    return $mobileArray;
}
function genericParts(){
    $publicFolder = publicFolder();
    $navArray = loadNav();
    $aboutArray = loadAbout();
    $mobileArray = findMobile();
    $url = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    return array(
        'publicFolder' => $publicFolder,
        'nav' => $navArray,
        'about' => $aboutArray,
        'mobileArray' => $mobileArray,
        'url'=>$url,
        'host'=>$_SERVER['SERVER_NAME'],
    );
}
function findInRepository(string $slug, $repository){
//    if(false !== strpos($slug,'#')){
//        $slug = substr($slug,0,16);
//    }
    $result=null;
    if(is_numeric($slug)){
        $result = $repository->find(intval($slug));
    }
    if (!$result && strlen($slug)==16){
        $result = $repository->findOneBy(['fid'=>$slug]);
    }
    if (!$result){
        $result = $repository->findOneBy(['name'=>str_replace('-',' ',$slug)]);
    }
    return $result;
}