<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    // menampilkan data status employees
    public function index()
    {
        // mengambil seluruh data
        $status = Status::all();

        // mengecek data
        if ($status->isEmpty()) {

            $data = [
                'message' => 'Data is empty'
            ];

            return response()->json($data, 200);

        } else {

            $data = [
                'message' => 'Get All Status',
                'data' => $status
            ];

            return response()->json($data, 200);
        }

    }


    public function store(Request $request)
    {
        // validasi data
        $validateData = $request->validate([
            'name_status' => 'required'
        ]);

        // membuat data
        $statuses = Status::create($validateData);

        $data = [
            'message' => 'Status is Created Succesfully',
            'data' => $statuses
        ];

        return response()->json($data, 201);
    }


    public function show($id)
    {
        // mencari berdasarkan ID
        $status = Status::find($id);

        // mengecek jika status ID tidak ada 
        if (!$status) {
            $data = [
                'message' => 'Status not found',
            ];

            return response()->json($data, 404);
        }

        $data = [
            'message' => 'Get detail status',
            'data' => $status,
        ];
        return response()->json($data, 200);
    }


    public function update(Request $request, $id)
    {
        // mencari data sesuai ID
        $status = Status::find($id);

        // mengecek apabila status tidak ada
        if (!$status) {

            $data = [
                'message' => 'Data not found'
            ];

            return response()->json($data, 404);
        }

        // menangkap inputan yang masuk
        $input = [
            'name_status' => $request->name_status ?? $status->name_status,
        ];

        // mengupdate data
        $status->update($input);

        // message
        $data = [
            'message' => 'Status updated successfully',
            'data' => $status
        ];

        return response()->json($data, 200);

    }


    public function destroy(Status $status, $id)
    {
        // mencari data sesuai ID
        $status = Status::find($id);

        // mengecek apabila status tidak ada
        if (!$status) {

            $data = [
                'message' => 'Status not found'
            ];

            return response()->json($data, 404);
        }

        // menghapus data 
        $status->delete();

        $data = [
            'message' => 'Status deleted succesfully',
            'data' => $status
        ];
        return response()->json($data, 200);
    }
}
