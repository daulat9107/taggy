<?php

namespace App;

use Daulat\Taggy\TaggableTrait;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use TaggableTrait;
}
