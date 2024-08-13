<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?= $setting-> nama_web?></title>
    <!-- Favicon icon -->
    <link href="<?= base_url('images/img/' . htmlspecialchars($setting->logo_tab)) ?>" rel="icon">
    <!-- Pignose Calender -->
    <link href="<?= base_url('./plugins/pg-calendar/css/pignose.calendar.min.css')?>" rel="stylesheet">
    <!-- Chartist -->
    <link rel="stylesheet" href="<?= base_url('./plugins/chartist/css/chartist.min.css')?>">
    <link rel="stylesheet" href="<?= base_url('./plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css')?>">
    <!-- Custom Stylesheet -->
    <link href="<?= base_url('css/style.css')?>" rel="stylesheet">

</head>