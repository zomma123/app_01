<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Store;
use Intervention\Image\Facades\Image;

class StoreController extends Controller
{
    //
    public function add(Request $request){
        try{
            if ($request->file('image')) {

                $upload_path = "assets/img";
                $generated_new_name = time() . '.' . $request->image->getClientOriginalExtension();
                $image = $request->file('image');
                $img = Image::make($image->getRealpath());
                $img->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                });

                $img->save($upload_path . '/' . $generated_new_name);

            } else {
                $generated_new_name = "";
            }

            $store = new Store;
            $store->name = $request->name;
            
            $store->image = $generated_new_name;

            $store->amount = $request->amount;
            $store->price_buy = $request->price_buy;
            $store->price_sell = $request->price_sell;
            $store->save();

            $success = true;
            $massage = "ເພີ່ມ​ຂໍ້​ມູນ​ສຳ​ເລັດ";

        }catch(\Illuminate\Database\QueryException $ex){
            $success = false;
            $massage = $ex->getMessage();
        }

        $response = [
             'success' =>$success,
             'message'=>$massage
        ];

        return response()->json($response); 
    
}
    public function index(){
        // $store = Store::orderBy("id", "asc")->get();
        // return  $store ;
        
        $search = \Request::get('search');
        $store = Store::orderBy('id', 'desc')->where('id', 'LIKE', "%$search%")->orWhere('name', 'LIKE', "%$search%")
        ->paginate(3)->toArray();
        return array_reverse($store);
}

    public function edit($id){

        $store= Store::find($id);
        return response()->json($store);

        
}

    public function update($id, Request $request){
        try {
        $store= Store::find($id);
        $store->update([
            'name'=>$request->name,
            'amount'=>$request->amount,
            'price_buy'=>$request->price_buy,
            'price_sell'=>$request->price_sell,
        ]);

        $success = true;
            $massage = "ແກ້​ໄຂ​ ຂໍ້​ມູນ​ສຳ​ເລັດແລ້ວ";

        }catch(\Illuminate\Database\QueryException $ex){
            $success = false;
            $massage = $ex->getMessage();
        }

        $response = [
             'success' =>$success,
             'message'=>$massage
        ];

        return response()->json($response);
        
        // return response()->json($store);
}
public function delete($id){
    try {
    $store= Store::find($id);
    $store -> delete();

    $success = true;
            $massage = "ຂໍ້​ມູນ​ຖືກ​ລຶບ​ແລ້ວ";

        }catch(\Illuminate\Database\QueryException $ex){
            $success = false;
            $massage = $ex->getMessage();
        }

        $response = [
             'success' =>$success,
             'message'=>$massage
        ];

        return response()->json($response);
}

}