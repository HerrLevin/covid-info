<?php
$DIVI = "https://www.intensivregister.de/api/public/reporting/laendertabelle";
$currentDate = new DateTime('Europe/Berlin');
// 7-day-incidence
$DIVIAttributes = json_decode(file_get_contents($DIVI), true)['data'];

$key = array_search('BADEN_WUERTTEMBERG', array_column($DIVIAttributes, 'bundesland'));
$federalState = $DIVIAttributes[$key];
$count = $federalState['faelleCovidAktuell'];
$bedsFree = $federalState['intensivBettenFrei'];
if ($count < 100) {
    $risk = 0;
} else if ($count <= 250) {
    $risk = 1;
} else if ($count <= 390){
    $risk = 2;
} else if ($federalState['covidKapazitaetFrei'] > 50) {
    $risk = 3;
} else {
    $risk = 4;
}
?>

@extends('_layouts.main', ['risk' => $risk])

@section('icon', 'fas fa-procedures')

@section('smallHeading', strtr('ICU beds free: :count', [':count' => $bedsFree]))

@section('heading', 'Covid ICU beds used:')

@section('number', $count)

@section('info', strtr('*Data retrieved from DIVI at: :dateTime (:state)', [':dateTime' => $currentDate->format('Y-m-d H:i:s'), ':state' => $federalState['bundesland']]))
