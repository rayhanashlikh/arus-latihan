<?php

namespace Modules\Doctor\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Doctor\Entities\doctor;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        try {
            $doctor = doctor::join('users', 'doctors.user_id', '=', 'users.id')
                ->join('doctor_categories', 'doctors.doctor_category_id', '=', 'doctor_categories.id')
                ->select('users.name as doctor_name', 'users.email as doctor_email', 'users.nik as doctor_nik', 'users.phone as doctor_phone', 'doctor_categories.name as doctor_category_name')
                ->paginate(5);
            return response()->json([
                'status' => "Here's the data of Doctors",
                'data' => $doctor
            ],200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'Data could not be retrieved',
                'data' => $th->getMessage()
            ],400);
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('doctor::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        try {
            $doctor = doctor::create([
                'user_id' => $request->user_id,
                'doctor_category_id' => $request->doctor_category_id
            ]);
            return response()->json([
                'status' => 'Doctor successfully added',
                'data' => $doctor 
            ],200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'Doctor failed to be added',
                'data' => $th->getMessage()
            ]);
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('doctor::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('doctor::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        try {
            $doctor = doctor::find($id);
            $doctor->user_id = $request->user_id;
            $doctor->doctor_category_id = $request->doctor_category_id;
            $doctor->save();
            return response()->json([
                'status' => 'Doctor successfully updated',
                'data' => $doctor
            ],200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'Doctor failed to be updated',
                'data' => $th->getMessage()
            ],400);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $doctor = doctor::find($id);
            $doctor->save();
            return response()->json([
                'status' => 'Doctor data successfully deleted',
                'data' => $doctor
            ],200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'Doctor data failed to be updated',
                'data' => $th->getMessage()
            ],400);
        }
    }
}
