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
					->add_partial('header')
					->add_partial('footer')
					->add_partial('sidebar')
					->load('dashboard', $this->data);
	}

	/**
	 * Admin panel using Semantic UI theme.
	 */
	public function semantic()
	{
 		$this->theme->theme('semantic')
					->add_partial('header')
					->add_partial('footer')
					->add_partial('sidebar')
 					->title('Admin Panel')
					->add_css('style')
					->add_js('scripts')
					->load('dashboard', $this->data);
	}
}

/* End of file Admin.php */
/* Location: ./application/modules/admin/controllers/Admin.php */
