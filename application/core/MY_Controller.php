<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * MY_Controller
 *
 * This class simply extends MX_Controller. All controllers that DOES NOT
 * require a logged-in user should extend this class.
 *
 * @package 	CodeIgniter
 * @category 	Core Extension
 * @author 	Kader Bouyakoub <bkader_at_mail_dot_com>
 * @link 	https://github.com/bkader
 */

class MY_Controller extends MX_Controller {
	/**
	 * To use Laravel static routes.
	 */
	private $__filter_params;

	/**
	 * @var  array  array of data to pass to view files.
	 */
	protected $data = array();

	/**
	 * @var  object holds the currently logged-in user's object.
	 */
	protected $current_user;

	/**
	 * Class constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->__filter_params = array($this->uri->uri_string());
		$this->call_filters('before');

		// Github buttons (Remove this please)
		$this->theme->add_js('https://buttons.github.io/buttons.js');

		// Uncomment these lines once you set your theme.
		// $this->theme->add_partial('header')
		// 			->add_partial('footer');

		log_message('debug', 'MY_Controller Class Initialized');
	}

	// ------------------------------------------------------------------------

	/**
	 * Remapping to use Laravel static routing.
	 */
	public function _remap($method, $params = array())
	{
		if (method_exists($this, $method))
		{
			return call_user_func_array(array($this, $method), $params);
		}
		else
		{
			show_404();
		}
		($method != 'call_filters') && $this->call_filters('after');
	}

	// ------------------------------------------------------------------------

	/**
	 * Calls filters at routing.
	 * 
	 * @param string $type
	 */
	private function call_filters($type)
	{
		$loaded_route = $this->router->get_active_route();
		$filter_list = Route::get_filters($loaded_route, $type);

		foreach ($filter_list as $filter_data)
		{
			$param_list = $this->__filter_params;
			
			$callback = $filter_data['filter'];
			$params = $filter_data['parameters'];
			
			// check if callback has parameters
			if ( ! is_null($params))
			{
				// separate the multiple parameters in case there are defined
				$params = explode(':', $params);
				
				// search for uris defined as parameters, they will be marked as {(.*)}
				foreach ($params as &$p)
				{
					if (preg_match('/\{(.*)\}/', $p, $match_p))
					{
						$p = $this->uri->segment($match_p[1]);
					}
				}

				$param_list = array_merge($param_list, $params);
			}
			
			if (class_exists('Closure') and method_exists('Closure', 'bind'))
			{
				$callback = Closure::bind($callback, $this);
			}
			
			call_user_func_array($callback, $param_list);
		}

		log_message('debug', "\"{$type}\" Filter Called");
	}

	// ------------------------------------------------------------------------

	/**
	 * Prepares form validation library and form helper.
	 *
	 * @param 	array 	$rules 	rules to be used for validation form.
	 */
	protected function prepare_form($rules = array())
	{
		// Load validation form if not already loaded.
		if ( ! class_exists('CI_Form_validation', false))
			$this->load->library('form_validation');

		// Hack to make form validation HMVC work.
		$this->form_validation->CI =& $this;

		// Load form helper if not already loaded.
		(function_exists('form_open')) or $this->load->helper('form');

		// Area they any rules to use?
		empty($rules) or $this->form_validation->set_rules($rules);
	}

}

// ------------------------------------------------------------------------
/**
 * User_Controller
 *
 * All controllers that require a logged-in user should extend this class.
 *
 * @package 	CodeIgniter
 * @category 	Core Extension
 * @author 	Kader Bouyakoub <bkader_at_mail_dot_com>
 * @link 	https://github.com/bkader
 */

class User_Controller extends MY_Controller {
	/**
	 * Class constructor
	 */
	public function __construct()
	{
		parent::__construct();

		// Put your user check logic here:
		// if ( ! $this->auth->online())
		// {
		// 	redirect('login','refresh');
		// 	exit;
		// }
	}
}

// ------------------------------------------------------------------------
/**
 * Admin_Controller
 *
 * Controllers that require a logged-in admin user should extend this class.
 *
 * @package 	CodeIgniter
 * @category 	Core Extension
 * @author 	Kader Bouyakoub <bkader_at_mail_dot_com>
 * @link 	https://github.com/bkader
 */

class Admin_Controller extends User_Controller {
	/**
	 * Class constructor
	 */
	public function __construct()
	{
		parent::__construct();

		// Put your user rank check logic here:
		// if ( ! $this->current_user->admin)
		// {
		// 	redirect('','refresh');
		// 	exit;
		// }
	}
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */
