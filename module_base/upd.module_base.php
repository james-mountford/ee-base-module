<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Module_base_upd
 *
 * Install/update file for module.
 *
 * Note: The class name should be in the format "Your_module_upd", i.e. an
 * capitalised first letter only, and ending "_upd".
 */
class Module_base_upd
{
	var $version = '1.0';
	var $module_name  = '';
	var $module_class = '';

	/**
	 * __construct
	 *
	 * Gets the EE instance and sets module info.
	 */
	public function __construct()
	{
		$this->EE =& get_instance();

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
		return str_replace('_upd', '', __CLASS__);
	}

	/**
	 * install
	 *
	 * Add the module to the exp_modules table, and perform other setup as
	 * necessary.
	 *
	 * Note:
	 * - This method is required by EE.
	 * - has_cp_backend should be 'y' if the module has a control panel, 'n'
	 *   otherise.
	 * - has_publish_fields should be 'y' if the module adds tabs or fields to
	 *   the publish page, 'n' otherwise.
	 *
	 * @return Boolean
	 **/
	public function install()
	{
		$this->EE->load->library('logger');

		// Add to modules table.
		$data = array(
			'module_name'        => $this->_get_module_class(),
			'module_version'     => $this->version,
			'has_cp_backend'     => 'y',
			'has_publish_fields' => 'y',
		);

		$this->EE->db->insert('modules', $data);

		// Add action handlers.
		//
		// - Get the action ID using `$this->EE->functions->fetch_action_id($class, $method)`.
		// - The URL for an action is "your-site.com/?ACT=123", where '123' is
		//   the action ID.
		$data = array(
			// array(
			// 	'class'  => $this->_get_module_class(),
			// 	'method' => 'add_area',
			// ),
		);

		if ( ! empty($data) )
			$this->EE->db->insert_batch('actions', $data);

		// Add publish tabs.
		//
		// See the tabs() method for details.
		$this->EE->load->library('layout');
		$this->EE->layout->add_layout_tabs($this->tabs(), $this->_get_module_class());

		// Run custom SQL, generally to add your own tables.
		//
		// - Add
		// - Use `$this->EE->db->dbprefix('your_table')` to get the EE prefixed
		//   name for your table. DO NOT just assume it to be 'exp_' or use
		//   an unprefixed table name.
		$sql = array();

		// $table_name = $this->EE->db->dbprefix('your_table');
		// $sql[] = "CREATE TABLE IF NOT EXISTS {$table_name} ( \n"
		//        . "  id INT(11) AUTO_INCREMENT PRIMARY KEY, \n"
		//        . "  foo VARCHAR(64) NOT NULL, \n"
		//        . "); \n";

		if ( ! empty($sql) )
		{
			foreach ( $sql as $query )
			{
				$this->EE->db->query($query);
			}
		}

		return true;
	}

	/**
	 * update
	 *
	 * Checked on any visit to the modules control panel in EE. Performs updates
	 * based on version.
	 *
	 * Note:
	 * - version_compare() should be used to compare versions.
	 * - See http://ellislab.com/expressionengine/user-guide/development/guidelines/general.html#comparing-version-numbers
	 *
	 * @param String $current  Current installed version.
	 * @return Boolean  true if update was performed, false otherwise.
	 */
	public function update($current = '')
	{
		// Check if we're already at the current version.
		if ( version_compare($current, $this->version, '=') )
		{
			return false;
		}

		if ( version_compare($current, $this->version, '<') )
		{
			// Lower version installed. Perform an update.
		}

		return true;
	}

	/**
	 * uninstall
	 *
	 * - Required by EE.
	 * - Removes publish tabs.
	 * - Removes actions references from DB.
	 * - Removes module references from DB.
	 *
	 * @return Boolean
	 **/
	public function uninstall()
	{
		$this->EE->load->library('logger');

		// Remove tabs.
		$this->EE->load->library('layout');
		$this->EE->layout->delete_layout_tabs($this->tabs(), $this->_get_module_class());

		// Remove actions from EE.
		$table_name = $this->EE->db->dbprefix('actions');
		$sql = "DELETE FROM {$table_name} WHERE class = '{$this->_get_module_class()}';";
		$this->EE->db->query($sql);

		// Remove custom tables.
		//
		// Add the name of custom tables to the $tables array
		$tables = array(
			// 'your_table',
		);

		foreach ( $tables as $table )
		{
			$sql = 'DROP TABLE IF EXISTS ' . $this->EE->db->dbprefix($table) . ';';
			$this->EE->db->query($sql);
		}

		// Remove module from EE.
		$table_name = $this->EE->db->dbprefix('modules');
		$sql = "DELETE FROM {$table_name} WHERE module_name = '{$this->_get_module_class()}';";
		$this->EE->db->query($sql);

		return true;
	}

	/**
	 * tabs
	 *
	 * Scaffold tab layouts, returning an array of tabs, each of which should
	 * consist of an array of fields with settings.
	 *
	 * Note: It is not necessary to namespace fields here, as EE will do so
	 * automatically.
	 *
	 * @return Array  Tabs to add to publish page.
	 **/
	public function tabs()
	{
		$tabs = array();

		// $tabs['your_tab'] = array(
		// 	'your_field' => array(
		// 		'visible'     => 'true',
		// 		'collapse'    => 'false',
		// 		'htmlbuttons' => 'true',
		// 		'width'       => '100%'
		// 	),
		// );

		return $tabs;
	}
}

/* End of file upd.moduel_base.php */
/* Location: /upd.moduel_base.php */