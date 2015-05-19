<?php
# Protect against web entry
if ( !defined( 'MEDIAWIKI' ) ) {
    exit;
}

/** @see RedisBagOStuff for a ful explanation of these options. **/
$wgObjectCaches['redis'] = array(
  'class'                => 'RedisBagOStuff',
  'servers'              => array( '192.168.189.13:6379' )
  );

# Set defaults for all wikis
$wgScriptPath = "/w";
$wgScriptExtension = ".php";
$wgUsePathInfo = true;
$wgArticlePath = "/wiki/$1";
$wgStylePath = "$wgScriptPath/skins";
$wgLogo = "$wgStylePath/common/images/wiki.png";
$wgFavicon = "/favicon.ico";

$wgDBtype = "mysql";
$wgDBserver = "db-local";
$wgDBprefix = "";
# Settings to tweak database performance
# http://www.mediawiki.org/wiki/Manual:$wgAntiLockFlags
$wgAntiLockFlags = ALF_NO_LINK_LOCK | ALF_NO_BLOCK_LOCK;
# http://www.mediawiki.org/wiki/Manual:$wgSQLMode
$wgSQLMode = null;

$wgDefaultSkin = "vector";
$wgVectorUseIconWatch = true;
$wgAllowUserCss = true;
$wgAllowUserJs = true;
$wgAllowSiteCSSOnRestrictedPages = true;

# Uncommnent this is Mediawiki is crashing and you need a stack trace
$wgShowExceptionDetails = true;
$wgShowSQLErrors = true;
#$wgDebugToolbar = true;
#$wgDebugLogFile = "/srv/www/mediawiki/tmp/debug-log";
#$wgDebugDumpSql = True;

# Set this value to put the Wiki in read-only mode for maintenance
#$wgReadOnly = "MediaWiki upgrade in process...";
#$wgSiteNotice = "in process...";

if ( ! $wgCommandLineMode ) {
    $myInstance=$_SERVER['SERVER_NAME'];
} else {
    $myInstance = getenv("MW_INSTANCE");
}

# Load the configuration for the wiki being requested
$my_config = $IP.'/LocalSettings/wiki/'.$myInstance.'.php';
$my_secrets = $IP.'/LocalSettings/secrets/'.$myInstance.'.php';
if (file_exists ($my_config) && file_exists($my_secrets)) {
    include $my_secrets;
    include $my_config;
} else {
    # No configuration was found for this wiki, do something about that
    echo "This request was sent to MediaWiki, and there is no configuration for $myInstance.\n";
    exit(0);
}

# Skin specific extensions
require_once "$IP/skins/Vector/Vector.php";
if ( $wgDefaultSkin == 'filament' ) {
    require_once($IP.'/skins/filament/filament.php');
}
if ( $wgDefaultSkin == 'foreground' ) {
    require_once($IP.'/skins/foreground/foreground.php');
}

# set email addresses using the instance variable
$wgEmergencyContact = "admin@" . $myEmailDomain;
$wgPasswordSender   = "admin@" . $myEmailDomain;

# Set upload directory per wiki
$wgUploadDirectory = "{$IP}/images/$myWikiToken";
$wgUploadPath = "/w/images/$myWikiToken";

# Override the cookie names, I don't like database tokens in there
$wgCookiePrefix = $myWikiToken;

# Allow microdata
$wgAllowMicrodataAttributes = true;

# Set miser mode for a little more speed
# This depends on running updateSpecialPages which is done every day at 10:05p via cron
$wgMiserMode = true;

# Set domains that we do want search engines to follow. This is global for all wikis and includes
# subdomains of each domain.
# TODO: This needs to be moved to the site configurations!
# consider just setting $wgNoFollowLinks to false
$wgNoFollowDomainExceptions = array( 'roadsignmath.com',
   'mediawiki.org', 'semantic-mediawiki.org', 'wikiquote.org',
   'wikipedia.org', 'wiktionary.org', 'thingelstad.com', 'jjt.me',
   'creativecommons.org', 'flickr.com', 'eff.org', 'pinboard.in',
   'wikinosh.com' );

# Enable subpages
# User namespace and all talk namespaces are enabled by default
$wgNamespacesWithSubpages[NS_MAIN] = true;
$wgNamespacesWithSubpages[NS_PROJECT] = true;
$wgNamespacesWithSubpages[NS_TEMPLATE] = true;

