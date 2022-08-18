<?php

namespace App\Traits;

trait BlameableCustomTrait
{
    /** override function ini agar softdelete di ignore */
    public static function bootBlameable()
    {
        static::creating(function ($model) {
            $createdBy = $model->getCreatedByColumn();
            if ($createdBy) {
                $createdByAttribute = $createdBy;
                $model->{$createdByAttribute} = \Auth::id();
            }
        });

        static::updating(function ($model) {
            $updatedBy = $model->getUpdatedByColumn();
            if ($updatedBy) {
                $updatedByAttribute = $updatedBy;
                $model->{$updatedByAttribute} = \Auth::id();
            }
        });
    }
}
