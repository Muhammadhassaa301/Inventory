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

class ProductHistoryController extends Controller
{
    public function list($id)
    {
        try {
            $productitem = ProductItem::find($id);

            $product = Product::find($productitem->product_id);

            $ProdInfo = array("id"=>$product->id, "ProdName"=>$product->title, "ProductItemID"=>$id);            

            $pmh =  $productitem->products_maintenance_history;
            $variations = $productitem->variations;
            return view('admin.products.items.history.list', compact('productitem', 'variations', 'pmh', 'ProdInfo'));

        } catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $pmh = ProductsMaintenanceHistory::find($id);

            $pmh->delete();
            
            return redirect()->back()->with('success', 'Invoice Item Deleted Successfully');
            
        } catch (\Exception $e) {

            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    public function edit(Request $request, $id)
    {
        try {

            $pmh = ProductsMaintenanceHistory::find($request->history_id);

            // admin.products.items.history.partials.edit_inner
            $html = view('admin.products.items.history.partials.edit_inner', compact('pmh'))->render();

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
}