# Set global job run rate, this should be done out of process with RunJobs
$wgJobRunRate = 0;

## UPO means: this is also a user preference option
$wgEnableEmail = true;
$wgEnableUserEmail = true; # UPO
$wgEnotifUserTalk = true; # UPO
$wgEnotifWatchlist = true; # UPO
$wgEmailAuthentication = true;
# Use the job queue to batch and send emails
$wgEnotifUseJobQ = true;
# Require email authentication before someone can edit
$wgEmailConfirmToEdit = true;

# MySQL table options to use during installation or update
$wgDBTableOptions   = "ENGINE=InnoDB, DEFAULT CHARSET=binary";
$wgDBmysql5 = true;
$wgDBtransactions = true;

## Shared memory settings
$wgMainCacheType = 'redis';
$wgSessionCacheType = 'redis';
$wgSessionsInObjectCache = true;
$wgEnableParserCache = true;
$wgParserCacheExpireTime = 60 * 60;

# Job queue in redis
/*  # Commenting out as this seems not ready for prime time yet.
$wgJobTypeConf['default'] = array(
  'class'          => 'JobQueueRedis',
  'redisServer'    => '192.168.189.13:6379',
  'redisConfig'    => array(),
  'claimTTL'       => 3600
);
*/

## To enable image uploads, make sure the 'images' directory
## is writable, then set this to true:
$wgEnableUploads = true;
$wgUseImageMagick = true;
$wgImageMagickConvertCommand = "/usr/bin/convert";
$wgMaxShellMemory = 409600;
$wgSVGConverter = 'ImageMagick';
## allow uploading from a URL
$wgGroupPermissions['autoconfirmed']['upload_by_url'] = true;
$wgAllowCopyUploads = true;

$wgVerifyMimeType = false;
$wgFileExtensions = array_merge($wgFileExtensions, array('svg', 'pdf', 'eps', 'ai', 'psd', 'graffle', 'zip', 'kml', 'kmz', 'mp3', 'm4v', 'mp4', 'm4a', 'mov', 'wav', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'key', 'pages', 'gz', 'tgz', 'numbers', 'ttf', 'eot', 'gpx', 'otf', 'woff', 'csv' ) );

if ($myLocalTime) {
    #Set Default Timezone to localtime
    $wgLocaltimezone = "America/Chicago";
    $oldtz = getenv("TZ");
    putenv("TZ=$wgLocaltimezone");
    # Versions before 1.7.0 used $wgLocalTZoffset as hours.
    # After 1.7.0 offset as minutes
    $wgLocalTZoffset = date("Z") / 60;
    putenv("TZ=$oldtz");
    # Set date formatting to American
    $wgAmericanDates = true;
} else {
    $wgLocaltimezone = "UTC";
    $oldtz = getenv("TZ");
    putenv("TZ=$wgLocaltimezone");
    $wgLocalTZoffset = date("Z") / 60;
    putenv("TZ=$oldtz");
    $wgAmericanDates = false;
}

# InstantCommons allows wiki to use images from http://commons.wikimedia.org
# Some of my wikis use it
switch ($myInstance) {
    case "wiki.planetkubb.com":
    case "roadsignmath.com":
    case "wikinosh.com":
    case "bodwiki.com":
    $wgUseInstantCommons = true;
    break;
    default:
    $wgUseInstantCommons  = false;
}

## If you use ImageMagick (or any other shell command) on a
## Linux server, this will need to be set to the name of an
## available UTF-8 locale
$wgShellLocale = "en_US.utf8";

## If you have the appropriate support software installed
## you can enable inline LaTeX equations:
# In Mediawiki 1.18.0 this was moved out of trunk, we need an extension for it now
# http://www.mediawiki.org/wiki/Extension:Math
require_once("$IP/extensions/Math/Math.php");
$wgUseMathJax = true;
$wgDefaultUserOptions['math'] = MW_MATH_MATHJAX; // setting MathJax as default rendering option (optional)

#'/srv/www/mediawiki/public_html/w/extensions/Math/math/texvc';

## Set $wgCacheDirectory to a writable directory on the web server
## to make your wiki go slightly faster. The directory should not
## be publically accessible from the web.
$wgCacheDirectory = "/srv/www/mediawiki/cache/$myWikiToken/";
# $wgUseFileCache = true;
# $wgFileCacheDirectory = "{$wgCacheDirectory}/html";
$wgUseETag = true;
$wgCachePages = true;

