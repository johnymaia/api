<?php

namespace App\Repositories;

use App\Models\WordAnnotation;

class WordAnnotationRepositoryEloquent implements WordAnnotationRepositoryInterface
{
    private $model;

    public function __construct(WordAnnotation $wordAnnotation)
    {
        $this->model = $wordAnnotation;
    }

    public function getAll()
    {
        $annotation = $this->model->all();
        $result = array();
        for ($i = 0; $i < count($annotation); $i++) {
            $tag =  $annotation[$i]->wordtag()->get();
            $tags = array(
                'tags' => $tag,
            );
            $result[count($result)] = $annotation[$i]->toArray()+$tags;
        }
        return $result;
    }

    public function get($id)
    {
        $annotation = $this->model::find($id);
        $tag =  $annotation->wordtag()->get();
        $tags = array(
            'tags' => $tag,
        );
        return $annotation->toArray()+$tags;
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        return $this->model->find($id)->update($data);
    }

    public function destroy($id)
    {
        return $this->model->find($id)->delete();
    }
}
