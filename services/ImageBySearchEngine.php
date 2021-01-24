<?php

/**
 * Class GoogleImages
 * Author: Agostinho Neto
 * Date: 23th January 2021
 * https://github.com/agostinhodev
 * Subject: Class to get a image by Google Images
 */

class ImageBySearchEngine{

    public function search($query, $limit, $search_engine){

        $query = trim(str_replace(" ", "+", $query));

        //Open a connection with Search Engine Images
        $url = $search_engine == "google"
            ? "https://www.google.com/search?q=". $query ."&tbm=isch"
            : "https://www.bing.com/images/search?q=" . $query . "&scope=images";

        $fp = @file_get_contents($url);

        if($fp === FALSE)
            return null;

        if (!$fp)
            return null;

        //Search for all img tags on the page
        preg_match_all('/<img[^>]+>/i',$fp, $result);

        $result = $result[0];

        $images = [];

        //Here we will have several images in the $result array
        //It is necessary to scroll through it to search for valid images
        for($i = 1; $i < count($result); $i++){

            //Get prop img content
            preg_match( '@src="([^"]+)"@' , $result[$i], $match );
            $result[$i] = array_pop($match);

            /*If it is a valid image, assign
            the value for variable $ image and for the loop*/
            if (@getimagesize($result[$i])) {

                if(count($images) == $limit)
                    break;

                $image["uri"] = trim($result[$i]);

                array_push($images, $image);

            }

        }

        //returns a array containing the URIs of images
        return $images;

    }

}