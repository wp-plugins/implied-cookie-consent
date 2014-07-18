=== Implied Cookie Consent ===
Contributors: Senktec
Tags: cookie law, cookie warning, cookie consent
Tested up to: 3.9.1
Requires at least: 3.0.1
Stable tag: 1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html


== Description ==

This plugin displays an unobtrusive information bar at the top of the page informing the user about the site's use of cookies. This approach follows an implied consent model. It doesn't explicitly ask the user for consent before placing cookies, it merely infoms them about the use of cookies. When the user navigates to a second page or clicks on the dismiss button, the bar is hidden. This approach is similar to that used on many government websites including gov.uk. 

The plugin has settings in the admin which allows the colour and content of the information bar to be customised.

An example cookie information page will be created on installation of the plugin. It is up to you to correctly populate the text on that page.

= Why another cookie plugin? =

There are many WordPress cookie plugins available but none of them seemed to do what I wanted. They typically tend to provide a very intrusive experience for the user (e.g. via modal popups), or are too complex to configure.

= Technical Details =

This plugin uses jQuery (JavaScript) to show and hide the information bar. A cookie is stored via the jQuery Cookie Plugin (included with this plugin) to track that the message has been displayed and does not need to be shown on each subsequent page view. 


== Installation ==

1. Install this plugin in the usual way in 'wp-content/plugins'.
2. Customise the info bar message and colour via the settings page.
3. Customise the cookie information page.


== Frequently Asked Questions ==

= Can I do additional styling of the cookie info bar in CSS? =

Yes, you can get a handle via the 'icc_message' CSS ID:

`#icc_message {
    color: green;	
}`


= Does this plugin analyse the cookies my site uses? =

No. A cookies page with example information is created on installation of the plugin, but it is up to you to determine which cookies are used on your site and ensure the content on the page is appropriate.


= Do I have to use the cookies page the plugin creates? =

No, absolutely not. Create your own page wherever you like and update the cookie info bar message in the settings to link to the correct page.


= Does installing this plugin guarantee compliance with the EU Cookie Law? =

No. The plugin author can't provide any guarantee that installing this plugin will make your site compliant with the EU Cookie Law. You should verify that the consent model used here is appropriate for your site.


== Screenshots ==

1. The information bar in the page header.
2. Admin settings.


== Upgrade Notice ==

= 1.1 =
Improve support for multi-language.

= 1.0 =
First version of this plugin.


== Changelog ==

= 1.1 =
* Improve support for i18n.
* Add POT file.

= 1.0 =
* First version of this plugin.
* Updates to readme.txt.

