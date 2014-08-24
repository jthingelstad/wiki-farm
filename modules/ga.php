<?php
# Protect against web entry
if ( !defined( 'MEDIAWIKI' ) ) {
    exit;
}

$wgHooks['SkinAfterBottomScripts'][] = 'lfGoogleAnalytics';
function lfGoogleAnalytics ( $sk, &$text ) {
    global $wgGoogleAnalyticsAccount;
    if ( $sk->getUser()->isAllowed('noanalytics') ) {
        $text .= "<!-- Google Analytics code omitted -->\n";
        return true;
    }
    $text .= <<<GASCRIPT
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', '$wgGoogleAnalyticsAccount', 'auto');
  ga('require', 'displayfeatures');
  ga('send', 'pageview');
</script>
GASCRIPT
    ;

    return true;

}

