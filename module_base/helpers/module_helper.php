<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Get the control panel URL for a method.
 *
 * @param  string $method Method to call.
 * @param  array  $data   Associative array of GET vars to pass.
 * @return string         URL.
 */
if ( ! function_exists('get_cp_url') )
{
	function cp_url(string $method, array $data)
	{
		$query_string = '';

		foreach ( $data as $key => $value )
			$query_string .= '&' . urlencode($key) . '=' . urlencode($value);

		return "C=addons_modules"
		     . "&M=show_module_cp"
		     . "&module={$this->module_name}"
		     . "&method={$method}"
		     . $query_string;
	}
}



/* End of file module_helper.php */
/* Location: ./helpers/module_helper.php */