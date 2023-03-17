<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SalesOrder;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SalesOrderController extends Controller
{
    public function index()
    {
        try {
            $data = SalesOrder::join('customers', 'sales_orders.id_customer', '=', 'customers.id')
                ->join('products', 'sales_orders.id_product', '=', 'products.id')
                ->select('sales_orders.id', 'products.kode_product', 'products.title', 'products.price', 'customers.nama', 'customers.no_telepon', 'customers.alamat', 'sales_orders.quantity', 'sales_orders.total_price')
                ->get();
            $response = ["message" => "oke!", "data" => $data];
            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json(["message" => $e->errorInfo]);
        }
    }

    public function store(Request $request)
    {
        // $validateData = $request->validate([
        //     "id_customer" => "required",
        //     "id_product" => "required",
        //     "quantity" => "required",
        // ]);
        $id_customer = $request->id_customer;
        $id_product = $request->id_product;
        $quantity = $request->quantity;

        try {
            $find = Product::where('id', $id_product)->first();
            if ($quantity > $find['quantity']) {
                $response = ["message" => "Permintaan melebihi stock yang tersedia"];
            } else {
                $totPrice = $quantity * $find['price'];
                $newQuantity = $find['quantity'] - $quantity;
                $savedData = SalesOrder::create([
                    "id_customer" => $id_customer,
                    "id_product" => $id_product,
                    "quantity" => $quantity,
                    "total_price" => $totPrice,
                ]);
                $updtQuantity = $find->update(['quantity' => $newQuantity]);
                $response = ["message" => "Data berhasil disimpan", "data1" => $savedData, "data2" => $updtQuantity];
                // $response = ["message" => "Data tersedia"];
            }
            return response()->json($response, Response::HTTP_CREATED);
        } catch (QueryException $e) {
            return response()->json(["message" => $e->errorInfo]);
        }
    }

    public function destroy($id)
    {
        try {
            $find = SalesOrder::where("id", $id)->first();
            $deleteData = $find->delete();
            $response = ["message" => "Data berhasil dihapus", "data" => $deleteData];
            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json(["message" => $e->errorInfo]);
        }
    }
}
