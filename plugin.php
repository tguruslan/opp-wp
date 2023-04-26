<?php
/*
Plugin Name: opp
Plugin URI: https://github.com/tguruslan/opp-wp
Description: для додавання використайте: [opp id=""]
Author: ruslan
Version: 1.0.0
Author URI: https://github.com/tguruslan
*/

add_shortcode( 'opp', function( $atts, $content="" ){
    require_once ABSPATH . 'wp-admin/includes/file.php';
    extract(shortcode_atts(array("id" => '',), $atts));

    $out='';

    $id = ltrim(rtrim($id, "/"), "/");
    $html=wp_remote_get('https://udpu.edu.ua/navchannia/osvitni-prohramy/'.$id)['body'];

    $doc = new DOMDocument();
    $doc->loadHTML($html);

    wp_enqueue_style('opp', plugins_url('style.css',__FILE__ ));
    wp_enqueue_script('opp', plugins_url('script_stud.js',__FILE__ ), array( 'jquery' ), null );

    $xpath = new DOMXpath($doc);
    $out .= $doc->saveHTML($xpath->query("//dl[contains(@class,'fields-container')]")->item(0));
    $out .= $doc->saveHTML($xpath->query("//div[@itemprop='articleBody']")->item(0));

    // $title = $xpath->query("//div[contains(@class,'page-header')]")->item(0);

    return $out;
});

