<?php
require_once('class-sl-activation.php');
require_once('class-sl-shortcode.php');
require_once('class-sl-formhandler.php');
require_once('class-sl-settings.php');
require_once('class-sl-metafields.php');
require_once('class-sl-posttype.php');
require_once('class-sl-dependencies.php');

/**
* Primary Plugin Class
*/
class SL_SimpleLocator {

	function __construct()
	{
		$this->init();
		$this->form_action();
		add_filter( 'plugin_action_links_' . 'wp-simple-locator/simplelocator.php', array($this, 'settings_link' ) );
		add_action('init', array($this, 'add_localization') );
	}


	/**
	* Initialize
	*/
	public function init()
	{
		new SL_Activation;
		new SL_Dependencies;
		new SL_PostType;
		new SL_MetaFields;
		new SL_Settings;
		new SL_Shortcode;
	}


	/**
	* Set Form Action & Handler
	*/
	public function form_action()
	{
		if ( is_admin() ) {
			add_action( 'wp_ajax_nopriv_locate', 'wpsl_form_handler' );
			add_action( 'wp_ajax_locate', 'wpsl_form_handler' );
		}
	}


	/**
	* Add a link to the settings on the plugin page
	*/
	public function settings_link($links)
	{ 
  		$settings_link = '<a href="options-general.php?page=wp_simple_locator">Settings</a>'; 
  		array_unshift($links, $settings_link); 
  		return $links; 
	}


	/**
	* Localization Domain
	*/
	public function add_localization()
	{
		load_plugin_textdomain('wpsimplelocator', false, 'wpsimplelocator' . '/languages' );
	}

}