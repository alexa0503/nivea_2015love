<?php
function getIP() {
	if (@$_SERVER["HTTP_X_FORWARDED_FOR"]) {
		$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
	} else if (@$_SERVER["HTTP_CLIENT_IP"]) {
		$ip = $_SERVER["HTTP_CLIENT_IP"];
	} else if (@$_SERVER["REMOTE_ADDR"]) {
		$ip = $_SERVER["REMOTE_ADDR"];
	} else if (@getenv("HTTP_X_FORWARDED_FOR")) {
		$ip = getenv("HTTP_X_FORWARDED_FOR");
	} else if (@getenv("HTTP_CLIENT_IP")) {
		$ip = getenv("HTTP_CLIENT_IP");
	} else if (@getenv("REMOTE_ADDR")) {
		$ip = getenv("REMOTE_ADDR");
	} else {

		$ip = '0.0.0.0';
	}

	return $ip;
}
function cmsMenu($obj){
	$items = array(
		array('Dashboard', array('c'=>'cms','m'=>'index')),
		//array('留言管理', array('c'=>'index','m'=>'message')),
		array('用户管理', array('c'=>'cms','m'=>'user'),
			'items'=> array(
				array('查看所有', array('c'=>'cms','m'=>'user'),),
				//array('清空数据', array('c'=>'index','m'=>'userClear'),),
				array('导出数据', array('c'=>'cms','m'=>'userExport'),),
				),
			),
	);
	$output = '<ul id="main-nav">';
	foreach ($items as $item) {
		$output .= '<li><a href="'.site_url($item[1]).'" class="nav-top-item';
		if(!array_key_exists('items', $item))
			$output .= ' no-submenu';
		if(stripos($obj->router->fetch_method(), $item[1]['m']) !== false)
			$output .= ' current';
		$output .= '">'.$item[0].'</a>';
		if(array_key_exists('items', $item)){
			$output .= '<ul>';
			foreach ($item['items'] as $value) {
				$output .= '<li><a href="'.site_url($value[1]).'"';
				if($obj->router->fetch_method() == $value[1]['m'])
					$output .= ' class="current"';
				$output .= '>'.$value[0].'</li>';
			}
			$output .= '</ul>';
		}
		$output .= '</li>';
	}
	$output .= '</ul>';
	return $output;
}