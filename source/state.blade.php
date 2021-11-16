<?php

$state = 'UNKNOWN STATE';

$url = 'https://corona.karlsruhe.de';
$handle = curl_init($url);
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
$html = curl_exec($handle);
curl_close($handle);
libxml_use_internal_errors(true); // Prevent HTML errors from displaying
$doc = new DOMDocument();
$doc->loadHTML($html);
$strong = $doc->getElementsByTagName('strong');
foreach ($strong as $entry) {
    if (in_array($entry->nodeValue, ['Basisstufe', 'Warnstufe', 'Alarmstufe']) ) {
        $state = $entry->nodeValue;
    }
}
$currentDate = new DateTime('Europe/Berlin');
if ($state === 'Basisstufe') {
    $risk = 0;
    $icon = 'fas fa-check';
} else if ($state === 'Warnstufe') {
    $risk = 1;
    $icon = 'fas fa-exclamation-triangle';
} else if ($state === 'Alarmstufe'){
    $risk = 2;
    $icon = 'fas fa-skull-crossbones';
} else {
    $risk = 4;
    $icon = 'fas fa-question-circle';
}
?>

@extends('_layouts.main', ['risk' => $risk])

@section('icon', $icon)

@section('heading', $state)

@section('info', strtr('*Data retrieved from corona.karlsruhe.de at: :dateTime', [':dateTime' => $currentDate->format('Y-m-d H:i:s')]))
