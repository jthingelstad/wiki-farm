<?php
# Protect against web entry
if ( !defined( 'MEDIAWIKI' ) ) {
    exit;
}


$wgServer = "http://" . $myInstance;
$myWikiToken = "rwbookclub";
$myClosedWiki = true;
$myLocalTime = true;
$myEmailDomain = "rwbookclub.com";
$wgSitename = "R/W Book Club";
$wgMetaNamespace = "RW_Book_Club";
$wgLogo = "/w/images/rwbookclub/3/3e/Rwbookclub_wiki_logo.png";
$wgDBname = "mw_rwbookclub";
$wgDBuser = "mw_rwbookclub";
$wgDBpassword = $SECRET_DBPASSWORD;
$wgDBprefix = "mw_ccbc_";
$wgSecretKey = $SECRET_SECRETKEY;
$wgUpgradeKey = $SECRET_UPGRADEKEY;

# Create additional namespace for meetings
define("NS_MEETING", 800);
define("NS_MEETING_TALK", 801);
$wgExtraNamespaces[NS_MEETING] = "Meeting";
$wgExtraNamespaces[NS_MEETING_TALK] = "Meeting_talk";
$wgContentNamespaces[] = NS_MEETING;

$myWikiApiaryURL = "http://wikiapiary.com/wiki/RW_Book_Club";
$wgSitemapNamespaces = array(0, 2, 4, 6, 14, 800);

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

