<?php
/*
Author: Eddie Machado
URL: htp://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images, 
sidebars, comments, ect.
*/

/************* INCLUDE NEEDED FILES ***************/

/*
1. library/bones.php
    - head cleanup (remove rsd, uri links, junk css, ect)
	- enqueueing scripts & styles
	- theme support functions
    - custom menu output & fallbacks
	- related post function
	- page-navi function
	- removing <p> from around images
	- customizing the post excerpt
	- custom google+ integration
	- adding custom fields to user profiles
*/
require_once('library/bones.php'); // if you remove this, bones will break
/*
2. library/custom-post-type.php
    - an example custom post type
    - example custom taxonomy (like categories)
    - example custom taxonomy (like tags)
*/
require_once('library/custom-post-type.php'); // you can disable this if you like
/*
3. library/admin.php
    - removing some default WordPress dashboard widgets
    - an example custom dashboard widget
    - adding custom login css
    - changing text in footer of admin
*/
require_once('library/admin.php'); // this comes turned off by default
/*
4. library/translation/translation.php
    - adding support for other languages
*/
// require_once('library/translation/translation.php'); // this comes turned off by default

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'home-frame', 725, 425, true );
add_image_size( 'home-frame-wide', 1300, 425, true );
add_image_size( 'thumb-narrow', 70, 0 );


add_filter( 'image_size_names_choose', 'my_custom_sizes' );

function my_custom_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'thumb-narrow' => __('Narrow Thumbnail'),
        'salsa-template-wide' => __('Salsa Template Wide'),
    ) );
}

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
    register_sidebar(array(
    	'id' => 'sidebar1',
    	'name' => 'Sidebar',
    	'description' => 'The primary sidebar that appears on most pages.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));
        
    register_sidebar(array(
    	'id' => 'footer1',
    	'name' => 'Footer Widgets',
    	'description' => 'Widgets in the main footer area.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h3 class="widgettitle">',
    	'after_title' => '</h3>',
    ));

} // don't remove this bracket!

/************* COMMENT LAYOUT *********************/
		
// Comment Layout
function bones_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="clearfix">
			<header class="comment-author vcard">
			    <?php 
			    /*
			        this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
			        echo get_avatar($comment,$size='32',$default='<path_to_url>' );
			    */ 
			    ?>
			    <!-- custom gravatar call -->
			    <?php
			    	// create variable
			    	$bgauthemail = get_comment_author_email();
			    ?>
			    <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5($bgauthemail); ?>?s=32" class="load-gravatar avatar avatar-48 photo" height="32" width="32" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
			    <!-- end custom gravatar call -->
				<?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>
				<time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time('F jS, Y'); ?> </a></time>
				<?php edit_comment_link(__('(Edit)', 'bonestheme'),'  ','') ?>
			</header>
			<?php if ($comment->comment_approved == '0') : ?>
       			<div class="alert info">
          			<p><?php _e('Your comment is awaiting moderation.', 'bonestheme') ?></p>
          		</div>
			<?php endif; ?>
			<section class="comment_content clearfix">
				<?php comment_text() ?>
			</section>
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</article>
    <!-- </li> is added by WordPress automatically -->
<?php
} // don't remove this bracket!

/************* SEARCH FORM LAYOUT *****************/

// Search Form
function bones_wpsearch($form) {
    $form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
    <label class="screen-reader-text" for="s">' . __('Search for:', 'bonestheme') . '</label>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="'.esc_attr__('Search the Site...','bonestheme').'" />
    <input type="submit" id="searchsubmit" value="'. esc_attr__('Search') .'" />
    </form>';
    return $form;
} // don't remove this bracket!

// VIDEO
// remove dimensions from oEmbed videos
add_filter( 'embed_oembed_html', 'tdd_oembed_filter', 10, 4 ) ; 
function tdd_oembed_filter($html, $url, $attr, $post_ID) {
    $return = '<figure class="video-container">'.$html.'</figure>';
    return $return;
}

// DO SHORTCODES IN WIDGETS
//add_filter('widget_text', 'do_shortcode');

// SOCIAL ICONS
add_filter( 'storm_social_icons_type', create_function( '', 'return "icon-sign";' ) );
add_filter( 'storm_social_icons_networks', 'extra_icons');
function extra_icons($networks) {
    $extra_icons = array (
        '/feed' => array( 'class' => 'rss', 'icon' => 'icon-rss', 'icon-sign' => 'icon-rss-sign' ),
        );
    $extra_icons = array_merge( $networks, $extra_icons );
    return $extra_icons;
}

