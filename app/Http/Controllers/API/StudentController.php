<?php

namespace App\Http\Controllers\API;

use Auth;
use App\Models\Student;
use App\Models\Guardian;
use Tymon\JWTAuth\Manager;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;

class StudentController extends Controller
{
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }

    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth('student')->attempt($credentials)) 
        {
            return response()->json(['error' => "Email or Password doesn't exist"], 401);
        }

        return $this->respondWithToken($token); 
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:students',
            'password'=>'required|min:6'
        ]);

        $student = Student::create($data);

        return $this->login($student);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'student' => auth('student')->user()->name
        ]);
    }

    public function getRequestedGuardians()
    {
        $student = auth('student')->user();

        $requestedGuardians = $student->guardians()->wherePivot('is_verified' , 0)->get();

        return $requestedGuardians;
    }

    public function acceptdGuardian($guardian_id)
    {
        $student = auth('student')->user();

        $guardian = Guardian::findOrFail($guardian_id);

        $student->guardians()->syncWithoutDetaching([$guardian->id => ['is_verified' => 1]]);

        return response()->json([
            'message' => 'Successful Request. Guardian Accepted',
        ], 200);
    }
}
