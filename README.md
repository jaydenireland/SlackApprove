# Slack Approval Wordpress Plugin

This is a simple plugin that send a link to a Slack to approve a post when a pending review post is saved.


## Backstory
I wrote this plugin to demonstrate my knowledge of OOP and ability to use the WordPress API for a job application.

I had never used the WP API and the only experience I had was in the user position, and even that has been limited.

Since one of the requirements of this project was "the code must be 100% authored by you". I took this as meaning
"no dependencies". To be completely honest, it was a little refreshing to have an empty dependencies array.

The bulk of this plugin is in the WordPressBridge namespace, which basically just emulated a limited OOP version of the WordPress Plugin API. If I were to continue work on WordPressBridge, I would love to make it a full MVC framework like [TypeRocket](https://typerocket.com/wordpress-mvc/). 








---
This project is not meant to be used in a dev or production environment. It "demonstrates interacting with the WordPress plugin API, object oriented programming and has some basic interaction with the WordPress database".
Since this was just a demonstration, the link to approve posts that is sent to Slack doesn't even have any authentication. It just takes a post ID and is wide open. 
I think if I were to include dependencies in this project I would pass a signed jwt with the id to the Slack message.