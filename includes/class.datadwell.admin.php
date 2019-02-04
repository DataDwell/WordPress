<?php

if(!defined('ABSPATH') )
{
	exit;
}

class DataDwellAdmin {

    private static $_instance = null;
    private $file;
    private $dir;

	/**
	 * Constructor function.
	 */
    public function __construct($file = '')
    {
        $this->file = $file;
        $this->dir = dirname($this->file);

		// Filters
        add_filter('plugin_action_links_' . plugin_basename($this->file), [$this, 'add_options_link']);

        // Menu Items
        add_action('admin_menu', [$this, 'add_menu_item']);

        if(array_key_exists('datadwell_domain', $_REQUEST)) {
            update_option('datadwell_domain', $_REQUEST['datadwell_domain']);
            update_option('datadwell_apikey', $_REQUEST['datadwell_apikey']);
        }

    }

	/**
	 * Add settings page to admin menu
	 */
	public function add_menu_item() {
		add_options_page( __( 'Data Dwell', 'datadwell' ), __( 'Data Dwell', 'datadwell' ), 'manage_options', 'datadwell-settings', [$this, 'page_settings']);
	}

	/**
	 * Insert settings links to plugin page
	 *
	 * @param array $links WordPress links
	 * @return array WordPress links including wordpress links
	 */
    public function add_options_link( $links )
    {
        
        $options_link = '<a href="options-general.php?page=datadwell-settings">' . __( 'Settings', 'datadwell' ) . '</a>';
		array_push( $links, $options_link );

		return $links;
	}

	/**
	 * Load settings page content
	 */
	public function page_settings() {
        add_option('datadwell_domain', '', null, true);
		add_option('datadwell_apikey', '', null, true);
		include $this->dir . '/views/settings.php';
		include $this->dir . '/views/demo.php';
	}

    /**
	 * DataDwellAdmin Instance
	 *
	 * @return DataDwellAdmin instance
	 */
    public static function instance($file = '')
    {
        if(is_null(self::$_instance))
        {
			self::$_instance = new self($file, $version);
		}

		return self::$_instance;
    }

}