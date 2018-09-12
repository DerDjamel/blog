<?php
include'init.php';
$DB = new Database();

if(Request::isPost()){
    $action = filter_input( INPUT_POST, 'action');
}

if(Request::isGet()){
    $action = filter_input( INPUT_GET, 'action');
}

if($action === FALSE || $action === NULL){
    $action = 'home';
}


switch($action){
    /*
    ***** CASE 1
    */
    case 'home':
        $requestedPosts  = $DB->select('USER, POST',
                          '*', 
                          'USER.U_ID = POST.U_ID');
        
        $posts = array();
        foreach($requestedPosts as $requestedPost){
            $post = new Post($requestedPost['P_ID'], 
                             $requestedPost['P_TITLE'], 
                             $requestedPost['P_CONTENT'], 
                             $requestedPost['P_CREATED'], 
                             $requestedPost['U_FIRSTNAME'] . ' '. $requestedPost['U_LASTNAME']);
            $posts[] = $post;
        }
        require(APP_PATH . 'view\home.php');  
        break;
    /*
    ***** CASE 2
    */
    case 'view_post':
        $postID = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if(!($postID === FALSE || $postID ===NULL)){
            $post = $DB->select('USER, POST', '*', 'P_ID = ? AND POST.U_ID = USER.U_ID', array($postID));
            $post = new Post($post[0]['P_ID'],
                             $post[0]['P_TITLE'],
                             $post[0]['P_CONTENT'],
                             $post[0]['P_CREATED'],
                             $post[0]['U_FIRSTNAME'] . ' '. $post[0]['U_LASTNAME']);
            
            
            $requestedComments = $DB->select('USER, COMMENT', 
                                    '*', 
                                    'USER.U_ID = COMMENT.U_ID AND COMMENT.P_ID = ?', 
                                    array($postID));
               
            $comments = array();
            foreach($requestedComments as $c){
            $comment = new Comment( $c['C_ID'],  
                                    $c['C_CONTENT'], 
                                    $c['C_CREATED'], 
                                    $c['U_FIRSTNAME'] . ' '. $c['U_LASTNAME']);
            $comments[] = $comment;
        }
            require(APP_PATH . 'view\view_post.php');
        }
        break;
    /*
    ***** CASE 3
    */
    case 'login_v':
        require(APP_PATH . 'view\login_v.php');
        break;
        
    /*
    ***** CASE 4
    */
    case 'login':
        $email      = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password   = filter_input(INPUT_POST, 'password');
        $user = $DB->select('USER', 
                            '*', 
                            'U_EMAIL = ? AND U_PASSWORD = ?', 
                            array($email, $password));
        if($DB->getCount() > 0){
            $_SESSION['loggedIn']   = true;
            $user                   = $user[0];
            $user = new User($user['U_ID'],
                            $user['U_FIRSTNAME'],
                            $user['U_LASTNAME'],
                            $user['U_EMAIL'],
                            $user['U_PASSWORD'],
                            $user['U_BIO'],
                            $user['U_JOINED'],
                            $user['U_BIRTHDATE'],
                            $user['U_ISADMIN'],
                            $user['SEXE']);
            $_SESSION['loggedIn'] = true;
            $_SESSION['user'] = serialize($user);
            Redirect::to('user/index.php');
        }
        else {
            /* redirect to error 404 */
            echo '404';
        }
        break;
    /*
    ***** CASE 5
    */
    case 'register_v':
        require(APP_PATH . 'view\register_v.php');
        break;
    /*
    ***** CASE 6
    */
    case 'register':
        $firstName          = filter_input(INPUT_POST, 'firstName');
        $lastName           = filter_input(INPUT_POST, 'lastName');
        $email              = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password           = filter_input(INPUT_POST, 'password');
        $password_again     = filter_input(INPUT_POST, 'password_again');
        $birthdate          = filter_input(INPUT_POST, 'birthdate');
        $sexe               = filter_input(INPUT_POST, 'sexe');
        $bio                = 'no bio for now';
        
        
        $DB->insert('USER', array(NULL, $firstName, $lastName, $email, $password, $bio, 'NOW()',$birthdate, '0',$sexe));
        
        $user = $DB->select('USER', 
                            '*', 
                            'U_EMAIL = ? AND U_PASSWORD = ?', 
                            array($email, $password));
        
        if($DB->getCount() > 0){
            $_SESSION['loggedIn']   = true;
            $user                   = $user[0];
            $user                   = new User( $user['U_ID'],
                                                $user['U_FIRSTNAME'],
                                                $user['U_LASTNAME'],
                                                $user['U_EMAIL'],
                                                $user['U_PASSWORD'],
                                                $user['U_BIO'],
                                                $user['U_JOINED'],
                                                $user['U_BIRTHDATE'],
                                                $user['U_ISADMIN'],
                                                $user['SEXE']);
            $_SESSION['user'] = serialize($user);
        Redirect::to('user/index.php');
        break;
}


}











