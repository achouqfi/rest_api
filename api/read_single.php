<?php
    // headers

    header('Access-Control-Allow-Origin:*');
    header('Content-Type: aplication/json');

    include_once '../config/dataBase.php';
    include_once '../model/Post.php';

    // Instantiate DB & connect 
    $database = new dataBase();
    $db= $database->connect();

    // Instantiace blog post object
    $post = new Post($db);

    //get ID 
    $post -> id = isset($_GET['id']) ? $_GET['id'] : die();

    //get post
    $post -> read_single();

    //create array
    $post_array = array(
        'id' => $post->id,
        'title' => $post->title,
        'body' => $post->body,
        'author' => $post->author,
        'category_id' => $post->category_id,
        'category_name' => $post->id

    );

    // make json
    print_r(json_encode($post_array));