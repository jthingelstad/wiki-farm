<?php
# Protect against web entry
if ( !defined( 'MEDIAWIKI' ) ) {
    exit;
}


$wgServer = "http://" . $myInstance;
$myWikiToken = "links";
$myEmailDomain = "thingelstad.com";
$myClosedWiki = true;
$myLocalTime = true;
$wgSitename = "links_thing";
$wgLogo = "/w/images/links/3/35/Paperclip.png";
$wgDBname = "mw_links";
$wgDBuser = "mw_links";
$wgDBpassword = $SECRET_DBPASSWORD;
$wgSecretKey = $SECRET_SECRETKEY;
$wgUpgradeKey = $SECRET_UPGRADEKEY;
$myWikiApiaryURL = "http://wikiapiary.com/wiki/Links_thing";
$wgSitemapNamespaces = array(0, 2, 4, 6, 14);
$wgDefaultSkin = "foreground";

# GA stuff
$wgGroupPermissions['*']['noanalytics'] = false;
$wgGroupPermissions['bot']['noanalytics'] = true;
$wgGroupPermissions['sysop']['noanalytics'] = true;
$wgGroupPermissions['bureaucrat']['noanalytics'] = true;
$wgGoogleAnalyticsAccount = 'UA-49944629-5';

require_once($IP.'/LocalSettings/modules/ga.php');

