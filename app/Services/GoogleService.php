<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Response;
use GuzzleHttp\Client;
class GoogleService
{
    private $annotationService;

    public function __construct(WordAnnotationService $annotationService)
    {
        $this->annotationService = $annotationService;
    }
   
    public function googlevision(array $request)
    {
        $client = new Client();
        $url = "https://vision.googleapis.com/v1/images:annotate?fields=responses&key=AIzaSyBxLORCkMO5_FT0sqQwCZoXpoDZp4rWBAs";
        $data = json_encode(array(
            'requests' =>
            array(
                0 =>
                array(
                    'image' =>
                    array(
                        'content' =>  $request['content'],
                    ),
                    'features' =>
                    array(
                        0 =>
                        array(
                            'type' => 'TEXT_DETECTION',
                        ),
                    ),
                ),
            ),
        ));

        $client = new Client([
            'headers' => ['Content-Type' => 'application/json']
        ]);
        
        $response = $client->post(
            $url,
            ['body' => $data]
        );

        $body = json_decode($response->getBody(), true);
        $body = $body['responses']['0']['textAnnotations'];


        $words = array();
        for ($i = 1; $i < count($body); $i++) {
            $word = $body[$i]['description'];
            $word = self::removePontuacao($word);
           // $word = preg_replace('/[^\w\s]/', '', $word);
            $result = $this->annotationService->contains($word);
 
            if (count($result) > 0 && !in_array($word, $words)) {
                $tags = array('tags' => $result);
                $words[count($words)] = $body[$i]+$tags;
            }
        }
        
        return $words;
    }

    public function removePontuacao($string)
    {
        $unwantedChars = array(',', '!', '?', '.', ':', ';', '/', '|', '[', ']', '(', ')'); // create array with unwanted chars
        return str_replace($unwantedChars, '', $string); // remove them
    }
}