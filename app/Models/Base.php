<?php

namespace App\Models;

use App\Traits\BlameableCustomTrait;
use App\Traits\SearchModelTrait;
use App\Traits\ShowColumnOptionTrait;
use DateTimeInterface;
use DigitalCloud\Blameable\Traits\Blameable;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;

class Base extends Model
{
    use Cachable;
    use SearchModelTrait;
    use ShowColumnOptionTrait;    
    use Blameable, BlameableCustomTrait{
        BlameableCustomTrait::bootBlameable insteadof Blameable;
    }
    
    const CREATED_BY = 'created_by';
    const UPDATED_BY = 'updated_by';

    protected $hidden = ['created_at', 'deleted_at', 'updated_at', 'created_by', 'updated_by'];
    protected static $logFillable = true;

    /**
     * Get the name of the "created by" column.
     *
     * @return null|string
     */
    public function getCreatedByColumn()
    {
        return static::CREATED_BY;
    }

    /**
     * Get the name of the "updated by" column.
     *
     * @return null|string
     */
    public function getUpdatedByColumn()
    {
        return static::UPDATED_BY;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function createdBy()
    {
        return $this->belongsTo(\App\Models\Base\User::class, static::CREATED_BY);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function updatedBy()
    {
        return $this->belongsTo(\App\Models\Base\User::class, static::UPDATED_BY);
    }

    public function getCreatedAtAttribute($value){        
        return localFormatDateTime($value);
    }

    public function getUpdatedAtAttribute($value){
        return localFormatDateTime($value);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
