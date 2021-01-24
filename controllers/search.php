<?php

    $data = [];
    $httpStatusCode = 406;

    try{

        $query = isset($_GET["query"]) ? $_GET["query"] : NULL;
        $limit = isset($_GET["limit"]) ? $_GET["limit"] : NULL;
        $search_engine = isset($_GET["search_engine"]) ? $_GET["search_engine"] : NULL;

        if(is_null($query))
            throw new Exception("Please enter the query you want to search for");

        if(is_null($limit))
            throw new Exception("Please enter the number of images you want to display");

        if(is_null($search_engine))
            throw new Exception("Please enter the search engine you want to use");

        require_once "../services/ImageBySearchEngine.php";

        $imageBySearchEngine = new ImageBySearchEngine();
        $images = $imageBySearchEngine->search( $query, $limit, $search_engine );

        if(count($images) === 0)
            throw new Exception("Could not find any image from the given query");

        $data["images"] = $images;
        $httpStatusCode = 200;

    } catch(Exception $e){

        $data["message"] = $e->getMessage();

    }

    echo json_encode($data);
    http_response_code($httpStatusCode);