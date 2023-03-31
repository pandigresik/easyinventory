<?php

namespace App\Repositories\Inventory;

/**
 * Class StockMoveRepository
 * @package App\Repositories\Inventory
 * @version November 28, 2022, 10:56 am WIB
*/

class TransferInWHRepository extends StockMoveRepository
{    
    protected $moveType = 'TR_IN';
}
