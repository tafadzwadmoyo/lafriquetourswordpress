<!DOCTYPE html>
<?php function insert_page_func($attr)
{
	$header = get_page_by_title($attr['title']);
	echo $header->post_content;
	
};

add_shortcode('insert_page', 'insert_page_func'); ?>


<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/bootstrap/css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="wrapper" class="hfeed">
<header id="header" role="banner">
<section id="branding">


<!--<div id="site-title"><?php //if ( is_front_page() || is_home() || is_front_page() && is_home() ) { echo '<h1>'; } ?><a href="<?php //echo esc_url( home_url( '/' ) ); ?>" title="<?php //echo esc_html( get_bloginfo( 'name' ) ); ?>" rel="home"><?php //echo esc_html( get_bloginfo( 'name' ) ); ?></a><?php //if ( is_front_page() || is_home() || is_front_page() && is_home() ) { echo '</h1>'; } ?></div>
<div id="site-description"><?php //bloginfo( 'description' ); ?></div>-->
</section>

<table class="header_table">
<tr>
<td>
<?php insert_page_func(array('title'=>'Header'));?>
</td>
<td>
<div class="smbtoolbar">
<?php echo smbtoolbar_shortcode(); ?> 
</div>
</td>
</tr>
</table>
<nav id="menu" role="navigation">

<ul class="menu_ul">
<?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>

</ul>
</nav>
</header>

<div id="container">