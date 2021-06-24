<?php
    // headers

    header('Access-Control-Allow-Origin:*');
    header('Content-Type: aplication/json');
    header('Access-Control-Allow-Methods: DELETE');

    include_once '../config/dataBase.php';
    include_once '../model/Post.php';

    // Instantiate DB & connect 
    $database = new dataBase();
    $db= $database->connect();

    // Instantiace blog post object
    $post = new Post($db);

    //get raw posted data 
    $data = json_decode(file_get_contents("php://input"));

    //set id to update
    $post -> id = $data ->id;

    //create post 
    if($post -> delete())
    {
        echo json_encode(
            array('message' => 'Post deleted')
        );
    }else{
        echo json_encode(
            array('message' => 'post not deleted')
        );
    }
    