<?php
class item
{
	public $name;
	public $url;
	public $type;
	public $image;

   function __construct( $type=false, $url=false, $name=false, $image=false) 
   {
		$this->type = $type;
		$this->url = $url;
		$this->name = $name;
		$this->image = $image;
   }
}


	//This function tell what to do according URL segments
	function whatToDo($y, $m, $d, $site)
	//------------------------------------------
	{
		$doThis = 'error';
		//rrrewinder.com/site/yyyy/mm/dd				
		if ( $site !==false && $y !==false && $m !==false && $d !==false )
			$doThis ="day";
		if 	( $y ==false && $m ==false && $d ==false )
			$doThis ="recent";

		return $doThis;
	}
	
	//------------------------------------------
	function check_year ( $y )
	//------------------------------------------
	{
		//if ( $y == '')
		//	return date('Y',mktime(0,0,0,date("m"),(date("d")-1),date("Y")));	
					
		if ( is_numeric ( $y ) )
			return ( $y );
		else
			return false;
	}

	//------------------------------------------
	function check_month ( $m )
	//------------------------------------------
	{		
	//	if ( $m == '')
	//		return date('m',mktime(0,0,0,date("m"),(date("d")-1),date("Y")));		
	
		if ( is_numeric ( $m ) && $m >= 1 && $m <= 12 )
			return ( $m );
		else
			return false;
	}
	
	//------------------------------------------
	function check_day ( $d )
	//------------------------------------------
	{
	//	if ( $d == '')
	//		return date('d',mktime(0,0,0,date("m"),(date("d")-1),date("Y")));	
	
		if ( is_numeric ( $d ) && $d >= 1 && $d <= 31 )
			return ( $d );
		else
			return false;
	}	
	
	//------------------------------------------
	function check_site ( $webname, $domains )
	//------------------------------------------
	{
		if ( array_key_exists ( $webname, $domains ) )
			return $webname;
		else
			return 'flickr';
	}			

	//------------------------------------------
	function get_domains ()
	//------------------------------------------
	{
		$domains = array ();
		
		$domains['delicious'] 	= array ( 'name' => 'delicious', 	'webname' => 'delicious', 	'type' => 'xml' );
		$domains['digg'] 		= array ( 'name' => 'digg', 		'webname' => 'digg', 		'type' => 'xml' );
		$domains['hn'] 			= array ( 'name' => 'hacker news', 	'webname' => 'hn', 			'type' => 'xml' );
		$domains['pinboard'] 	= array ( 'name' => 'pinboard', 	'webname' => 'pinboard', 	'type' => 'xml' );
		$domains['reddit'] 		= array ( 'name' => 'reddit', 		'webname' => 'reddit', 		'type' => 'xml' );
		$domains['1'] 			= array ( 'name' => '1', 			'webname' => '1', 			'type' => 'separator' );
		$domains['hulu'] 		= array ( 'name' => 'hulu', 		'webname' => 'hulu', 		'type' => 'xml' );
		$domains['youtube'] 	= array ( 'name' => 'youtube', 		'webname' => 'youtube', 	'type' => 'xml' );
		$domains['yahoovideos'] = array ( 'name' => 'yahoo videos', 'webname' => 'yahoovideos', 'type' => 'xml' );
		$domains['2'] 			= array ( 'name' => '2', 			'webname' => '2', 			'type' => 'separator' );
		$domains['dribbble'] 	= array ( 'name' => 'dribbble', 	'webname' => 'dribbble', 	'type' => 'xml' );
		$domains['flickr'] 		= array ( 'name' => 'flickr', 		'webname' => 'flickr', 		'type' => 'xml' );
		$domains['ffffound'] 	= array ( 'name' => 'ffffound', 	'webname' => 'ffffound', 	'type' => 'xml' );
$domains['imgur'] 		= array ( 'name' => 'imgur', 		'webname' => 'imgur', 		'type' => 'xml' );		
$domains['instagram'] 		= array ( 'name' => 'instagram', 		'webname' => 'instagram', 		'type' => 'json' );	
		$domains['picplz'] 		= array ( 'name' => 'picplz', 		'webname' => 'picplz', 		'type' => 'json' );
		$domains['3'] 			= array ( 'name' => '3', 			'webname' => '3', 			'type' => 'separator' );
		$domains['itunes'] 		= array ( 'name' => 'itunes', 		'webname' => 'itunes', 		'type' => 'xml' );
		$domains['wearehunted'] = array ( 'name' => 'we are hunted','webname' => 'wearehunted', 'type' => 'xml' );
		$domains['4'] 			= array ( 'name' => '6', 			'webname' => '6', 			'type' => 'separator' );
		$domains['twitter'] 	= array ( 'name' => 'twitter', 		'webname' => 'twitter', 	'type' => 'json' );
		$domains['wordpress'] 	= array ( 'name' => 'wordpress', 	'webname' => 'wordpress', 	'type' => 'xml' );
		$domains['5'] 			= array ( 'name' => '5', 			'webname' => '5', 			'type' => 'separator' );		
		$domains['googletrends']= array ( 'name' => 'google trends','webname' => 'googletrends','type' => 'xml' );
		$domains['yahoobuzz'] 	= array ( 'name' => 'yahoo buzz', 	'webname' => 'yahoobuzz', 	'type' => 'xml' );
		$domains['6'] 			= array ( 'name' => '4', 			'webname' => '4', 			'type' => 'separator' );		
		$domains['amazon'] 		= array ( 'name' => 'amazon', 		'webname' => 'amazon', 		'type' => 'xml' );
		
		return $domains;
	}

	//------------------------------------------
	function get_files ( $webname )
	//------------------------------------------
	{
			$files =  array_reverse ( scandir ( "feeds/".$webname ) );
			$site_lenght = strlen ( $webname );	

			if ( $files )
			{
				//getting rid off . and .. directories
				array_pop ( $files );
				array_pop ( $files );
			}
			return $files;
	}
	
	//------------------------------------------
	function get_recent_feed ( $webname ) 			//('hn') return hn20101231.xml
	//------------------------------------------
	{
		$files =  get_files ( $webname );
		if ( $files )
			return $files[0];
		else return false;
	}
	
	//------------------------------------------
	function extract_feed_date ( $feed, $site ) //ex ( hn20101231.xml 'hn') return: array (y=>2010,m=>12,d=>31)
	//------------------------------------------
	{
		//eliminate site form str
		$count = strlen ( $site );
		$date  = substr ($feed, $count, 8);	
		
		$feed_date = array ();
		$feed_date['y'] = substr ($date, 0, 4); //year
		$feed_date['m'] = substr ($date, 4, 2); //month
		$feed_date['d'] = substr ($date, 6, 2); //day
		
		return $feed_date;	
	}


	//------------------------------------------
	
	
	
	
	
	
	
	
	
				
