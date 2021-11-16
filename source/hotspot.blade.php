<?php
$RKI = "https://services7.arcgis.com/mOBPykOjAyBO2ZKk/arcgis/rest/services/RKI_Landkreisdaten/FeatureServer/0/query?outFields=OBJECTID,cases7_per_100k,GEN&geometryType=esriGeometryPoint&spatialRel=esriSpatialRelWithin&inSR=4326&outSR=4326&f=json&geometry=8.4034195,49.0068705";
$currentDate = new DateTime('Europe/Berlin');
// 7-day-incidence
$RKIAttributes = json_decode(file_get_contents($RKI), true)['features'][0]['attributes'];
$count = round($RKIAttributes['cases7_per_100k'], 2);
$city = $RKIAttributes['GEN'];

if ($count < 35) {
    $risk = 0;
} else if ($count < 50) {
    $risk = 1;
} else if ($count < 100){
    $risk = 2;
} else if ($count < 400) {
    $risk = 3;
} else {
    $risk = 4;
}
?>

@extends('_layouts.main', ['risk' => $risk])

@section('icon', 'fas fa-viruses')

@section('smallHeading', strtr(':city is a Covid-19 Hotspot!', [':city' => $city]))

@section('heading', '7-day-incidence:')

@section('number', $count)

@section('info', strtr('*Data retrieved from RKI at: :dateTime', [':dateTime' => $currentDate->format('Y-m-d H:i:s')]))