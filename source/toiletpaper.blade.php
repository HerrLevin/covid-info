<?php

$city = "Karlsruhe";
$headings = ['There is enough toilet paper in :city', 'Toilet paper in :city is running out!', 'Toilet paper in :city is short in supply!'];
$products = [28171, 127048, 137425, 452740, 452744, 452753, 485695, 485698, 504606, 524535, 525943, 535981, 593761, 594080, 595420, 610544, 708997, 709006, 799358, 842480, 846857, 853483, 863567, 879536];;
$stores = [1017, 1096, 1117, 1507, 152, 1538, 185, 1963, 2063, 2696, 275, 2825, 2831, 292, 331, 333, 445, 518, 915];
$DmUrl = strtr('https://products.dm.de/store-availability/DE/availability?dans=:products&storeNumbers=:stores', [
    ':products' => implode(',', $products),
    ':stores'   => implode(',', $stores)
]);

$currentDate = new DateTime('Europe/Berlin');
$count = 0;
$DmAttributes = json_decode(file_get_contents($DmUrl), true)['storeAvailabilities'];
foreach ($DmAttributes as $store) {
    foreach ($store as $product) {
        $count += $product['stockLevel'];
    }
}

if ($count < 480) {
    $risk = 3;
    $heading = $headings[2];
} else if ($count < 2000) {
    $risk = 2;
    $heading = $headings[2];
} else if ($count < 4000) {
    $risk = 1;
    $heading = $headings[3];
} else {
    $risk = 0;
    $heading = $headings[0];
}
?>

@extends('_layouts.main', ['risk' => $risk])

@section('icon', 'fas fa-toilet-paper')

@section('smallHeading', strtr($heading, [':city' => $city]))

@section('heading', 'Packs toilet paper:')

@section('number', $count)

@section('info', strtr('*Data retrieved from DM for 16 stores in Karlsruhe at: :dateTime', [':dateTime' => $currentDate->format('Y-m-d H:i:s')]))