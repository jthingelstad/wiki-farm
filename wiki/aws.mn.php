<?php
# Protect against web entry
if ( !defined( 'MEDIAWIKI' ) ) {
    exit;
}


$wgServer = "http://" . $myInstance;
$myWikiToken = "awsmn";
$myEmailDomain = "aws.mn";
$myClosedWiki = false;
$myLocalTime = true;
$wgSitename = "AWS MN";
$wgMetaNamespace = "awsmn";
#$wgLogo = "/w/images/minnestar/thumb/2/2e/Star.png/160px-Star.png";
$wgDBname = "mw_awsmn";
$wgDBuser = "mw_awsmn";
$wgDBpassword = $SECRET_DBPASSWORD;
$wgSecretKey = $SECRET_SECRETKEY;
$wgUpgradeKey = $SECRET_UPGRADEKEY;

$myWikiApiaryURL = "http://wikiapiary.com/wiki/AWS_MN";
$wgSitemapNamespaces = array(0, 2, 4, 6, 14);

# Use Foreground skin
$wgDefaultSkin = "foreground";
$wgSkipSkins = array( 'chick', 'cologneblue', 'modern', 'myskin', 'nostalgia', 'simple', 'standard', 'filament', 'monobook', 'vector' );

# GA stuff
$wgGroupPermissions['*']['noanalytics'] = false;
$wgGroupPermissions['bot']['noanalytics'] = true;
$wgGroupPermissions['sysop']['noanalytics'] = true;
$wgGroupPermissions['bureaucrat']['noanalytics'] = true;
$wgGoogleAnalyticsAccount = 'UA-49944629-12';

require_once($IP.'/LocalSettings/modules/ga.php');

