
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<div class="post-cover">

<div class="format-box">
<?php
	$format = get_post_format();
	if ( $format == "image" ) { echo '<i class="icon-picture"></i> '; }  
	else if ( $format == "link" ) { print '<i class="icon-link"></i>';  }  
	else if ( $format == "audio" ) { print '<i class="icon-music"></i>';  }  
	else if ( $format == "video" ) { print '<i class="icon-film"></i>';  }  
	else if ( $format == "quote" ) { print '<i class="icon-comment-alt"></i>';  }  
	else if ( $format == "aside" ) { print '<i class="icon-pencil"></i>';  } 
	else { print '<i class="icon-file"></i>';  }  
 ?>
 </div>

	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', '_s' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

		<footer class="entry-meta">
	
		<span class="clock"> <i class="icon-time"></i> <?php days_ago(); ?></span> 
		<span class="perml"> <i class="icon-bolt"></i> <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', '_s' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">PERMALINK</a></span>
			
	</footer><!-- #entry-meta -->
</div>	
	</article><!-- #post-<?php the_ID(); ?> -->
