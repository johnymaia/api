<?php

namespace App\Repositories;

use App\Models\WordAnnotation;

interface WordAnnotationRepositoryInterface
{
    public function __construct(WordAnnotation $wordAnnotation);

	public function getAll();
	
	public function get($id);
	
	public function store(array $data);
	
	public function update($id, array $data);
	
	public function destroy($id);
}