<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Supplie;
use App\Repositories\ProductRepository;
use App\Repositories\SupplieRepository;

class ReportController extends Controller
{

  /**
     * The product repository instance.
     *
     * @var ProductRepository
     */
    protected $productRepository;

    /**
       * The Supplie repository instance.
       *
       * @var SupplieRepository
       */
      protected $supplieRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProductRepository $productRepository, SupplieRepository $supplieRepository)
    {
        $this->middleware('auth');
        $this->productRepository = $productRepository;
        $this->supplieRepository = $supplieRepository;
    }

    public function stock(Request $request)
  	{
        $products = \App\Models\Product::all();
        $productStock = [];

        foreach ($products as $product) {
          array_push($productStock, [
            'name' => $product->name,
            'qtd' => $this->productRepository->totalStock($product)
          ]);
        }

        $supplies = \App\Models\Supplie::all();
        $supplieStock = [];

        foreach ($supplies as $supplie) {
          array_push($supplieStock, [
            'name' => $supplie->name,
            'qtd' => $this->supplieRepository->totalStock($supplie)
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


        return view('balance',[
          'income' => $income,
          'expenses' => $expenses,
          'total_income' => $total_income,
          'total_expenses' => $total_expenses,
          'total' => $total,
        ]);
  	}

}
