<?php

class Updater extends Controller {

	function Updater()
	{
		parent::Controller();	
	}

	function index()
	{
		$this->load->helper('file');
		$this->load->helper('rewind');
		
		$t_hour = date("G"); $t_month= date("m");	$t_day= date("d");	$t_year= date("Y");

		if ( $t_hour >= 22 )
		{
			$sites = array
			(

				"amazon" 		=> "http://www.amazon.com/rss/bestsellers/books/ref=pd_ts_rss_link",
//				"delicious" 	=> "http://feeds.delicious.com/v2/rss/?count=25",
				"digg" 			=> "http://services.digg.com/2.0/story.getTopNews?type=rss",
				"flickr" 		=> "http://pipes.yahoo.com/pipes/pipe.run?_id=93b846efb5d1f3b6c9f4a2d4522c3308&_render=rss",
				"googletrends" 	=> "http://www.google.com/trends/hottrends/atom/hourly",
							
				"hulu" 			=> "http://rss.hulu.com/HuluPopularVideosToday?format=xml",
				"itunes" 		=> "http://ax.itunes.apple.com/WebObjects/MZStoreServices.woa/ws/RSS/topsongs/limit=100/xml",
				"reddit" 		=> "http://www.reddit.com/.rss",	
				"yahoobuzz" 	=> "http://buzzlog.buzz.yahoo.com/feeds/buzzoverl.xml",
							
				"yahoovideos" 	=> "http://new.music.yahoo.com/services/getRSS.php?target=/video/v1/list/published/popular;response=artists",
				"youtube" 		=> "http://gdata.youtube.com/feeds/base/standardfeeds/most_popular?client=ytapi-youtube-browse&alt=rss&time=today",																																											
				"hn"			=> "http://news.ycombinator.com/rss",
				"dribbble" 		=> "http://pipes.yahoo.com/pipes/pipe.run?_id=5193405f822c4283b9009687a1ed3321&_render=rss",
							
				"ffffound" 		=> "http://feeds.feedburner.com/ffffound/everyone",
				"pinboard" 		=> "http://feeds.pinboard.in/rss/popular/",
				"wearehunted" 	=> "http://wearehunted.com/chart.rss",
				"twitter"		=> "http://twitter.com/statuses/user_timeline/113425681.rss",
				"wordpress" 	=> "http://freshlypressed.wordpress.com/feed/",
				"picplz"		=> "http://api.picplz.com/api/v2/feed.json?type=interesting&pic_page_size=100",
				"slideshare"	=> "http://www.slideshare.net/rss/ssod",
//				"instagram" 	=> "https://api.instagram.com/v1/media/popular?client_id=6c2d1047399447e6bca9e9781ea22f43",
				"imgur" 	=> "http://feeds.feedburner.com/ImgurGallery?format=xml",
				"twitter"	=> "http://api.twitter.com/1/statuses/user_timeline.json?screen_name=toptweets&include_rts=true&count=100&trim_user=1",
"xydo" => "http://www.xydo.com/f/x_all",
"topsy"=> "http://otter.topsy.com/toplinks.rss?thresh=top100",
"behance" => "http://feeds.feedburner.com/behance/vorr?format=xml"		
			);
	
			$json_sites = array ('picplz', 'instagram', 'twitter');
			
			//look if files exist, if not,  get them
			foreach ( $sites as $site => $url )
			{
				if ( in_array ( $site, $json_sites ) )
					$extension = '.json';
				else
					$extension = '.xml';
				
				$file_path = 'feeds/'.$site.'/'.$site.$t_year.$t_month.$t_day.$extension;
				if ( !file_exists ( $file_path ) )
				{
					echo "GETTING ". $site.'-->'.$url;
					$this->_getFeed( $url, $site, $extension );
				}
				else
				{
					//if file exists but it is empty, get it again
					if ( filesize ( $file_path ) < 800 )
					{
						echo "GETTING ". $site.'-->'.$url;
						$this->_getFeed( $url, $site, $extension );
					}
					else
					{
						echo "DONE ". $site.'-->'.$url;
					}										
				}
				echo "<br>";
			}								
		}
		else
		{
			echo "NO schedule";
		}
	}
	
	function clean()
	{
		//this will clean the cron logs every week
	}

	//////////////////////////////////////////////
	//Get the feed from the site
	function _getFeed($siteUrl, $siteName, $extension)
	//------------------------------------------
	{
		$today = date("Ymd");		
		$data = file_get_contents($siteUrl);
		if ( ! write_file('./feeds/'.$siteName.'/'.$siteName.$today.$extension, $data))//write file in root/feeds/sitename
		{
			 echo 'Unable to write the file';
			 return false;
		}
		else
		{
			 echo 'File written!'; 
			 return true;
		}	
	}
	
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */