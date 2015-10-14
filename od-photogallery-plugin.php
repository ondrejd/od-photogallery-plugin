<?php
/*
Plugin Name: ondrejd's Photogallery Plugin
Plugin URI: https://github.com/ondrejd/od-photogallery-plugin/
Description: WordPress plug-in for creating image galleries and publishing them with your posts.
Version: 0.6
Author: Ondřej Doněk
Author URI: http://ondrejdonek.blogspot.cz/
*/

/*  ***** BEGIN LICENSE BLOCK *****
    Version: MPL 1.1

    The contents of this file are subject to the Mozilla Public License Version
    1.1 (the "License"); you may not use this file except in compliance with
    the License. You may obtain a copy of the License at
    http://www.mozilla.org/MPL/

    Software distributed under the License is distributed on an "AS IS" basis,
    WITHOUT WARRANTY OF ANY KIND, either express or implied. See the License
    for the specific language governing rights and limitations under the
    License.

    The Original Code is WordPress Photogallery Plugin.

    The Initial Developer of the Original Code is
    Ondrej Donek.
    Portions created by the Initial Developer are Copyright (C) 2009
    the Initial Developer. All Rights Reserved.

    Contributor(s):

    ***** END LICENSE BLOCK ***** */

// TODO Add test if autoload exists! Otherwise show message to the user.
require_once dirname(__FILE__) . '/vendor/autoload.php';

/**
 * @author Ondřej Doněk, <ondrejd@gmail.com>
 * @since 0.6
 */
class odWpPhotogalleryPlugin extends \odwp\SimplePlugin
{
	protected $id = 'od-photogallery-plugin';
	protected $version = '0.6';
	protected $textdomain = 'od-photogallery-plugin';
    protected $enable_default_options_page = true;

	/**
	 * Constructor.
	 *
     * @since 0.6
	 * @return void
	 */
	public function __construct() {
		$this->init_locales();

		$this->options = array();
		$this->options[] = new \odwp\PluginOption(
			'main_gallery_dir',
			__('Photogallery folder', $this->get_textdomain()),
			\odwp\PluginOption::TYPE_STRING,
			'wp-content/photogallery/',
			__('Relative path (from WordPress root) where will be storred photogallery files.', $this->get_textdomain())
		);
		$this->options[] = new \odwp\PluginOption(
			'gallery_page_id',
			__('Default gallery page', $this->get_textdomain()),
			\odwp\PluginOption::TYPE_NUMBER,
			7,
			__('ID of default page with photogallery.', $this->get_textdomain())
		);
		$this->options[] = new \odwp\PluginOption(
			'gallery_thumb_size_use_default',
			__('Use default thumbnails size', $this->get_textdomain()),
			\odwp\PluginOption::TYPE_BOOL,
			false,
			__('You can use either default WordPress thumbnail size or your own.', $this->get_textdomain())
		);
		$this->options[] = new \odwp\PluginOption(
			'gallery_thumb_size_width',
			__('Thumbnail width', $this->get_textdomain()),
			\odwp\PluginOption::TYPE_NUMBER,
			100,
			__('Set width of thumbnail images in pixels.', $this->get_textdomain())
		);
		$this->options[] = new \odwp\PluginOption(
			'gallery_thumb_size_height',
			__('Thumbnail height', $this->get_textdomain()),
			\odwp\PluginOption::TYPE_NUMBER,
			75,
			__('Set height of thumbnail images in pixels.', $this->get_textdomain())
		);
		$this->options[] = new \odwp\PluginOption(
			'gallery_full_size_width',
			__('Full images width', $this->get_textdomain()),
			\odwp\PluginOption::TYPE_NUMBER,
			640,
			__('Set width of full-sized images in pixels.', $this->get_textdomain())
		);
		$this->options[] = new \odwp\PluginOption(
			'gallery_full_size_height',
			__('Full images height', $this->get_textdomain()),
			\odwp\PluginOption::TYPE_NUMBER,
			480,
			__('Set height of full-sized images in pixels.', $this->get_textdomain())
		);
		$this->options[] = new \odwp\PluginOption(
			'gallery_supported_img_types',
			__('Supported images', $this->get_textdomain()),
			\odwp\PluginOption::TYPE_STRING,
			'jpg,png',
			__('Comma-separated list of supported images formats.', $this->get_textdomain())
		);
		$this->options[] = new \odwp\PluginOption(
			'gallery_max_upload_count',
			__('Maximal uploads at once', $this->get_textdomain()),
			\odwp\PluginOption::TYPE_NUMBER,
			5
		);

		parent::__construct();
	}

    /**
     * Returns title of the plug-in.
     *
     * @since 0.6
     * @param string $suffix (Optional.)
     * @param string $sep (Optional.)
     * @return string
     */
    public function get_title($suffix = '', $sep = ' - ') {
		if (empty($suffix)) {
			return __('Photos', $this->get_textdomain());
		}

		return sprintf(
			__('Photos%s%s', $this->get_textdomain()),
			$sep,
			$suffix
		);
	}
} // End of odWpPhotogalleryPlugin

// ===========================================================================
// Plugin initialization

global $od_photogallery_plugin;

$od_photogallery_plugin = new odWpPhotogalleryPlugin();
