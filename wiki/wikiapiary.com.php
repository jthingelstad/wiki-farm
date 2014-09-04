<?php
# Protect against web entry
if ( !defined( 'MEDIAWIKI' ) ) {
    exit;
}

$wgServer = "https://" . $myInstance;
$myWikiToken = "wikiapiary";
$myEmailDomain = "wikiapiary.com";
$myClosedWiki = false;
$myLocalTime = false;
$wgSitename = "WikiApiary";
$wgLogo = "/w/images/wikiapiary/a/a3/Apiary-logo-135.png";
$wgDBname = "mw_wikiapiary";
$wgDBuser = "mw_wikiapiary";
$wgDBpassword = $SECRET_DBPASSWORD;
$wgSecretKey = $SECRET_SECRETKEY;
$wgUpgradeKey = $SECRET_UPGRADEKEY;

# Create additional namespaces
define("NS_EXTENSION", 800);
define("NS_EXTENSION_TALK", 801);
$wgExtraNamespaces[NS_EXTENSION] = "Extension";
$wgExtraNamespaces[NS_EXTENSION_TALK] = "Extension_talk";
$wgContentNamespaces[] = NS_EXTENSION;
$wgNamespacesToBeSearchedDefault[NS_EXTENSION] = true;

define("NS_FARM", 802);
define("NS_FARM_TALK", 803);
$wgExtraNamespaces[NS_FARM] = "Farm";
$wgExtraNamespaces[NS_FARM_TALK] = "Farm_talk";
$wgContentNamespaces[] = NS_FARM;
$wgNamespacesToBeSearchedDefault[NS_FARM] = true;
$wgNamespacesWithSubpages[NS_FARM] = true;

define("NS_SKIN", 804);
define("NS_SKIN_TALK", 805);
$wgExtraNamespaces[NS_SKIN] = "Skin";
$wgExtraNamespaces[NS_SKIN_TALK] = "Skin_talk";
$wgContentNamespaces[] = NS_SKIN;
$wgNamespacesToBeSearchedDefault[NS_SKIN] = true;

define("NS_GENERATOR", 808);
define("NS_GENERATOR_TALK", 809);
$wgExtraNamespaces[NS_GENERATOR] = "Generator";
$wgExtraNamespaces[NS_GENERATOR_TALK] = "Generator_talk";
$wgContentNamespaces[] = NS_GENERATOR;
$wgNamespacesToBeSearchedDefault[NS_GENERATOR] = true;
$wgNamespacesWithSubpages[NS_GENERATOR] = true;

define("NS_HOST", 810);
define("NS_HOST_TALK", 811);
$wgExtraNamespaces[NS_HOST] = "Host";
$wgExtraNamespaces[NS_HOST_TALK] = "Host_talk";
$wgContentNamespaces[] = NS_HOST;
$wgNamespacesToBeSearchedDefault[NS_HOST] = true;
$wgNamespacesWithSubpages[NS_HOST] = true;

$myWikiApiaryURL = "http://wikiapiary.com/wiki/WikiApiary";
$wgSitemapNamespaces = array(0, 2, 4, 6, 14, 800, 802, 804, 808, 810);

# Create namespace for issue tracking
define("NS_ISSUE", 806);
define("NS_ISSUE_TALK", 807);
$wgExtraNamespaces[NS_ISSUE] = "Issue";
$wgExtraNamespaces[NS_ISSUE_TALK] = "Issue_talk";

$wgDefaultSkin = "foreground";
# Foreground is specific, so lets disable other skins
$wgSkipSkins = array( 'chick', 'cologneblue', 'modern', 'myskin', 'nostalgia', 'simple', 'standard', 'filament', 'monobook', 'vector' );
# Allow User CSS, mostly for skin testing
$wgAllowUserCss = true;

$wgHooks['SkinTemplateOutputPageBeforeExec'][] = 'lfTOSLink';
function lfTOSLink( $sk, &$tpl ) {
    $tpl->set( 'termsofservice', $sk->footerLink( 'termsofservice', 'termsofservicepage' ) );
    $tpl->data['footerlinks']['places'][] = 'termsofservice';
    return true;
}

$wgForegroundFeatures = array(
  'showActionsForAnon' => true,
  'NavWrapperType' => 'divonly',
  'showHelpUnderTools' => true,
  'showRecentChangesUnderTools' => true,
  'IeEdgeCode' => 1,
  'showFooterIcons' => true,
  'addThisFollowPUBID' => 'ra-5407bddd55dceeb5'
);

# Enable translation
$wgGroupPermissions['user']['translate'] = true;
$wgTranslateFuzzyBotName = 'Fuzzy Bee';

# GA stuff
$wgGroupPermissions['*']['noanalytics'] = false;
$wgGroupPermissions['bot']['noanalytics'] = true;
$wgGroupPermissions['sysop']['noanalytics'] = true;
$wgGroupPermissions['bureaucrat']['noanalytics'] = true;
$wgGoogleAnalyticsAccount = 'UA-49847989-1';

require_once($IP.'/LocalSettings/modules/ga.php');
