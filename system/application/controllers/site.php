<?php

class Site extends Controller {

	function Site()
	{
		parent::Controller();	

		$this->load->helper('url');	
		$this->load->helper('rewind');
		
		//$this->output->enable_profiler(TRUE);
		
		error_reporting(E_ALL);
		ini_set('display_errors', '1');

	}
	
	function index ( $site='', $y='', $m='', $d='', $item_number=0)
	{							
		$data['domains'] = get_domains();
		$data['y'] = check_year  	($y);	
		$data['m'] = check_month	($m);	
		$data['d'] = check_day 		($d);
		$data['site'] = check_site		($site, $data['domains']);
		$data['item_number'] = $item_number;
		
		$current_date = array ( 'y' => $data['y'], 'm' => $data['m'], 'd' => $data['d'] );
				
		$doThis = whatToDo( $data['y'], $data['m'], $data['d'], $data['site'] );
		$data['doThis'] = $doThis;
		
				
		switch ( $doThis )
		{
		case "day":
			//previous
			$previous_feed_date = extract_feed_date (  $this->_get_previous_feed ( $data['domains'], $data['site'], $current_date ), $data['site'] );			
			$data['yesterday'] = $data['site'].'/'.$previous_feed_date['y'].'/'.$previous_feed_date['m'].'/'.$previous_feed_date['d'];
			
			//current
			$data['feedUrl']    = "feeds/".$data['site']."/".$data['site'].$data['y'].$data['m'].$data['d'].".".$data['domains'][$data['site']]['type'];
			
			//view			
			if ( file_exists ( $data['feedUrl'] ) ) //the file exists
			{
				$data['title'] = 'Popular links on '.$data['domains'][$data['site']]['name'].' '.$data['y'].'/'.$data['m'].'/'.$data['d'].' | rrrewind';
				$data['view'] 	= 'view_show';

$data['items'] = $this->get_items ( $data['domains'], $data['site'], $data['feedUrl'] );			
			}
			else									//the file DONT exist
				$data['view']	= 'view_archives';
			break;
		
		case "recent":
			//current
			$recent_feed = get_recent_feed ( $data['site'] );
			$data['feedUrl']    = "feeds/".$data['site']."/".$recent_feed;
			
			//previous
			$current_date = extract_feed_date ( $recent_feed, $data['site'] );	
			$previous_feed_date = extract_feed_date (  $this->_get_previous_feed ( $data['domains'], $data['site'], $current_date ), $data['site'] );			
			$data['yesterday'] = $data['site'].'/'.$previous_feed_date['y'].'/'.$previous_feed_date['m'].'/'.$previous_feed_date['d'];
					
			$data['y'] = $current_date ['y'];	
			$data['m'] = $current_date ['m'];	
			$data['d'] = $current_date ['d'];
			$data['title'] = 'Popular links on '.$data['domains'][$data['site']]['name'].' '.$data['y'].'/'.$data['m'].'/'.$data['d'].' | rrrewind';

$data['items'] = $this->get_items ( $data['domains'], $data['site'], $data['feedUrl'] );
		
			//view
			$data['view'] 		= 'view_show';
			break;
		
		case "error":
			$data['view'] = 'view_error';
			break;
		}

		$this->load->view('template', $data);

		
	}

	function _get_previous_feed ( $domains, $webname, $date )
	{
		//get files of this site
		$files =  get_files ( $webname );
		$result = false;
		
		if ( $files )
		{
			$count = count ( $files ) - 1; //count -1 because last file because it doesnt has a previous file
			//files loop
			for ( $i=0; $i< $count; $i++ )
			{				
				if ( $files [ $i ] == $webname.$date['y'].$date['m'].$date['d'].".".$domains[$webname]['type'] ) //if file is same than current day 
				{
					$result = $files [$i + 1];					//get the previous
				}
			}
			return $result;				
		}
	}
	


	function archives ( $site )
	{
		$data['domains'] = get_domains();
		$data['site'] = check_site ($site, $data['domains']);
		$data['y'] = '';
		$data['m'] = '';
		$data['d'] = '';
		$data['item_number'] = 0;
		$data['title'] = $data['site'].' archives | rrrewind';
		
		
		$data['view'] = 'view_archives';
		$this->load->view('template', $data);
	}

	function tos ()
	{
		$data['domains'] = get_domains();
		$data['site'] = '';
		$data['y'] = '';
		$data['m'] = '';
		$data['d'] = '';
		$data['title'] = 'Terms of service';
		$data['item_number'] = 0;
		
		$data['view'] = 'view_tos';
		$this->load->view('template', $data);
	}
	
	function get_another_day ( $y, $m, $d, $days)
	{
		$new_y  = date('Y',mktime(0,0,0,$m,($d + $days),$y));
		$new_m  = date('m',mktime(0,0,0,$m,($d + $days),$y));
		$new_d  = date('d',mktime(0,0,0,$m,($d + $days),$y));
		
		return $new_y."/".$new_m."/".$new_d;	
	}


	function get_items ( $domains, $site, $feedUrl )
	{
		$file_content = file_get_contents($feedUrl);
		if($file_content)
		{
			//For XML
			if ( $domains[$site]['type'] == 'xml' )
			{	
				$xml = simplexml_load_string($file_content, null, LIBXML_NOCDATA); 
				if($xml !== false)
				{						
					return extract_items ( $site, $xml );												
				}
			}
			//JSON
			if ( $domains[$site]['type'] == 'json' )
			{				
				$json = json_decode ( $file_content, true );						
				return extract_items ( $site, $json );
			}	
		}
	}


	
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */