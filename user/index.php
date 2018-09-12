<?php
include '../init.php';
$DB = new Database();


if($_SESSION['loggedIn']){
    if(Request::isPost()){
    $action = filter_input( INPUT_POST, 'action');
    }

    if(Request::isGet()){
        $action = filter_input( INPUT_GET, 'action');
    }

    if($action === FALSE || $action === NULL){
        $action = 'view_profile';
    }

    if(isset($_SESSION['user'])){
        $user = unserialize($_SESSION['user']);
    }


    switch($action){
        case 'view_profile':
            $requestedPosts  = $DB->select('POST',
                              '*', 
                              'POST.U_ID = ?', array($user->getID()));

            $posts = array();
            foreach($requestedPosts as $requestedPost){
                $post = new Post($requestedPost['P_ID'], 
                                 $requestedPost['P_TITLE'], 
                                 $requestedPost['P_CONTENT'], 
                                 $requestedPost['P_CREATED'], 
                                 $user->getName());
                $posts[] = $post;
            }


            include 'view/view_profile.php';
            break;

        case 'edit_profile_v':
            include 'view/edit_profile_v.php';
            break;
            
        case 'edit_profile':
            $firstName          = filter_input(INPUT_POST, 'firstName');
            $lastName           = filter_input(INPUT_POST, 'lastName');
            $email              = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $password           = filter_input(INPUT_POST, 'password');
            $password_again     = filter_input(INPUT_POST, 'password_again');
            $bio                = filter_input(INPUT_POST, 'bio');
            
            
            $firstName  = $firstName === FALSE  || $firstName === NULL ? $user->getFirstName() : $firstName;
            $lastName   = $lastName === FALSE   || $lastName === NULL    ? $user->getLastName()  : $lastName;
            $email      = $email === FALSE      || $email === NULL ? $user->getEmail() : $email;
            $password   = $password === FALSE   || $password === NULL && !empty($password) ? $user->getPassword() : $password;
            $bio        = $bio === FALSE        || $bio === NULL ? $user->getBio() : $bio;
            
            $error = $DB->update('USER','U_FIRSTNAME = ?, 
                                U_LASTNAME = ?, 
                                U_EMAIL = ?, 
                                U_PASSWORD = ?,
                                U_BIO = ?', 'U_ID = ' . $user->getID() . '',
                                array($firstName, $lastName, $email, $password, $bio));
            
            
            
            
            if(!$error){
                $user = $DB->select('USER', 
                            '*', 
                            'U_EMAIL = ? AND U_PASSWORD = ?', 
                            array($email, $password));
        
                if($DB->getCount() > 0){
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
                    Redirect::to('index.php?action=view_profile');
                    }
            }else {
                echo 'not succseful';
            }
            
            
            break;
            
        case 'delete_profile':
            $error = $DB->delete('USER', 'U_ID = ?', array($user->getID()));
            if(!$error){
                session_unset();
                session_destroy();
                Redirect::to('../index.php');
            } else {
                echo 'not succseful';
            }
            
            break;
            
        case 'logout':
            session_unset();
            session_destroy();
            Redirect::to('../index.php');
            break;
    }/* switch end*/
} else {
    echo 'not logged in and need to redirect to index';
}


