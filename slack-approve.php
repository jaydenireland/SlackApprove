<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              com.jaydenireland
 * @since             1.0.0
 * @package           SlackApprove
 *
 * @wordpress-plugin
 * Plugin Name:       slack approve
 * Plugin URI:        com.jaydenireland.slackapprove
 * Description:       This plugin allows you to approve posts from contributors via Slack integration
 * Version:           1.0.0
 * Author:            Jayden Ireland
 * Author URI:        com.jaydenireland
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       slack-approve
 * Domain Path:       /languages
 */
require("vendor/autoload.php");

$bridge = new \SlackApprove\WordPressBridge\WordPressBridge('slack-approve/v1');

/**
 * When post is updated send link to Slack asking for approval
 */
$updateAction = $bridge->addAction('post_updated', function($id) use ($bridge) {
   $post = $bridge->Posts->get($id);
   if ($post->post_status === 'pending') {
      $slack = new \SlackApprove\Slack\SlackClient(get_option('slack_approve_webhook_url'));
      $slack->sendMessage(sprintf(
         "Please approve the following post %s", get_rest_url(null, $bridge->getNamespace() . '/approve/' . $post->ID)
      ));
   }
});


/**
 * Links sent to slack point to this route
 */
$bridge->addRoute('/approve/(?P<id>\d+)', 'GET', function($data) use ($bridge, $updateAction){
   // Unregister update action
   $updateAction->unregister();

   $id = (int)$data['id'];
   $post = $bridge->Posts->get($id);
   $post->post_status = 'publish';
   
   return [
      'success' => $bridge->Posts->save($post),
      'post' => $post
   ];

   
}, fn() => true);


/**
 * Add Webhook URL to settings
 */
$bridge->addAction('admin_init', function() {
   add_settings_section(
		'slack_approve_setting_section',
		'Slack Approve',
		function () { echo 'WordPress Slack Approve Plugin'; },
		'general'
	);

   add_settings_field('slack_approve_webhook_url', 'Slack Approve Webhook URL', function() {
      echo sprintf(<<<HTML
         <input name="slack_approve_webhook_url" id="slack_approve_webhook_url" class="regular-text" type="text" value="%s"/>
      HTML, get_option('slack_approve_webhook_url'));
   }, 'general', 'slack_approve_setting_section');
   register_setting('general', 'slack_approve_webhook_url');
});