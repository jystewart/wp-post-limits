=== WP Post Limits ===
Contributors: jystewart
Tags: limitations, cms, users
Requires at least: 2.7.0
Tested up to: 2.9.2
Stable tag: trunk
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=10973638

Restrict the number of posts users can make depending on their role

== Description ==

When running wordpress for short term projects, contests, etc. it can be useful to be able
to define a limit on the number of posts a given user can make. This plugin allows admins to
define limits on a per-role basis.

Say you wanted 'authors' to be limited to 5 posts and 'contributors' to just 1, this plugin is
the way to do it.

Please Note: This plugin is only tested on PHP5 and may not work on earlier versions.

== Installation ==

1. Upload `wp-post-limits` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to the Post Limits option under Settings and make the appropriate entries

== Frequently Asked Questions ==

There are no frequently asked questions as yet.

== Screenshots ==

1. The settings page in use

== Upgrade Notice ==

No upgrade steps necessary

== To Do ==
* Add automated tests
* Solicit user feedback on further options

== Changelog ==

= 1.0.1 =
* Add warning if plugin is run on PHP4

= 1.0 =
* Consolidated code in use in various projects
* Prepared for first release
