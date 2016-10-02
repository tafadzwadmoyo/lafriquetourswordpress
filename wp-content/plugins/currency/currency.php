<?php
/**
 * Plugin Name: Currency
 * Description: 
 * Version: 1.0
 * Author: Tafadzwa Moyo
 * Author URI: 
 * License: 
 */
 
function getCurrency($c)
{
	$cur = file_get_contents('http://free.currencyconverterapi.com/api/v3/convert?q='.$c['base'].'_'.$c['tar'].'&compact=ultra');
	$arr=json_decode($cur);
	foreach($arr as $x => $x_value) {
		echo (round($x_value*$c['value'], $c['decimal'])).' '.strtoupper($c['tar']);
		echo "<br>";
	}	
}

add_shortcode ("currency", "getCurrency");

add_action ("currency", "getCurrency");
?>