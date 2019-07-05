<?php

namespace App\Models;

class ValidationWordAnnotation
{
    const RULE_WordAnnotation = [
        'word' => 'required | max:250',
        'description' => 'required',
    ];
}