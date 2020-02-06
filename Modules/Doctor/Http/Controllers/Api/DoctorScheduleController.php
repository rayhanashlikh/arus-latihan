<?php

namespace Modules\Doctor\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Doctor\Entities\doctor_schedule;

class DoctorScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        try {
            $doctor_schedule = doctor_schedule::join('doctors', 'doctor_schedules.doctor_id', '=', 'doctors.id')
                ->join('users', 'doctors.user_id', '=', 'users.id')
                ->join('doctor_categories', 'doctors.doctor_category_id', '=', 'doctor_categories.id')
                ->select('users.name as doctor_name', 'doctor_categories.name as doctor_category_name', 'day', 'time')
                ->paginate(5);
            return response()->json([
                'status' => "Here's your doctor schedules data",
                'data' => $doctor_schedule
            ],200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'Failed to retrieve doctor schedules data',
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
            $doctor_schedule = doctor_schedule::create([
                'doctor_id' => $request->doctor_id,
                'day' => $request->day,
                'time' => $request->time
            ]);
            return response()->json([
                'status' => 'Doctor schedule successfully added',
                'data' => $doctor_schedule 
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'Doctor schedule failed to be added',
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
            $doctor_schedule = doctor_schedule::find($id);
            $doctor_schedule->doctor_id = $request->doctor_id;
            $doctor_schedule->day = $request->day;
            $doctor_schedule->time = $request->time;
            $doctor_schedule->save();
            return response()->json([
                'status' => 'Doctor Schedule updated successfully',
                'data' => $doctor_schedule
            ],200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'Doctor Schedule failed to be updated',
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
            $doctor_schedule = doctor_schedule::find($id);
            $doctor_schedule->delete();
            $doctor_schedule->save();
            return response()->json([
                'status' => 'Doctor Schedule have been deleted',
                'data' => $doctor_schedule
            ],200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'Doctor Schedule failed to be deleted',
                'data' => $th->getMessage()
            ],400);
        }
    }
}
