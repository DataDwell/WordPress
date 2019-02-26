<?php

if(!defined('ABSPATH') )
{
	exit;
}

class DataDwell {

    private static $_instance = null;
    private $file;
    private $dir;

	/**
	 * Constructor function.
	 * @return  void
	 */
    public function __construct($file = '')
    {
        $this->file = $file;
        $this->dir = dirname($this->file);
    }

    /**
	 * DataDwell Instance
	 *
	 * @return DataDwell instance
	 */
    public static function instance($file = '')
    {
        if(is_null(self::$_instance))
        {
			self::$_instance = new self($file, $version);
		}

		return self::$_instance;
	}

    /**
	 * Prepeare API arguments
	 *
	 * @return array of arguments to use with WP HTTP
	 */
	private function prepare_api_args($method = 'POST')
	{
		if(get_option('datadwell_domain'))
		{
			return [
				'method' => $method, 
				'headers' => [
					'Authorization' => 'Bearer ' . get_option('datadwell_apikey'),
					'Content-Type' => 'application/json'
				],
				'data_format' => 'body'
			];
		}
		return null;
	}

    /**
	 * Prepeare API URL
	 *
	 * @return string to make the API request
	 */
	private function prepare_api_url($uri, $params = null)
	{
		if(get_option('datadwell_domain'))
		{
			$url = 'https://'.get_option('datadwell_domain').'/api/v2/' . $uri;
			if(is_array($params))
			{
				$url .= '?' . http_build_query($params);
			}
			return $url;
		}
		return null;
	}

    /**
	 * Asset search, simple text search of assets
	 *
	 * @return object directly from the API: https://datadwell.docs.apiary.io/#reference/assets/search/search-assets
	 */
	public function asset_search($query, $from = 0, $size = 20, $includes = null, $additional_params = null)
	{
		$url = $this->prepare_api_url('assets/search', $includes);
		if(!is_null($url))
		{
			$args = $this->prepare_api_args();
			$params = [];

			if(!empty($additional_params)){
				$params = $additional_params;
			}

			$params += [
				'query' => $query,
				'from' => $from,
				'size' => $size
			];

			$args['body'] = json_encode((object)$params);

			$response = wp_remote_post($url, $args);
			return json_decode($response['body']);
		}
		return null;
	}

    /**
	 * Asset advanced search
	 * See https://datadwell.docs.apiary.io/#reference/assets/search/search-assets on how to format the body
	 *
	 * @return object directly from the API: https://datadwell.docs.apiary.io/#reference/assets/search/search-assets
	 */
	public function asset_search_advanced($body, $from = 0, $size = 20, $includes = null)
	{
		$url = $this->prepare_api_url('assets/search', $includes);
		if(!is_null($url))
		{
			$args = $this->prepare_api_args();
			$body->from = $from;
			$body->size = $size;
			$args['body'] = json_encode($body);
			$response = wp_remote_post($url, $args);
			return json_decode($response['body']);
		}
		return null;
	}

    /**
	 * Asset previews, fetch thumbnails and previews for assets
	 *
	 * @return object directly from the API: https://datadwell.docs.apiary.io/#reference/assets/preview-multiple/search-assets
	 */
	public function asset_previews($assets)
	{
		$url = $this->prepare_api_url('assets/preview');
		if(!is_null($url))
		{
			if(is_numeric($assets))
			{
				$asset_ids = [$assets];
			}
			else if(is_object($assets))
			{
				$asset_ids = [];
				if(!empty($assets->assets)) {
					foreach ( $assets->assets as $asset ) {
						$asset_ids[] = $asset->id;
					}
				}
			}
			else if(is_array($assets))
			{
				$asset_ids = $assets;
			}
			else
			{
				return [];
			}
			$args = $this->prepare_api_args();
			$args['body'] = json_encode($asset_ids);
			
			$response = wp_remote_post($url, $args);
			return json_decode($response['body']);
		}
		return null;
	}

    /**
	 * List of all metafields available to assign to assets
	 *
	 * @return object directly from the API: https://datadwell.docs.apiary.io/#reference/metadata/list/get-all-metadata
	 */
	public function metadata_get_fields($parent_metafield_id = null)
	{
		$url = $this->prepare_api_url('metadata/list' . (!is_null($parent_metafield_id) ? '/' . $parent_metafield_id : ''));
		if(!is_null($url))
		{
			$args = $this->prepare_api_args('GET');
			
			$response = wp_remote_get($url, $args);
			return json_decode($response['body']);
		}
		return null;
	}

    /**
	 * Get metadata details about specific metadata
	 *
	 * @return object directly from the API: https://datadwell.docs.apiary.io/#reference/metadata/details/get-metadata-details
	 */
	public function metadata_get_details($metafield_id)
	{
		$url = $this->prepare_api_url('metadata/details/' . $metafield_id);
		if(!is_null($url))
		{
			$args = $this->prepare_api_args('GET');
			
			$response = wp_remote_get($url, $args);
			return json_decode($response['body']);
		}
		return null;
	}

    /**
	 * Create folder
	 *
	 * @return integer folder id of newly created folder
	 */
	public function folder_create($name, $parent_folder_id)
	{
		return 1;
	}

	/**
	 * Get folders
	 *
	 * @return Get all subfolders for given folder. If no folder ID is provided the base folders will be returned.
	 */
	public function get_folders($folder_id = null)
	{
		$url = $this->prepare_api_url('folders/list/' . $folder_id);
		if(!is_null($url))
		{
			$args = $this->prepare_api_args('GET');

			$response = wp_remote_get($url, $args);
			return json_decode($response['body']);
		}
		return null;
	}

	/**
	 * Get folder details
	 *
	 * @return Return base details for the folder.
	 */
	public function get_folder_details($folder_id)
	{
		$url = $this->prepare_api_url('folders/details/' . $folder_id);
		if(!is_null($url))
		{
			$args = $this->prepare_api_args('GET');

			$response = wp_remote_get($url, $args);
			return json_decode($response['body']);
		}
		return null;
	}

    /**
	 * Create upload folder
	 *
	 * @return integer folder id of newly created folder
	 */
	public function upload_url($folder_id)
	{
		return '//upload';
	}

    /**
	 * Simple demo page to see the functionality
	 */
	public function print_demo()
	{
		include $this->dir . '/views/demo.php';
	}
    
}