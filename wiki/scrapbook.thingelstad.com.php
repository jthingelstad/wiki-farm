<?php
# Protect against web entry
if ( !defined( 'MEDIAWIKI' ) ) {
    exit;
}


$wgServer = "http://" . $myInstance;
$myWikiToken = "scrapbook";
$myEmailDomain = "thingelstad.com";
$myClosedWiki = true;
$myLocalTime = true;
$wgSitename = "Thingelstad Scrapbook";
$wgMetaNamespace = "Thingelstad_Scrapbook";
$wgLogo = "/w/images/scrapbook/7/7e/Scrapbook-icon.png";
$wgDBname = "mw_scrapbook";
$wgDBuser = "mw_scrapbook";
$wgDBpassword = $SECRET_DBPASSWORD;
$wgSecretKey = $SECRET_SECRETKEY;
$wgUpgradeKey = $SECRET_UPGRADEKEY;
$myWikiApiaryURL = "http://wikiapiary.com/wiki/Main_Page";