// LIMIT WORDS IN EXCERPTS
function string_limit_words($string, $word_limit) {
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit)
  array_pop($words);
  return implode(' ', $words);
}

// FILTER WORDPRESS SEO BY YOAST
    // remove WP-SEO columns from edit-list pages in admin
    add_filter( 'wpseo_use_page_analysis', '__return_false' );
    // put WP-SEO panel at bottom of edit screens (low priority)
    add_filter('wpseo_metabox_prio' , 'my_wpseo_metabox_prio' );
    function my_wpseo_metabox_prio() {
        return 'low' ;                                
    }

function get_custom_field_value($szKey, $bPrint = false) {
    global $post;
    $szValue = get_post_meta($post->ID, $szKey, true);
    if ( $bPrint == false ) return $szValue; else echo $szValue;
}

// REPLACE _* *_ WITH <STRONG> HTML IN WIDGET TITLES
// usage: _*This*_ word is bold
add_filter( 'widget_title', function($title) {
    $title = str_replace('_*', '<strong>', $title);
    $title = str_replace('*_', '</strong>', $title);
    return $title;
} );


// display term list shortcode [display_terms type="term-slug"]
add_shortcode( 'display_terms', 'display_terms' );
function display_terms( $atts ) {
    extract( shortcode_atts( array(
        'type' => '',
    ), $atts ) );

    $args = array( 'orderby' => 'name', 'hide_empty' => 1 );
    $terms = get_terms($type, $args);

    $count = count($terms); $i=0;
    if ($count > 0) {
        $term_list = '<ul class="my_tag_archive">';
        foreach ($terms as $term) {
            $i++;
            $term_list .= '<li><a class="term-title" href="'. site_url() . '/learning-center/resources/' . $type . '/' . $term->slug . '" title="' . sprintf(__('View all %s resources', 'my_localization_domain'), $term->name) . '">' . $term->name . '</a><span>'. $term->description . '</span>';
            if ($count != $i) $term_list .= '</li>'; else $term_list .= '</li></ul>';
        }
        return $term_list;
    }
}

// PRINT CATEGORY COLORS FOR EVENT WIDGET IN HEADER
add_action( 'wp_print_styles', 'my_print_event_cat_colours' );
function my_print_event_cat_colours(){
    if (function_exists('eo_get_category_color')) {
        $cats = get_terms( 'event-category' );
        if( $cats ){

            echo '<style>';
            foreach( $cats as $cat ){
                     printf( 
                          ".ew-%s{ background: %s;}\n", 
                          sanitize_html_class( $cat->slug ), 
                          eo_get_category_color( $cat ) 
                     ); 
            }
            echo '</style>';
        }
    }
}

add_filter( 'widget_text', array( $wp_embed, 'run_shortcode' ), 8 );
add_filter( 'widget_text', array( $wp_embed, 'autoembed'), 8 );
add_filter('widget_text', 'do_shortcode');


// SET UP NOTIFICATIONS FOR LOCAL CASA FORMS
add_filter('gform_field_value_notify_email', 'populate_post_notify_email');
function populate_post_notify_email($value){
    global $post;

    $notify_email = get_post_meta($post->ID, 'form_notification_email', true);

    return $notify_email;
}

// ADD FOOTER OPTIONS PAGE ACF acf
if( function_exists('acf_add_options_page') ) {
  acf_add_options_page('Footer Info'); // necessary for v.5 :-/
}

//SHORTCODE FOR YEAR
// usage: [year]
add_shortcode('year', 'year_shortcode');
function year_shortcode() {
  $year = date('Y');
  return $year;
}

// SHORTCODE FOR EMAIL OBFUSCATION
add_shortcode('email', 'emailbot_ssc');
function emailbot_ssc($attr) {
    extract( shortcode_atts( array(
        'address' => '',
    ), $attr ) );
 
    $email = '<a class="email_link" href="mailto:'.antispambot($attr['address']).'" title="Send Us An Email" target="_blank">';
    $email .= antispambot($attr['address']);
    $email .= '</a>';
 
    return $email;
}

add_action( 'pre_get_posts', 'tc_posts_per_page', 1 );
function tc_posts_per_page( $query ) {
    if ( is_admin() || !$query->is_main_query() )
        return;

    if ( is_post_type_archive() || is_tax() ) {
        // Display all posts for a custom post type called 'find your nearest'
        $query->set( 'posts_per_page', 1000 );
        return;
    }
}

// ACF Add custom scripts into wp_footer
add_action('wp_footer', 'add_footerscripts');
function add_footerscripts() {
    if(function_exists('get_field') && get_field('additional_scripts', 'option')) {
        echo get_field('additional_scripts', 'option');
    }
}


