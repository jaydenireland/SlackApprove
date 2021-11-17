<?php
namespace SlackApprove\WordPressBridge\Model;

class Posts {

    /**
     * Get a wp post
     * 
     * get_post returns the 
     *
     * @param integer $id
     * @return WP_Post
     */
    public function get(int $id): \WP_Post {
        return get_post($id);
    }

    /**
     * Save a post
     *
     * @param WP_Post $post
     * @return boolean
     */
    public function save(\WP_Post $post): bool {
        return wp_update_post($post);
    }

}