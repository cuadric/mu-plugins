<?php
/**
 * Plugin Name: Cuadric Common Functions
 * Plugin URI: http://www.cuadric.com
 * Description: Un repositorio con funciones comunes
 * Author: Gonzalo Sanchez
 * Author URI: http://blog.cuadric.com
 * Version: 3.0
 */

//--------------------------------------------------------------------------------------------------------------------------------


function cuadric_my_custom_frontend() {
	wp_enqueue_style( 'cuadric_trace', plugins_url( 'css/cuadric_trace.css', __FILE__ ), array(), '1' );
	wp_enqueue_script( 'cuadric_trace', plugins_url( 'js/cuadric_trace.js', __FILE__ ), array('jquery'), '1' );
}
function cuadric_my_custom_admin() {
	// --> http://codex.wordpress.org/Function_Reference/plugins_url
	if ( is_admin() ) :
		wp_enqueue_style( 'cuadric_admin_css_custom', plugins_url( 'css/cuadric_admin_customizations.css', __FILE__ ), array(), '1' );
		wp_enqueue_script( 'cuadric_admin_js_custom', plugins_url( 'js/cuadric_admin_customizations.js', __FILE__ ), array('jquery'), '1' );
	endif;

	wp_enqueue_style( 'cuadric_trace', plugins_url( 'css/cuadric_trace.css', __FILE__ ), array(), '1' );
	wp_enqueue_script( 'cuadric_trace', plugins_url( 'js/cuadric_trace.js', __FILE__ ), array('jquery'), '1' );
}

add_action('admin_enqueue_scripts', 'cuadric_my_custom_admin');
add_action('wp_enqueue_scripts', 	'cuadric_my_custom_frontend', 100);

// ---------------------------------------------------------------------------------------------------

function is_admin_logged(){
	if (current_user_can( 'manage_options' )) {
		return true;
	} else {
		return false;
	}
}

// imprime una variable, array u objeto de forma legible.
function print_var($var, $title='', $force_show=false){ // force_show es para imprimir aunque no esté el admin logueado.
	if( $force_show || is_admin_logged() ){
		print_var_now($var, $title);
	}
}

function print_var_now($var, $title=''){
		echo '<div class="debug_trace">';
			echo '<p class="debug_title"><span class="expand_btn"></span><span class="colapse_btn"></span>Trace: ';
				if($title){ echo $title; }
			echo '</p>';
			echo '<pre class="debug_pre">';
			print_r($var);
			echo '</pre>';
			?>
			<?php
		echo '</div>';
}

/**
* Uso: <?php trace($wp_query) ?> // o cualquier variable, array o lo que sea.
*
*/
function trace($var, $title='', $force_show=false){
	print_var($var, $title, $force_show);
}

// ---------------------------------------------------------------------------------------------------

// conditional tags para ver donde estamos

add_action( 'wp_footer', 'show_conditionals', 1000 );

