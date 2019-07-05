<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use App\Models\ValidationWordAnnotation;
use App\Repositories\WordAnnotationRepositoryInterface;
use Symfony\Component\HttpFoundation\Response;
use App\Repositories\WordTagRepositoryInterface;

class WordAnnotationService
{
    private $repo;
    private $wordTagRapo;

    public function __construct(WordAnnotationRepositoryInterface $repo, WordTagRepositoryInterface $wordTagRapo)
    {
        $this->repo = $repo;
        $this->wordTagRapo = $wordTagRapo;
    }
    
    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function get($id)
    {
        return $this->repo->get($id);
    }

    public function store(array $data)
    {
        $validator = Validator::make($data, ValidationWordAnnotation::RULE_WordAnnotation);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }
        
        $response = $this->repo->store($data);
        $tag = self::storeTags($response["id"], $response); 
        $result = $response->toArray()+$tag;
        return $result;
    }

    public function update($id, array $data)
    {
        $validator = Validator::make($data, ValidationWordAnnotation::RULE_WordAnnotation);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }
        
        self::destroyTags($id);
        $response = $this->repo->update($id, $data);
        $tag = self::storeTags($id, $data); 
        $result = self::get($id);
        return $result;
    }

    public function destroy($id)
    {
        $deleteTag = self::destroyTags($id);
        $deletedAnnotation = $this->repo->destroy($id);

        if ($deleteTag && $deletedAnnotation) {
            return $response = 'message:success';
        } else {
            return $response = 'message:error';
        }
    }

    public function destroyTags($id)
    {
        return $this->wordTagRapo->destroy($id);
    }

    public function storeTags($id, $response)
    {
        $word_id = $id;
        $wordArray = explode(" ", $response["word"]);
        $tags = array();
        for ($i = 0; $i < count($wordArray); $i++) {
            $tag = array (
                'word_id' => $word_id,
                'name' => $wordArray[$i],
            );

            $tags[count($tags)] =  $this->wordTagRapo->store($tag);
        }
        $tag = array(
            'tags' => $tags,
        );
        return $tag;
    }

    public function contains($name)
    {
        return $this->wordTagRapo->contains($name);
    }
}