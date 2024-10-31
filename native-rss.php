<?php
/*
Plugin Name: Native RSS
Plugin URI: http://wasistlos.waldemarstoffel.com/plugins-fur-wordpress/native-rss
Description: This plugin will change the language tag of the blogfeeds from "en" to the native language of your WP-installation by default. You can however, change the feed-language in the settings, e.g. if your blog is running in french, but you publish in dutch. Nothing specific will change in the feed but your blog will be found easier by people using the language, you are actually writing in. Also it helps search engines to list your site correcly, if you provide the feed as a sitemap. 
Version: 2.3
Author: Stefan Crämer
Author URI: http://www.stefan-craemer.com
License: GPL3
Text Domain: native-rss
Domain Path: /languages
*/

/*  Copyright 2011 - 2016 Stefan Crämer  (email : support@atelier-fuenf.de)

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.

*/


/* Stop direct call */

defined('ABSPATH') OR exit;

class NativeRSS {
	
	const language_file = 'native-rss';
	
	function NativeRSS() {
		
		// import laguage files

		load_plugin_textdomain(self::language_file, false , basename(dirname(__FILE__)).'/languages');
		
		//Additional links on the plugin page

		add_filter('plugin_row_meta', array($this, 'nrs_register_links'),10,2);
		add_filter('plugin_action_links', array($this, 'nrs_plugin_action_links'),10,2);
		add_action('admin_init', array($this, 'native_rss_init'));
		register_activation_hook(__FILE__, array($this, 'set_language'));
		register_deactivation_hook(__FILE__, array($this, 'unset_language'));
		add_action('admin_menu', array($this, 'nrs_admin_menu'));
		
	}
	
	function nrs_register_links($links, $file) {
		
		$base = plugin_basename(__FILE__);
		if ($file == $base) :
			
			$links[] = '<a href="http://wordpress.org/extend/plugins/native-rss/faq/" target="_blank">'.__('FAQ', self::language_file).'</a>';
			$links[] = '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=GTBQ93W3FCKKC" target="_blank">'.__('Donate', self::language_file).'</a>';
		
		endif;
		
		return $links;
	
	}
	
	function nrs_plugin_action_links( $links, $file ) {
		
		$base = plugin_basename(__FILE__);
		
		if ($file == $base) array_unshift($links, '<a href="'.admin_url( 'options-general.php?page=set-feed-language' ).'">'.__('Settings', self::language_file).'</a>');
	
		return $links;
	
	}

	// init
	
	function native_rss_init() {
		
		register_setting( 'rss_language', 'rss_language', array($this, 'nrs_validate') );
		
		add_settings_section('native_rss_setting', __('Language settings', self::language_file), array($this, 'nrs_display_section'), 'new_rss_language');
		
		add_settings_field('feed_language', __('Language:', self::language_file), array($this, 'nrs_display_field'), 'new_rss_language', 'native_rss_setting');
	
	}
	
	function nrs_display_section() {
		
		echo '<p>'.__('Please give the two-letter ISO code of your language.', self::language_file).'</p>';
	
	}
	
	function nrs_display_field() {
		
		$rss_language = get_option('rss_language');
		
		echo '<input id="feed_language" name="rss_language" size="4" type="text" value="'.$rss_language.'" />';
		
	}

	// Setting the RSS <language> tag to the blog's default language on activation and customize if necessary
	
	function set_language() {
		
		$new_rss_language = substr(get_bloginfo('language'),0,2 );
		
		update_option('rss_language', $new_rss_language);
		
	}

	// Setting the RSS <language> tag back to english on deactivation
	
	function unset_language() {
		
		update_option('rss_language', 'en');
		
	}

	// Installing options page
	
	function nrs_admin_menu() {
		
		add_options_page('Native RSS', 'Native RSS', 'administrator', 'set-feed-language', array($this, 'nrs_options_page'));
		
	}

	// Calling the options page
	
	function nrs_options_page() {
		
		?>
		
		<div class="wrap">
        <a href="<?php _e('http://wasistlos.waldemarstoffel.com/plugins-fur-wordpress/native-rss-plugin'); ?>"><div id="a5-logo" class="icon32" style="background: url('<?php echo plugins_url('native-rss/img/a5-logo.png');?>');"></div></a>
		<h2>Native RSS</h2>
		<?php _e('Customize the &#60;language&#62; tag of your feeds.', self::language_file); ?>
		
		<form action="options.php" method="post">
		
		<?php settings_fields('rss_language'); ?>
		<?php do_settings_sections('new_rss_language'); ?>
		
		<?php submit_button(); ?>
		</form></div>
		
		<?php
	}

	function nrs_validate($input) {
		
		$newinput = trim($input);
		
		$language = get_option('rss_language');
		
		if(!preg_match('/^[a-z]{2}$/i', $newinput)) :
			
			add_settings_error('native_rss_setting', 'native-rss-error', __('Please give the two-letter ISO code of your language.', self::language_file), 'error');
			
			return $language;
			
		endif;
	
	return $newinput;
	
	}

}

$native_rss = new NativeRSS;


?>