function show_conditionals(){

	if ( ! isset($_GET['conditionals']) ) {
		return;
	}


	$c = '';

	$c .= '<div id="conditional_tags">';
		$c .= '<h2>Conditional tags</h2>';
		$c .= '<ul>';
			$c .= '<li><span class="key">comments_open</span><span class="val"> = ' . 		comments_open() . '</span></li>';
			//$c .= '<li><span class="key">has_tag</span><span class="val"> = ' . 			has_tag() . '</span></li>';
			//$c .= '<li><span class="key">in_category</span><span class="val"> = ' . 		in_category() . '</span></li>';
			$c .= '<li><span class="key">is_404</span><span class="val"> = ' . 				is_404() . '</span></li>';
			$c .= '<li><span class="key">is_admin</span><span class="val"> = ' . 			is_admin() . '</span></li>';
			$c .= '<li><span class="key">is_archive</span><span class="val"> = ' . 			is_archive() . '</span></li>';
			$c .= '<li><span class="key">is_attachment</span><span class="val"> = ' . 		is_attachment() . '</span></li>';
			$c .= '<li><span class="key">is_author</span><span class="val"> = ' . 			is_author() . '</span></li>';
			$c .= '<li><span class="key">is_category</span><span class="val"> = ' . 		is_category() . '</span></li>';
			$c .= '<li><span class="key">is_comments_popup</span><span class="val"> = ' . 	is_comments_popup() . '</span></li>';
			$c .= '<li><span class="key">is_date</span><span class="val"> = ' . 			is_date() . '</span></li>';
			$c .= '<li><span class="key">is_day</span><span class="val"> = ' . 				is_day() . '</span></li>';
			$c .= '<li><span class="key">is_feed</span><span class="val"> = ' . 			is_feed() . '</span></li>';
			$c .= '<li><span class="key">is_front_page</span><span class="val"> = ' . 		is_front_page() . '</span></li>';
			$c .= '<li><span class="key">is_home</span><span class="val"> = ' . 			is_home() . '</span></li>';
			$c .= '<li><span class="key">is_month</span><span class="val"> = ' . 			is_month() . '</span></li>';
			$c .= '<li><span class="key">is_multi_author</span><span class="val"> = ' . 	is_multi_author() . '</span></li>';
			$c .= '<li><span class="key">is_multisite</span><span class="val"> = ' . 		is_multisite() . '</span></li>';
			$c .= '<li><span class="key">is_page</span><span class="val"> = ' . 			is_page() . '</span></li>';
			$c .= '<li><span class="key">is_page_template</span><span class="val"> = ' . 	is_page_template() . '</span></li>';
			$c .= '<li><span class="key">is_paged</span><span class="val"> = ' . 			is_paged() . '</span></li>';
			$c .= '<li><span class="key">is_preview</span><span class="val"> = ' . 			is_preview() . '</span></li>';
			$c .= '<li><span class="key">is_search</span><span class="val"> = ' . 			is_search() . '</span></li>';
			$c .= '<li><span class="key">is_single</span><span class="val"> = ' . 			is_single() . '</span></li>';
			$c .= '<li><span class="key">is_singular</span><span class="val"> = ' . 		is_singular() . '</span></li>';
			$c .= '<li><span class="key">is_sticky</span><span class="val"> = ' . 			is_sticky() . '</span></li>';
			$c .= '<li><span class="key">is_super_admin</span><span class="val"> = ' . 		is_super_admin() . '</span></li>';
			$c .= '<li><span class="key">is_tag</span><span class="val"> = ' . 				is_tag() . '</span></li>';
			$c .= '<li><span class="key">is_tax</span><span class="val"> = ' . 				is_tax() . '</span></li>';
			$c .= '<li><span class="key">is_time</span><span class="val"> = ' . 			is_time() . '</span></li>';
			$c .= '<li><span class="key">is_trackback</span><span class="val"> = ' . 		is_trackback() . '</span></li>';
			$c .= '<li><span class="key">is_year</span><span class="val"> = ' . 			is_year() . '</span></li>';
			$c .= '<li><span class="key">pings_open</span><span class="val"> = ' . 			pings_open() . '</span></li>';
		$c .= '</ul>';
	$c .= '</div>';

	$c .= '<style>';
		$c .= '#conditional_tags {';
			$c .= 'padding: 2em;';
			$c .= 'font-family: monospace;';
			$c .= 'font-size: 120%;';
		$c .= '}';
		$c .= '#conditional_tags .key {';
			$c .= 'display: inline-block;';
			$c .= 'min-width: 12em;';
		$c .= '}';
	$c .= '</style>';

	echo $c;
}


// ---------------------------------------------------------------------------------------------------

// incrusta el link oculto hacia /wp-admin en un cuadrito en la esquina superior de cada página, fixed.
function cuadric_admin_link() {
	echo '<a href="' . admin_url() . '" style="display:block; position:fixed; z-index:10000; left:0; top:0; width:14px; height:14px; background-color:transparent; cursor:default;"></a>';
}
add_action('wp_footer', 'cuadric_admin_link');

// --------------------------------------------------------------------------------------------------------------------------------------------

// Change user contact fields profile
function cuadric_change_user_profile( $contactmethods ) {

	unset($contactmethods['aim']);
	unset($contactmethods['yim']);
	unset($contactmethods['jabber']);

	$contactmethods['twitter'] 		= 'Twitter (sin @)';
	$contactmethods['facebook'] 	= 'Facebook';
	$contactmethods['googleplus'] 	= 'Google Plus';

	return $contactmethods;
}
add_filter('user_contactmethods', 'cuadric_change_user_profile' , 10, 1);

// ---------------------------------------------------------------------------------------------------

// Eliminar todas las funciones de Blogueo de wordpress.

// - xmlrpc.php sirve para publicar en wordpress desde programas de escritorio y también para recibir pinhgbacks y trackbacks desde otros blogs.
// http://digwp.com/2009/06/xmlrpc-php-security/
function cuadric_remove_blogging_head_links() {
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	remove_action( 'wp_head', 'feed_links', 2 );
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'index_rel_link' );
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' );
	remove_action( 'wp_head', 'wp_generator' );
}
add_action('init', 'cuadric_remove_blogging_head_links');

