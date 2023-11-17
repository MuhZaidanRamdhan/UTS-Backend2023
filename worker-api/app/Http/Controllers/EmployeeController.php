<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    // menampikan data employee
    public function index()
    {
        // mengambil seluruh data
        $employees = Employee::with("status:id,name_status")->get();

        // mengecek data
        if ($employees->isEmpty()) {

            $data = [
                'message' => 'Data is empty'
            ];

            return response()->json($data, 200);

        } else {

            $data = [
                'message' => 'Get All employees',
                'data' => $employees
            ];

            return response()->json($data, 200);
        }
    }


    public function store(Request $request)
    {
        // validasi data
        $validateData = $request->validate([
            'name' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'required',
            'status' => 'required',
            'hired_on' => 'required'
        ]);


        // membuat data
        $employees = Employee::create($validateData);

        // mengambil data relasi dari tabel status
        $employees->load('status:id,name_status');

        $data = [
            'message' => 'Employees is Created Succesfully',
            'data' => $employees
        ];

        return response()->json($data, 201);
    }


    public function show(Employee $employee, $id)
    {
        // mencari berdasarkan ID
        $employees = Employee::find($id);

        // mengecek jika employees ID tidak ada 
        if (!$employees) {
            $data = [
                'message' => 'Data not found',
            ];

            return response()->json($data, 404);
        }

        // mengambil relasi dari tabel status
        $employees->load('status:id,name_status');

        $data = [
            'message' => 'Get detail Employees',
            'data' => $employees
        ];
        return response()->json($data, 200);
    }


    public function update(Request $request, $id)
    {
        // mencari data sesuai ID
        $employees = Employee::find($id);
        // mengecek apabila employees tidak ada
        if (!$employees) {

            $data = [
                'message' => 'Data not found'
            ];

            return response()->json($data, 404);
        }

        // menangkap inputan yang masuk jika tidak ada data baru maka data lama yang di pakai
        $input = [
            'name' => $request->name ?? $employees->name,
            'gender' => $request->gender ?? $employees->gender,
            'phone' => $request->phone ?? $employees->phone,
            'address' => $request->address ?? $employees->address,
            'email' => $request->email ?? $employees->email,
            'status' => $request->status ?? $employees->status,
            'hired_on' => $request->hired_on ?? $employees->hired_on,
        ];

        // mengupdate data
        $employees->update($input);

        // mengambil relasi di tabel status
        $employees->load('status:id,name_status');

        // message
        $data = [
            'message' => 'Employees updated successfully',
            'data' => $employees
        ];

        return response()->json($data, 200);

    }


    public function destroy($id)
    {
        // mencari data sesuai ID
        $employees = Employee::find($id);

        // mengecek apabila employees tidak ada
        if (!$employees) {

            $data = [
                'message' => 'Data not found'
            ];

            return response()->json($data, 404);
        }

        // mendelete data
        $employees->delete();

        $data = [
            'message' => 'employees deleted succesfully',
            'data' => $employees
        ];
        return response()->json($data, 200);
    }


    public function search(Request $request, $name)
    {
        // mendapatkan data employeee berdasarkan input
        $employees = Employee::where('name', 'like', '%' . $name . '%')->get();

        // mengecek jika yang di search tidak ada di data
        if ($employees->isEmpty()) {
            $data = [
                'message' => 'No employees found with name ' . $name,
            ];
            return response()->json($data, 404);
        }

        $data = [
            'message' => 'Get Search succesfully',
            'data' => $employees
        ];
        return response()->json($data, 200);
    }

    public function active(Request $request)
    {
        // mendapatkan status dengan id 1 = active
        $employees = Employee::where('status', 1)->with('status:id,name_status')->get();

        // Check for empty results
        if ($employees->isEmpty()) {
            $data = [
                'message' => 'No employees found with status active',
            ];
            return response()->json($data, 404);
        }

        // Return the results
        return response()->json($employees, 200);
    }

    public function inactive(request $request)
    {
        // Get the employees
        $employees = Employee::where('status', 2)->with('status:id,name_status')->get();

        // 
        if ($employees->isEmpty()) {
            $data = [
                'message' => 'No employees found with status inactive',
            ];
            return response()->json($data, 404);
        }

        // Return the results
        return response()->json($employees, 200);
    }
    public function terminated(request $request)
    {
        // Get the employees
        $employees = Employee::where('status', 3)->with('status:id,name_status')->get();

        // 
        if ($employees->isEmpty()) {
            $data = [
                'message' => 'No employees found with status terminated',
            ];
            return response()->json($data, 404);
        }

        // Return the results
        return response()->json($employees, 200);
    }
}
