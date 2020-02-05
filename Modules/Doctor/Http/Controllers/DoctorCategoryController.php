<?php

namespace Modules\Doctor\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Doctor\Entities\doctor_category;

class DoctorCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        try {
            $doctor_category = doctor_category::paginate(5);
            return response()->json([
                'status' => "Here's your doctor categories",
                'data' => $doctor_category
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
        
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        try {
            $doctor_category = doctor_category::create(['name' => $request->name]);
            return response()->json([
                'status' => 'Category added successfully',
                'data' => $doctor_category
            ],200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'Category failed to be added',
                'data' => $th->getMessage()
            ],400);
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
            $doctor_category = doctor_category::find($id);
            $doctor_category->name = $request->name;
            $doctor_category->save();

            return response()->json([
                'status' => 'Category edited successfully ',
                'data' => $doctor_category
            ],200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'Category failed to be edited',
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
        //
    }
}