# Disabling counters, front end caching in nginx makes it incorrect
$wgDisableCounters = true;
$wgUseGzip = true;

$wgEnableSidebarCache = true;

# Site language code, should be one of ./languages/Language(.*).php
$wgLanguageCode = "en";

## For attaching licensing metadata to pages, and displaying an
## appropriate copyright notice / icon. GNU Free Documentation
## License and Creative Commons licenses are supported so far.
switch ($myInstance) {
    case "wiki.thingelstad.com":
    case "scrapbook.thingelstad.com":
        # These wikis are not for sharing
        $wgRightsPage = ""; # Set to the title of a wiki page that describes your license/copyright
        $wgRightsUrl = "";
        $wgRightsText = "";
        $wgRightsIcon = "";
        # $wgRightsCode = ""; # Not yet used
        break;

        case "wiki.minnestar.org":
        # $wgEnableCreativeCommonsRdf = true;
        $wgRightsPage = ""; # Set to the title of a wiki page that describes your license/copyright
        $wgRightsUrl  = "http://creativecommons.org/licenses/by-nc/3.0/us/";
        $wgRightsText = "Creative Commons Attribution-NonCommercial 3.0 United States License";
        $wgRightsIcon = "http://i.creativecommons.org/l/by-nc/3.0/us/88x31.png";
        # $wgRightsCode = ""; # Not yet used
        # If using CC we need to include this extension. This was moved out
        # of core in 1.18.0
        # require_once("$IP/extensions/CreativeCommonsRdf/CreativeCommonsRdf.php");
        break;

        default:
        # Default is CC-BY_SA
        # $wgEnableCreativeCommonsRdf = true;
        $wgRightsPage = ""; # Set to the title of a wiki page that describes your license/copyright
        $wgRightsUrl  = "http://creativecommons.org/licenses/by-sa/3.0/";
        $wgRightsText = "Creative Commons Attribution Share Alike";
        $wgRightsIcon = "{$wgStylePath}/common/images/cc-by-sa.png";
        # $wgRightsCode = ""; # Not yet used
        # If using CC we need to include this extension. This was moved out
        # of core in 1.18.0
        # require_once("$IP/extensions/CreativeCommonsRdf/CreativeCommonsRdf.php");
    }
# Path to the GNU diff3 utility. Used for conflict resolution.
    $wgDiff = "/usr/bin/diff";
    $wgDiff3 = "/usr/bin/diff3";

    $wgShowIPinHeader = false;
    $wgMinimalPasswordLength = 8;

