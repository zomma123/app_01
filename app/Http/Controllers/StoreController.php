<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Store;
use App\Models\Transection;
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

            $product_id_new = $store->id;
            // ບັນທຶກ ລາຍຈ່າຍ ສັ່ງຊື້ສິນຄ້າ
            $number = 1;
            $tran = Transection::all()->sortByDesc('id')->take(1)->toArray();

            foreach($tran as $new){
                $number = $new["tran_id"];
            }
            // ຕົວຢ່າງ INC00001
            if($number !=''){
                $number1 = str_replace("INC","",$number); // 00001
                $number2 = str_replace("EXP","",$number1);
                $number3 = (int)$number2+1; // 1+1 = 2
                $length = 5;
                $number = substr(str_repeat(0,$length).$number3, - $length); //00002
            }

            if($request->acc_type == "income") {
                $tnum = "INC";
            } elseif($request->acc_type == "expense") {
                $tnum = "EXP";
            }

            $trans = new Transection();
            $trans->tran_id = $tnum.$number;
            $trans->product_id = $product_id_new;
            $trans->tran_type = $request->acc_type;
            $trans->tran_detail = "ນຳເຂົ້າສິນຄ້າໃໝ່ ".$request->name;
            $trans->amount = $request->amount;
            $trans->price = $request->amount*$request->price_buy;
            $trans->save();

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
        ->paginate(6)->toArray();
        return array_reverse($store);
}

    public function edit($id){

        $store= Store::find($id);
        return response()->json($store);

        
}

    public function update($id, Request $request){
        try {
        $store= Store::find($id);
        
        if ($request->file('image')) {
            $upload_path = "assets/img";
            if ($store->image != '') {
                if (file_exists($upload_path . '/' . $store->image)) {
                    unlink($upload_path . '/' . $store->image);
                }
            }

            $generated_new_name = time() . '.' . $request->image->getClientOriginalExtension();
            $image = $request->file('image');
            $img = Image::make($image->getRealpath());
            $img->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            $img->save($upload_path . '/' . $generated_new_name);

            // ອັບເດດ
            $store->update([
                'name' => $request->name,
                'image' => $generated_new_name,
                'amount' => $request->amount,
                'price_buy' => $request->price_buy,
                'price_sell' => $request->price_sell,
            ]);

        } else {
            $generated_new_name = "";

            // ອັບເດດ
            $store->update([
                'name' => $request->name,
                'amount' => $request->amount,
                'price_buy' => $request->price_buy,
                'price_sell' => $request->price_sell,
            ]);
        }

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