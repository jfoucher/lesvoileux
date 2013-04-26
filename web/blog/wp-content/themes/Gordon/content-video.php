<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<div class="post-cover">

<div class="format-box">
<i class="icon-film"></i>
 </div>

	<header class="entry-header">
		<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', '_s' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
	</header><!-- .entry-header -->

	<div class="entry-content">
	
		<div class="media-box">
			<?php $videofile= SmartMetaBox::get('video_url');			
			echo $videofile; ?>
		</div>
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', '_s' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', '_s' ), 'after' => '</div>' ) ); ?>
		
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<span class="clock"> <i class="icon-time"></i> <?php days_ago(); ?></span> 
		<span class="comments-link"> <i class="icon-comment"></i>  <?php comments_popup_link( __( 'Leave a comment', '_s' ), __( '1 Comment', '_s' ), __( '% Comments', '_s' ) ); ?></span>
		<span class="perml"> <i class="icon-bolt"></i> <a href="<?php the_permalink(); ?>" rel="bookmark">PERMALINK</a></span>
	</footer><!-- #entry-meta -->
</div>	

</article><!-- #post-<?php the_ID(); ?> -->