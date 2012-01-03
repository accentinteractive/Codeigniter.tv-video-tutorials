<?php
class Posts extends MY_Model
{

    function __construct (){
        parent::__construct();
        $this->table_name = 'posts';
        $this->primary_key = 'post_id';
        $this->order_by = 'post_pubdate DESC';
    }
    
    
    /**
     * Overrides MY_Model save method. Here you can add some 
     * custom functionality, such as saving an image, or updating related data.
     * 
     * @see MY_Model::save()
     */
    public function save($data, $id = FALSE) {
        
        $id = parent::save($data, $id);
        
        // Use the id to save an image, for example
        dump('Save an image for post ' . $id);
        
        return $id; 
    }
}