function extract_items ( $site, $content )
{
	switch ($site)
	{
		case 'flickr': //ok
			$items = get_flickr ( $content );
			break;

		case 'ffffound': //ok
			$items = get_ffffound ( $content );			
			break;

		case 'dribbble': //ok
			$items = get_dribbble ( $content );
			break;					

		case 'imgur': //ok
			$items = get_imgur ( $content );
			break;	
			
		case 'picplz': //ok
			$items = get_picplz ( $content );
			break;			

		case 'instagram': //ok
			$items = get_instagram( $content );
			break;				
			
		case 'delicious': //ok
			$items = get_delicious( $content );
			break;	
			
		case 'hn': //ok
			$items = get_delicious( $content );
			break;				

		case 'reddit': //ok
			$items = get_delicious( $content );
			break;

		case 'pinboard': //ok
			$items = get_pinboard ( $content );
			break;				
			
		case 'digg': //ok
			$items = get_digg ( $content );
			break;					

		case 'youtube': //ok
			$items = get_youtube ( $content );
			break;		

		case 'hulu': //ok
			$items = get_hulu( $content );
			break;	
			
		case 'yahoovideos': //ok
			$items = get_yahoovideos( $content );
			break;
			
		case 'yahoobuzz': //ok
			$items = get_yahoobuzz ( $content );
			break;		
			
		case 'googletrends': //ok
			$items = get_googletrends ( $content );
			break;

		case 'amazon': //ok
			$items = get_amazon( $content );
			break;		
			
		case 'itunes'://ok
			$items = get_itunes( $content );
			break;

		case 'wearehunted': //ok
			$items = get_wearehunted ( $content );
			break;
			
		case 'twitter'://ok
			$items = get_twitter ( $content );
			break;

		case 'wordpress': //ok
			$items = get_delicious( $content );
			break;			
	}
	return $items;
}				

