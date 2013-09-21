<?php 
$this->load->view('header');
switch ($view)
{
	case 'view_show':
		$this->load->view('view_show');
		break;

	case 'view_calendar':
		$this->load->view('view_calendar');
		break;		

	case 'view_archives':
		$this->load->view('view_archives');
		break;		
		
	case 'view_tos':
		$this->load->view('view_tos');
		break;		

	case 'view_error':
		$this->load->view('view_error');
		break;				
}
$this->load->view('view_footer');
//$this->load->view('footer'); 
?>