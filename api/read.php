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

    //blog post query
    $result = $post ->read();
    
    //get row count 
    $num = $result ->rowCount();

    //cher if any posts
    if($num > 0)
    {
        // Post array 
        $post_arr = array();
        $post_arr['data'] = array();

        while($row = $result -> fetch(PDO::FETCH_ASSOC))
        {
            extract($row);

            $post_item = array(
                'id' => $id,
                'title' => $title,
                'body' => html_entity_decode($body),
                'author' => $author,
                'categpry_id' => $category_id,
                'category_name' => $category_name
            );

            // Push to "data"
            array_push($post_arr['data'], $post_item);
        }

        // turn to json & output
        echo json_encode($post_arr);
    }else{
        // no posts 
        echo json_encode(
            array('message' => 'No posts found')
        );
    }

