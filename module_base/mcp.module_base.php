<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Module_base_mcp
 *
 * Control panel file for module.
 **/
class Module_base_mcp
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
		return str_replace('_mcp', '', __CLASS__);
	}

	/**
	 * _set_cp_title
	 *
	 * Set the title for the current control panel page.
	 *
	 * @param String $title  Title to set.
	 */
	private function _set_cp_title(string $title)
	{
		$this->EE->cp->set_variable('cp_page_title', $title);
	}

	/**
	 * index
	 *
	 * Control panel page.
	 *
	 * @return string  Page HTML.
	 */
	public function index()
	{
		$view_data = array();
		return $this->EE->load->view('cp/index', $view_data, true);
	}
}

/* End of file mcp.tf_blocks.php */
/* Location: /mcp.tf_blocks.php */