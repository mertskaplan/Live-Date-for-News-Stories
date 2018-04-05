=== Plugin Name ===
Contributors: mertskaplan
Donate link: https://mertskaplan.com/iletisim
Tags: news, date
Requires at least: 4.6
Tested up to: 4.9.4
Stable tag: 4.3
Requires PHP: 5.2.4
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Dynamic "when" information for news stories according to visitor's timeline.

== Description ==

You can use live date information prepared in accordance with news writing rules in news stories. For instance; "yesterday" expression in the "The Italian Foreign Ministry said in the press statement **yesterday** that history and culture...", will automatically be arranged according to the time of the visitor and news release like as "the days we passed", "last week" or "last month".

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Use the short code and enjoy it.

== Using ==

1. Enter the date and time (or just date) between `[liveDate4news][/liveDate4news]` tags in "little-endian" format. Ex: `[liveDate4news]15.03.2018 16:41[/liveDate4news]`
2. If you want time information to begin with capital letters, enter the value "capital" into the tag like as `[liveDate4news capital]4/11/2018[/liveDate4news]`
