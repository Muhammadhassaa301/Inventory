<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;

use App\Models\Invoice;
use App\Models\Product;
use App\Models\ProductItem;
use App\Models\Variation;
use App\Models\Vendor;
use App\Models\ProductsMaintenanceHistory;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    
    public function list()
    {
        $invoices = Invoice::all();
        //dd('test');
        return view('admin.invoices.list', compact('invoices'));
    }

    public function addinvoicelist()
    {
        $vendors = Vendor::all();
        $products = Product::all();
        return view('admin.invoices.add', compact('vendors', 'products'));
    }

    public function store(Request $request)
    {
        //dd($request->all());

        $TotAmount = 0;
        $TotQty = 0;
        foreach ($request->items as $v) 
        {
           $TotAmount = $TotAmount + ($v['quantity'] * $v['product_price']);
           $TotQty = $TotQty + $v['quantity'];
        }
        
        //print_r("");
        //dd($request->all());

        $invoice = new Invoice();

        $invoice->invoice_no = $request->invoice_no;
        $invoice->date = $request->date;
        $invoice->vendor_id = $request->vendor;
        $invoice->department_id = Auth::user()->department_id;
        $invoice->quantity = $TotQty;        
        $invoice->amount = $TotAmount;

         $invoice->save();
        
        // ---------------------------------------------
     
       // dd($request->items);

       /*
            id
            serial_no
            invoice_id
            product_id **
            employee_id
            variation_id
            department_id
            price **
            -----
            product
            quantity
            product_price
        */

        $totChild = count($request->items);
        $cnt = 1;

        foreach ($request->items as $v) 
        {
            for ($x = 0; $x < $v['quantity']; $x++)
            {
                $ProdItems = new ProductItem();

                $ProdItems->serial_no = $cnt;
               
                $ProdItems->invoice_id = $invoice->id;
                $ProdItems->product_id = $v['product'];
              //$ProdItems->employee_id = $v->product;

                $variation = $v['variation'] ?? '';
                
                if($variation)
                {
                    $ProdItems->variation_id = $variation;
                } 
                
                $ProdItems->department_id = Auth::user()->department_id;
                $ProdItems->price = $v['product_price'];
                
                $cnt = $cnt + 1;

                $ProdItems->save();

                //print_r("");
            }
        }

        return redirect()->route('invoice.list');

        return view('admin.vendors.list');
        //print_r("Saved!");
    }

    public function getproductprice(Request $request)
    {
        try {
            $product = Product::find($request->product_id);
            if($product->type == 'fixed') {
                $price = $product->price;
            }
            elseif($product->type == 'variable') {
                $variations = $product->variations;
            }


            return response()->json([
                'success' => true,
                'product_id' => $product->id,
                'price' => $price ?? '',
                'type' => $product->type,
                'variations' => $variations ?? ''
            ]);


        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ]);
        }

    }

    public function listitem($id)
    {
        $invoice = Invoice::find($id);
        $productitems = $invoice->productitems;
        $vendor = $invoice->vendor;
        
        //dd('test2');
        //dd($productitems);

        $ItemGrp =  $productitems->groupBy('product_id');         
        
        return view('admin.invoices.productitems.list', compact('invoice', 'productitems', 'vendor', 'ItemGrp'));
        //return view('admin.invoices.listitem', compact('invoice', 'productitems', 'vendor', 'ItemGrp'));

        //dd($ItemGrp);

        // $InvItems = $productitems::select('price')
        //                    ->groupBy('product_id')
        //                    ->get();

        //                    dd($InvItems);
        
        
    }

    public function delete($id)
    {
        try {
            $invoice = Invoice::find($id);
            
            //dd($invoice);

            ProductItem::where('invoice_id', $id)->delete();

            $invoice->delete();

            $invoices = Invoice::all();
            //return view('admin.invoices.list', compact('invoices'));
            
            return redirect()->back()->with('success', 'Invoice Deleted Successfully');

        } catch (\Exception $e) {

            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    public function deleteitem($id)
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

    public function edititem($id)
    {
        try {
            $products = Product::all();
            $productitems = ProductItem::find($id);            
            $pro = Product::where('id', $productitems->product_id)->first();

            //dd('test edit');
            
            return view('admin.invoices.productitems.edit', compact('productitems', 'products', 'pro'));

        } catch (\Exception $e) {

            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    public function update($id, Request $request)
    {
        try {            
            //dd($id);
            
            $productitem = ProductItem::find($id);
            $invoice = Invoice::find($productitem->invoice_id);            

            $price_old = $productitem->price;
            $invoice->amount = $invoice->amount - $price_old + $request->price;

            $productitem->serial_no = $request->serial_no;
            $productitem->prodct_code = $request->product_code;
            $productitem->prodct_id = $request->product_id;
            $productitem->variation_id = $request->variation_id;
            $productitem->price = $request->price;

            $invoice->save();
            $productitem->save();
            return redirect()->route('invoice.productitem.list', $productitem->invoice_id)->with('success', 'Product Item Successfully Updated');

            //return redirect()->back()->with('success', 'Product Deleted Successfully');
            
            //return view('admin.invoices.edititem', compact('productitems', 'products', 'pro'));

        } catch (\Exception $e) {

            return redirect()->back()->with('failed', $e->getMessage());
        }
        
    }

    public function listhistory($id)
    {
        try {
            $productitem = ProductItem::find($id);

            $product = Product::find($productitem->product_id);

            $ProdInfo = array("id"=>$product->id, "ProdName"=>$product->title, "ProductItemID"=>$id);            

            $pmh =  $productitem->products_maintenance_history;
            $variations = $productitem->variations;
            return view('admin.invoices.productitems.history.list', compact('productitem', 'variations', 'pmh', 'ProdInfo'));

        } catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    
    public function addhistory(Request $request)
    {
        // dd($id);
        //dd($request->all());
        //dd($request['product_item_id']);

        $pmh = new ProductsMaintenanceHistory();

        $pmh->product_item_id = $request['product_item_id'];
        $pmh->title = $request['title'];
        $pmh->description = $request['description'];
        $pmh->amount = $request['amount'];

        $pmh->save();


        // $productitem = ProductItem::find($id);        

        // $product = Product::find($productitem->product_id);

        // $ProdInfo = array("id"=>$product->id, "ProdName"=>$product->title, "ProductItemID"=>$id);      

        // return view('admin.invoices.productitems.history.add', compact('productitem',  'ProdInfo'));     
        
        return redirect()->back()->with('success', 'Saved Successfully');
    }

    public function deletehistory($id)
    {
        try {
            $pmh = ProductsMaintenanceHistory::find($id);

            $pmh->delete();
            
            return redirect()->back()->with('success', 'Invoice Item Deleted Successfully');
            
        } catch (\Exception $e) {

            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

       public function edithistory(Request $request, $id)
    {
        try {

            $pmh = ProductsMaintenanceHistory::find($request->history_id);

            $html = view('admin.invoices.productitems.history.partials.edit_inner', compact('pmh'))->render();

            return response()->json([
                'success' => true, 'html' => $html
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);

        }
    }

    
    public function updatehistory(Request $request)
    {
        try {  
            //dd($request->all());

            $pmhA =  ProductsMaintenanceHistory::find($request->id);

            $pmhA->title = $request->title;
            $pmhA->description = $request->description;
            $pmhA->amount = $request->amount;
            
            $pmhA->save();
            return redirect()->back()->with('success', 'Invoice History Successfully Updated');

            //return redirect()->route('admin.invoices.productitems.history.list', $pmh->product_item_id)->with('success', 'Product Item Successfully Updated');
            
            // =======================

            // $productitem = ProductItem::find($pmhA->product_item_id);

            // $product = Product::find($productitem->product_id);

            // $ProdInfo = array("id"=>$product->id, "ProdName"=>$product->title, "ProductItemID"=>$pmhA->product_item_id);            

            // $pmh =  $productitem->products_maintenance_history;
            // $variations = $productitem->variations;

            
            //return view('admin.invoices.productitems.history.list', compact('productitem', 'variations', 'pmh', 'ProdInfo'));


            //return redirect()->route('invoices.productitems.history.list', $pmh->product_item_id)->with('success', 'Product Item Successfully Updated');
         // return redirect()->route('invoice.productitem.history.list', $pmh->product_item_id)->with('success', 'Product Item Successfully Updated');

        } catch (\Exception $e) {

            return redirect()->back()->with('failed', $e->getMessage());
        }
        
    }



    public function edit($id)
    {
        $invoice = Invoice::find($id);

        $vendors = Vendor::all();

        $products = Product::all();
        return view ('admin.invoices.edit',compact('invoice','vendors','products'));
    }


}

