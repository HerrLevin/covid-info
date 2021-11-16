<?php
$CZapi = 'https://api.corona-zahlen.org/germany';
$currentDate = new DateTime('Europe/Berlin');
// 7-day-incidence
$StateAttributes = json_decode(file_get_contents($CZapi), true);
$count = round($StateAttributes['weekIncidence'], 2);
$rValue = $StateAttributes['r']['value'];


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

@section('icon', 'fas fa-globe-europe')

@section('smallHeading', strtr('R-Value in Germany: :value', [':value' => $rValue]))

@section('heading', '7-day-incidence:')

@section('number', $count)

@section('info', strtr('*Data for Germany retrieved from corona-zahlen.org at: :dateTime', [':dateTime' => $currentDate->format('Y-m-d H:i:s')]))