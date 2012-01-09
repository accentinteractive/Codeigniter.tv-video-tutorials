<?php
class Posts extends MY_Model
{

    function __construct (){
        parent::__construct();
        $this->table_name = 'posts';
        $this->primary_key = 'post_id';
        $this->order_by = 'post_pubdate DESC';
    }

}