//-------------------------------------------
function show_images ( $items, $site, $y, $m, $d, $id=0, $show_social=true )
//-------------------------------------------
{
	$count = 1;
	$CI =& get_instance();
	$url_prefix = $site.'/'.$y.'/'.$m.'/'.$d;
	foreach ( $items as $item ) 
	{
		if ( $id == 0 )
		{
		?>
			<div class="new_item">
				<div class="column">
					<a href="<?php echo $item->url;?>"><img title="<?php echo $item->name;?>" class="framed_img" src="<?php echo $item->image;?>"></a>
				</div>
				<?php
				/*
				if ( $show_social )
				{?>
				<div class="social">
					<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:like href="<?php echo site_url( $url_prefix.'/'.$count);?>" layout="button_count" show_faces="false" width="90" font=""></fb:like>
				</div>
				<?php
				}
				*/
				?>
			</div>
		<?php
		}
		else
		{
			if ( $count == $id )
			{
			?>
				<div class="new_item">
					<div class="column">
						<a href="<?php echo $item->url;?>"><img title="<?php echo $item->name;?>" class="framed_img" src="<?php echo $item->image;?>"></a>
					</div>
					<?php
					if ( $show_social )
					{?>
					<div class="social">
						<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:like href="<?php echo site_url( $url_prefix.'/'.$count);?>" layout="button_count" show_faces="false" width="90" font=""></fb:like>
					</div>
					<?php
					}?>
				</div>
			<?php
			}
		}
		$count++;
	}
}

//-------------------------------------------
function show_duo ( $items)
//-------------------------------------------
{
	foreach ( $items as $item ) 
	{
	?>


		<div class="item_visual">
			<div class="left">
				<a href="<?php echo $item->url;?>"><img src="<?php echo $item->image;?>" height="55" width="55"></a>
			</div>
			<div class="right">
				<a class="" href="<?php echo $item->url;?>"><?php echo $item->name;?></a>
			</div>						
		</div>			
	

	<?php
	}
}

//-------------------------------------------
function show_lines ( $items )
//-------------------------------------------
{
	foreach ( $items as $item ) 
	{
	?>
		<div class="new_item">
			<a class="links" href="<?php echo $item->url;?>"><?php echo $item->name;?></a>
		</div>
	<?php
	}
}

//-------------------------------------------
function show_hulu ( $items )
//-------------------------------------------
{
	foreach($items as $item)
	{?>
		<div class="item">
			<a class="embedthing" href="<?php echo $item->url;?>"><?php $item->name;?></a>
		</div><?php					
	}
}

//-------------------------------------------
function get_flickr ( $xml )
//-------------------------------------------
{
	$result = array();
	
	$items = $xml->xpath ('channel/item');
	
	$links = $xml->xpath ('channel/item/link');
	$contents = $xml->xpath ('channel/item/media:group/media:content');	
	$count = count ( $links );
	
	for ( $i=0; $i<$count; $i++ ) 
	{
		$image = str_replace ( '_m.jpg', '.jpg', (string)$contents [$i]['url']);
		$result[$i] = new item ( 'image', (string)$links[$i], $items[$i]->title, $image );
	}	
	return $result;
}

//-------------------------------------------
function get_ffffound( $xml )
//-------------------------------------------
{
	$result = array();
	
	$items = $xml->xpath ('channel/item');
	$links = $xml->xpath ('channel/item/link');
	$contents = $xml->xpath ('channel/item/media:content');	
	$count = count ( $links );
	
	for ( $i=0; $i<$count; $i++ ) 
	{
		$image = (string)$contents [$i]['url'];
		$result[$i] = new item ( 'image', (string)$links[$i], $items[$i]->title, $image );
	}	
	return $result;
}


//-------------------------------------------
function get_dribbble( $xml )
//-------------------------------------------
{
	$result = array();
	
	$items = $xml->xpath ('channel/item');
	$links = $xml->xpath ('channel/item/link');
	$contents = $xml->xpath ('channel/item/media:content');	
	$count = count ( $links );
	
	for ( $i=0; $i<$count; $i++ ) 
	{
		$image = (string)$contents [$i]['url'];
		$result[$i] = new item ( 'image', (string)$links[$i], $items[$i]->title, $image );
	}	
	return $result;
}

