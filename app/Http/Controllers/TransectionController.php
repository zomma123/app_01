<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transection;
use App\Models\Store;
use App\Models\Bill;
use App\Models\Bill_list;

class TransectionController extends Controller
{
    //
    public function add(Request $request){

        try{
            $bill_id = 0;
            $Bill = Bill::all()->sortByDesc('id')->take(1)->toArray();

            foreach ($Bill as $new) {
                $bill_id = $new["bill_id"];
            }

            // ຕົວຢ່າງ INC00001

            // $bill_id1 = str_replace("INC","",$bill_id); // 00001
            // $bill_id2 = str_replace("EXP","",$bill_id1);
            $bill_id3 = (int) $bill_id + 1; // 1+1 = 2
            $length = 5;
            $new_bill_id = substr(str_repeat(0, $length) . $bill_id3, -$length); //00002

            // ບັນທຶກຂໍ້ມູນໃບບິນ
            $Bill = new Bill();
            $Bill->bill_id = $new_bill_id;
            $Bill->cus_name = $request->cus_name;
            $Bill->cus_tel = $request->cus_tel;
            $Bill->save();

        //return $request->listorder;

        foreach($request->listorder as $item){

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
            $trans->product_id = $item["id"];
            $trans->tran_type = $request->acc_type;
            $trans->tran_detail = $item["name"];
            $trans->amount = $item["amount"];
            $trans->price = $item["amount"]*$item["price_sell"];
            $trans->save();

            // ທຳການ ຕັດສະຕ໋ອກສິນຄ້າ
            $store = Store::find($item["id"]);

            // update
            $store_update = Store::find($item["id"]);
            $store_update->update([
                'amount' => $store->amount - $item["amount"]
            ]);

            // ບັນທຶກລາຍການໃບບິນ
            $Bill = new Bill_list();
            $Bill->bill_id = $new_bill_id;
            $Bill->name = $item['name'];
            $Bill->amount = $item['amount'];
            $Bill->price = $item['price_sell'];
            $Bill->save();
            

        }

        $success = true;
            $message = "ຢືນ​ຢັນ​ການ​ຊຳ​ລະ!";
        } catch (\Illuminate\Database\QueryException $ex){
            $success = false;
            $message = $ex->getMessage();
        }

        $response = [
            "success" => $success,
            "message" => $message,
            "Bill_id" => $new_bill_id
        ];
        
        return response()->json($response);

    }
}
