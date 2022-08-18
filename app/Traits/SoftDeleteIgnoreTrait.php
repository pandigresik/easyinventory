<?php

namespace App\Traits;

trait SoftDeleteIgnoreTrait
{
    /** override function ini agar softdelete di ignore */
    public static function bootSoftDeletes()
    {
    }
}
