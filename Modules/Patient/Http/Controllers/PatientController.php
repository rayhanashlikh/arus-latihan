<?php

namespace Modules\Patient\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Patient\Entities\user_family_member;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        try {
            $patient = user_family_member::join('users', 'user_family_members.user_id', '=', 'users.id')
                ->select('users.name as user_name','email','users.nik as user_nik','phone','user_family_members.name as family_name','user_family_members.nik as family_nik','gender','date_of_birth','place_of_birth')
                ->paginate(5);
            // $user = DB::table('users')->pluck('name', 'email', 'nik', 'phone' );
            return response()->json([
                'status' => "Here's your data",
                'patient' => $patient
            ],200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'Failed to retrieve data',
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
        return view('patient::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        try {
            $patient = user_family_member::create([
                'user_id' => $request->user_id,
                'name' => $request->name,
                'nik' => $request->nik,
                'gender' => $request->gender,
                'date_of_birth' => $request->date_of_birth,
                'place_of_birth' => $request->place_of_birth
            ]);
            return response()->json([
                'status' => 'Data successfully added',
                'data' => $patient
            ],200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'Data failed to be added',
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
        return view('patient::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('patient::edit');
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
            $patient = user_family_member::find($id);
            $patient->user_id = $request->user_id;
            $patient->name = $request->name;
            $patient->nik = $request->nik;
            $patient->gender = $request->gender;
            $patient->date_of_birth = $request->date_of_birth;
            $patient->place_of_birth = $request->place_of_birth;
            $patient->save();

            return response()->json([
                'status' => 'Data successfully updated',
                'data' => $patient
            ],200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'Data failed to be updated',
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
            $patient = user_family_member::find($id);
            $patient->delete();
            $patient->save();
            return response()->json([
                'status' => 'Data Successfully Deleted',
                'data' => $patient 
            ],200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'data' => $patient
            ],400);
        }
    }
}
