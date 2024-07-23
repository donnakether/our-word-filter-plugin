<?php
/*
  Plugin Name: Our Word Filter Plugin
  Description: Replaces a list of words.
  Version: 1.1
  Author: Dev Don
  Author URI: https://devdon.com.br
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class OurWordFilterPlugin {
  function __construct() {
    add_action('admin_menu', array($this, 'ourMenu'));
  }

  function ourMenu() {
    $mainPageHook = add_menu_page('Words to Filter', 'Word Filter', 'manage_options', 'ourwordfilter', array($this, 'wordFilterPage'), plugin_dir_url( __FILE__ ) . 'custom.svg', 100);
    //add_menu_page('Words to Filter', 'Word Filter', 'manage_options', 'ourwordfilter', array($this, 'wordFilterPage'), 'data:image/svg+xml;base64, PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHZpZXdCb3g9IjAgMCAyMCAyMCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZmlsbC1ydWxlPSJldmVub2RkIiBjbGlwLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik0xMCAyMEMxNS41MjI5IDIwIDIwIDE1LjUyMjkgMjAgMTBDMjAgNC40NzcxNCAxNS41MjI5IDAgMTAgMEM0LjQ3NzE0IDAgMCA0LjQ3NzE0IDAgMTBDMCAxNS41MjI5IDQuNDc3MTQgMjAgMTAgMjBaTTExLjk5IDcuNDQ2NjZMMTAuMDc4MSAxLjU2MjVMOC4xNjYyNiA3LjQ0NjY2SDEuOTc5MjhMNi45ODQ2NSAxMS4wODMzTDUuMDcyNzUgMTYuOTY3NEwxMC4wNzgxIDEzLjMzMDhMMTUuMDgzNSAxNi45Njc0TDEzLjE3MTYgMTEuMDgzM0wxOC4xNzcgNy40NDY2NkgxMS45OVoiIGZpbGw9IiNGRkRGOEQiLz4KPC9zdmc+', 100);
    add_submenu_page('ourwordfilter', 'Word To Filter', 'Words List', 'manage_options', 'ourwordfilter', array($this, 'wordFilterPage'));
    add_submenu_page('ourwordfilter', 'Word Filter Option', 'Options', 'manage_options', 'word-filter-options', array($this, 'optionsSubPage'));
    add_action("load-{$mainPageHook}", array($this, 'mainPageAssets'));
  }

  function mainPageAssets() {
    wp_enqueue_style('filterAdminCss', plugin_dir_url(__FILE__) . 'styles.css');
  }

  function wordFilterPage() { ?>
  <div class="wrap">
    <h1>Word Filter</h1>
    <?php if (isset($_POST['justsubmitted']) == "true") echo 'Thank you.'?>
    <form method="POST">
        <input type="hidden" name="justsubmitted" value="true">
        <label for="plugin_words_to_filter"><p>Enter a <strong>comma-separated</strong> 
        list of words to filter from your site's content </p></label>
        <div class="word-filter__flex-container">
            <textarea name="plugin_words_to_filter" id="plugin_words_to_filter" placeholder="bad, mean, awful, horrible"></textarea>
        </div>
        <input type="submit" name="submit" id="submit" class="button button-primary" value="Save changes">
    </form>
  </div>
  <?php }

  function optionsSubPage() { ?>
    Hello world sub page
  <?php }
}

$ourWordFilterPlugin = new OurWordFilterPlugin();