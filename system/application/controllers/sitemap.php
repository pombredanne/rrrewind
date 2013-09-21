<?php

class Sitemap extends Controller {

	function Sitemap()
	{
		parent::Controller();	

		$this->load->helper('url');	
		$this->load->helper('rewind');
	}
	
	function index ( )
	{							
		$domains= get_domains();
		header('Content-type: text/xml');
		echo '<?xml version="1.0" encoding="UTF-8"?>';?>
		<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"><url><loc><?php echo site_url();?></loc><priority>1</priority></url><?php

		//foreach domain
		foreach ( $domains as $domain )
		{
			//if not a separator
			if ( $domain['type'] != 'separator' )
			{
				//get files
				$files = get_files( $domain['webname'] );
				foreach ( $files as $file)
				{
					//get rid off extension
					$file = str_replace ( ".".$domain['type'], "", $file );
					//extract segments
					$date = extract_feed_date ( $file, $domain['webname'] );
					//make url
					$url = site_url ( $domain['webname'].'/'.$date['y'].'/'.$date['m'].'/'.$date['d'] );					
					
					//display URL tag					
					echo'<url><loc>'.$url.'</loc></url>';
				}
			}
		}
		echo "</urlset>";
	}

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */