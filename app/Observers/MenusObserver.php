<?php

namespace App\Observers;

use App\Models\Base\Menus;
use App\Models\Base\MenusTree;

class MenusObserver
{
    /**
     * Handle the Menus "created" event.
     */
    public function created(Menus $menus)
    {
        MenusTree::fixTree();
    }

    /**
     * Handle the Menus "updated" event.
     */
    public function updated(Menus $menus)
    {
    }

    /**
     * Handle the Menus "deleted" event.
     */
    public function deleted(Menus $menus)
    {
    }

    /**
     * Handle the Menus "restored" event.
     */
    public function restored(Menus $menus)
    {
    }

    /**
     * Handle the Menus "force deleted" event.
     */
    public function forceDeleted(Menus $menus)
    {
    }
}
