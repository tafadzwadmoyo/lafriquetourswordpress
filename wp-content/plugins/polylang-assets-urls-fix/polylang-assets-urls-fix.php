<?php
/*
Plugin Name: Polylang assets URLs fix
Description: This plugin properly handles assets URLs when using different domains for each language
Author: Kuba Mikita
Author URI: https://www.wpart.co/
Version: 1.1
License: GPL2
*/

/*
    Copyright (C) 2016  Kuba Mikita  jakub@underdev.it

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


global $polylang_urls;
$polylang_urls = false;

function udev_fix_polylang_urls( $src ) {

	global $polylang_urls;

	if ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] == 'on' ) {
		$prefix = 'https://';
	} else {
		$prefix = 'http://';
	}

	if ( ! $polylang_urls ) {

		$polylang_settings = get_option( 'polylang' );
		$polylang_urls = array();

		foreach ( $polylang_settings['domains'] as $domain ) {
			$polylang_urls[] = str_replace( $prefix, '', $domain );
		}

	}

	$script_host = parse_url( $src, PHP_URL_HOST );

	if ( ! in_array( $script_host, $polylang_urls ) ) {
		return $src;
	}

	return str_replace( $prefix . $script_host . '/', pll_home_url(), $src );

}

function udev_polylang_fix_urls_bwp_minify( $html_tag, $src ) {
	return str_replace( $src, udev_fix_polylang_urls( $src ), $html_tag );
}

if ( ! function_exists( 'is_plugin_active' ) ) {
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

if ( is_plugin_active( 'polylang/polylang.php' ) ) {
	add_filter( 'style_loader_src', 'udev_fix_polylang_urls', 10, 1 );
	add_filter( 'script_loader_src', 'udev_fix_polylang_urls', 10, 1 );
	add_filter( 'bwp_minify_get_tag', 'udev_polylang_fix_urls_bwp_minify', 10, 2 );
}
