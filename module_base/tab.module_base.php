<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Module_base_tab
 *
 * Tab methods for EE.
 **/
class Module_base_tab
{
	var $version     = '1.0';

	var $module_name  = '';
	var $module_class = '';

	public function __construct()
	{
		// Get EE instance.
		$this->EE =& get_instance();

		// Load helper.
		$this->EE->load->helper('module');

		// Load lang file.
		$this->EE->lang->loadfile('module_base');

		$module_name  = $this->_get_module_name();
		$module_class = $this->_get_module_class();
	}

	/**
	 * _get_module_name
	 *
	 * Get the module name, determined from the standard EE naming conventions.
	 */
	private function _get_module_name()
	{
		return ucfirst(str_replace('_', ' ', $this->_get_module_class()));
	}

	/**
	 * _get_module_class
	 *
	 * Get the class for the main mod.module.php file. Thanks to the standard
	 * naming convention, we can work this out automagically.
	 */
	private function _get_module_class()
	{
		return str_replace('_tab', '', __CLASS__);
	}

	/**
	 * publish_tabs
	 *
	 * Creates the fields that will be displayed on the publish page. It must
	 * return $settings, a multidimensional associative array specifying the
	 * display settings and values associated with each of your fields.
	 *
	 * @param Int $channel_id  The channel_id of the channel this entry exists, or will exist, in.
	 * @param Int $entry_id  The current entry_id, if editing an exisiting entry.
	 * @return Array  Settings.
	 **/
	public function publish_tabs($channel_id, $entry_id = '')
	{
		$settings = array();

		return $settings;
	}

	/**
	 * validate_publish
	 *
	 * Validate data after the publish form has been submitted but before
	 * any additions to the database.
	 *
	 * @param Array $params  Data supplied by EE.
	 * @return Array  Errors if they exist.
	 * @return Boolean  false if no errors.
	 **/
	public function validate_publish($params)
	{
		$errors = array();

		return ( empty($errors) ? false : $errors );
	}

	/**
	 * publish_data_db
	 *
	 * Allows the insertion of data after the core insert/update has been done,
	 * thus making available the current $entry_id.
	 *
	 * @param Array $params  Data supplied by EE.
	 * @return void
	 **/
	public function publish_data_db($params)
	{
		return;
	}

	/**
	 * publish_data_delete_db
	 *
	 * Called near the end of the entry delete function, this allows you to sync
	 * your records if any are tied to channel entry_ids.
	 *
	 * @param Array $params  Data supplied by EE.
	 * @return void
	 **/
	public function publish_data_delete_db($params)
	{
		return;
	}
}

/* End of file tab.module_base.php */
/* Location: /tab.module_base.php */
