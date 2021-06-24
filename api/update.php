<?php
    // headers

    header('Access-Control-Allow-Origin:*');
    header('Content-Type: aplication/json');
    header('Access-Control-Allow-Methods: PUT');
    // header('Access-Control-Allow-Headers: A');

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

    $post -> title = $data ->title;
    $post -> body = $data ->body;
    $post -> author = $data ->author;
    $post -> category_id = $data ->category_id;

    //create post 
    if($post -> update())
    {
        echo json_encode(
            array('message' => 'Post updated')
        );
    }else{
        echo json_encode(
            array('message' => 'post not updated')
        );
    }
    