# Set permissions for the wiki
# Default case is that anonymous users cannot edit, but can register
    switch ($myInstance) {
        case "rwbookclub.com":
        $wgGroupPermissions['*']['edit'] = false;
        $wgGroupPermissions['*']['delete'] = false;
        $wgGroupPermissions['*']['createaccount'] = false;

        $wgGroupPermissions['bot']['upload_by_url'] = true;

        $wgGroupPermissions['Alumni'] = $wgGroupPermissions['user'];
        break;

        case "roadsignmath.com":
    # Disable anonymous editing
        $wgGroupPermissions['*']['edit'] = false;

    # Create group for elevated permissions
        $wgRestrictionLevels[] = 'editors';
        $wgGroupPermissions['editors']['autopatrol'] = true;
        $wgGroupPermissions['editors']['autoconfirmed'] = true;
        $wgGroupPermissions['editors']['skipcaptcha'] = true;
        $wgGroupPermissions['editors']['editors'] = true;
        $wgGroupPermissions['editors']['replacetext'] = true;
        $wgGroupPermissions['editors']['suppressredirect'] = true;
        $wgGroupPermissions['editors']['delete'] = true;

    # Make sure sysop are granted these rights as well
        $wgGroupPermissions['sysop']['editors'] = true;
        break;

        case "scrapbook.thingelstad.com":
        # You must be registered to even see this wiki, private
        $wgGroupPermissions['*']['read'] = false;
        case "wiki.thingelstad.com":
        # Permit only registered users to edit and add users
        $wgGroupPermissions['*']['edit'] = false;
        $wgGroupPermissions['*']['delete'] = false;
        $wgGroupPermissions['*']['createaccount'] = false;
        break;

        case "filament.thingelstad.com":
        # Permit only registered users to edit and add users
        $wgGroupPermissions['*']['edit'] = false;
        $wgGroupPermissions['*']['delete'] = false;
        $wgGroupPermissions['*']['createaccount'] = false;

        # Setup editor group
        $wgGroupPermissions['editors']['autopatrol'] = true;
        $wgGroupPermissions['editors']['autoconfirmed'] = true;
        $wgGroupPermissions['editors']['skipcaptcha'] = true;
        $wgGroupPermissions['editors']['editors'] = true;
        $wgGroupPermissions['editors']['replacetext'] = true;

        break;

        case "wiki.minnestar.org":
        $wgGroupPermissions['board']['board-edit'] = true;  // allow members of board group to edit pages in Board namespace
        $wgGroupPermissions['*']['board-talk-edit'] = true; // allow any registered user to edit talk pages for board space
        break;

        case "wikiapiary.com":
        # Disable anonymous editing
        $wgGroupPermissions['*']['edit'] = false;

        # Create new restriction levels for protecting pages
        $wgRestrictionLevels[] = 'editors';
        $wgRestrictionLevels[] = 'operators';

	# Regular users
	$wgGroupPermissions['user']['move'] = false;

        # Trusted users
        $wgGroupPermissions['trusted-users']['autopatrol'] = true;
        $wgGroupPermissions['trusted-users']['autoconfirmed'] = true;
        $wgGroupPermissions['trusted-users']['skipcaptcha'] = true;

        # Setup editor group
        $wgGroupPermissions['editors']['autopatrol'] = true;
        $wgGroupPermissions['editors']['autoconfirmed'] = true;
        $wgGroupPermissions['editors']['skipcaptcha'] = true;
        $wgGroupPermissions['editors']['editors'] = true;
        $wgGroupPermissions['editors']['replacetext'] = true;
        $wgGroupPermissions['editors']['delete'] = true;
       	$wgGroupPermissions['editors']['move'] = true;
	$wgGroupPermissions['editors']['suppressredirect'] = true;

        # Setup operator group
        $wgGroupPermissions['operators']['autopatrol'] = true;
        $wgGroupPermissions['operators']['operators'] = true;
        $wgGroupPermissions['operators']['suppressredirect'] = true;

        # Make sure sysop are granted these rights as well
        $wgGroupPermissions['sysop']['editors'] = true;
        $wgGroupPermissions['sysop']['operators'] = true;

        break;

        case "wiki.planetkubb.com":
        case "foreground.thingelstad.com":
        # Disable anonymous editing
        $wgGroupPermissions['*']['edit'] = false;

        # Create new restriction levels for protecting pages
        $wgRestrictionLevels[] = 'editors';
        $wgRestrictionLevels[] = 'coders';

        # Autochecked users
        $wgGroupPermissions['trusted-users']['autopatrol'] = true;
        $wgGroupPermissions['trusted-users']['autoconfirmed'] = true;
        $wgGroupPermissions['trusted-users']['skipcaptcha'] = true;

        # Setup editor group
        $wgGroupPermissions['editors']['autopatrol'] = true;
        $wgGroupPermissions['editors']['autoconfirmed'] = true;
        $wgGroupPermissions['editors']['skipcaptcha'] = true;
        $wgGroupPermissions['editors']['editors'] = true;
        $wgGroupPermissions['editors']['replacetext'] = true;
        $wgGroupPermissions['editors']['suppressredirect'] = true;
        $wgGroupPermissions['editors']['delete'] = true;

        # Setup editor group
        $wgGroupPermissions['Coders']['coders'] = true;


        # Make sure sysop are granted these rights as well
        $wgGroupPermissions['sysop']['editors'] = true;
        $wgGroupPermissions['sysop']['coders'] = true;

        break;

        default:
        $wgGroupPermissions['*']['edit'] = false;
    }

# Query string length limit for ResourceLoader. You should only set this if
# your web server has a query string length limit (then set it to that limit),
# or if you have suhosin.get.max_value_length set in php.ini (then set it to
# that value)
    $wgResourceLoaderMaxQueryLength = -1;

# Enable adminlinks
    include_once("$IP/extensions/AdminLinks/AdminLinks.php");

