<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Admin Module
 *
 * @package 	CodeIgniter
 * @subpackage 	Modules
 * @category 	Controllers
 * @author 	Kader Bouyakoub <bkader@mail.com>
 * @link 	https://github.com/bkader
 */

class Admin extends Admin_Controller
{
	/**
	 * Admin panel homepage.
	 */
	public function index()
	{
		$this->theme->title('Admin Panel')
					->load('dashboard', $this->data);
	}
}

/* End of file Admin.php */
/* Location: ./application/modules/admin/controllers/Admin.php */