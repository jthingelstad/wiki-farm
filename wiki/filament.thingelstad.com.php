<?php
# Protect against web entry
if ( !defined( 'MEDIAWIKI' ) ) {
    exit;
}

$wgServer = "http://" . $myInstance;
$myWikiToken = $myInstance;
$myEmailDomain = "thingelstad.com";
$myClosedWiki = true;
$myLocalTime = false;
$wgSitename = "Filament";
# $wgLogo = "/w/images/wiki_thing/3/31/Wiki_thing.png";
# $myPiwikIDSite = "2";
# $myGoogleMapsKey = "ABQIAAAAgB9FFqinrEZGFc4wikkR3xQ-1UJwvbmTUWO1cRimi5StWnebBRRXTUko0ynxjzL_j7lQqwauD1x3sQ";
$wgDBname = "mw_filament";
$wgDBuser = "mw_filament";
$wgDBpassword = $SECRET_DBPASSWORD;
$wgSecretKey = $SECRET_SECRETKEY;
$wgUpgradeKey = $SECRET_UPGRADEKEY;

$myWikiApiaryURL = "http://wikiapiary.com/wiki/Filament_Demo";
$wgSitemapNamespaces = array(0, 2, 4, 6, 14);

$wgDefaultSkin = "filament";

# GA stuff
$wgGroupPermissions['*']['noanalytics'] = false;
$wgGroupPermissions['bot']['noanalytics'] = true;
$wgGroupPermissions['sysop']['noanalytics'] = true;
$wgGroupPermissions['bureaucrat']['noanalytics'] = true;
$wgGoogleAnalyticsAccount = 'UA-49847989-3';

require_once($IP.'/LocalSettings/modules/ga.php');
