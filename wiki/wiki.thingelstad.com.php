<?php
# Protect against web entry
if ( !defined( 'MEDIAWIKI' ) ) {
    exit;
}


$wgServer = "http://" . $myInstance;
$myWikiToken = "wiki_thing";
$myEmailDomain = "thingelstad.com";
$myClosedWiki = true;
$myLocalTime = true;
$wgSitename = "wiki_thing";
$wgLogo = "/w/images/wiki_thing/3/31/Wiki_thing.png";
$wgDBname = "mw_wiki_thing";
$wgDBuser = "mw_wiki_thing";
$wgDBpassword = $SECRET_DBPASSWORD;
$wgDBprefix = "mw_thing_";
$wgSecretKey = $SECRET_SECRETKEY;
$wgUpgradeKey = $SECRET_UPGRADEKEY;

# Create additional namespace for notes
define("NS_NOTE", 800);
define("NS_NOTE_TALK", 801);
$wgExtraNamespaces[NS_NOTE] = "Note";
$wgExtraNamespaces[NS_NOTE_TALK] = "Note_talk";
$wgContentNamespaces[] = NS_NOTE;
$wgNamespacesToBeSearchedDefault[NS_NOTE] = true;

$myWikiApiaryURL = "http://wikiapiary.com/wiki/Wiki_thing";
$wgSitemapNamespaces = array(0, 2, 4, 6, 14);

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
$wgGroupPermissions['*']['noanalytics'] = false;
$wgGroupPermissions['bot']['noanalytics'] = true;
$wgGroupPermissions['sysop']['noanalytics'] = true;
$wgGroupPermissions['bureaucrat']['noanalytics'] = true;
$wgGoogleAnalyticsAccount = 'UA-49944629-11';

require_once($IP.'/LocalSettings/modules/ga.php');
