<?php

namespace App\Http\Controllers\API;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class CourseController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:teacher', ['only'=> ['store', 'update']]);

        // $this->middleware('auth:client', ['only'=> ['index', 'view']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:courses',
            'price' => 'required|numeric',
        ]);

        $teacher = auth('teacher')->user();

        $course = Course::create($data);

        $teacher->courses()->syncWithoutDetaching($course);
    
        if($course)
        {
            return response()->json([
                'message' => 'Course Created Successfully.'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update($course_id , Request $request)
    {

        $teacher = auth('teacher')->user();

        $course = $teacher->courses()->where('course_id' , $course_id)->first();

        if(! $course)
        {
            return response()->json([
                'message' => 'unauthorized'
            ] , 401);
        }

        $data = $request->validate([
            'name' => 'required|unique:courses',
            'price' => 'required|numeric',
        ]);

        $course = Course::findOrFail($course_id);

        $course->update($data);

        return response()->json([
            'message' => 'Updated Successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //
    }
}
