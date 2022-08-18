<?php

namespace App\Traits;

trait ShowColumnOptionTrait
{
    /** this column shown on dropdown, usually name */
    protected $showColumnOption = 'name';

    /**
     * Get the value of showColumnOption.
     */
    public function getShowColumnOption()
    {
        return $this->showColumnOption ?? $this->getKeyName();
    }

    /**
     * Set the value of showColumnOption.
     *
     * @param mixed $showColumnOption
     *
     * @return self
     */
    public function setShowColumnOption($showColumnOption)
    {
        $this->showColumnOption = $showColumnOption;

        return $this;
    }
}