# There may be some SMW specific config we need to deal with
$smwgRSSWithPages = false; # In RSS feeds only display the link, don't encode the content of the wiki page
$smwgAdminRefreshStore = false; # Do not allow a refresh to be requested via the web interface
$smwgPageSpecialProperties[] = '_CDAT';
$smwgPageSpecialProperties[] = '_LEDT';
$smwgQUpperbound = 30000;
$smwgQMaxLimit = 30000;
$smwgQueryProfiler = array(
    'smwgQueryDurationEnabled' => true,
    );
switch ($myInstance) {
    case "rwbookclub.com":
    $smwgNamespacesWithSemanticLinks[NS_MEETING] = true;
    $smwgQEqualitySupport = SMW_EQ_NONE;
    break;

    case "wikiapiary.com":
    $sfgAutoCreateUser = 'Bumble Bee';
    $smwgQEqualitySupport = SMW_EQ_NONE;
    $smwgNamespacesWithSemanticLinks[NS_EXTENSION] = true;
    $smwgNamespacesWithSemanticLinks[NS_FARM] = true;
    $smwgNamespacesWithSemanticLinks[NS_SKIN] = true;
    $smwgNamespacesWithSemanticLinks[NS_ISSUE] = true;
    $smwgNamespacesWithSemanticLinks[NS_GENERATOR] = true;
    $smwgNamespacesWithSemanticLinks[NS_HOST] = true;
    $smwgNamespacesWithSemanticLinks[NS_LIBRARY] = true;

    # Set Semantic Tags configuration
    $GLOBALS['smtgTagsPropertyFallbackUsage'] = true;
    $GLOBALS['smtgTagsProperties'] = array(
	// Standard meta tags
	'keywords' => 'Has tag',
	'description' => array('Has description', 'Has tagline'),
	'author' => 'Page author',

	// Twitter Cards
	'twitter:title' => 'Has name',
	'twitter:image' => 'Has image URL',
	'twitter:description' => array('Has description', 'Has tagline'),

	// Open Graph protocol supported tags
	'og:title' => 'Has name',
	'og:image' => 'Has image URL',
	'og:description' => array('Has description', 'Has tagline'),
    );

    $GLOBALS['smtgTagsStrings'] = array(
	// Static tags
	'twitter:card' => 'summary',
	'twitter:site' => '@WikiApiary',
	'og:site_name' => 'WikiApiary'
    );
    break;

    case "tosredux.org":
    $smwgNamespacesWithSemanticLinks[NS_ORGANIZATION] = true;
    break;

    case "bodwiki.com":
    $smwgNamespacesWithSemanticLinks[NS_COMPANY] = true;
    $smwgNamespacesWithSemanticLinks[NS_ISSUE] = true;
    break;

    case "wiki.planetkubb.com":
    $sfgAutoCreateUser = 'KubbBot';
    $smwgNamespacesWithSemanticLinks[NS_PLAYER] = true;
    $smwgNamespacesWithSemanticLinks[NS_TEAM]  = true;
    $smwgNamespacesWithSemanticLinks[NS_GAME] = true;
    $smwgNamespacesWithSemanticLinks[NS_CLUB] = true;
    $smwgNamespacesWithSemanticLinks[NS_EVENT] = true;
    $smwgNamespacesWithSemanticLinks[NS_ISSUE] = true;
    break;

    case "wiki.minnestar.org":
    $sfgAutoCreateUser = 'Minnebot';
    $smwgNamespacesWithSemanticLinks[NS_BOARD] = true;
    break;

}

enableSemantics("$myInstance");

# Now with composer: require_once( "$IP/extensions/SemanticExtraSpecialProperties/SemanticExtraSpecialProperties.php" );
$GLOBALS['sespSpecialProperties'] = array(
    '_PAGEID',     // Let's get a Page ID
    '_CUSER',      // Creating user
    '_EUSER',      // All contributing users
    '_NREV',       // Number of revisions to page
    '_TNREV',      // Number of revisions to talk page
    '_SUBP',       // Add properties for subpages as well
    '_USERREG'     // Add the date the user registered
    );
$sespUseAsFixedTables = True;  // Use fixed properties
$wgSESPExcludeBots = true;     // Exclude bots from user stuff, except for creating user

$wgUseAjax = true;

include_once("$IP/extensions/SemanticForms/SemanticForms.php");
#$sfgRenameEditTabs = true;
$sfgRenameMainEditTab = true;

require_once("$IP/extensions/SemanticFormsInputs/SemanticFormsInputs.php");
$sdgNamespaceIndex = 170;

