<?php
/**
 * Plugin Name: Cuadric Custom Functions
 * Plugin URI: http://www.cuadric.com
 * Description: Un repositorio con funciones comunes
 * Author: Gonzalo Sanchez
 * Author URI: http://blog.cuadric.com
 * Version: 0.1.0
 */ 
	
//--------------------------------------------------------------------------------------------------------------------------------

	function is_admin_logged(){
		if (is_user_logged_in()) {
			get_currentuserinfo();
			global $user_level;
			if($user_level > 0){
			return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	// imprime una variable, array u objeto de forma legible.
	function print_var($var, $title='', $force_show=false){ // force_show es para imprimir aunque no esté el admin logueado.
		if($force_show){
			print_var_now($var, $title);
		}elseif (is_admin_logged()){
			print_var_now($var, $title);
		}
	}
	
	function print_var_now($var, $title=''){
			echo '<pre class="trace">';
			if($title){ echo $title . '<br /><br />' ; }
			print_r($var);
			echo '</pre>';
	}
	
	// función para mostrar el objeto wp_query con toda la info disponible sobre la consulta actual.
	function print_globals() {
		global $wp_query;
		print_var($wp_query);
	}
	
	function trace($var, $title='', $force_show=false){
		print_var($var, $title, $force_show);
	}

// ---------------------------------------------------------------------------------------------------

function cuadric_my_custom_admin_css() { ?>

	<style type="text/css">
		/* ocultamos el logo de WordPress */
		#wp-admin-bar-wp-logo {
			display:none !important;
		}
		#wpadminbar .quicklinks #wp-admin-bar-site-name {
			width: 170px;
			height: 28px;
			margin: 0;
			padding: 0;
			/* la siguiente linea hay que definirla en el functions.php del theme en cocreto, no es correcto que esté en un plugin. */
			/*background: url(' . get_bloginfo('template_directory') . '/img/Logo_admin.png) no-repeat center center;*/
		}
		
		/* hacemos más alta la caja de categorías */
		#taxonomy-category.categorydiv div.tabs-panel {
			max-height: 400px; /* original: 200px */
		}

		/* el título del esditor de contenidos principal TinyMCE */
		.quicktags-toolbar, .wp_themeSkin tr.mceFirst td.mceToolbar {
			border-bottom: 1px solid #D1D1D1;
			background: #DFF2FF !important;
			background-image: -webkit-gradient(linear,left bottom,left top,from(#DFF2FF),to(#ECFAFF)) !important;
			background-image: -webkit-linear-gradient(bottom,#DFF2FF,#ECFAFF) !important;
			background-image: -moz-linear-gradient(bottom,#DFF2FF,#ECFAFF) !important;
			background-image: -o-linear-gradient(bottom,#DFF2FF,#ECFAFF) !important;
			background-image: linear-gradient(to top,#DFF2FF,#ECFAFF) !important;
		}

		/* la lengüeta activa del editor principal TinyMCE */
		.tmce-active .switch-tmce, .html-active .switch-html {
			border-color: #CCC #CCC #ECFAFF !important;
			background-color: #ECFAFF !important;
			color: #555;
		}

		/* el editor  */
		#wp-content-editor-container {
			box-shadow: 0 1px 8px rgba(0, 0, 0, 0.1) !important;
		}

		/* la status bar del editor */
		#post-status-info {
			border-color: #DFDFDF #CCC #CCC;
			background-color: #EAEAEA;
			box-shadow: 0 1px 8px rgba(0, 0, 0, 0.1) !important;
		}

		/* las cabeceras de todos los widgets */
		.widget .widget-top, .postbox h3, .stuffbox h3, .widefat thead tr th, .widefat tfoot tr th, h3.dashboard-widget-title, h3.dashboard-widget-title span, h3.dashboard-widget-title small, .sidebar-name, #nav-menu-header, #nav-menu-footer, .menu-item-handle {
			background: #DFF2FF;
			background-image: -webkit-gradient(linear,left bottom,left top,from(#DFF2FF),to(#ECFAFF));
			background-image: -webkit-linear-gradient(bottom,#DFF2FF,#ECFAFF);
			background-image: -moz-linear-gradient(bottom,#DFF2FF,#ECFAFF);
			background-image: -o-linear-gradient(bottom,#DFF2FF,#ECFAFF);
			background-image: linear-gradient(to top,#DFF2FF,#ECFAFF);
		}

		/* todas los widgets */
		.postbox {
			box-shadow: 0 1px 8px rgba(0, 0, 0, 0.1) !important;
		}
		/* todos los widgets */
		.widget, #widget-list .widget-top, .postbox, #titlediv, #poststuff .postarea, .stuffbox {
			border-color: #D5D5D5 !important;
			-webkit-box-shadow: inset 0 1px 0 white;
			box-shadow: inset 0 1px 0 white;
			-webkit-border-radius: 3px;
			border-radius: 3px;
		}
	</style>
<?php
}
add_action('admin_head', 'cuadric_my_custom_admin_css');

// ---------------------------------------------------------------------------------------------------

add_action( 'load-post.php', 'cuadric_add_my_help_tab' ); 		// cuando se carga la página de edición de un post, una página o un custom post type existentes;
add_action( 'load-post-new.php', 'cuadric_add_my_help_tab' );	// cuando se carga la página de 'crear nuevo' post, página o custom post type;

function cuadric_add_my_help_tab () {
	
	$args = array(
		'id' => 'ayuda_nubalia',						// required: unique id for the tab
		'title' => 'Clases CSS útiles', 				// required: unique visible title for the tab
		//'content' => '<p>contenido plano o html</p>', // optional: actual help text/html
		'callback' => 'get_help_content_from_file', 	// optional: The function to be called to output the content for this page
	);
	
	$screen = get_current_screen();
	// trace($screen, '$screen');
	/*
	$screen :	
	WP_Screen Object
	(
		[action] => 'add'				'add' cuando se está creando un nuevo post o página, '' vacío cuando se está editando uno existente
		[base] => 'post'
		[columns:private] => 0
		[id] => 'page'					'page' o 'post' o 'custompostype??????' . averiguarlo.
		[in_admin:protected] => 'site'
		[is_network] => 
		[is_user] => 
		[parent_base] => 
		[parent_file] => 
		[post_type] => 'page'
		[taxonomy] => 
		[_help_tabs:private] => Array
			(
			)
	
		[_help_sidebar:private] => 
		[_options:private] => Array
			(
			)
	
		[_show_screen_options:private] => 
		[_screen_settings:private] => 
	)

	
	*/
	
	$screen->add_help_tab( $args );
}

function get_help_content_from_file(){


		setlocale(LC_TIME, 'es_ES.UTF-8');
		
		$row = 1;
		$cuenta_lin = 0;
		
		$path = $_SERVER{'DOCUMENT_ROOT'};
		$len = strlen( $path);
		$end = strrpos( $path, "/");
		$dif = $len - ($len - $end);
		$root = substr( $path, 0, $dif);
		
		// echo '$root = ' . $root; 
		// $root = /var/www/vhosts/nubaliacloudcompany.siliconpeople.net

		$relative_path = '/httpdocs/wp-content/themes/nubalia/classes.css';

		$file = $root . $relative_path;
		echo 'classes.css --> ' . $relative_path;

		//$url  = get_bloginfo('template_directory') . '/classes.css';
		//$file = file_get_contents($url);
		
		
		/*  esto no va
		$stream = fopen($url,"r");
		$file = stream_get_contents($stream);
		fclose($stream);
		*/

		ob_start();
		include $file;
		$file_content = ob_get_contents();
		ob_end_clean();
		
		echo '<pre style="max-height:600px;">';
			echo $file_content;
			//echo apply_filters('the_content', '[css]' . $file_content . '[/css]', 60);
		echo '</pre>';
}

function get_help_content(){
	
	$content = '';
		$content .= '<p>Contenidos de relleno establecidos en /wp-comtent/mu-plugin/cuadric_functions.php</p>';
		$content .= '<ul>';
			$content .= '<li><strong>.bloque</strong> Agrega 20px de padding superior e inferior.</li>';
			$content .= '<li><strong>.bloque.primero</strong> Agrega 20px de padding solo inferior.</li>';
			$content .= '<li><strong>.linea</strong> height:0; display:blopck; border-top:1px solid #ccc;</li>';
		$content .= '</ul>';
	
		$content = '<pre style="max-height:600px;">' . addslashes($content) . '</pre>';
	
		
	echo $content;
}

// ---------------------------------------------------------------------------------------------------

// incrusta el link oculto hacia /wp-admin en un cuadrito de 30x30 en la esquina sup-izq de cada página
function goto_wp_admin_link() {
  	echo '<a href="' . admin_url() . '" style="display:block; position:absolute; z-index:10000; left:0; top:0; width:30px; height:30px; background-color:transparent; pointer:default;"></a>';
}
add_action('wp_footer', 'goto_wp_admin_link');

// --------------------------------------------------------------------------------------------------------------------------------------------

// Change user contact fields profile
function change_user_profile( $contactmethods ) {
	// Add Twitter field
	$contactmethods['twitter'] = 'Twitter (sin @)';
	// Add Facebook field
	$contactmethods['facebook'] = 'Facebook';
	// Remove AIM, Yahoo IM, Google Talk/Jabber
	unset($contactmethods['aim']);
	unset($contactmethods['yim']);
	unset($contactmethods['jabber']);
	
	return $contactmethods;
}
add_filter('user_contactmethods', 'change_user_profile' ,10, 1);



// ---------------------------------------------------------------------------------------------------