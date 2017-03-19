<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{

  public function totalStock(Product $product)
   {
       return $product->product_transactions()->sum('qtd');
   }

}
