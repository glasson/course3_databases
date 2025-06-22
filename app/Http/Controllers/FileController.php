<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\ProductCategory;
use App\Models\Manufacturer;
use App\Models\Medicine;
use App\Models\Sell;
use App\Models\SoldProduct;

class FileController extends Controller
{
    function products_in_stock(Request $request){
        $fields = array_slice(array_keys(Product::first()->toArray()), 1, -1);
        $data = Product::where('apteka_id',$request->input('id')) ->where('quantity','>',0)->select($fields)->get();
        $temp_file_path = storage_path('app/TMP_products_in_stock.csv');
        $csv_file = fopen($temp_file_path, 'w');
            fputcsv($csv_file, $fields);
            foreach ($data as $record) {
                $record = $this->change_id_to_name($record);
                fputcsv($csv_file, $record->toArray());
            }
        fclose($csv_file);
        return response()->download($temp_file_path)->deleteFileAfterSend(true);
    }

    function expired_products(){
        $fields = array_slice(array_keys(Product::first()->toArray()), 1);
        $data = Product::where('expiration_date', '<', now())->select($fields)->get();
        $temp_file_path = storage_path('app/TMP_expired_products.csv');
        $csv_file = fopen($temp_file_path, 'w');
            fputcsv($csv_file, $fields);
            foreach ($data as $record) {
                $record = $this->change_id_to_name($record);
                fputcsv($csv_file, $record->toArray());
            }
        fclose($csv_file);
        return response()->download($temp_file_path)->deleteFileAfterSend(true);
    }

    function promotions(){
        $fields = array_slice(array_keys(Promotion::first()->toArray()), 1);
        $data = Promotion::select($fields)->get();
        $temp_file_path = storage_path('app/TMP_promotions.csv');
        $csv_file = fopen($temp_file_path, 'w');
            fputcsv($csv_file, $fields);
            foreach ($data as $record) {
                $record->product = Product::find($record->product)->name;
                fputcsv($csv_file, $record->toArray());
            }
        fclose($csv_file);
        return response()->download($temp_file_path)->deleteFileAfterSend(true);
    }

    function purchases_history(Request $request){
        //$fields = array_slice(array_keys(Sell::first()->toArray()), 1);
        
        $client = Client::where('phone', $request->input('phone'))->first();
        $client = $client->id;
        $data = Sell::where('client', $client)->get();
        $temp_file_path = storage_path('app/TMP_purchases_history.csv');
        $csv_file = fopen($temp_file_path, 'w');
            foreach ($data as $sell_record) {
                $sold_products = SoldProduct::where('sell_id', $sell_record->id)->get();//->select($fields);
                $sell_record_values = array_values($sell_record->toArray());
                $employee = Employee::find($sell_record_values[1])->name .' '. Employee::find($sell_record_values[1])->surname .' '. Employee::find($sell_record_values[1])->patronymic;
                $date = $sell_record_values[3];
                fputcsv($csv_file, [$employee, $date]);  
                // error_log($sell_record_values[1])  ;
                foreach($sold_products as $sp){
                    $sp_values = array_slice(array_values($sp->toArray()), 2);
                    $sp_values[0] = Product::find($sp_values[0])->name;
                    fputcsv($csv_file, $sp_values);
                    
                }
            }
        fclose($csv_file);
        return response()->download($temp_file_path)->deleteFileAfterSend(true);
    }

    private function change_id_to_name($record){
        $tmp_name = Medicine::find($record->medicine);
        $tmp_name===null ? $record->medicine = 'нет' : $record->medicine = $tmp_name->name;

        $tmp_name = ProductCategory::find($record->category);
        $tmp_name===null ? $record->category = 'нет' : $record->category = $tmp_name->name;

        $tmp_name = Manufacturer::find($record->manufacturer);
        $tmp_name===null ? $record->manufacturer = 'нет' : $record->manufacturer = $tmp_name->name;

        return $record;
    }
}
