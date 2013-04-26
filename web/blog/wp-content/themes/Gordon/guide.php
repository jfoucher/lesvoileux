<?php
function theme_guide(){
add_theme_page( 'Theme guide','Theme documentation','edit_themes', 'theme-documentation', 'w2f_theme_guide');
}
add_action('admin_menu', 'theme_guide');

function w2f_theme_guide(){
		echo '<div class="wrap">
		<div id="icon-options-general" class="icon32"><br></div>
		<h2>Theme Documentation</h2>
		
		<div class="metabox-holder">
		<div class="postbox-container" style="width:70%;">
		
		
		
				<div class="postbox"> <!-- postbox begin -->
						<h3 class="hndle"> <span> Theme License </span> </h3>
						
						<div class="inside">
						<p>	The PHP code of the theme is licensed under the GPL license as is WordPress itself. You can read it here: http://codex.wordpress.org/GPL. 
  							All other parts of the theme including, but not limited to the CSS code, images, and design are licensed for free personal usage.  </p>
  								<p> You are requested to retain the credit banners on the template. </p>
  								<p> You are allowed to use the theme on multiple installations, and to edit the template for your personal use. </p>
  								<p> You are NOT allowed to edit the theme or change its form with the intention to resell or redistribute it. </p>  
  								<p> You are NOT allowed to use the theme as a part of a template repository for any paid CMS service. </p>
							
						</div>
				</div> <!-- postbox end -->
				
				
				<div class="postbox"> <!-- postbox begin -->
						<h3 class="hndle"> <span> About the theme </span> </h3>
						
						<div class="inside">
						<p>	Gordon is a tumlog theme. The theme supports the following formats.  </p>
  			<ol>
  				<li><b>Aside</b> - Typically styled without a title. Similar to a Facebook note update.  </li>
  				<li><b>Link</b> - Post will contain a link or group of links</li>
				<li><b>Image</b> - Post with image. It uses the featured image property to attach image </li>	
				<li><b>Audio</b> - Post with audio file. Use the audio file metabox to enter the audio url.</li>
				<li><b>Video</b> - Post with video . Use the video metabox to enter the video embed code.</li>
				<li><b>Chat</b> - Post with chat transcript. </li>
				<li><b>Quote</b> - Post with quote from famous personalities. </li>
				<li><b>Standard</b> - Deafult post without any format </li>
  			</ol>
							
						</div>
				</div> <!-- postbox end -->
		
		
	
				
								
		
		
		</div>
		</div>
		
		
		
		</div>';
}

 ?>