<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class index extends CI_Controller {
	const ERROR_NONE = 0;
	public $app_parse;
    //protected $signPackage;
    //const WECHAT_APPID = 'wx36310fe660ca89bd';
	//const WECHAT_SECRET = '4a8246af05807eb13bef49b836119feb';
	function __construct()
	{
		@session_start();
		parent::__construct();
		$this->load->helper('menu');
	}

	/**
	 * 表单提交
	 */
	public function post()
	{
        //$this->load->helper('curl');
		$_SESSION['token'] = session_id();
		$ret = 0;
		$msg = '';
		$this->db->trans_start();
		try {
			$name = isset($_REQUEST['name']) ? trim(strip_tags($_REQUEST['name'])) : null;
			$tel = isset($_REQUEST['tel']) ? trim(strip_tags($_REQUEST['tel'])) : null;
			$address = isset($_REQUEST['address']) ? trim(strip_tags($_REQUEST['address'])) : null;
			$type = isset($_REQUEST['type']) ? trim(strip_tags($_REQUEST['type'])) : null;
			if( empty($name) ){
				$ret = 1001;
				$msg = 'name 不能为空~';
			}
			elseif( empty($tel) ){
				$ret = 1002;
				$msg = 'tel 不能为空~';
			}
			elseif( empty($address) ){
				$ret = 1003;
				$msg = 'address 不能为空~';
			}
			elseif( empty($type) ){
				$ret = 1004;
				$msg = 'type 不能为空~';
			}
			else{
				$data = array(
					'name' => $name,
					'tel' => $tel,
					'address' => $address,
					'type' => $type,
					'create_ip' => getIP(),
					'create_time' => date('Y-m-d H:i:s'),
				);
				$this->db->insert('love2015_user', $data);
			}

			/*
			$this->db->where('phone', $phone);
			$count = $this->db->count_all_results('t_user');
			if($count < 0){
				$ret = 1001;
				$msg = '该手机号码已经被申领';
			}
			else{

			}
			*/
		} catch (Exception $e) {
			$ret = 2000;
			$msg = $e->getMessage();
		}
		$this->db->trans_complete();
		$result = array(
			'ret' => $ret,
			'msg' => $msg,
			);
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}
	public function shareInfo()
     {
         if( isset($_GET['url'])){
         	$url = urldecode($_GET['url']);
             $jssdk = new Jssdk(self::WECHAT_APPID, self::WECHAT_SECRET);
             $signPackage = $jssdk->GetSignPackage();
             $data = $signPackage;
             $this->output->set_content_type('application/json')->set_output(json_encode($data));
         }
     }
}
