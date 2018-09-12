<?php
class Comment {
    private $id, $content, $created, $author;
    
    public function __construct($id, $content, $created, $author){
        $this->id       = $id;
        $this->content  = $content;
        $this->created  = $created;
        $this->author   = $author;
    }
    
    
    public function generateComment(){
        $theComment = '<p class="comment"><span>'
        . $this->author .'</span><br>' 
        . $this->content .
        '</p>';
        return $theComment;
    }
    
    
    
}