<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<?php if ( $this->uri->segment(1) =='' ) $title = "rrrewind: popular links archive";?>
<title><?php echo $title ;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="<?php echo site_url("assets/style.css") ?>" type="text/css" media="screen, projection">
<link REL="SHORTCUT ICON" HREF="<?php echo site_url("assets/favicon.ico") ?>">
<meta name="google-site-verification" content="yCqWPK2bHxixc9vAlThYtvbRIdWddA4feSc9AlZjplA" />
<meta name="verifyownership" content="58037bffacde7da9cc3e6305ea059e05" />

<script language="javascript" type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>

<script>
$(document).ready(function()
 {	
	$(".links").mouseover(function() {
		$(this).css("background-color","#eee");
	});

	$(".links").mouseout(function() {
		$(this).css("background-color","#f6f6f6");
	});
	
	
	$(".itunes_item").mouseover(function() {
		$(this).css("background-color","#eee");
	});
	
	$(".itunes_item").mouseout(function() {
		$(this).css("background-color","#f6f6f6");
	});	
	
	$(".item_visual").mouseover(function() {
		$(this).css("background-color","#eee");
	});
	
	$(".item_visual").mouseout(function() {
		$(this).css("background-color","#f6f6f6");
	});


	$("#rew").click(function() {
		document.location.href='<?php echo site_url($yesterday); ?>';
	});
		
	$("#rew").mouseover(function() {
		$(this).css("background-color","#eee");
		$(this).css('cursor','pointer');
		$('#button_rew').attr('src','<?php echo site_url ('assets/button_rew_hover.jpg');?>');				
	});

	$("#rew").mouseout(function() {
		$(this).css("background-color","#f6f6f6");
		$('#button_rew').attr('src','<?php echo site_url ('assets/button_rew.jpg');?>');
	});
	
	var desirable_height = $(window).height();
	$("#rew").height(desirable_height);
 }
)


</script>

<script type="text/javascript" src="http://scripts.embed.ly/embedly.js" ></script>

<script type="text/javascript">
var embedly_cssSelector = 'a.embedthing';
</script>


<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-7449067-3']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

<?php
if ( $item_number != 0 )
{?>
<meta property="og:title" content="<?php echo str_replace ('"', '', $items[$item_number-1]->name );?>" />
<meta property="og:type" content="article" />
<meta property="og:url" content="<?php echo site_url( $site.'/'.$y.'/'.$m.'/'.$d.'/'.$item_number);?>" />
<meta property="og:image" content="<?php echo $items[$item_number-1]->image;?>" />
<meta property="og:site_name" content="Rrrewind" />
<meta property="fb:app_id" content="35329151568" />
<?php
}
?>
</head>

<body>
<div id="wrap">
	<div id="sidebar">
		<div id="navbar">
			<a href="<?php echo site_url ();?>"><img src="<?php echo site_url ('assets/logo.png');?>"></a><br><br>
				
			<!-- NAVIGATION -->
			<ul><?php
			foreach ( $domains as $domain )
			{
				if ( $domain['type'] == 'separator' )
					echo "<li class='separator'></li>";
				else 
				{
					//current navigation
					if ( $site == $domain['webname'] )
					{ $current = ' class="current"';}
					else
					{ $current = '';}
					/*?><li <?php echo $current;?>><a href="<?php echo site_url($domain."/".$y.'/'.$m.'/'.$d); ?>"><?php echo $value;?></a></li><?php
					*/
					?><li <?php echo $current;?>><a href="<?php echo site_url($domain['webname']); ?>"><?php echo $domain['name'];?></a></li><?php
				}	
			}
			?>
			</ul>
		</div>
		
		<div id="press">
			<h4>Press</h4>
			<p>
				"See what went popular and when"<br>			
				<a href="http://techcrunch.com/2010/12/30/rrrewind/">TechCrunch</a>
			</p>
			<p>
				"A Wayback Machine for Social Media"<br>			
				<a href="http://lifehacker.com/#!5729801/rrrewind-is-a-wayback-machine-for-social-media">Lifehacker</a>
			</p>
			<p>
				"This will quickly become one of your favourite haunts"<br>			
				<a href="http://www.makeuseof.com/tag/hot-online-missed-find-rrrewind/">MakeUseOf</a>
			</p>
		</div>

		<div id="social">
			<h4>Share</h4>
			<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:like href="http://rrrewind.com" layout="button_count" show_faces="false" width="100" font="arial"></fb:like>
			<br>
			<a href="http://twitter.com/share" class="twitter-share-button" data-url="http://rrrewind.com" data-text="Travel in time with rrrewind.com" data-count="none" data-via="earlyriser">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>	
		</div>
		
		<img src="<?php echo site_url ('assets/button_rew_hover.jpg');?>" height="0" width="0">
	</div>	