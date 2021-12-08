<?php

namespace App\Http\Controllers\API;

use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionController extends Controller
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
    public function store($quiz_id , Request $request)
    {
        $quiz = Quiz::findOrFail($quiz_id);

        $data = request()->all();

        $data = $request->validate([
            'pounts' => 'required|numeric|gt:0'
        ]);

        $question = Question::create($data);

        $quiz->questions()->save($question);

        $quiz->points += $question->points;

        $quiz->save();

        return response()->json([
            'message' => 'Question Created Successfully.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show($question_id)
    {
        $question = Question::with('question_options')->findOrFail($question_id);

        return $question;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy($question_id)
    {
        $question = Question::findOrFail($question_id);

        $quiz = $question->quiz;

        $quiz->points -= $question->points;

        $quiz->save();

        $question->delete();

        return response()->json([
            'message' => 'Question Deleted Successfully.'
        ]);
    }
}
