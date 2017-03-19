<?php

namespace App\Repositories;

use App\Models\Supplie;

class SupplieRepository
{

  public function totalStock(Supplie $supplie)
   {
       return $supplie->supplie_transactions()->sum('qtd');
   }

}
