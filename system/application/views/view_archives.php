	<div id="content_wrap">
		<div id="content" class="archives_links">
			<h1>Archives / <?php echo $domains[$site]["name"];?></h1>
			<?php 
			$feednames =  get_files ( $site );
			$site_lenght = strlen ( $site );	

			if ( $feednames )
			{				
				foreach ( $feednames as $feedname)
				{
					$string = substr( $feedname, $site_lenght, 8);
					$feed_date = extract_feed_date ( $feedname, $site );
					?><a class="archives_link" href="<?php echo site_url ( $site.'/'.$feed_date['y'].'/'.$feed_date['m'].'/'.$feed_date['d'] );?>"><?php echo $string;?></a><br><?php
				}
			}		
			?>
		</div><!-- end content -->
	</div><!-- end content_wrap -->
	
</div><!-- end wrap -->