add_filter('wpseo_breadcrumb_links', 'remove_home_from_breadcrumb');
function remove_home_from_breadcrumb($links)
{
    if ( $links[0]['url'] == get_home_url() ) {
        array_shift($links);
    }
    return $links;
}

add_action( 'after_setup_theme', 'wpse3882_after_setup_theme' );
function wpse3882_after_setup_theme()
{
    add_editor_style();
}
// see http://wordpress.stackexchange.com/questions/141534/how-to-customize-tinymce4-in-wp-3-9-the-old-way-for-styles-and-formats-doesnt
add_filter('tiny_mce_before_init', 'mce_mod');
function mce_mod( $init ) {
    $init['block_formats'] = 'Paragraph=p;Heading 1=h1;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6';

    $style_formats = array (
        array( 'title' => 'Cursive text', 'inline' => 'span', 'classes' => 'curlytext' ),
        array( 'title' => 'Call To Action Button (Red)', 'selector' => 'a,span', 'classes' => 'button' ),
        array( 'title' => 'Call To Action Button (Blue)', 'selector' => 'a,span', 'classes' => 'blue button' ),
        array( 'title' => 'Big text', 'inline' => 'span', 'classes' => 'bigtext' ),
        array( 'title' => 'Bigger text', 'inline' => 'span', 'classes' => 'biggertext' ),
        array( 'title' => 'Biggest text', 'inline' => 'span', 'classes' => 'biggesttext' ),
    );

    $init['style_formats'] = json_encode( $style_formats );

    $init['style_formats_merge'] = false;
    unset($init['preview_styles']);
    return $init;
}


add_filter( 'mce_buttons_2', 'mce_add_buttons' );
function mce_add_buttons( $buttons ){
    $buttons[] = 'superscript';
    $buttons[] = 'subscript';
    $buttons[] = 'anchor';
    array_splice( $buttons, 1, 0, 'styleselect' );

   // $index = array_search( 'underline', $buttons );
    //if ( $index !== false ) { unset( $buttons[$index] ); }
    $remove = array('underline','forecolor','alignjustify');   
    return array_diff($buttons,$remove);
    //return $buttons;
}


// see http://wesbos.com/custom-wordpress-tinymce-wysiwyg-classes/
//add_filter('tiny_mce_before_init', 'make_mce_awesome');
function make_mce_awesome( $init ) {
    // our Options will go here..
    $init['theme_advanced_blockformats'] = 'p,blockquote,h1,h2,h3,h4,h5,h6';
    $init['theme_advanced_text_colors'] = 'E31D1A,3AC1E1,00457C,238FB9,AFA198';
    $init['theme_advanced_disable'] = 'underline,spellchecker,wp_help,content_wp_more,wp_more';
    $init['theme_advanced_buttons2_add'] = 'styleselect';
    $init['theme_advanced_styles'] = "Cursive text=curlytext;Call To Action Button (Red)=button,Call To Action Button (Blue)=blue button,Big text=bigtext,Bigger Text=biggertext,Biggest Text=biggesttext";
    return $init;
}

// see http://codex.wordpress.org/Plugin_API/Filter_Reference/mce_buttons,_mce_buttons_2,_mce_buttons_3,_mce_buttons_4
//add_filter('mce_buttons', 'my_mce_buttons_2');
function my_mce_buttons_2($buttons) {   
    /**
     * Add in a core button that's disabled by default
     */
    $buttons[] = 'anchor';
    $buttons[] = 'sub';
    $buttons[] = 'sup';

    return $buttons;
}

// REMOVE WIDGET TITLE IF IT BEGINS WITH EXCLAMATION POINT
// To use, add a widget and in the Title field put !The title here
// The title will show in the control panel, but not on the site itself
add_filter( 'widget_title', 'remove_widget_title' );
function remove_widget_title( $widget_title ) {
    if ( substr ( $widget_title, 0, 1 ) == '!' )
        return;
    else 
        return ( $widget_title );
}


// Add custom post types to archives
// see http://css-tricks.com/snippets/wordpress/make-archives-php-include-custom-post-types/#comment-193523
function custom_post_archive($query) {
    if (!is_admin() && !is_post_type_archive('event') && !is_post_type_archive('find_your_nearest') && !is_tax('event-venue') && !is_tax('event-category') && $query->is_archive)
        $query->set( 'post_type', array('resources', 'nav_menu_item', 'post') );
    remove_action( 'pre_get_posts', 'custom_post_archive' );
}
add_action('pre_get_posts', 'custom_post_archive');