<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Module_base
 *
 * Main module file.
 *
 * Note: The class name should be in the format "Your_module", i.e. an
 * capitalised first letter only, and matching the module directory name.
 */
class Module_base
{
	var $version     = '1.0';
	var $module_name  = '';
	var $module_class = '';

	var $tag_data;
	var $return_data;

	public function __construct()
	{
		// Get instances.
		$this->EE =& get_instance();

		// Load helper.
		$this->EE->load->helper('module');

		// Get tagdata to be processed.
		if ( isset($this->EE->TMPL) )
			$this->tag_data = $this->EE->TMPL->tagdata;

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
		return __CLASS__;
	}
}

/* End of file mod.module_base.php */
/* Location: /mod.module_base.php */