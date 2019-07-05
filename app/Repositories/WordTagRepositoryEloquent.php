<?php

namespace App\Repositories;

use App\Models\WordTag;

class WordTagRepositoryEloquent implements WordTagRepositoryInterface
{
    private $model;

    public function __construct(WordTag $wordTag)
    {
        $this->model = $wordTag;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function get($id)
    {
        return $this->model->find($id);
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
        return $this->model::where('word_id', "$id")->delete();
    }

    public function contains($name)
    {
        return $this->model::where('name', "$name")->get();
    }
}