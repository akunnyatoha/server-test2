<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerController extends Controller
{
    public function index()
    {
        try {
            $data = Customer::get();
            $response = ["message" => "oke!", "data" => $data];
            // dd($response);
            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json(["message" => $e->errorInfo]);
        }
    }

    public function store(Request $request)
    {
        $nama = $request->nama;
        $no_telepon = $request->no_telepon;
        $email = $request->email;
        $alamat = $request->alamat;

        try {
            $savedData = Customer::create([
                "nama" => $nama,
                "no_telepon" => $no_telepon,
                "email" => $email,
                "alamat" => $alamat,
            ]);
            $response = ["message" => "Data berhasil disimpan", "data" => $savedData];
            return response()->json($response, Response::HTTP_CREATED);
        } catch (QueryException $e) {
            return response()->json(["message" => $e->errorInfo]);
        }
    }

    public function getCustomerById($id)
    {
        try {
            $getData = Customer::where("id", $id)->first();
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
        $nama = $request->nama;
        $no_telepon = $request->no_telepon;
        $email = $request->email;
        $alamat = $request->alamat;

        try {
            $find = Customer::where("id", $id)->first();
            $savedData = $find->update([
                "nama" => $nama,
                "no_telepon" => $no_telepon,
                "email" => $email,
                "alamat" => $alamat,
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
            $find = Customer::where("id", $id)->first();
            $deleteData = $find->delete();
            $response = ["message" => "Data berhasil dihapus", "data" => $deleteData];
            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json(["message" => $e->errorInfo]);
        }
    }
}
