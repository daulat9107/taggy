<?php

namespace Daulat\Taggy\Models;

use Daulat\Taggy\Scopes\TagUsedScopesTrait;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use TagUsedScopesTrait;
}
