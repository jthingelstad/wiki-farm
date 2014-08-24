<?php
# Protect against web entry
if ( !defined( 'MEDIAWIKI' ) ) {
    exit;
}


$wgServer = "http://" . $myInstance;
$myWikiToken = "bodwiki";
$myEmailDomain = "bodwiki.com";
$myClosedWiki = false;
$myLocalTime = false;
$wgSitename = "BODWiki";
#$wgLogo = "/w/images/wikiapiary/a/a3/Apiary-logo-135.png";
$wgDBname = "mw_bodwiki";
$wgDBuser = "mw_bodwiki";
$wgDBpassword = $SECRET_DBPASSWORD;
$wgSecretKey = $SECRET_SECRETKEY;
$wgUpgradeKey = $SECRET_UPGRADEKEY;

# Create additional namespaces
define("NS_COMPANY", 800);
define("NS_COMPANY_TALK", 801);
$wgExtraNamespaces[NS_COMPANY] = "Company";
$wgExtraNamespaces[NS_COMPANY_TALK] = "Company_talk";
$wgContentNamespaces[] = NS_COMPANY;
$wgNamespacesToBeSearchedDefault[NS_COMPANY] = true;
// define("NS_FARM", 802);
// define("NS_FARM_TALK", 803);
// $wgExtraNamespaces[NS_FARM] = "Farm";
// $wgExtraNamespaces[NS_FARM_TALK] = "Farm_talk";
// $wgContentNamespaces[] = NS_FARM;
// $wgNamespacesToBeSearchedDefault[NS_FARM] = true;
// define("NS_SKIN", 804);
// define("NS_SKIN_TALK", 805);
// $wgExtraNamespaces[NS_SKIN] = "Skin";
// $wgExtraNamespaces[NS_SKIN_TALK] = "Skin_talk";
// $wgContentNamespaces[] = NS_SKIN;
// $wgNamespacesToBeSearchedDefault[NS_SKIN] = true;
$myWikiApiaryURL = "http://wikiapiary.com/wiki/BODWiki";
$wgSitemapNamespaces = array(0, 2, 4, 6, 14);

$wgDefaultSkin = "foreground";
$wgSkipSkins = array( 'chick', 'cologneblue', 'modern', 'myskin', 'nostalgia', 'simple', 'standard', 'filament', 'monobook', 'vector' );

$wgUseInstantCommons = true;

# Create namespace for issue tracking
define("NS_ISSUE", 890);
define("NS_ISSUE_TALK", 891);
$wgExtraNamespaces[NS_ISSUE] = "Issue";
$wgExtraNamespaces[NS_ISSUE_TALK] = "Issue_talk";
