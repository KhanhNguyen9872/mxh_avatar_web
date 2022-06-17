<?php

/*
 * Author: djdungcuty
 * File Name: func.ua.php
 * Project: NNM
 * Website: http://nhanhnao.mobi
 */

function ua() {
    $agent = $_SERVER["HTTP_USER_AGENT"];
    if (preg_match('|NK([^\s\;\-\_\/\(\)]*)|', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|Nokia-([^\s\;\_\/\(\)\.]*)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|Nokia(\/)?([^\;\-\_\/\(\)\.]*)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|Nokia(\s)?([^\s\;\-\_\/\(\)\.]*)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|Aspen Simulator([^\;]*)|i', $agent, $match) && preg_match("|Aspen (\d{1})|", $agent, $match)) {
        return "Aspen Simulator " . $match[1];
    } else
    if (preg_match('|iPhone Simulator([^\;]*)|i', $agent, $match) && preg_match("|iPhone OS (\d{1})|", $agent, $match)) {
        return "iPhone Simulator " . $match[1];
    } else
    if (preg_match('|iPod([^\;]*)|i', $agent, $match) && preg_match("|iPhone OS (\d{1})|", $agent, $match)) {
        return "iPod " . $match[1];
    } else
    if (preg_match('|iPad([^\;]*)|i', $agent, $match) && preg_match("|CPU OS (\d{1})|", $agent, $match)) {
        return "iPad " . $match[1];
    } else
    if (preg_match("|iPhone OS ([^\_\/]*)|i", $agent, $match) or preg_match("|CPU OS (\d{1})|", $agent, $match)) {
        return "iPhone " . $match[1];
    } else
    if (preg_match('|BlackBerry(\s)?([^\;\/]+)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|SonyEricsson(\s)?([^\s\_\/]*)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|Ericsson([^\/\(\)]+)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|(Galaxy\s)?Nexus\s([^\Build]*)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|SoftBank/1.0/([^\s\/]+)|i', $agent, $match)) {
        return "SoftBank/" . $match[1];
    } else
    if (preg_match('|SAMSUNG(\s)?([^\s\;\_\/]+)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|SAM([^\s\/]+)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|SEC([^\s\/]+)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|SCH([^\s\/]+)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|SGH([^\s\/]+)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|SPH([^\s\/]+)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|GT-([^\s\-\/]+)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|HTC(\s)?([^\s\/\\\]*)|i', $agent, $match)) {
        return str_replace(array("-", "_"), " ", $match[0]);
    } else
    if (preg_match('|MOT-([^\s\;\_\/\.]+)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|Motor([^\;\_\/\.\(\)]+)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|LG(\/)?([^\s\/]*)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|SAGEM([^\s\/]+)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|SG([^\s\;\/\(\)]+)|', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|PHILIPS(\s)?([^\s\_\/]*)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|SHARP([^\s\/]+)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|SIE([^\s\/]+)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|Alcatel(\s)?([^\s\/]*)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|Panasonic(\s)?([^\s\/]*)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|Dopod(\s)?([^\_\/\Build]*)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|CHT([^\/]+)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|SPV(\s)?([^\s\;\/]*)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|NEC(\s)?([^\s\/]+)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|ASUS(\s)?([^\s\-\/]*)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|Toshiba(\s)?([^\_\/]*)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|BenQ(\s)?([^\s\/]+)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|Palm-([^\s\/\;\(\)]*)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|Palm(\s)?([^\s\/\(\)]*)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|Qtek([^\-\/]*)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|Amoi([^\/]*)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|Telit([^\/]*)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|Sendo([^\/]*)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|MobilePhone ([^\s\;\/]*)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|Sanyo(\s)?([^\s\;\/]*)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|Huawei/1.0/([^\s\/]*)|i', $agent, $match)) {
        return "Huawei " . $match[1];
    } else
    if (preg_match('|Huawe(\s)?([^\/]*)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|Nexian([^\s\/]*)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|Pantech(\s)?([^\s\/]*)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|i-mobile(\s)?([^\,\/]*)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|Micromax(\s)?([^\s\-\/]*)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|Cricket([^\s\/]*)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|Fly(\s)?([^\s\/]*)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|TIANYU(\s)?([^\s]*)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|AUDIOVOX(\s)?([^\s\/]*)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|CDM(\-)?([^\s\/]*)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|LENOVO([^\s\/]+)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|OPPO(\s)?([^\s\/]*)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|SPICE(\s)?([^\s\/]*)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|Meizu(\s)?([^\;\-\/\Build]*)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|CometBird/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|Bird(\s)?([^\/]*)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|INN([^\s\/]+)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|KWC([^\s\/]+)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|LCT(\_)?([^\s\_\/]*)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|TCL(\_)?([^\s\_\/]*)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|TSM([^\s\/]+)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|Xda(\_)?([^\;\/]*)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|ZTE(\-)?([^\s\-\/\(\)]*)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|RT([^\s\/]+)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|O2([^\s\/]+)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|KDDI-([^\s]+)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Kindle(\s)?([^\s]+)|i", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|RIM Tablet([^\s]+)|i', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|PlayStation BB Navigator (\d{1,2}\.\d)|i", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|PlayStation Portable|i", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|PlayStation(\s)?(\d{1})|i", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Tablet Browser (\d{1,2}\.\d)|i", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Maemo Browser (\d{1,2}\.\d)|i", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|UC Browser(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|UCWEB(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Puffin/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Opera Mini(/)?([0-9\.]{0,3})|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Opera Mobi/([a-z0-9\-]{1,5})|i", $agent, $match) && preg_match("|Version/(\d{1,2}\.\d)|", $agent, $match)) {
        return str_replace("Version/", "Opera Mobile/", $match[0]);
    } else
    if (preg_match("|Opera Mobi/([a-z0-9]{1,3})|i", $agent, $match)) {
        return "Opera Mobile";
    } else
    if (preg_match("|Skyfire/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Bolt/(\d{1,2}\.\d)|i", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|jB5/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|TeaShark/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|SoftBank/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|NetFront/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|IEMobile(/)?(\s)?(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|MobileExplorer/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Mobile Safari(\s)?(/)?(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|uZardWeb/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Iris/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Dolfin/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Minimo/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Fennec/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Blazer (\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|portalmmm/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|MiniBrowser/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Internet Channel/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Wii ([a-z]+) Channel/(\d{1,2}\.\d)|i", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Nintendo Wii|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|TencentTraveler ([0-9\.]{0,3})|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Google Wireless Transcoder|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Netscape(/)?([0-9\.]{1,3})|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Navigator/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|SeaMonkey/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Firebird/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Blackbird/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|BlackHawk/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Cheshire/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Deepnet Explorer (\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Flock/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Orca/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|OmniWeb/(v)?(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Epiphany/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|MultiZilla v(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Multi-Browser (\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|UltraBrowser (\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Comodo_Dragon/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|QQBrowser/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Maxthon(/)?(\s)?([0-9\.]{0,3})|i", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|RockMelt/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Chrome/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Sleipnir/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Lunascape (\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Avant Browser|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|SlimBrowser|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Opera/(\d{1,2}\.\d)|", $agent, $match) && preg_match("|Version/(\d{1,2}\.\d)|", $agent, $match)) {
        return str_replace("Version/", "Opera ", $match[0]);
    } else
    if (preg_match("|Opera(/)?(\s)?(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Epic/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Firefox/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Ninesky-android-mobile/(\d{1,2}\.\d)|", $agent, $match)) {
        return "Ninesky/" . $match[1];
    } else
    if (preg_match("|AOL (\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|MSIE (\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Dooble/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Safari/(\d{3})|", $agent, $match) && preg_match("|Version/(\d{1,2}\.\d)|", $agent, $match)) {
        return str_replace("Version/", "Safari ", $match[0]);
    } else
    if (preg_match("|K-Meleon/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Konqueror/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Camino/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Lynx/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|AvantGo (\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|EudoraWeb (\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Thunderbird/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|iTunes/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|QuickTime/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Windows-Media-Player/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Galeon/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Amiga-AWeb/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|AmigaVoyager/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|iCab (\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|amaya/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|facebook bot|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|facebookscraper/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|facebookexternalhit/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Facebook FirePHP/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Facebook API PHP(\d{1})|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|([A-Z]+)TB(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Google/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Googlebot(/)?(\s)?(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Googlebot-Mobile/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Googlebot FirePHP(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Googlebot-Image(/)?(\s)?(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Googlebot-Earth/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Googlebot-Sitemaps/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Googlebot-Site-Verification/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Mediapartners-Google/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Mediapartners-Google/PHP-proxy|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Mediapartners-Google|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|AdsBot-Google-Mobile|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|AdsBot-Google|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|AppEngine-Google|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|FeedFetcher-Google|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|AOL Search|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|AskBar (\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|TeomaBar (\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Ask Jeeves/Teoma|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Ask Jeeves Corporate Spider|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|FunWebProducts-AskJeeves|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|BingSearch/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|bingbot/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Msnbot(/)?(\s)?(\d{1,2}\.\d)|i", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|msnbot-media/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|msnbot-Products/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|MSNAttackBot/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|MSMOBOT/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|MSNBOT-MOBILE/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|MSMOBOT Mozilla/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|MSMOBOT CHTML|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Twitterbot/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Twitterrific/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|TwitterFonPro/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|TwitterResearch|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|TwitterIrcGateway|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Yandex/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|YandexBot/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|YandexMedia/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|YandexImages/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|YandexFavicons/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|YandexZakladki/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|YandexAntivirus/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|yahoobot|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Y!J-([a-z0-9\.\/]{7}+)|i", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Yahoo! Slurp/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Yahoo! Slurp|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Yahoo-Test/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Yahoo-Blogs/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|YahooSeeker/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|YahooFeedSeeker/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|YahooSeeker-Testing/v(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Bloglines/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Bloglines-Images/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Baiduspider/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Baiduspider-image+|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Baiduspider-favo+|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Baiduspider+|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|archive_crawler/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|ia_archiver/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|ia_archiver|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Perl Crawler Robot v(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Python-httplib(\d{1})|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Python-urllib/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Python (\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|PECL::HTTP/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|PEAR HTTP|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|HTTP_Request2/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|WordPress-Do-P-/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|WordPress-B-/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|WordPress/(\d{1,2}\.\d)|i", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|WordPress|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|WWW-Mechanize/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|DoCoMo/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Charlotte/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|ZyBorg/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|event_fetcher/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|gonzo[/]?(\d{1})|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Semager/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|ReqwirelessWeb/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|http://(\www.)?inbuzunar.mobi|', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|http://Anonymouse.org|', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|http://www.80legs.com|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|iCjobs Stellenangebote Jobs|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Seznam screenshot-generator|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|Download Master|', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|OPENWAVE|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|MAUI|i", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Twiceler|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Teemer|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|ELinks|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|yacybot|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|cometrics-bot|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|infometrics-bot|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|webmeasurement-bot|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Linguee Bot|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|SEOkicks-Robot|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Cityreview Robot|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|URL-Expander-Bot|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Yanga WorldSearch Bot|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Speedy Spider|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Nusearch Spider|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|iCCrawler|i", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|MSIECrawler|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|GVC WEB crawler|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|LINK TRADE crawler|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Krugle web crawler|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|([a-z]+)/Nutch-(\d{1,2}\.\d)|i", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|GarlikCrawler/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|NimbleCrawler (\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Plukkie/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Acoon-Robot v(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|MJ12bot/v(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|discobot/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|spbot/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|aiHitBot/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|DBLBot/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|DotBot/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|SiteBot/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|NaverBot/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Gigamega.bot/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|MyFamilyBot/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Webbot/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Exabot/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|MojeekBot/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|eCairn-Grabber/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Java/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|LinkWalker/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|LiteFinder/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Sogou web spider/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|WebAlta Crawler/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|WebCopier v(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Web Downloader/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Offline Explorer/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|SuperBot/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|WebZIP/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Wget/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|GNU/wget (\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|W3C-checklink/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|W3C_Validator/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|Snoopy v(\d{1,2}\.\d)|', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|DA (\d{1,2}\.\d)|', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|SmallProxy (\d{1,2}\.\d)|', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match("|Mozilla/(\d{1,2}\.\d)|", $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|Microsoft-WebDAV-MiniRedir/(\d{1,2}\.\d)|', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|Microsoft Pocket Internet Explorer/(\d{1,2}\.\d)|', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|Microsoft URL Control|', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|Microsoft Office Protocol Discovery|', $agent, $match)) {
        return $match[0];
    } else
    if (preg_match('|Microsoft Data Access Internet Publishing Provider Protocol Discovery|', $agent, $match)) {
        return $match[0];
    } else {
		$useragent = explode(' ', $agent);
		if($useragent[0] == 'Opera/9.80') {
		$useragent[0] = $_SERVER['HTTP_X_OPERAMINI_PHONE'];
		$useragent[0] = str_replace('#', '', $useragent[0]);
		}
        return $useragent[0];
    }
}
?>