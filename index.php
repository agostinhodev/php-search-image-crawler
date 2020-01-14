<?php

class Imagem{

        public function getByGoogle($termo){

            //Abre uma conexão com o Google Images
            $url = "https://www.google.com/search?q=". $termo ."&tbm=isch";
            $fp = @file_get_contents($url);
            
            if($fp === FALSE)
                return null;

            if (!$fp) 
                return null;

            //Busca por todas as tags img na págia
            preg_match_all('/<img[^>]+>/i',$fp, $result); 
            $result = $result[0];
            
            $imagem = NULL;

            $i = 0;
            //Aqui teremos várias imgs no array $result
            //É necessário percorrê-lo para buscar as imagens válidas
            for($i = 0; $i < count($result); $i++){

                //Pega o contente da prop img 
                preg_match( '@src="([^"]+)"@' , $result[$i], $match );
                $result[$i] = array_pop($match);
            
                /*Se for uma imagem válida, atribui 
                o valor a variavel $imagem e para o loop*/
                if (@getimagesize($result[$i])) {

                    $imagem = trim($result[$i]);                
                    break;

                }           

            }   

            //retorna uam string contendo a URL
            return $imagem;        
        
        }

    }

    $imagem = new Imagem();
    $img = $imagem->getByGoogle("5000198885744"); // Aqui vc passa o argumento da busca
  
    if(!$img){

        $img = "noImage.jpg";

    }

    $imginfo = getimagesize($img);        
    header("Content-type: {$imginfo['mime']}");
    readfile($img);

?>