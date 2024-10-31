=== Native RSS ===

Contributors: tepelstreel
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=GTBQ93W3FCKKC
Tags: RSS feed, RSS, feed, language, language settings, settings, SEO, native WP
Requires at least: 2.7
Tested up to: 4.5
Stable tag: 2.3

Changes the <language> tag of your feeds to the language you are publishing in.

== Description ==

The RSS-language will change the <language> tag of your feeds from the default ('en') to the language of your WP installation by default. In case you are e.g. using French as the WP language, but want to publish in Dutch, you can change the language in the settings section. Nothing specific will change in the feed but your blog will be found easier by people using the language, you are actually writing in. Also it helps search engines to list your site correcly, if you provide the feed as a sitemap. 

The plugin was tested up to WP 3.4 and should work with versions down to 2.7 but was never tested with those.

== Installation ==

1. Upload the `rss-language` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Customize if nessecary

== Frequently Asked Questions ==

= I want to change the language to Brazilian Portuguese, but the plugin doesn't let me do this =

The setting for the 'rss_language' in the options table has to be ISO two-letter language code. So Portuguese is allowed, but not the Brazilian.

= I activated the plugin and still in the feed the language is displayed as 'en' =

Empty the cache of your browser in that case. And reload the feed. The language should have changed now.

== Screenshots ==

1. Feed sourcecode
2. Settings

== Changelog ==

= 2.3 =

* Serbo-Croatian translation added thanks to [Andrijana Nikolic](http://webhostinggeeks.com/)

= 2.2 =

* WP 4.1 ready

= 2.1 =

* Small bugfix

= 2.0 =

* Added some functionality to admin bar in WP 3.3beta (obsolete)

= 1.0 =

* Initial release

== Upgrade Notice ==

= 1.0 = 

Nothing so far

= 2.0 =

Functionality for WP 3.3 added

= 2.1 =

Small bugfix

= 2.2 =

WP 4.1 ready

= 2.3 =

Serbo-Croatian translation added