<?php
# Protect against web entry
if ( !defined( 'MEDIAWIKI' ) ) {
    exit;
}

$wgServer = "http://" . $myInstance;
$myWikiToken = $myInstance;
$myEmailDomain = "patrickrhone.com";
$myClosedWiki = true;
$myLocalTime = true;
$wgSitename = "rhone links";
#$wgLogo = "/w/images/links/3/35/Paperclip.png";
$wgDBname = "mw_rhone_links";
$wgDBuser = "mw_rhone_links";
$wgDBpassword = $SECRET_DBPASSWORD;
$wgSecretKey = $SECRET_SECRETKEY;
$wgUpgradeKey = $SECRET_UPGRADEKEY;
$myWikiApiaryURL = "http://wikiapiary.com/wiki/Rhone_links";
$wgSitemapNamespaces = array(0, 2, 4, 6, 14);
$wgDefaultSkin = "filament";