// ---------------------------------------------------------------------------------------------------

	function nl2br2($string) {
		$rep    = '<br>';
		$string = str_replace(array("\r\n", "\r", "\n"), $rep, $string);
		return $string;
	}

// ---------------------------------------------------------------------------------------------------
/*
// función para obtener el ID del post o la página actual
function get_current_id() {
	global $wp_query;
	return $wp_query->post->ID;
}
// función para obtener el ID de la categoría actual (solo en category.php)
function get_current_cat_id() {
	global $wp_query;
	return $wp_query->queried_object->cat_ID;
}
// función para obtener el ID de la categoría actual (solo en category.php)
function get_current_term_id() {
	global $wp_query;
	return $wp_query->queried_object->term_id;
}
*/
// ---------------------------------------------------------------------------------------------------

// agregamos todos los custom post types a la caja "Right now" del dashboard
function cuadric_dashboard_right_now_extra_content() {

	$showTaxonomies = 1;

	// Custom taxonomies counts
	if ($showTaxonomies) {
		$taxonomies = get_taxonomies( array( '_builtin' => false ), 'objects' );

		foreach ( $taxonomies as $taxonomy ) {
			$num_terms            = wp_count_terms( $taxonomy->name );
			$num                  = number_format_i18n( $num_terms );
			$text                 = _n( $taxonomy->labels->singular_name, $taxonomy->labels->name, $num_terms );
			$associated_post_type = $taxonomy->object_type;

			if ( current_user_can( 'manage_categories' ) ) {
				$output = '<a href="edit-tags.php?taxonomy=' . $taxonomy->name . '&post_type=' . $associated_post_type[0] . '">' . $num . ' ' . $text .'</a>';
			}

			echo '<li class="taxonomy-count">' . $output . ' </li>';
		}
	}

	// Custom post types counts
	$post_types = get_post_types( array( '_builtin' => false ), 'objects' );
	foreach ( $post_types as $post_type ) {
		if($post_type->show_in_menu==false) {
			continue;
		}
		$num_posts = wp_count_posts( $post_type->name );
		$num       = number_format_i18n( $num_posts->publish );
		$text      = _n( $post_type->labels->singular_name, $post_type->labels->name, $num_posts->publish );

		if ( current_user_can( 'edit_posts' ) ) {
			$output = '<a href="edit.php?post_type=' . $post_type->name . '">' . $num . ' ' . $text . '</a>';
		}

		echo '<li class="page-count ' . $post_type->name . '-count">' . $output . '</td>';
	}

	global $wpdb;
		$users = number_format_i18n( $wpdb->get_var("SELECT COUNT(ID) FROM $wpdb->users") );
		echo '<li class="post-count"><a href="users.php">' . $users . ' usuarios</a></li>';
}

add_action( 'dashboard_glance_items', 'cuadric_dashboard_right_now_extra_content' );

// ---------------------------------------------------------------------------------------------------


// impedimos que se pueda comentar en la plantilla de attachments. Suele ser un nido de comentarios spam.
function noMediaComments( $open, $post_id ) {
	$post = get_post( $post_id );
	if ( 'attachment' == $post->post_type )
		$open = false;
	return $open;
}
add_filter( 'comments_open', 'noMediaComments', 10, 2 );

// ---------------------------------------------------------------------------------------------------


// Variable & intelligent excerpt length.
function the_custom_excerpt( $length = 350, $show_readmore_link = true, $post_id = NULL ) { // El tamaño máximo del excerpt está en caractares, no en palabras.

	echo get_the_custom_excerpt( $length, $show_readmore_link, $post_id );

}

function get_the_custom_excerpt( $length, $show_readmore_link = true, $post_id = NULL ){

	if ( !is_numeric($post_id) ) {
		global $post;
	} else {
		$post = get_post($post_id);
	}


	$text = $post->post_excerpt;

	if ( $text == '' ) {
		//$text = get_the_content('');
		$text = $post->post_content;
		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]>', $text);
	}

	if ( !$text ) {
		return;
	}

	$text = strip_shortcodes($text); // opcional pero recomendable
	$text = preg_replace('/<h([1-2])(.*?)<\/h([1-2])>/si', '', $text); // eliminamos los heading h1 y h2.
	$text = strip_tags($text); // usar ' $text = strip_tags($text,'<p><a>'); ' si queeremos conservar algunas etiquetas

	$text    = substr($text,0,$length);
	$excerpt = reverse_strrchr($text, '.', 1);
	if ( !$excerpt ) {
		$excerpt = reverse_strrchr($text, '?', 1);
	}

	if( $excerpt ) {
		$out = apply_filters( 'the_excerpt', $excerpt . '...' );
	} else {
		$out = apply_filters( 'the_excerpt', $text . '...' );
	}

	$readmore_link = '.. <a class="read_more_link" href="'. get_permalink($post->ID) . '">' .  apply_filters( 'excerpt_more', ' ' . __('Read more') ) . '</a>';

	$out = $excerpt ? $excerpt : $text;

	if ( $show_readmore_link ) {
		$out .= $readmore_link;
	}

	$out = apply_filters('the_excerpt', $out);

	return $out;


}

