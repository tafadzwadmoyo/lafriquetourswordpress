<?php

function wdps_update($version) {
  global $wpdb;
  if (version_compare($version, '1.0.3') == -1) {
    $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "wdpsslider` ADD `smart_crop` tinyint(1) NOT NULL DEFAULT 0");
    $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "wdpsslider` ADD `crop_image_position` varchar(16) NOT NULL DEFAULT 'center center'");
    $wpdb->query("ALTER TABLE " . $wpdb->prefix . "wdpsslider ADD `bull_back_act_color` varchar(8) NOT NULL DEFAULT '000000'");
    $wpdb->query("ALTER TABLE " . $wpdb->prefix . "wdpsslider ADD `bull_back_color` varchar(8) NOT NULL DEFAULT 'CCCCCC'");
    $wpdb->query("ALTER TABLE " . $wpdb->prefix . "wdpsslider ADD `bull_radius` varchar(32) NOT NULL DEFAULT '20px'");
  }
  if (version_compare($version, '1.0.5') == -1) {
    $wpdb->query("ALTER TABLE " . $wpdb->prefix . "wdpsslider ADD `carousel_degree` int(4) NOT NULL DEFAULT 0");
    $wpdb->query("ALTER TABLE " . $wpdb->prefix . "wdpsslider ADD `carousel_grayscale` int(4) NOT NULL DEFAULT 0");
    $wpdb->query("ALTER TABLE " . $wpdb->prefix . "wdpsslider ADD `carousel_transparency` int(4) NOT NULL DEFAULT 0");
  }
  if (version_compare($version, '1.0.6') == -1) {
    $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "wdpslayer` ADD `layer_characters_count` int(4) NOT NULL DEFAULT 250");
  }
  if (version_compare($version, '1.0.9') == -1) {
    $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "wdpsslider` CHANGE `taxonomies` `taxonomies` longtext NOT NULL DEFAULT ''");
  }
  if (version_compare($version, '1.0.11') == -1) {
    $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "wdpsslider` ADD `featured_image` tinyint(1) NOT NULL DEFAULT 1");
  }
  if (version_compare($version, '1.0.12') == -1) {
    $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "wdpsslider` CHANGE `choose_post` `choose_post` longtext NOT NULL DEFAULT ''");
  }
  if (version_compare($version, '1.0.14') == -1) {
    $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "wdpsslider` ADD `possib_add_google_fonts` tinyint(1) NOT NULL DEFAULT 0");
    $wpdb->query("ALTER TABLE " . $wpdb->prefix . "wdpsslider ADD `possib_add_ffamily_google` varchar(255) NOT NULL DEFAULT ''");    
  }
  return;
}