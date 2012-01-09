<?php
class Blog extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper('general');
        $this->load->model('posts');
    }

    public function listing() {
        $posts = array();

        // Uncomment lines tp play around with the  methods in MY_Model
        
        /* CI built-in db functions still work */
        // $this->db->order_by('post_id'); // Set order outside MY_Model method
        // $this->db->limit(2); // Set limit outside MY_Model method
        // $this->db->select('post_slug'); // Set limit outside MY_Model method
        // Etc.
        
        /* get() */
        $posts = $this->posts->get(); // Get all posts
        // $posts = $this->posts->get(1); // Get post ID 1
        // $posts = $this->posts->get(array(1, 2)); // Get post ID 1 and 2
        
        /* get_by() */
        // $posts = $this->posts->get_by('post_slug', 'first-post', NULL, TRUE);
        // $posts = $this->posts->get_by(array('post_slug' => 'third-post', 'post_pubdate <' => '2011-10-18'));
        // $posts = $this->posts->get_by(array('post_slug' => 'third-post', 'post_pubdate <' => '2011-10-18'), NULL, TRUE);
        
        /* get_key_value() */
        // $posts = $this->posts->get_key_value('post_slug', 'post_title');
        // $posts = $this->posts->get_key_value('post_slug', 'post_title', 1);
        // $posts = $this->posts->get_key_value('post_slug', 'post_title', array(1, 2));
        
        /* get_assoc() */
        // $posts = $this->posts->get_assoc();
        // $this->db->select('post_slug, post_id, post_title'); $posts = $this->posts->get_assoc();
        // $posts = $this->posts->get_assoc(1);
        // $posts = $this->posts->get_assoc(array(1, 2));
        
        /* to_assoc() */
        // $posts = $this->posts->get_by(array('post_slug' => 'third-post', 'post_pubdate <' => '2011-10-18'), NULL, TRUE); $posts = $this->posts->to_assoc($posts);
        
        dump($posts);
    }
    
    /**
     * Add a new record to the posts table
     * 
     * @return void
     * @author Joost van Veen
     */
    public function add() {
        
        $data = array(
            'post_title' => 'This is my fourth post',
            'post_body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'post_pubdate' => '2012-01-02 00:00:00',
            'post_author' => 'Joost van Veen',
            'post_slug' => 'fourth-post');
        
         $id = $this->posts->save($data);
         dump('A new record with an id of ' . $id . ' was saved.');
    }
    
    /**
     * Update a record in the posts table
     * 
     * @return void
     * @author Joost van Veen
     */
    public function update() {
        
        $data = array(
            'post_title' => 'This is my fifth post',
            'post_body' => 'Suspendisse eleifend sollicitudin consectetur.',
            'post_pubdate' => '2012-01-03 00:00:00',
            'post_author' => 'Some other author',
            'post_slug' => 'fifth-post');
        
         $id = $this->posts->save($data, 6);
         dump('A record with an id of ' . $id . ' was updated.');
    }
    
    public function delete() {
        $id = array(2,5);
        $this->posts->delete($id);
    }

}