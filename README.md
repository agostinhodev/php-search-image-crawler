# PHP Search Image Using Search Engine

This is a simple code to allow you search for images on Web Search Engines like Google and Bing using only PHP

## How to test it?

* Clone this project
* Copy your content inside your Apache or Nginx public folder, like `/var/www` or something similar
* Open your browser

### Example Search Using Bing
[![image.png](https://i.postimg.cc/bwPxY8Y8/image.png)](https://postimg.cc/Wh9FSBJf)

### Example Search Using Google
[![image.png](https://i.postimg.cc/PfZvCcRq/image.png)](https://postimg.cc/3W8x6L7M)


## How to use in my personal project?

The magic of this code happens on file `services/ImageBySearchEngine.php` which is a Oriented Object file that 
has a method called `search()`

#### To use, you need to create an object as following:

```php
<?php

$data = [];

try{

    require_once "services/ImageBySearchEngine.php";
    
    $query = "cute kittens"; //The query you want search for
    $limit = 10; //The number of images you want to show
    $search_engine = "google"; // The search engine key. You can use "bing" as well.
    
    $imageBySearchEngine = new ImageBySearchEngine();
    $images = $imageBySearchEngine->search( $query, $limit, $search_engine );
    
    if(count($images) === 0)
        throw new Exception("Could not find any image from the given query");
    
    $data["images"] = $images;

} catch (Exception $e){

    $data["message"] = $e->getMessage();

}
```

You will receive a array like this
```php
array(10) {
    [0]=>
    array(1) {
        ["uri"] => 
        string(121) "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSnFm8xIu_nPgVZ7Xw-w5wClwiBExSJDeMNANRLeu8hmy7xLQgXuaY8Yp4tqcc&s"
    }
    [1]=>
    array(1) {
        ["uri"]=>
        string(121) "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRDIa6b2ZyHQSGpBBVBi3Sf50AEaUhCM-CJyAI4qTm4yvsvvUrHDfw4N9LBCQQ&s"
    }
    [2]=>
    array(1) {
    ["uri"]=>
        string(120) "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQgYZXBCpD4K5WjwpiK24HcPewCa9WigE08GMcY7Hf1lPpk1ecJwfiVgZRJQA&s"
    }
}
```
Or if you prefeer, a JSON like this:

```json
{
  "images":[
    {
      "uri": "https:\/\/encrypted-tbn0.gstatic.com\/images?q=tbn:ANd9GcSnFm8xIu_nPgVZ7Xw-w5wClwiBExSJDeMNANRLeu8hmy7xLQgXuaY8Yp4tqcc&amp;s"
    },
    {
      "uri": "https:\/\/encrypted-tbn0.gstatic.com\/images?q=tbn:ANd9GcRDIa6b2ZyHQSGpBBVBi3Sf50AEaUhCM-CJyAI4qTm4yvsvvUrHDfw4N9LBCQQ&amp;s"
    },
    {
      "uri": "https:\/\/encrypted-tbn0.gstatic.com\/images?q=tbn:ANd9GcQgYZXBCpD4K5WjwpiK24HcPewCa9WigE08GMcY7Hf1lPpk1ecJwfiVgZRJQA&amp;s"
    }
  
  ]
  
}

```

## Notice
The way like you will use this tool it's not my responsability. <br>
I built this simple script for a college work to show how we can implement a crawler using PHP.<br>
I prefeer to use Google Images and Bing Images because it's a good example of how we can 
manipule elements on page using DOM.<br>
However we could use other sites like Google Maps, Bing Images, Instagram, Facebook, or any other.<br>
[Google Terms of Service](https://policies.google.com/terms?hl=en&fg=1) and [Microsoft Services Agreement](https://www.microsoft.com/en-us/servicesagreement/) can explain more to you about their Policys And Terms. <br><br>
Be an ethical developer!

## Contributing
Please refer to each project's style and contribution guidelines for submitting patches and additions. In general, we follow the "fork-and-pull" Git workflow.

* Fork the repo on GitHub
* Clone the project to your own machine
* Commit changes to your own branch
* Push your work back up to your fork
* Submit a Pull request so that we can review your changes
* NOTE: Be sure to merge the latest from "upstream" before making a pull request!