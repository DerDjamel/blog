<?php
class Post {
    private $id,
            $title,
            $content,
            $created,
            $author,
            $min_content,
            $numOfComments;
    
    public function __construct($id, $title, $content, $created, $author){
        $this->id       = $id;
        $this->title    = $title;
        $this->content  = $content;
        $this->created  = $created;
        $this->author   = $author;
        $this->min_content = substr($this->content, 0, 400) . ' ...';
    }
    
    
    public function getID()             { return $this->id;                 }
    public function getTitle()          { return $this->title;              }
    public function getContent()        { return $this->content;            }
    public function getCreated()        { return $this->created;            }
    public function getAuthor()         { return $this->author;             }
    public function getNumOfComments()  { return $this->numOfComments;      }
    public function getMinContent()     { return $this->min_content;        }
    
    
    public function setNumOfComments($num)  { $this->numOfComments = $num;  }
    
    public function generatePost(){
        $thePost = 
            '<article class="blog-post">
            <h2 class="blog-post-title"> <a href="../index.php?action=view_post&id=' . $this->id . '">' . $this->title . '</a></h2>
            <p class="blog-post-content"> ' . $this->content . '</p>
            <footer class="blog-post-footer">
                <p>created by : ' . $this->author .' in ' . $this->created . '</p>
            </footer>
            </article>';
        return $thePost;
        
    }
    
    public function generateMinPost(){
        $thePost = 
            '<article class="blog-post">
            <h2 class="blog-post-title"> <a href="../index.php?action=view_post&id=' . $this->id . '">' . $this->title . '</a></h2>
            <p class="blog-post-content"> ' . $this->min_content . '</p>
            <footer class="blog-post-footer">
                <p>created by : ' . $this->author .' in ' . $this->created . '</p>
            </footer>
            </article>';
        return $thePost;
        
    }
    
    
}