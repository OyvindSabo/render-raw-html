# Render Raw HTML

A plugin for WordPress that enables you to serve a single HTML document, e.g. a single-page application, without interference from themes or global styles.

## Description

The Render Raw HTML plugin makes it easy to use your WordPress instance to serve a single HTML document, like a single-page application, without the interference from themes or global styles one would get by trying to embed it into a WordPress post or page. Using WordPress to serve a single page application retains the advantage of having access to a rich variety of admin plugins, while still giving you full control to code your own content.

The simple interface of the Render Raw HTML plugin gives you a single textarea where you can paste your HTML (including inlined styles and scripts). This and only this HTML will be displayed when visiting any URL of your page (except for pages like /wp-login.php and /wp-admin/).

## Installation

1. Install Render Raw HTML by uploading the `render-raw-html` directory to the `/wp-content/plugins/` directory. Alternatively, you can download this repository and zip it. Then, in your WordPress instance, go to Plugins > Add New > Upload Plugin, and upload the zipped repository.
2. Activate Render Raw HTML through the Plugins menu in WordPress.
3. Insert code in your header or footer by going to the `Settings > Render Raw HTML` menu.

## Frequently Asked Questions

### Can I display different html documents for different routes?

No. This plugin mainly targets single page applications. Any routing will have to be handled on the front-end by the single page application, for instance through hash-based routing.

### How can I get to the admin dashboard when the toolbar is not visible?

You can navigate to the admin dashboard or the login page by navigating to /wp-admin/ or /wp-login.php respectively. For instance, if the URL of your website is https://example.com, you can navigate to the admin dashboard or login page by navigating to https://example.com/wp-admin/ or https://example.com/wp-login.php respectively.

## Screenshots

Coming soon. Probably. Maybe.
