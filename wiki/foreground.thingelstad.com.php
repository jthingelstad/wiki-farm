<?php
# Protect against web entry
if ( !defined( 'MEDIAWIKI' ) ) {
    exit;
}

$wgServer = "http://" . $myInstance;
$myWikiToken = $myInstance;
$myEmailDomain = "thingelstad.com";
$myClosedWiki = false;
$myLocalTime = false;
$wgSitename = "Foreground";
# $wgLogo = "/w/images/wiki_thing/3/31/Wiki_thing.png";
$wgDBname = "mw_foreground";
$wgDBuser = "mw_foreground";
$wgDBpassword = $SECRET_DBPASSWORD;
$wgSecretKey = $SECRET_SECRETKEY;
$wgUpgradeKey = $SECRET_SECRETKEY;

$myWikiApiaryURL = "http://wikiapiary.com/wiki/Foreground";
$wgSitemapNamespaces = array(0, 2, 4, 6, 14);

# Create additional namespaces
define("NS_SANDBOX", 800);
define("NS_SANDBOX_TALK", 801);
$wgExtraNamespaces[NS_SANDBOX] = "Sandbox";
$wgExtraNamespaces[NS_SANDBOX_TALK] = "Sandbox_talk";

$wgDefaultSkin = "foreground";
$wgSkipSkins = array( 'chick', 'cologneblue', 'modern', 'myskin', 'nostalgia', 'simple', 'standard', 'filament', 'monobook', 'vector' );

# GA stuff
$wgGroupPermissions['*']['noanalytics'] = false;
$wgGroupPermissions['bot']['noanalytics'] = true;
$wgGroupPermissions['sysop']['noanalytics'] = true;
$wgGroupPermissions['bureaucrat']['noanalytics'] = true;
$wgGoogleAnalyticsAccount = 'UA-49847989-2';

require_once($IP.'/LocalSettings/modules/ga.php');

