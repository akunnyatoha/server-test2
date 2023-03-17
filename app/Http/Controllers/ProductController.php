<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{

    public function index()
    {
        try {
            $data = Product::get();
            $response = ["message" => "oke!", "data" => $data];
            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json(["message" => $e->errorInfo]);
        }
    }

    public function store(Request $request)
    {
        $kode_product = $request->kode_product;
        $title = $request->title;
        $quantity = $request->quantity;
        $price = $request->price;

        try {
            $find = Product::where("kode_product", $kode_product)->first();
            if ($find != null) {
                $totQuantity = $quantity + $find['quantity'];
                $savedData = $find->update([
                    'title' => $title,
                    'quantity' => $totQuantity,
                    'price' => $price
                ]);
                $response = ["message" => "Data berhasil disimpan", "data" => $find];
            } else {
                $savedData = Product::create([
                    'kode_product' => $kode_product,
                    'title' => $title,
                    'quantity' => $quantity,
                    'price' => $price
                ]);
                $response = ["message" => "Data berhasil disimpan", "data" => $savedData];
            }
            return response()->json($response, Response::HTTP_CREATED);
        } catch (QueryException $e) {
            return response()->json(["message" => $e->errorInfo]);
        }
    }

    public function getProductById($id)
    {
        try {
            $getData = Product::where("id", $id)->first();
            if ($getData == null) {
                $response = ["message" => "data tidak ada"];
            } else {
                $response = ["message" => "data ada", "data" => $getData];
            }
            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json(["message" => $e->errorInfo]);
        }
    }

    public function update(Request $request, $id)
    {
        $kode_product = $request->kode_product;
        $title = $request->title;
        $quantity = $request->quantity;
        $price = $request->price;

        try {
            $find = Product::where("id", $id)->first();
            $savedData = $find->update([
                'kode_product' => $kode_product,
                'title' => $title,
                'quantity' => $quantity,
                'price' => $price
            ]);
            $response = ["message" => "Data berhasil diupdate", "data" => $savedData];
            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json(["message" => $e->errorInfo]);
        }
    }

    public function destroy($id)
    {
        try {
            $find = Product::where("id", $id)->first();
            $deleteData = $find->delete();
            $response = ["message" => "Data berhasil dihapus", "data" => $deleteData];
            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json(["message" => $e->errorInfo]);
        }
    }
}
