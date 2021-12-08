<?php

namespace App\Http\Controllers\API;

use App\Models\Question;
use App\Models\ModelAnswer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ModelAnswerController extends Controller
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
    public function store($question_id , Request $request)
    {
        $question = Question::findOrFail($question_id);

        $data = request()->all();

        $modelAnswer = new ModelAnswer($data);

        $question->model_answer()->save($modelAnswer);

        return response()->json([
            'message' => 'Model Answer Created Successfully.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ModelAnswer  $modelAnswer
     * @return \Illuminate\Http\Response
     */
    public function show(ModelAnswer $modelAnswer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ModelAnswer  $modelAnswer
     * @return \Illuminate\Http\Response
     */
    public function edit(ModelAnswer $modelAnswer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ModelAnswer  $modelAnswer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ModelAnswer $modelAnswer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ModelAnswer  $modelAnswer
     * @return \Illuminate\Http\Response
     */
    public function destroy(ModelAnswer $modelAnswer)
    {
        //
    }
}
