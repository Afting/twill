<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasRelated;
use A17\Twill\Models\Behaviors\HasRevisions;
use A17\Twill\Models\Model;

class Book extends Model
{
    use HasRelated, HasRevisions;

    protected $fillable = [
        'published',
        'title',
        'description',
    ];
}
