<?php

namespace App\Repositories;

use App\Models\WordTag;

interface WordTagRepositoryInterface
{
    public function __construct(WordTag $wordTag);

	public function getAll();
	
	public function get($id);
	
	public function store(array $data);
	
	public function update($id, array $data);
	
	public function destroy($id);
}