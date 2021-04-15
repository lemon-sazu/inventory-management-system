<?php

namespace App\Http\Controllers;

use App\Models\ProductStock;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\ProductSizeStock;
use Illuminate\Support\Facades\Validator;

class StocksController extends Controller
{
    public function stock(){
        return view('stocks.stock');
    }
    public function stockSubmit(Request $request){

        $validate = Validator::make($request->all(), [
            'product_id' => 'required|numeric',
            'stock_type' => 'required|string',
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
                $new_item = new ProductStock();
                $new_item->product_id = $request->product_id;
                $new_item->date = $request->date;
                $new_item->status = $request->stock_type;
                // item those value as array so that why 
                $new_item->size_id = $item['size_id'];
                $new_item->quantity = $item['quentity'];
                $new_item->save();

                $psq = ProductSizeStock::where('product_id', $request->product_id)
                    ->where('size_id', $item['size_id'])->first();
                if($request->stock_type == ProductStock::STOCK_IN){
                    $psq->quantity = $psq->quantity + $item['quentity'];
                }else{
                    $psq->quantity = $psq->quantity - $item['quentity'];
                }
                $psq->save();
            }
        }
        flash('Product Created Successfully.')->success();
        flash('Stock Updated Successfully.')->success();

        return response()->json([
            'success' => true,

        ], Response::HTTP_OK);
    }
    public function history(){
        $stocks = ProductStock::with(['size', 'product'])->orderBy('created_at', 'DESC')->get();
        return view('stocks.history', compact('stocks'));
    }
}