$srfgArraySep = "\n";
$srfgArrayPropSep = ',';

# Enable Semantic Compound Queries
include_once( "$IP/extensions/SemanticCompoundQueries/SemanticCompoundQueries.php" );

include_once("$IP/extensions/ExternalData/ExternalData.php");
switch ($myInstance) {
    case "wikiapiary.com":
    $edgDBServer['apiary'] = "db-local";
    $edgDBServerType['apiary'] = "mysql";
    $edgDBName['apiary'] = "apiary";
    $edgDBUser['apiary'] = "apiary";
    $edgDBPass['apiary'] = $SECRET_EXTDATADBPASSWORD;
    break;
}

require_once("$IP/extensions/ApprovedRevs/ApprovedRevs.php");
include_once("$IP/extensions/DataTransfer/DataTransfer.php");
require_once("$IP/extensions/ReplaceText/ReplaceText.php" );
require_once( "$IP/extensions/Arrays/Arrays.php" );
# HashTables
require_once( "$IP/extensions/HashTables/HashTables.php" );
# Loops
require_once( "$IP/extensions/Loops/Loops.php" );
ExtLoops::$maxLoops = 1000;

# Bundled in core in 1.23
require_once("$IP/extensions/CSS/CSS.php");
require_once("$IP/extensions/ParserFunctions/ParserFunctions.php" );
$wgPFEnableStringFunctions = true;

# Regex Fun
require_once( "$IP/extensions/RegexFun/RegexFun.php" );

require_once( "$IP/extensions/Variables/Variables.php" );
$wgVectorFeatures['vector-collapsiblenav']['global'] = true;
$wgVectorFeatures['expandablesearch']['global'] = false;
$wgVectorUseSimpleSearch = true;

require_once("$IP/extensions/Nuke/Nuke.php");

# We only load these spam prevention extensions if the wiki allows open registration
# Wikis that are invite only don't really need this.
# TODO: Move to a module
function DenyRegistrationByEmail( $user, &$message ) {
    $emailAddr = $user->getEmail();
    if (preg_match( '/@yopmail\.com$/', $emailAddr ) OR
        preg_match( '/@mailinator\.com$/', $emailAddr ) OR
        preg_match( '/@emailmiser\.com$/', $emailAddr ) ) {
        $message =  'The email address ' . $emailAddr . ' is banned on this wiki. Please register with a different address.';
    return false;
}
return true;
}

function DenyRegistrationByUsername( $user, &$message ) {
    $username = $user->getName();
    if (preg_match( '/^Rayban/', $username ) OR preg_match( '/^Oakley/', $username ) ) {
        $message = 'The username ' . $username . ' is banned on this wiki.';
        return false;
    }
    return true;
}

if ( !$myClosedWiki) {
    # Block certain email addresses from registering
    $wgHooks['AbortNewAccount'][] = 'DenyRegistrationByEmail';
    $wgHooks['AbortNewAccount'][] = 'DenyRegistrationByUsername';

    # main thing to deal with spammers
    require_once( "$IP/extensions/ConfirmEdit/ConfirmEdit.php" );
    require_once("$IP/extensions/ConfirmEdit/QuestyCaptcha.php");
    $wgCaptchaClass = 'QuestyCaptcha';

    # Set number question for questy
    # sudo pear install channel://pear.php.net/Numbers_Words-0.16.2
    # http://pear.php.net/package-info.php?package=Numbers_Words 
    require_once("Numbers/Words.php");

    $myChallengeNumber = rand(0, 899999999) + 100000000;
    $myChallengeString = (string)$myChallengeNumber;
    $num_words = new Numbers_Words();
    $myChallengeStringLong = $num_words->toWords($myChallengeNumber);
    $myChallengeIndex = rand(0, 8) + 1;

    $myChallengePositions = array (
        'first',
        'second',
        'third',
        'fourth',
        'fifth',
        'sixth',
        'seventh',
        'eighth',
        'ninth'
    );
    $myChallengePositionName = $myChallengePositions[$myChallengeIndex - 1];

    $wgCaptchaQuestions[] = array (
        'question' => "What is the $myChallengePositionName digit of the number <strong>$myChallengeStringLong</strong>?",
        'answer' => $myChallengeString[$myChallengeIndex - 1]
    );

    # $wgCaptchaQuestions[] = array( 'question' => "", 'answer' => "" );
    # Skip CAPTCHA for people who have confirmed emails
    $wgGroupPermissions['emailconfirmed']['skipcaptcha'] = true;
    $ceAllowConfirmedEmail = true;
}

