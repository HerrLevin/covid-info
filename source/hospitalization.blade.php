<?php
$state = 'BW';
$CZapi = 'https://api.corona-zahlen.org/states/' . $state;
$currentDate = new DateTime('Europe/Berlin');
// 7-day-incidence
$StateAttributes = json_decode(file_get_contents($CZapi), true)['data'][$state];
$count = round($StateAttributes['hospitalization']['incidence7Days'], 1);
$stateName = $StateAttributes['name'];


if ($count <= 4) {
    $risk = 0;
} else if ($count <= 8) {
    $risk = 1;
} else if ($count <= 12){
    $risk = 2;
} else if ($count <= 15) {
    $risk = 3;
} else {
    $risk = 4;
}
?>

@extends('_layouts.main', ['risk' => $risk])

@section('icon', 'fas fa-hospital-user')

@section('smallHeading', strtr('Hospitalization incidence in :state', [':state' => $stateName]))

@section('heading', '7-day-incidence:')

@section('number', $count)

@section('info', strtr('*Data retrieved from corona-zahlen.org at: :dateTime', [':dateTime' => $currentDate->format('Y-m-d H:i:s')]))