//-------------------------------------------
function get_imgur( $xml )
//-------------------------------------------
{
	$result = array();
	
	$links = $xml->xpath ('channel/item/link');
	$images = $xml->xpath ('channel/item/description');
	$start = 'src="';
	$end = '"';
	$count = count ( $links );
	
	for ( $i=0; $i<$count; $i++ ) 
	{
		$image = get_string_between ( $images [ $i ], $start, $end);
		$result[$i] = new item ( 'image', $links[$i], '', $image );
	}	
	return $result;
}

//-------------------------------------------
function get_picplz( $json )
//-------------------------------------------
{
	$result = array();
	$pics = $json['value']['pics'];
	
	foreach ( $pics as $pic )
	{
		$image = $pic['pic_files']['320rh']['img_url'];
		array_push ( $result,  new item ( 'image', $pic['url'], $pic['caption'], $image ) );
	}	
	return $result;
}

//-------------------------------------------
function get_instagram( $json )
//-------------------------------------------
{
	$result = array();
	$pics = $json['data'];
	
	foreach ( $pics as $pic )
	{
		$image = $pic['images']['low_resolution']['url'];
		array_push ( $result, new item ( 'image', $pic['link'], $pic['caption']['text'], $image ) );
	}
	return $result;
}

//-------------------------------------------
//LINKS
//-------------------------------------------

	//-------------------------------------------				
	function get_delicious ( $xml )
	//-------------------------------------------
	{
		$result = array();
		
		foreach($xml->channel->item as $item)
		{
			array_push ( $result, new item ( 'link', $item->link, $item->title, '' ) );
		}
		return $result;
	}	

	//-------------------------------------------				
	function get_pinboard ( $xml )
	//-------------------------------------------
	{
		$result = array();
		
		foreach($xml->item as $item)
		{
			if ( strpos ( $item->link, 'place:') === false )
			{
				array_push ( $result, new item ( 'link', $item->link, $item->title, '' ) );	
			}
		}
		return $result;
	}					

	//-------------------------------------------				
	function get_digg ( $xml )
	//-------------------------------------------
	{
		$result = array();
		
		foreach($xml->channel->item as $item)
		{
			array_push ( $result, new item ( 'link', $item->link, $item->title, '' ) );
		}
		return $result;
	}	

//-------------------------------------------
//VIDEOS
//-------------------------------------------
	//-------------------------------------------				
	function get_youtube( $xml )
	//-------------------------------------------
	{
		$result = array();
		$i = 0;
		
		foreach($xml->channel->item as $item)
		{
			$result[$i] = new item ( 'video', (string)$item->link, $item->title, '' );
			$i++;
		}
		return $result;
	}	


	//-------------------------------------------
	function show_youtube ( $items )
	//-------------------------------------------
	{
		foreach ( $items as $item ) 
		{
			
			$video_id= str_replace("http://www.youtube.com/watch?v=", "", $item->url);
			?>
			<div class="new_item">
				<object width="425" height="355">
				<param name="movie" value="http://www.youtube.com/v/<?php echo $video_id;?>&rel=1&border=1&fs=1"></param>
				<param name="allowFullScreen" value="true"></param>
				<embed src="http://www.youtube.com/v/<?php echo $video_id;?>&rel=1&border=1&fs=1" 
					type="application/x-shockwave-flash"
					width="425" height="355" 
					allowfullscreen="true">
				</embed>
				</object>
			</div>
		<?php
		}
	}
				

	//-------------------------------------------				
	function get_hulu( $xml )
	//-------------------------------------------
	{
		$result = array();
		$i = 0;
		
		foreach($xml->channel->item as $item)
		{
			$result[$i] = new item ( 'video', $item->guid, $item->title, '' );
			$i++;
		}
		return $result;
	}				


	//-------------------------------------------				
	function get_yahoovideos( $xml )
	//-------------------------------------------
	{
		$result = array();
		$i = 0;
		
		$items = $xml->xpath ('channel/item');
		$encodeds = $xml->xpath ('channel/item/content:encoded');
		$start ='<img border="0" src="';
		$end = '" width="150">';	
		
		foreach ( $items as $item ) 
		{
			$image = str_replace ( 'size=150x', 'size=300x', get_string_between ( $encodeds[$i], $start, $end) );
			$result[$i] = new item ( 'image', (string)$item->link, (string)$item->title, $image );
			$i++;
		}
		return $result;
	}				