// Returns the portion of haystack which goes until the last occurrence of needle
function reverse_strrchr($haystack, $needle, $trail) {
	return strrpos($haystack, $needle) ? substr($haystack, 0, strrpos($haystack, $needle) + $trail) : false;
}

// ---------------------------------------------------------------------------------------------------

// shortcode para mostrar el form de login
function cuadric_shortcode_login_form( $atts, $content = null ) {

	extract( shortcode_atts( array(
	  'redirect' => ''
	  ), $atts ) );

		if( $redirect ) {
			$redirect_url = $redirect;
		} else {
			$redirect_url = get_permalink();
		}

	if (!is_user_logged_in()) :
		$form = wp_login_form(array('echo' => false, 'redirect' => $redirect_url ));
	else:
		$form = wp_loginout( $redirect_url, false );
	endif;
	return $form;
}
add_shortcode('loginform', 'cuadric_shortcode_login_form');

// ---------------------------------------------------------------------------------------------------

// obtenemos el valor del parámetro 'paged' para utilizar en get_posts() y new WP_Query()
function cuadric_get_paged() {

	// esta función reemplaza a la siguiente forma de obtener $paged al hacer un get_posts() o un WP_Query():
	// 'paged' => get_query_var('paged') ? get_query_var('paged') : 1

	global $wp_query;

	$paged = 1;

	if( get_query_var('paged') ) {
		$paged = get_query_var( 'paged' );  // en archives y la front page por defecto de WP
	} elseif (get_query_var( 'page') ) {
		$paged = get_query_var( 'page' );   // en una fixed home page
	}

	return $paged;
}

// ---------------------------------------------------------------------------------------------------

// Agregamos una acción para ocultar la admin_bar a los no Admins. Se ejecuta bien tarde, 100, para superponerse a cualquier plugin que intente mostrarla.
add_action( 'show_admin_bar', 'cuadric_show_admin_bar', 100 );
function cuadric_show_admin_bar(){
	if (!current_user_can('administrator')):
		return false;
	else :
		return;
	endif;
}
// show_admin_bar(false);

// ---------------------------------------------------------------------------------------------------

// evitamos los <p> vacíos en los shortcodes anidados!!!!
function cuadric_fix_empty_p_shortcodes($content){
	$array = array (
		'<p>[' => '[',
		']</p>' => ']',
		']<br />' => ']'
	);
	$content = strtr($content, $array);
	return $content;
}
add_filter('the_content', 'cuadric_fix_empty_p_shortcodes');

// ---------------------------------------------------------------------------------------------------

// Convert absolute URLs in content to site relative ones
// Inspired by http://thisismyurl.com/6166/replace-wordpress-static-urls-dynamic-urls/
function cuadric_clean_static_url($content) {
	$thisURL = get_bloginfo('url');
	$stuff = str_replace(' src=\"'.$thisURL, ' src=\"', $content );
	$stuff = str_replace(' href=\"'.$thisURL, ' href=\"', $stuff );
	return $stuff;
}
//add_filter('content_save_pre','cuadric_clean_static_url','99');

// ---------------------------------------------------------------------------------------------------

// Quitamos las dimensiones la tag <img> al insertarlas en el editor. Importante para responsive.
// Cuidado con esta función!
// si vas a darle tamaños persoalizados a las imágenes dentro del editor deberás desactivarla, o no se guardarán esos tamaños.
function cuadric_remove_img_dimensions( $html ) {

	if ( is_admin() ) {
		$html = preg_replace( '/(width|height)=\"\d*\"\s/', '', $html );
	}
		return $html;
}
add_filter( 'post_thumbnail_html', 'cuadric_remove_img_dimensions', 10 );
add_filter( 'image_send_to_editor', 'cuadric_remove_img_dimensions', 10 );

// ---------------------------------------------------------------------------------------------------

