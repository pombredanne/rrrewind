				<?php

$CI =& get_instance();
/*				
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
/*				
function show_site ( $site, $content, $item_number )
{
	switch ($site)
	{
		case 'flickr': //ok
			$items = get_flickr ( $content );
			show_images ( $items, $site, $item_number );
			break;

		case 'ffffound': //ok
			$items = get_ffffound ( $content );
			show_images ( $items, $site, $item_number );			
			break;

		case 'dribbble': //ok
			$items = get_dribbble ( $content );
			show_images ( $items, $site, $item_number );
			break;					

		case 'imgur': //ok
			$items = get_imgur ( $content );
			show_images ( $items, $site, $item_number );
			break;	
			
		case 'picplz': //ok
			$items = get_picplz ( $content );
			show_images ( $items, $site, $item_number );
			break;			

		case 'instagram': //ok
			$items = get_instagram( $content );
			show_images ( $items, $site, $item_number );
			break;				
			
		case 'delicious': //ok
			$items = get_delicious( $content );
			show_lines ( $items );
			break;	
			
		case 'hn': //ok
			$items = get_delicious( $content );
			show_lines ( $items );
			break;				

		case 'reddit': //ok
			$items = get_delicious( $content );
			show_lines ( $items );
			break;

		case 'pinboard': //ok
			$items = get_pinboard ( $content );
			show_lines ( $items );
			break;				
			
		case 'digg': //ok
			$items = get_digg ( $content );
			show_lines ( $items );
			break;					

		case 'youtube': //ok
			$items = get_youtube ( $content );
			show_youtube ( $items );
			break;		

		case 'hulu': //ok
			$items = get_hulu( $content );
			show_hulu ( $items );
			break;	
			
		case 'yahoovideos': //ok
			$items = get_yahoovideos( $content );
			show_images ( $items );
			break;
			
		case 'yahoobuzz': //ok
			$items = get_yahoobuzz ( $content );
			show_lines ( $items );
			break;		
			
		case 'googletrends': //ok
			$items = get_googletrends ( $content );
			show_lines ( $items );
			break;

		case 'amazon': //ok
			$items = get_amazon( $content );
			show_images ( $items, 0, false );
			break;		
			
		case 'itunes'://ok
			$items = get_itunes( $content );
			show_duo (  $items );
			break;

		case 'wearehunted': //ok
			$items = get_wearehunted ( $content );
			show_duo (  $items );
			break;
			
		case 'twitter'://ok
			$items = get_twitter ( $content );
			show_duo (  $items );
			break;

		case 'wordpress': //ok
			$items = get_delicious( $content );
			show_lines ( $items );
			break;			
	}

}				

//-------------------------------------------
function show_images ( $items, $site, $id=0, $show_social=true )
//-------------------------------------------
{
	$count = 1;
	$CI =& get_instance();
	$url_prefix = $CI->uri->segment(1).'/'.$CI->uri->segment(2).'/'.$CI->uri->segment(3).'/'.$CI->uri->segment(4);
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
						<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:like href="http://rrrewind.com/123" layout="button_count" show_faces="false" width="90" font=""></fb:like>
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
		$result[$i] = new item ( 'image', (string)$links[$i], '', $image );
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
		$result[$i] = new item ( 'image', (string)$links[$i], '', $image );
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
		$result[$i] = new item ( 'image', (string)$links[$i], '', $image );
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
*/
?>		


	<div id="content_wrap">
		<div id="content">
			<div id="top">
				<h1>Popular on <?php echo $domains [$site]['name'].'&nbsp;&nbsp;&nbsp;&nbsp;'.$y.'/'.$m.'/'.$d?></h1>
				<div id="archives"><a href="<?php echo site_url ('archives/'.$site);?>">archives</a></div> 
			</div>
				
				<?php
	switch ($site)
	{
		case 'flickr': //ok
			show_images ( $items, $site, $y, $m, $d, $item_number );
			break;

		case 'ffffound': //ok
			show_images ( $items, $site, $y, $m, $d, $item_number );			
			break;

		case 'dribbble': //ok
			show_images ( $items, $site, $y, $m, $d, $item_number );
			break;					

		case 'imgur': //ok
			show_images ( $items, $site, $y, $m, $d, $item_number );
			break;	
			
		case 'picplz': //ok
			show_images ( $items, $site, $y, $m, $d, $item_number );
			break;			

		case 'instagram': //ok
			show_images ( $items, $site, $y, $m, $d, $item_number );
			break;				
			
		case 'delicious': //ok
			show_lines ( $items, $site, $y, $m, $d );
			break;	
			
		case 'hn': //ok
			show_lines ( $items, $site, $y, $m, $d );
			break;				

		case 'reddit': //ok
			show_lines ( $items, $site, $y, $m, $d );
			break;

		case 'pinboard': //ok
			show_lines ( $items, $site, $y, $m, $d );
			break;				
			
		case 'digg': //ok
			show_lines ( $items, $site, $y, $m, $d );
			break;					

		case 'youtube': //ok
			show_youtube ( $items, $site, $y, $m, $d );
			break;		

		case 'hulu': //ok
			show_hulu ( $items, $site, $y, $m, $d );
			break;	
			
		case 'yahoovideos': //ok
			show_images ( $items, $site, $y, $m, $d );
			break;
			
		case 'yahoobuzz': //ok
			show_lines ( $items, $site, $y, $m, $d );
			break;		
			
		case 'googletrends': //ok
			show_lines ( $items, $site, $y, $m, $d );
			break;

		case 'amazon': //ok
			show_images ( $items, $site, $y, $m, $d, 0, false );
			break;		
			
		case 'itunes'://ok
			show_duo (  $items, $site, $y, $m, $d );
			break;

		case 'wearehunted': //ok
			show_duo (  $items, $site, $y, $m, $d );
			break;
			
		case 'twitter'://ok
			show_duo (  $items, $site, $y, $m, $d );
			break;

		case 'wordpress': //ok
			show_lines ( $items, $site, $y, $m, $d );
			break;			
	}				
				
				/*

				//For XML
				if ( $domains[$site]['type'] == 'xml' )
				{				
					$file_content = file_get_contents($feedUrl);
					if($file_content)
					{
						$xml = simplexml_load_string($file_content, null, LIBXML_NOCDATA);
						if($xml !== false)
						{						
							show_site ( $site, $xml, $item_number );												
						}
					}
				}

				//For JSON
				if ( $domains[$site]['type'] == 'json' )
				{				
					$file_content = file_get_contents($feedUrl);
					if($file_content)
					{
						$json = json_decode ( $file_content, true );						
						show_site ( $site, $json, $item_number );
					}
				}
				*/
				?>															
		</div><!-- end content -->
	</div><!-- end content_wrap -->
		
	<div id="right_column">
		<div id="rew">
			<div id="rew_content">
				<a href="<?php echo site_url($yesterday); ?>"><img id="button_rew" src="<?php echo site_url ('assets/button_rew.jpg');?>" ></a>
				<br>Previous day
			</div>
		</div>
	</div>
</div><!-- end wrap -->
