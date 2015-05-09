<?php
# Protect against web entry
if ( !defined( 'MEDIAWIKI' ) ) {
    exit;
}


$wgServer = "http://" . $myInstance;
$myWikiToken = "tosredux";
$myEmailDomain = "tosredux.com";
$myClosedWiki = false;
$myLocalTime = false;
$wgSitename = "TOS Redux";
$wgMetaNamespace = "tosredux";
#$wgLogo = "/w/images/minnestar/thumb/2/2e/Star.png/160px-Star.png";
$wgDBname = "mw_tosredux";
$wgDBuser = "mw_tosredux";
$wgDBpassword = $SECRET_DBPASSWORD;
$wgSecretKey = $SECRET_SECRETKEY;
$wgUpgradeKey = $SECRET_UPGRADEKEY;

$myWikiApiaryURL = "http://wikiapiary.com/wiki/TOS_Redux";
$wgSitemapNamespaces = array(0, 2, 4, 6, 14);

# Use Foreground skin
$wgDefaultSkin = "foreground";
$wgForegroundFeatures = array(
  #'navbarIcon' => true,
  'showActionsForAnon' => true,
  'NavWrapperType' => 'divonly',
  'showHelpUnderTools' => true,
  'showRecentChangesUnderTools' => true,
  'IeEdgeCode' => 1,
  'showFooterIcons' => true
);

$wgSkipSkins = array( 'chick', 'cologneblue', 'modern', 'myskin', 'nostalgia', 'simple', 'standard', 'filament', 'monobook', 'vector' );

# GA stuff
#$wgGroupPermissions['*']['noanalytics'] = false;
#$wgGroupPermissions['bot']['noanalytics'] = true;
#$wgGroupPermissions['sysop']['noanalytics'] = true;
#$wgGroupPermissions['bureaucrat']['noanalytics'] = true;
#$wgGoogleAnalyticsAccount = 'UA-49944629-12';

#require_once($IP.'/LocalSettings/modules/ga.php');

