<?php

namespace App\Http\Controllers\API;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\QuestionOption;
use App\Http\Controllers\Controller;

class QuestionOptionController extends Controller
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

        $questionOption = new QuestionOption($data);

        $question->question_options()->save($questionOption);

        return response()->json([
            'message' => 'Question Option Created Successfully.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\QuestionOption  $questionOption
     * @return \Illuminate\Http\Response
     */
    public function show(QuestionOption $questionOption)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QuestionOption  $questionOption
     * @return \Illuminate\Http\Response
     */
    public function edit(QuestionOption $questionOption)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QuestionOption  $questionOption
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QuestionOption $questionOption)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QuestionOption  $questionOption
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuestionOption $questionOption)
    {
        //
    }
}
