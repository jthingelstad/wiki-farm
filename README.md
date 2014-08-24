This repository stores the LocalSettings structure that I use for [my MediaWiki farm](https://wikiapiary.com/wiki/Farm:Thingelstad.com).

The structure of this is pretty straightforward. The overall configuration for [MediaWiki](https://www.mediawiki.org/) is kept in [LocalSettings.php](https://www.mediawiki.org/wiki/Manual:LocalSettings.php) which should be a symlink from the main MediaWiki directory. This file will then pull things from:

* `wiki` where the core configuration for various wikis is kept
* `secrets` which are simple PHP files to store secret passwords that are not committed to source control
* `modules` which are grouping of settings to enable certain capabilities

### Why Share This?

[Running a MediaWiki farm](https://www.mediawiki.org/wiki/Manual:Wiki_family) isn't very well documented. What documentation exists has some major gaps. I think the structure I've put together to doing this is pretty simple and easy to manage and others running farms might benefit from it.

