<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\Brand;
use App\Models\Employee;
use App\Models\Product;
use App\Models\Variation;
use App\Models\Invoice;
use App\Models\ProductItem;
use App\Models\ProductsMaintenanceHistory;

class ProductItemController extends Controller
{
    public function list($id)
    {
        //$id = 53;

        $product = Product::find($id);
        $productitems = $product->productitems;

        $employees = Employee::all();

      //  $employees = Employee::all();
      //  dd($employees);

        //dd($productitems);

        //$vendor = $invoice->vendor;

        //$ItemGrp =  $productitems->groupBy('product_id');         
        
        
        return view('admin.products.items.list', compact('productitems','employees'));        
        //return view('admin.invoices.productitems.list', compact('invoice', 'productitems', 'vendor', 'ItemGrp'));        
    }
    public function edit($id)
    {
        try {
            $products = Product::all();
            $productitems = ProductItem::find($id);            
            $pro = Product::where('id', $productitems->product_id)->first();

            //dd('test edit');
            // admin.products.items.edit
            return view('admin.products.items.edit', compact('productitems', 'products', 'pro'));

        } catch (\Exception $e) {

            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            
            $item = ProductItem::find($id);

            //dd($item);

            $invoice = Invoice::find($item->invoice_id);

            $invoice->quantity--;
            $invoice->amount -= $item->price;

            //dd($invoice->price);

            $invoice->save();

            $item->delete();
            
            //$productitems = $invoice->productitems;
            //$vendor = $invoice->vendor;
            
            return redirect()->back()->with('success', 'Invoice Item Deleted Successfully');

           //dd($productitems);

            //$ItemGrp =  $productitems->groupBy('product_id'); 
            //return view('admin.invoices.listitem', compact('invoice', 'productitems', 'vendor'));

        } catch (\Exception $e) {

            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    public function getemployee(Request $request)
    {
        try{

        $productitem = ProductItem::find($request->productitem_id);

        $employees = Employee::all();
            


       $html = view('admin.products.items.partials.assign_inner', compact('productitem','employees'))->render();   
       
       
       return response()->json([
        'Success' => true, 
        'html' => $html
       ]);

    }
    catch(\Exception $exception)
    {

        return response()->json([
            'Success' => false, 
            'message' => $$exception->getMessage()
           ]);

    }


    }


    public function assignemployee (Request $request)
    {
        
        $productitem = ProductItem::find($request->productitem_id);

        $productitem->employee_id = $request->employee_id;

        $productitem->save();

        return redirect()->back()->with('success', 'Item Successfully Assigned');



    }

}
