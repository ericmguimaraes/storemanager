<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Supplie;
use App\Repositories\ProductSupplieRepository;
use Carbon\Carbon;

class ReportController extends Controller
{

  /**
     * The product repository instance.
     *
     * @var productSupplieRepository
     */
     protected $productSupplieRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProductSupplieRepository $productSupplieRepository)
    {
        $this->middleware('auth');
        $this->productSupplieRepository = $productSupplieRepository;
    }

    public function stock(Request $request)
  	{
        $products = \App\Models\Product::all();
        $productStock = [];

        foreach ($products as $product) {
          array_push($productStock, [
            'name' => $product->name,
            'qtd' => $this->productSupplieRepository->totalStockProduct($product)
          ]);
        }

        $supplies = \App\Models\Supplie::all();
        $supplieStock = [];

        foreach ($supplies as $supplie) {
          array_push($supplieStock, [
            'name' => $supplie->name,
            'qtd' => $this->productSupplieRepository->totalStockSupplie($supplie)
          ]);
        }

        return view('stock', [
            'products' => $productStock,
            'supplies' => $supplieStock,
        ]);
  	}

    public function balance(Request $request)
  	{
        $income = [];
        $expenses = [];
        $total_income =  0.00;
        $total_expenses =  0.00;
        $total = 0.00;

        $start_date = Carbon::now()->subMonth();
        $end_date = Carbon::now();

        if($request->daterange){
          $dates = [];
          $dates = explode(' - ',$request->daterange);
          $start_date = Carbon::createFromFormat('m/d/Y', $dates[0]);
          $end_date = Carbon::createFromFormat('m/d/Y', $dates[1]);
        }

        $products = $this->productSupplieRepository->product_transactions($start_date, $end_date);
        $supplies = $this->productSupplieRepository->supplie_transactions($start_date, $end_date);
        $income = $this->productSupplieRepository->income($products, $supplies);
        $expenses = $this->productSupplieRepository->expenses($products, $supplies);
        $total_income = $this->productSupplieRepository->total_income($products, $supplies);
        $total_expenses = $this->productSupplieRepository->total_expenses($products, $supplies);
        $total = $total_income-$total_expenses;

        return view('balance',[
          'income' => $income,
          'expenses' => $expenses,
          'total_income' => $total_income,
          'total_expenses' => $total_expenses,
          'total' => $total,
        ]);
  	}

}
