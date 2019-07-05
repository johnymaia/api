<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WordAnnotation;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\QueryException;
use GuzzleHttp\Client;
use Dotenv\Regex\Result;


class TanamidiaController extends Controller
{
    private $model;

    public function __construct(WordAnnotation $tanamidia)
    {
        $this->model = $tanamidia;
    }

    public function getAll()
    {
        $tanamidia = $this->model->all();

        return response()->json($tanamidia, Response::HTTP_OK);
    }

    public function get($id)
    {
        $tanamidia = $this->model->find($id);

        return response()->json($tanamidia, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $tanamidia = $this->model->create($request->all());

        return response()->json($tanamidia, Response::HTTP_CREATED);
    }

    public function update($id, Request $request)
    {
        $tanamidia = $this->model->find($id)->update($request->all());

        return response()->json($tanamidia, Response::HTTP_OK);
    }

    public function destroy($id)
    {
        // $tanamidia = $this->model->find($id)->delete();

        // return response()->json(null, Response::HTTP_OK);
    }

    public function testeGoogle(Request $request)
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
            $result = $this->model::where('word', 'LIKE', "{$word}%")->orWhere('word', 'LIKE', "%{$word}")->get();
 
            if (count($result) > 0 && !in_array($word, $words)) {
                $id = array('id' => $result['0']['id']);
                $id = array('word' => $result['0']['word']);
                
                $words[count($words)] = $id+$body[$i];
            }
        }
        
        return response()->json($words, Response::HTTP_OK);
    }

    public function cleanWord($string)
    {
        return preg_replace(array("/(á|à|ã|â|ä)/", "/(Á|À|Ã|Â|Ä)/", "/(é|è|ê|ë)/", "/(É|È|Ê|Ë)/", "/(í|ì|î|ï)/", "/(Í|Ì|Î|Ï)/", "/(ó|ò|õ|ô|ö)/", "/(Ó|Ò|Õ|Ô|Ö)/", "/(ú|ù|û|ü)/", "/(Ú|Ù|Û|Ü)/", "/(ñ)/", "/(Ñ)/", '/[^A-Za-z0-9\-]/'), explode(" ", "a A e E i I o O u U n N"), $string);
    }
}
