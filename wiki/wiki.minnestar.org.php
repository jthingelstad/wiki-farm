<?php
# Protect against web entry
if ( !defined( 'MEDIAWIKI' ) ) {
    exit;
}


$wgServer = "http://" . $myInstance;
$myWikiToken = "minnestar";
$myEmailDomain = "minnestar.org";
$myClosedWiki = false;
$myLocalTime = true;
$wgSitename = "minnestar Wiki";
$wgMetaNamespace = "minnestar";
$wgLogo = "/w/images/minnestar/thumb/2/2e/Star.png/160px-Star.png";
$wgDBname = "mw_minnestar";
$wgDBuser = "mw_minnestar";
$wgDBpassword = $SECRET_DBPASSWORD;
$wgSecretKey = $SECRET_SECRETKEY;
$wgUpgradeKey = $SECRET_UPGRADEKEY;

# Additional namespaces
define("NS_BOARD", 802);
define("NS_BOARD_TALK", 803);
$wgExtraNamespaces[NS_BOARD] = "Board";
$wgExtraNamespaces[NS_BOARD_TALK] = "Board_talk";
$wgNamespacesWithSubpages[NS_BOARD] = true;
$wgContentNamespaces[] = NS_BOARD;
$wgNamespacesToBeSearchedDefault[NS_BOARD] = true;

define("NS_PRESENTER", 1000);
define("NS_PRESENTER_TALK", 1001);
$wgExtraNamespaces[NS_PRESENTER] = "Presenter";
$wgExtraNamespaces[NS_PRESENTER_TALK] = "Presenter_talk";
$wgNamespacesWithSubpages[NS_PRESENTER] = true;
$wgContentNamespaces[] = NS_PRESENTER;
$wgNamespacesToBeSearchedDefault[NS_PRESENTER] = true;

define("NS_SPONSOR", 1002);
define("NS_SPONSOR_TALK", 1003);
$wgExtraNamespaces[NS_SPONSOR] = "Sponsor";
$wgExtraNamespaces[NS_SPONSOR_TALK] = "Sponsor_talk";
$wgNamespacesWithSubpages[NS_SPONSOR] = true;
$wgContentNamespaces[] = NS_SPONSOR;
$wgNamespacesToBeSearchedDefault[NS_SPONSOR] = true;

define("NS_SUPPORTER", 1004);
define("NS_SUPPORTER_TALK", 1005);
$wgExtraNamespaces[NS_SUPPORTER] = "Supporter";
$wgExtraNamespaces[NS_SUPPORTER_TALK] = "Supporter_talk";
$wgNamespacesWithSubpages[NS_SUPPORTER] = true;
$wgContentNamespaces[] = NS_SUPPORTER;
$wgNamespacesToBeSearchedDefault[NS_SUPPORTER] = true;

# Protect some namespaces
$wgNamespaceProtection[NS_BOARD] = array( 'board-edit' );
$wgNamespaceProtection[NS_BOARD_TALK] = array( 'board-talk-edit' );


$myWikiApiaryURL = "http://wikiapiary.com/wiki/Minne✱_wiki";
$wgSitemapNamespaces = array(0, 2, 4, 6, 14, 802);

# Use Foreground skin
$wgDefaultSkin = "foreground";
$wgSkipSkins = array( 'chick', 'cologneblue', 'modern', 'myskin', 'nostalgia', 'simple', 'standard', 'filament', 'monobook', 'vector' );

# GA stuff
$wgGroupPermissions['*']['noanalytics'] = false;
$wgGroupPermissions['bot']['noanalytics'] = true;
$wgGroupPermissions['sysop']['noanalytics'] = true;
$wgGroupPermissions['bureaucrat']['noanalytics'] = true;
$wgGoogleAnalyticsAccount = 'UA-36792913-2';

require_once($IP.'/LocalSettings/modules/ga.php');

