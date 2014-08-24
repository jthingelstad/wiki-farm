<?php
# Protect against web entry
if ( !defined( 'MEDIAWIKI' ) ) {
    exit;
}

# TOTAL HACK TO GET CHARTS WORKING RIGHT
$wgResourceLoaderDebug = true;

$wgServer = "http://" . $myInstance;
$myWikiToken = "planetkubb";
$myEmailDomain = "planetkubb.com";
$myClosedWiki = false;
$myLocalTime = false;
$wgSitename = "Planet Kubb Wiki";
$wgMetaNamespace = "Planet_Kubb";
$wgLogo = "/w/images/planetkubb/f/f7/PK-Logo-160px.png";
$wgDBname = "mw_planetkubb";
$wgDBuser = "mw_planetkubb";
$wgDBpassword = $SECRET_DBPASSWORD;
$wgSecretKey = $SECRET_SECRETKEY;
$wgUpgradeKey = $SECRET_UPGRADEKEY;

define("NS_PLAYER", 820);
define("NS_PLAYER_TALK", 821);
$wgExtraNamespaces[NS_PLAYER] = "Player";
$wgExtraNamespaces[NS_PLAYER_TALK] = "Player_talk";
$wgContentNamespaces[] = NS_PLAYER;
$wgNamespacesToBeSearchedDefault[NS_PLAYER] = true;

define("NS_TEAM", 822);
define("NS_TEAM_TALK", 823);
$wgExtraNamespaces[NS_TEAM] = "Team";
$wgExtraNamespaces[NS_TEAM_TALK] = "Team_talk";
$wgContentNamespaces[] = NS_TEAM;
$wgNamespacesToBeSearchedDefault[NS_TEAM] = true;

define("NS_GAME", 824);
define("NS_GAME_TALK", 825);
$wgExtraNamespaces[NS_GAME] = "Game";
$wgExtraNamespaces[NS_GAME_TALK] = "Game_talk";
$wgNamespacesWithSubpages[NS_GAME] = true;
$wgContentNamespaces[] = NS_GAME;
$wgNamespacesToBeSearchedDefault[NS_GAME] = true;

define("NS_CLUB", 826);
define("NS_CLUB_TALK", 827);
$wgExtraNamespaces[NS_CLUB] = "Club";
$wgExtraNamespaces[NS_CLUB_TALK] = "Club_talk";
$wgContentNamespaces[] = NS_CLUB;
$wgNamespacesToBeSearchedDefault[NS_CLUB] = true;

define("NS_EVENT", 828);
define("NS_EVENT_TALK", 829);
$wgExtraNamespaces[NS_EVENT] = "Event";
$wgExtraNamespaces[NS_EVENT_TALK] = "Event_talk";
$wgContentNamespaces[] = NS_EVENT;
$wgNamespacesToBeSearchedDefault[NS_EVENT] = true;

$myWikiApiaryURL = "http://wikiapiary.com/wiki/Planet_Kubb_Wiki";
$wgSitemapNamespaces = array(0, 2, 4, 6, 14, 820, 822, 824, 826, 828);

# Create namespace for issue tracking
define("NS_ISSUE", 890);
define("NS_ISSUE_TALK", 891);
$wgExtraNamespaces[NS_ISSUE] = "Issue";
$wgExtraNamespaces[NS_ISSUE_TALK] = "Issue_talk";

# Allow cross-site AJAX for Kubb scoring app
$wgCrossSiteAJAXdomains = array( 'grv.me', '*.grv.me', '*.wikipedia.org' );

$wgDefaultSkin = "foreground";
$wgSkipSkins = array( 'chick', 'cologneblue', 'modern', 'myskin', 'nostalgia', 'simple', 'standard', 'filament', 'monobook', 'vector' );

# GA stuff
$wgGroupPermissions['*']['noanalytics'] = false;
$wgGroupPermissions['bot']['noanalytics'] = true;
$wgGroupPermissions['sysop']['noanalytics'] = true;
$wgGroupPermissions['bureaucrat']['noanalytics'] = true;
$wgGoogleAnalyticsAccount = 'UA-49865875-2';

require_once($IP.'/LocalSettings/modules/ga.php');

