<?php

namespace App\Http\Controllers;

use App\Models\ProductStock;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\ReturnProduct;
use App\Models\ProductSizeStock;
use Illuminate\Support\Facades\Validator;

class ReturnProductsController extends Controller
{
    public function returnProduct(){
        return view('return_products.return');
    }
    public function returnProductSubmit(Request $request){

        $validate = Validator::make($request->all(), [
            'product_id' => 'required|numeric',
            'date' => 'required|string',
            'items' => 'required',
     
        ]);

        if($validate->fails()){
            return response()->json([
                'success' => false,
                'errors' => $validate->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        foreach ($request->items as $item) {
            if($item['quentity']>0){
                $new_item = new ReturnProduct();
                $new_item->product_id = $request->product_id;
                $new_item->date = $request->date;
                // item those value as array so that why 
                $new_item->size_id = $item['size_id'];
                $new_item->quantity = $item['quentity'];
                $new_item->save();

                $psq = ProductSizeStock::where('product_id', $request->product_id)
                    ->where('size_id', $item['size_id'])->first();
              
                    $psq->quantity = $psq->quantity + $item['quentity'];
                

                $psq->save();
            }
        }
        
        flash('Product Returned Successfully.')->success();

        return response()->json([
            'success' => true,

        ], Response::HTTP_OK);
    }
    public function history(){
        $return_product = ReturnProduct::with(['size', 'product'])->orderBy('created_at', 'DESC')->get();
        return view('return_products.history', compact('return_product'));
    }
}
