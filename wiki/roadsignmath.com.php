<?php
# Protect against web entry
if ( !defined( 'MEDIAWIKI' ) ) {
    exit;
}


$wgServer = "http://" . $myInstance;
$myWikiToken = "roadsignmath";
$myClosedWiki = false;
$myLocalTime = false;
$myEmailDomain = "roadsignmath.com";
$wgSitename = "Road Sign Math";
$wgMetaNamespace = "Road_Sign_Math";
$wgLogo = "/w/images/roadsignmath/3/3a/RSM_Logo_Small.png";
$wgAppleTouchIcon = "/w/images/roadsignmath/8/86/Rsm-apple-touch-icon.png";
$wgDBname = "mw_roadsignmath";
$wgDBuser = "mw_rsmath";
$wgDBpassword = $SECRET_DBPASSWORD;
$wgDBprefix = "mw_rsm_";
$wgSecretKey = $SECRET_SECRETKEY;
$wgUpgradeKey = $SECRET_UPGRADEKEY;
$myWikiApiaryURL = "http://wikiapiary.com/wiki/Road_Sign_Math";
$wgSitemapNamespaces = array(0, 2, 4, 6, 14);

$wgDefaultSkin = "foreground";
$wgForegroundFeatures = array(
  'navbarIcon' => true,
  'showActionsForAnon' => true,
  'NavWrapperType' => 'divonly',
  'showHelpUnderTools' => true,
  'showRecentChangesUnderTools' => true,
  'IeEdgeCode' => 1,
  'showFooterIcons' => true,
  #'addThisFollowPUBID' => 'ra-5407bddd55dceeb5'
);

$wgSkipSkins = array( 'chick', 'cologneblue', 'modern', 'myskin', 'nostalgia', 'simple', 'standard', 'filament', 'monobook', 'vector' );

# GA stuff
$wgGroupPermissions['*']['noanalytics'] = false;
$wgGroupPermissions['bot']['noanalytics'] = true;
$wgGroupPermissions['sysop']['noanalytics'] = true;
$wgGroupPermissions['bureaucrat']['noanalytics'] = true;
$wgGoogleAnalyticsAccount = 'UA-49944629-2';

require_once($IP.'/LocalSettings/modules/ga.php');

