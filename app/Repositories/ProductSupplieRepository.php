<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\Supplie;
use App\Models\Product_transaction;
use App\Models\Supplie_transaction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class ProductSupplieRepository
{


  public function product_transactions(Carbon $start_date, Carbon $end_date)
   {
       return Product_transaction::whereBetween('created_at', array($start_date, $end_date))->get();
   }

   public function supplie_transactions(Carbon $start_date, Carbon $end_date)
    {
        return Supplie_transaction::whereBetween('created_at', array($start_date, $end_date))->get();
    }

  public function totalStockProduct(Product $product)
   {
       return $product->product_transactions()->sum('qtd');
   }

   public function totalStockSupplie(Supplie $supplie)
    {
        return $supplie->supplie_transactions()->sum('qtd');
    }

   public function income(Collection $products, Collection $supplies)
   {
     $income = [];
     $income = $income + $this->formatIncome($products, true);
     $income = $income + $this->formatIncome($supplies, false);
     return $income;
   }

   public function expenses(Collection $products, Collection $supplies)
   {
     $expenses = [];
     $expenses = $expenses + $this->formatExpenses($products, true);
     $expenses = $expenses + $this->formatExpenses($supplies, false);
     return $expenses;
   }

   public function total_income(Collection $products, Collection $supplies)
   {
     $income = 0;
     $income = $income+$this->calculateTotalIncome($products);
     $income = $income+$this->calculateTotalIncome($supplies);
     return $income;
   }

   public function total_expenses(Collection $products, Collection $supplies)
   {
     $expenses = 0;
     $expenses = $expenses+$this->calculateTotalExpenses($products);
     $expenses = $expenses+$this->calculateTotalExpenses($supplies);
     return $expenses;
   }

   private function calculateTotalIncome(Collection $array){
     $income = 0;
     foreach ($array as $transaction) {
       if($transaction->qtd<0 && $transaction->unit_value!=0){
         $income = $income+($transaction->unit_value*$transaction->qtd*-1);
       }
     }
     return $income;
   }

   private function calculateTotalExpenses(Collection $array){
     $expenses = 0;
     foreach ($array as $transaction) {
       if($transaction->qtd>0 && $transaction->unit_value!=0){
         $expenses = $expenses+($transaction->unit_value*$transaction->qtd);
       }
     }
     return $expenses;
   }

   private function formatIncome(Collection $array, bool $is_product){
     $income = [];
     foreach ($array as $transaction) {
       if($transaction->qtd<0 && $transaction->unit_value>0){
         $name = "";
         if($is_product)
           $name = $transaction->product()->get()[0]->name;
         else
           $name = $transaction->supplie()->get()[0]->name;
         array_push($income, [
           'date' => $transaction->created_at->format('d/m/Y'),
           'name' => $name,
           'qtd' => -1*$transaction->qtd,
           'unit_value' => $transaction->unit_value,
           'total_value'=> -1*$transaction->unit_value*$transaction->qtd,
         ]);
       }
     }
     return $income;
   }

   private function formatExpenses(Collection $array, bool $is_product){
     $income = [];
     foreach ($array as $transaction) {
       $name = "";
       if($is_product)
         $name = $transaction->product()->get()[0]->name;
       else
         $name = $transaction->supplie()->get()[0]->name;
       if($transaction->qtd>0 && $transaction->unit_value>0){
         array_push($income, [
           'date' => $transaction->created_at,
           'name' => $name,
           'qtd' => $transaction->qtd,
           'unit_value' => $transaction->unit_value,
           'total_value'=> $transaction->unit_value*$transaction->qtd,
         ]);
       }
     }
     return $income;
   }

}