# Setup the contact page extension
require_once( "$IP/extensions/ContactPage/ContactPage.php" );
$wgContactConfig['default'] = array(
    'RecipientUser' => 'thingles', // Must be the name of a valid account
    'SenderEmail' => $wgPasswordSender,
        'SenderName' => $wgSitename . ' contact form', // "Contact Form on" needs to be localised 
        'RequireDetails' => true,
        'IncludeIP' => true,
        'AdditionalFields' => array(
            'Text' => array(
                'label-message' => 'emailmessage',
                'type' => 'textarea',
                'rows' => 20,
                'cols' => 80,
                'required' => true,
                ),
            ),
        );

# Now lets put a link in the bottom to the contact page
# docs on this at http://www.mediawiki.org/wiki/Manual:Footer
$wgHooks['SkinTemplateOutputPageBeforeExec'][] = 'lfFeedbackLink';
function lfFeedbackLink( $sk, &$tpl ) {
    $tpl->set( 'feedback', $sk->footerLink( 'feedback', 'feedbackpage' ) );
    $tpl->data['footerlinks']['places'][] = 'feedback';
    return true;
}

require_once("$IP/extensions/UserMerge/UserMerge.php" );
$wgGroupPermissions['bureaucrat']['usermerge'] = true;
$wgUserMergeProtectedGroups = array( 'sysop' );

require_once("$IP/extensions/Number2Words/Number2Words.php");
require_once("$IP/extensions/ParseURL/ParseURL.php");

# Add HeaderTabs
# http://www.mediawiki.org/wiki/Extension:Header_Tabs
# First declare some configuration params
require_once("$IP/extensions/HeaderTabs/HeaderTabs.php");
$htRenderSingleTab = true;
$htEditTabLink = false;

require_once("$IP/extensions/Poem/Poem.php");
require_once("$IP/extensions/Interwiki/Interwiki.php");
$wgGroupPermissions['*']['interwiki'] = false;
$wgGroupPermissions['sysop']['interwiki'] = true;
require_once("$IP/extensions/Cite/Cite.php");

require_once("$IP/extensions/DynamicPageList/DynamicPageList.php");
require_once("{$IP}/extensions/CategoryTree/CategoryTree.php");
$wgCategoryTreeMaxDepth = array(CT_MODE_PAGES => 2, CT_MODE_ALL => 2, CT_MODE_CATEGORIES => 5);

# enable more robust PDF handling
# DISABLE due to bug when using 1.21
# https://bugzilla.wikimedia.org/show_bug.cgi?id=48834
require_once("$IP/extensions/PdfHandler/PdfHandler.php");
$wgPdfProcessor = 'gs';
$wgPdfPostProcessor = $wgImageMagickConvertCommand;
$wgPdfInfo = 'pdfinfo';

require_once( "$IP/extensions/Gadgets/Gadgets.php" );

require_once( "$IP/extensions/WikiEditor/WikiEditor.php" );
$wgDefaultUserOptions['usebetatoolbar'] = 1;
$wgDefaultUserOptions['usebetatoolbar-cgd'] = 1;
$wgDefaultUserOptions['wikieditor-preview'] = 1;

require_once("$IP/extensions/Renameuser/Renameuser.php");

require_once("$IP/extensions/InputBox/InputBox.php");

require_once( "$IP/extensions/MyVariables/MyVariables.php" );

if ( !$myClosedWiki) {
    # Activate NewUserMessage
    # https://www.mediawiki.org/wiki/Extension:NewUserMessage
    # http://wikiapiary.com/wiki/Extension:NewUserMessage
    require_once( "$IP/extensions/NewUserMessage/NewUserMessage.php" );
}

# Activate UrlGetParameters
# http://www.mediawiki.org/wiki/Extension:UrlGetParameters
# http://wikiapiary.com/wiki/Extension:UrlGetParameters
require_once( "$IP/extensions/UrlGetParameters/UrlGetParameters.php" );

require_once("$IP/extensions/Widgets/Widgets.php");
$wgGroupPermissions['sysop']['editwidgets'] = true;

# Enable NOCACHE magic word extension
# http://www.mediawiki.org/wiki/Extension:MagicNoCache
require_once("$IP/extensions/MagicNoCache/MagicNoCache.php");


