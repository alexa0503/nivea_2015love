<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cms extends CI_Controller {
	const ERROR_NONE = 0;
	const ERROR_LOGIN_NO_USER_NAME = 1001;#没有用户名
	const ERROR_LOGIN_NO_PASSWORD = 1002;#没有密码
	const ERROR_LOGIN_NOT_MATCHING = 1003;#用户密码不匹配
	const ERROR_COOKIE_INVALID = 1100;#cookie失效
	const ERROR_COOKIE_VALIDATION_FAILS = 1101;#cookie验证失败
	const SALT = 'OMPCHINA';
	const PAGE_SIZE = 20;
	public $app_parse;
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->helper('menu');

		if($this->hasLogin() !== self::ERROR_NONE && $this->router->fetch_method() != 'login'){
			redirect('cms/login');
		}
		$menu = cmsMenu($this);
		$this->app_parse = array(
			'app_title'   => 'O.M.P. 后台管理系统',
			'app_sub_title' => '首页',
			'app_menu' => $menu,
			'user_name' => get_cookie('un'),
			'logout_url' => site_url('cms/logout'),
			'current_url'   => site_url('cms/'.$this->router->fetch_method()),
      );

	}
	public function index()
	{
		$this->parser->parse('cms/header', $this->app_parse);
		$this->parser->parse('cms/index', $this->app_parse);
		$this->load->view('cms/footer');
	}
	/**
	 * 用户管理
	 * @return [type] [description]
	 */
	public function user(){
		$this->load->library('pagination');
		$this->load->model('user_model');

		$page = (int)$this->input->get('page');
		if($page < 1)
			$page = 1;
		$limit = self::PAGE_SIZE;
		$offset = ($page -1) * $limit;

		
		$config['base_url'] = site_url('cms/user');
		$config['query_string_segment'] = 'page';
		$config['use_page_numbers'] = TRUE;
		$config['total_rows'] = $this->user_model->getSum();
		$config['per_page'] = $limit; 
		$config['anchor_class'] = 'class="number"';
		$config['cur_tag_open'] = '<a class="number current" href="#">';
		$config['cur_tag_close'] = '</a>';
		$this->pagination->initialize($config);

		$list = $this->user_model->getAll($limit, $offset);
		
		$this->app_parse['app_sub_title'] = '申领记录';
		$parse = $this->app_parse;
		$parse['list'] = $list;
		$parse['page'] = $this->pagination->create_links();
		$parse['current_url'] = $this->app_parse['current_url'];
		
		$parse['theads'] = $this->user_model->getFields();

		$this->parser->parse('cms/header', $this->app_parse);
		$this->parser->parse('cms/user', $parse);
		$this->load->view('cms/footer');
		
	}

	/**
	 * [login description]
	 * @return [type] [description]
	 */
	public function login(){
		if($this->hasLogin() === self::ERROR_NONE){
			redirect('cms/index');
		}
		if(isset($_POST['admin_form'])){
			$admin = $this->admin_model->getUserByname($_POST['admin_form']['user_name']);
			if($admin === NULL){
				$ret = self::ERROR_LOGIN_NO_USER_NAME;
				$msg = '用户名不存在';
			}
			elseif($admin->password != md5($_POST['admin_form']['password'])){
				$ret = self::ERROR_LOGIN_NOT_MATCHING;
				$msg = '用户名与密码不匹配';
			}
			else{
				$cookie['un'] = array(
				    'name'   => 'un',
				    'value'  => $admin->user_name,
				    'expire' => 30*24*3600,
				);
				$cookie['p'] = array(
				    'name'   => 'p',
				    'value'  => md5($admin->password.self::SALT),
				    'expire' => 30*24*3600,
				);
				set_cookie($cookie['un']);
				set_cookie($cookie['p']);
				$ret = self::ERROR_NONE;
				$msg = '';
			}
			$return = array(
				'ret' => $ret,
				'msg' => $msg,
			);
			$this->output->set_content_type('application/json')->set_output(json_encode($return));
		}
		else{
			$this->parser->parse('cms/login', $this->app_parse);
		}
	}

	public function userExport()
	{
		$this->load->library('PHPExcel'); 
		$this->load->library('PHPExcel/IOFactory');
		$this->load->model('user_model');
		$export_fields = $this->user_model->getFields();
		$objPHPExcel = new PHPExcel(); 
		$objPHPExcel->setActiveSheetIndex(0) 
		->setCellValue('A1', $export_fields['id'])
		->setCellValue('B1', $export_fields['name'])
		->setCellValue('C1', $export_fields['tel'])
			->setCellValue('D1', $export_fields['address'])
			->setCellValue('E1', $export_fields['type'])
		->setCellValue('F1', $export_fields['create_time'])
		->setCellValue('G1', $export_fields['create_ip']);
		$babies = $this->user_model->getAll(1000000000, 0);
		foreach ($babies as $key => $user) {
			$col = 0;
			foreach ($export_fields as $k => $v) {
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $key+2, $user[$k]); 
				$col++;
			}
		}
		$objPHPExcel->setActiveSheetIndex(0); 
		$objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5'); 
		header('Content-Type: application/vnd.ms-excel'); 
		header('Content-Disposition: attachment;filename="users_'.date('ymd').'.xls"'); 
		header('Cache-Control: max-age=0'); 
		$objWriter->save('php://output'); 
	}
	/**
	 * 
	 * @return boolean [description]
	 */
	protected function hasLogin(){
		$user_name = get_cookie('un');
		$pw = get_cookie('p');
		if(isset($user_name) && isset($pw)){
			$admin = $this->admin_model->getUserByname($user_name);
			if($admin === NULL || md5($admin->password.self::SALT) !== $pw){
				$ret = self::ERROR_COOKIE_VALIDATION_FAILS;
			}
			else
				$ret = self::ERROR_NONE;
		}
		else
			$ret = self::ERROR_COOKIE_INVALID;
		return $ret;
	}
	public function logout(){
		delete_cookie('un');
		delete_cookie('p');
		redirect('cms/index');
	}

}