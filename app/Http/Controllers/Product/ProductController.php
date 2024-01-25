<?php

namespace App\Http\Controllers\Product;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Variation;
use App\Models\Invoice;
use App\Models\ProductItem;
use App\Models\ProductsMaintenanceHistory;

class ProductController extends Controller
{   
    // public function listhistory($id)
    // {
    //     try {
    //         $productitem = ProductItem::find($id);

    //         $product = Product::find($productitem->product_id);

    //         $ProdInfo = array("id"=>$product->id, "ProdName"=>$product->title, "ProductItemID"=>$id);            

    //         $pmh =  $productitem->products_maintenance_history;
    //         $variations = $productitem->variations;
    //         return view('admin.products.items.history.list', compact('productitem', 'variations', 'pmh', 'ProdInfo'));

    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('failed', $e->getMessage());
    //     }
    // }

    public function list()
    {
        $products = Product::all();
        return view('admin.products.list', compact('products'));
    }

    public function addproduct()
    {
        $brands = Brand::all();
        return view('admin.products.add', compact('brands'));
    }

    public function store(StoreProductRequest $request)
    {
        try {
            //dd($request->all());
            $product = Product::create([
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price == null ? 0 : $request->price,
                'type' => $request->type,
                'asset_type' => $request->asset_type,
                'brand_id' => $request->brand,
                'department_id' => Auth::user()->department_id
            ]);

            $variations = array_map('array_filter', $request->variation);
            $variations = array_filter($variations);

            if($variations && $request->type == 'variable') {
                foreach ($variations as $variation) {
                    $newvariation = new Variation();
                    $newvariation->title = $variation['title'];
                    $newvariation->price = $variation['price'];
                    $newvariation->product_id = $product->id;
                    $newvariation->save();
                }
            }

            if($product)
            {
                return redirect()->back()->with('success', 'Product Added Successfully');
            }
            return redirect()->back()->with('failed', 'Something Went Wrong! Please try again later.');

        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $product = Product::find($id);
            $brands = Brand::all();
            $variations = $product->variations;
            return view('admin.products.edit', compact('product','brands', 'variations'));

        } catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    public function update($id, Request $request)
    {
        if(!$request->variation[0]['title']) {                      // If variation has empty fields
            $request->validate([
                'title' => 'required',
                'brand' => 'required',
                'type' => 'required',
                'asset_type' => 'required',
                'price' => 'required_if:type,fixed',
                'variation.*.title' => 'required_if:type,variable',
                'variation.*.price' => 'required_with:variation.*.title'
            ],
                [
                    'variation.*.title.required_if' => 'The variation field is required',
                    'variation.*.price.required_with' => 'The price field is required'
                ]
            );
        } else {
            $request->validate([                                    //
                'title' => 'required',
                'brand' => 'required',
                'type' => 'required',
                'asset_type' => 'required',
                'price' => 'required_if:type,fixed',
                'variation.*.title' => 'required_if:type,variable',
                'variation.*.price' => 'required_with:variation.*.title'
            ],
                [
                    'variation.*.title.required_if' => 'The variation field is required',
                    'variation.*.price.required_with' => 'The price field is required'
                ]
            );

        }

        try {
            $product = Product::find($id);
            $type = $product->type;

            $product->title = $request->title;
            $product->description = $request->description;
            $product->price = $request->price == null ? 0 : $request->price;
            $product->type = $request->type;
            $product->asset_type = $request->asset_type;
            $product->brand_id = $request->brand;
            $product->department_id = Auth::user()->department_id;
            $product->save();

            if($type != $request->type) {
                $existingvariations = Variation::where('product_id', $product->id)->delete();
            }

            $variations = array_map('array_filter', $request->variation);
            $variations = array_filter($variations);

            if($request->type == 'variable') {
                foreach ($variations as $variation) {
                    $variation_id = $variation['id'] ?? null;
                    $existingvariation = Variation::find($variation_id);
                    if (!$existingvariation) {
                        $newvariation = new Variation();
                        $newvariation->title = $variation['title'];
                        $newvariation->price = $variation['price'];
                        $newvariation->product_id = $product->id;
                        $newvariation->save();
                    } else {
                        $existingvariation->title = $variation['title'];
                        $existingvariation->price = $variation['price'];
                        $existingvariation->product_id = $product->id;
                        $existingvariation->save();
                    }
                }
            }

            return redirect()->back()->with('success', 'Product Updated Successfully');

        } catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $product = Product::find($id);

            Variation::where('product_id', $product->id)->delete();
            $product->delete();

            return redirect()->back()->with('success', 'Product Deleted Successfully');

        } catch (\Exception $e) {

            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    public function deletevariation(Request $request)
    {
        try {
            $variation = Variation::find($request->variation_id);
            if($variation) {
                $variation->delete();
            }

            return response()->json([
                'success' => true,
                'message' => 'Variation deleted successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    // public function deletehistory($id)
    // {
    //     try {
    //         $pmh = ProductsMaintenanceHistory::find($id);

    //         $pmh->delete();
            
    //         return redirect()->back()->with('success', 'Invoice Item Deleted Successfully');
            
    //     } catch (\Exception $e) {

    //         return redirect()->back()->with('failed', $e->getMessage());
    //     }
    // }

    // public function edithistory(Request $request, $id)
    // {
    //     try {

    //         $pmh = ProductsMaintenanceHistory::find($request->history_id);

    //         // admin.products.items.history.partials.edit_inner
    //         $html = view('admin.products.items.history.partials.edit_inner', compact('pmh'))->render();

    //         return response()->json([
    //             'success' => true, 'html' => $html
    //         ]);

    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => $e->getMessage()
    //         ]);

    //     }
    // }

    // public function deleteitem($id)
    // {
    //     try {
            
    //         $item = ProductItem::find($id);

    //         //dd($item);

    //         $invoice = Invoice::find($item->invoice_id);

    //         $invoice->quantity--;
    //         $invoice->amount -= $item->price;

    //         //dd($invoice->price);

    //         $invoice->save();

    //         $item->delete();
            
    //         //$productitems = $invoice->productitems;
    //         //$vendor = $invoice->vendor;
            
    //         return redirect()->back()->with('success', 'Invoice Item Deleted Successfully');

    //        //dd($productitems);

    //         //$ItemGrp =  $productitems->groupBy('product_id'); 
    //         //return view('admin.invoices.listitem', compact('invoice', 'productitems', 'vendor'));

    //     } catch (\Exception $e) {

    //         return redirect()->back()->with('failed', $e->getMessage());
    //     }
    // }

    // public function edititem($id)
    // {
    //     try {
    //         $products = Product::all();
    //         $productitems = ProductItem::find($id);            
    //         $pro = Product::where('id', $productitems->product_id)->first();

    //         //dd('test edit');
    //         // admin.products.items.edit
    //         return view('admin.products.items.edit', compact('productitems', 'products', 'pro'));

    //     } catch (\Exception $e) {

    //         return redirect()->back()->with('failed', $e->getMessage());
    //     }
    // }

    // public function listitem($id)
    // {
    //     //$id = 53;
    //     $product = Product::find($id);
    //     $productitems = $product->productitems;

    //     //dd($productitems);

    //     //$vendor = $invoice->vendor;

    //     //$ItemGrp =  $productitems->groupBy('product_id');         
        
        
    //     return view('admin.products.items.list', compact('productitems'));        
    //     //return view('admin.invoices.productitems.list', compact('invoice', 'productitems', 'vendor', 'ItemGrp'));        
    // }

}