$wgFooterIcons['servedby']['linode'] = array(
    "src" => "/served-by-linode.png",
    "url" => "http://www.linode.com/?r=d246dc8e9e305eefce68376a1a7a0b3e73dfa992",
    "alt" => "Served by Linode",
    );
$wgFooterIcons['servedby']['mariadb'] = array(
    "src" => "/mariadb-badge-88x31.png",
    "url" => "https://mariadb.org",
    "alt" => "Powered by MariaDB",
    );

# If a WikiApiary URL is set, add it to the footer
if (isset($myWikiApiaryURL)) {
    $wgFooterIcons['monitoredby']['wikiapiary'] = array(
        "src" => "https://wikiapiary.com/w/images/wikiapiary/b/b4/Monitored_by_WikiApiary.png",
        "url" => "$myWikiApiaryURL?pk_campaign=FooterIcon&pk_kwd=$myInstance",
        "alt" => "Monitored by WikiApiary"
        );
}

require_once("$IP/extensions/ApiSandbox/ApiSandbox.php");

# Enable Echo notifications
require_once( "$IP/extensions/Echo/Echo.php" );
$wgEchoUseJobQueue = True;
require_once( "$IP/extensions/Thanks/Thanks.php" );
# Enable the Thank interface for bot edits (disabled by default)
$wgThanksSendToBots = true;

require_once("$IP/extensions/SyntaxHighlight_GeSHi/SyntaxHighlight_GeSHi.php");
require_once( "$IP/extensions/CodeEditor/CodeEditor.php" );

require_once("$IP/extensions/Disambiguator/Disambiguator.php");

# Enable Lua scripting
# TODO: PK wiki currently uses the 828/829 namespaces. Scribunto is hardcoded to use those namespaces.
if ($myWikiToken != 'planetkubb') {
    require_once( "$IP/extensions/Scribunto/Scribunto.php" );
    $wgScribuntoDefaultEngine = 'luastandalone';
    $wgScribuntoUseGeSHi = true;
    $wgScribuntoUseCodeEditor = true;
}

# Only enable this when needed
require_once("$IP/extensions/BlockandNuke/BlockandNuke.php");
#$wgWhitelist = "$IP/extensions/BlockandNuke/whitelist.txt";
$wgWhitelist = "http://wikinosh.com/w/extensions/BlockandNuke/whitelist.txt";
$wgBaNSpamUser = "Spammer";

# ParserHooks
# required by SubPageList
require_once( "$IP/extensions/ParserHooks/ParserHooks.php" );

# SubPageList
require_once( "$IP/extensions/SubPageList/SubPageList.php" );

# pChart
require_once( "$IP/extensions/pChart4mw/pChart4mw.php" );

require_once( "$IP/extensions/Babel/Babel.php" );
require_once( "$IP/extensions/cldr/cldr.php" );

require_once( "$IP/extensions/CleanChanges/CleanChanges.php" );
$wgCCTrailerFilter = true;
$wgCCUserFilter = false;
$wgDefaultUserOptions['usenewrc'] = 1;

# Turn i18 tags into real words
require_once( "$IP/extensions/I18nTags/I18nTags.php" );

# Translate extension setup
require_once( "$IP/extensions/Translate/Translate.php" );
$wgGroupPermissions['translator']['translate'] = true;
$wgGroupPermissions['user']['translate'] = true;
$wgGroupPermissions['user']['translate-messagereview'] = true;
$wgGroupPermissions['user']['translate-groupreview'] = true;
$wgGroupPermissions['user']['translate-import'] = true;
$wgGroupPermissions['sysop']['pagetranslation'] = true;
$wgGroupPermissions['sysop']['translate-manage'] = true;
$wgTranslateDocumentationLanguageCode = 'qqq';
$wgExtraLanguageNames['qqq'] = 'Message documentation'; # No linguistic content. Used for documenting messages

require_once( "$IP/extensions/UniversalLanguageSelector/UniversalLanguageSelector.php" );

# Localisation Update (part of MLEB)
require_once( "$IP/extensions/LocalisationUpdate/LocalisationUpdate.php" );
$wgLocalisationUpdateDirectory = "$IP/cache";

# Activate Semantic Rating
require_once( "$IP/extensions/SemanticRating/SemanticRating.php" );

# END
