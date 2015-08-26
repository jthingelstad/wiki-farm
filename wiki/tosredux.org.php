<?php
# Protect against web entry
if ( !defined( 'MEDIAWIKI' ) ) {
    exit;
}


$wgServer = "http://" . $myInstance;
$myWikiToken = "tosredux";
$myEmailDomain = "tosredux.org";
$myClosedWiki = false;
$myLocalTime = false;
$wgSitename = "TOSRedux";
$wgMetaNamespace = "TOSRedux";
#$wgLogo = "/w/images/minnestar/thumb/2/2e/Star.png/160px-Star.png";
$wgDBname = "mw_tosredux";
$wgDBuser = "mw_tosredux";
$wgDBpassword = $SECRET_DBPASSWORD;
$wgSecretKey = $SECRET_SECRETKEY;
$wgUpgradeKey = $SECRET_UPGRADEKEY;

$myWikiApiaryURL = "http://wikiapiary.com/wiki/TOSRedux";
$wgSitemapNamespaces = array(0, 2, 4, 6, 14);

# Create additional namespaces
define("NS_ORGANIZATION", 800);
define("NS_ORGANIZATION_TALK", 801);
$wgExtraNamespaces[NS_ORGANIZATION] = "Organization";
$wgExtraNamespaces[NS_ORGANIZATION_TALK] = "Organization_talk";
$wgContentNamespaces[] = NS_ORGANIZATION;
$wgNamespacesToBeSearchedDefault[NS_ORGANIZATION] = true;

# Create additional namespaces
define("NS_TOPIC", 802);
define("NS_TOPIC_TALK", 803);
$wgExtraNamespaces[NS_TOPIC] = "Topic";
$wgExtraNamespaces[NS_TOPIC_TALK] = "Topic_talk";
$wgContentNamespaces[] = NS_TOPIC;
$wgNamespacesToBeSearchedDefault[NS_TOPIC] = true;

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