//-------------------------------------------
//TRENDS
//-------------------------------------------

	//-------------------------------------------				
	function get_yahoobuzz ( $xml )
	//-------------------------------------------
	{
		$result = array();
		$i = 0;
		
		foreach($xml->channel->item as $item)
		{
			$result[$i] = new item ( 'link', $item->link, $item->title, '' );
			$i++;
		}
		return $result;
	}	

	//-------------------------------------------
	function get_googletrends( $xml )
	//-------------------------------------------
	{
		$result = array();
		$i = 0; 
		$children =  $xml->children('http://www.w3.org/2005/Atom');
		$parts = $children->entry;
		$urls = array ();
		
		foreach ($parts as $entry) 
		{	
			$details = $entry->children('http://www.w3.org/2005/Atom');	
			$dom = new domDocument();	
			@$dom->loadHTML($details->content);	
			$anchors = $dom->getElementsByTagName('a');
		
			foreach ($anchors as $anchor) 
			{	
				$result[$i] = new item ( 'link', $anchor->getAttribute('href'), $anchor->nodeValue, '' );
				$i++;
			}	
		}
		return $result;

	}
	

//-------------------------------------------
function get_amazon( $xml )
//-------------------------------------------
{
	$result = array();
	$i = 0;
	
	foreach($xml->channel->item as $item)
	{
		$image = get_string_between ( $item->description, '<img src="', '"');
		$result[$i] = new item ( 'link', $item->link, $item->title, $image );
		$i++;
	}
	return $result;
}


//-------------------------------------------
//MUSIC
//-------------------------------------------
//-------------------------------------------
function get_itunes( $xml )
//-------------------------------------------
{
	$result = array();
	
	foreach ($xml->entry as $entry) 
	{	
		$imgs = $entry->xpath ('im:image');	
		$image = (string)$imgs[0];
		array_push ( $result, new item ( 'duo', (string)$entry->id, (string)$entry->title, $image ) );
	}
	return $result;
}

//-------------------------------------------
function get_wearehunted( $xml )
//-------------------------------------------
{
	$result = array();
	
	foreach ($xml->xpath ('channel/item') as $item) 
	{	
		$url = (string)$item->guid;
		$name = (string)$item->title;
		$attributes = ( $item->enclosure->attributes() );		
		foreach ( $attributes as $attribute => $value )
		{
			if ( $attribute == 'url' )
			$image = (string)$value;
		}
		array_push ( $result, new item ( 'duo', $url, $name, $image ) );
	}
	return $result;
}

//-------------------------------------------
function get_twitter( $json )
//-------------------------------------------
{
	$result = array();

	foreach ( $json as $item )
	{
		//if a retweet
		if ( isset ( $item['retweeted_status']['text'] ) )
		{
			$user = get_string_between ( $item['text'], 'RT @', ':');
			$name="<b>".$user.": </b>";			
			$name .= $item['retweeted_status']['text'];
			$id_str = $item['retweeted_status']['id_str'];			
			$image = "http://img.tweetimag.es/i/".$user."_b";
			$url = "http://twitter.com/".$user."/statuses/".$id_str;
		
			array_push ( $result, new item ( 'duo', $url, $name, $image ) );
		}	
	}
	return $result;
}


//-------------------------------------------
function show_twitter( $json )
//-------------------------------------------
{ 
	$items = $json;
	foreach ( $items as $item )
	{
		//if a retweet
		if ( isset ( $item['retweeted_status']['text'] ) )
		{
			$title = $item['retweeted_status']['text'];
			$id_str = $item['retweeted_status']['id_str'];
			$user = get_string_between ( $item['text'], 'RT @', ':');
			$src = "http://img.tweetimag.es/i/".$user."_b";
			$href = "http://twitter.com/".$user."/statuses/".$id_str;
			?>
			<div class="item_visual">
				<div class="left">
					<a href="<?php echo $href;?>"><img src="<?php echo $src;?>" height="55" width="55"></a>
				</div>
				<div class="right">
					<a class="" href="<?php echo $href;?>"><b><?php echo $user;?>: </b><?php echo $title;?></a>
				</div>						
			</div>		
			<?php			
		}		
	}
}



				

function get_string_between($string, $start, $end){

	$string = " ". $string;
	
	$ini = strpos($string,$start);
	
	if ($ini == 0) return "";
	
	$ini += strlen($start);
	
	$len = strpos($string, $end, $ini) - $ini;
	
	return substr($string, $ini, $len);

}	
?>