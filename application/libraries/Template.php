<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Template
{
	protected $CI;
	var $template_data = array();

	function set($name, $value)
	{
		$this->template_data[$name] = $value;
	}
	function loadTemplate($template = '', $view = '', $view_data = array(), $return = FALSE)
	{
		$this->CI = &get_instance();
		$this->set('contents', $this->CI->load->view($view, $view_data, TRUE));
		return $this->CI->load->view($template, $this->template_data, $return);
	}
	function loadWebsite($template = '', $view = '', $view_data = array(), $return = FALSE)
	{
		$this->CI = &get_instance();
		$this->set('web_theme', $this->CI->load->view($view, $view_data, TRUE));
		return $this->CI->load->view($template, $this->template_data, $return);
	}
	function getBulan($key_bulan = 'all')
	{
		$bulan = array('01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember');
		if ($key_bulan != 'all')
		{
			return $bulan[$key_bulan];
		}
		else
		{

			return $bulan;
		}
	}

}