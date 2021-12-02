<?php

namespace App\Http\Controllers\API;

use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LessonController extends Controller
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
    public function store($course_id , Request $request)
    {
        $teacher = auth('teacher')->user();

        $course = $teacher->courses()->where('course_id' , $course_id)->first();

        if(! $course)
        {
            return response()->json([
                'message' => 'unauthorized'
            ] , 401);
        }

        $data = request()->all();

        $data = $request->validate([
            'name' => 'required|unique:courses',
        ]);

        $data = array_merge($data , ['course_id' => $course_id]);

        $lesson = $teacher->lessons()->create($data);

        if($lesson)
        {
            return response()->json([
                'message' => 'Lesson Created Successfully.'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function show(Lesson $lesson)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function edit(Lesson $lesson)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lesson $lesson)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lesson $lesson)
    {
        //
    }
}
