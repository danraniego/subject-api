<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;

class SubjectsController extends Controller
{
    /**
     * Get All Subjects
     */
    public function getSubjects()
    {
        $subjects = Subject::get();

        $response = [
            'success' => true,
            'subjects' => $subjects
        ];


        return response($response, 200);
    }

    /**
     * Create New Subject
     */
    public function createSubject(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'instructor' => 'required|string',
            'lecture_schedule' => 'required|string',
            'lab_schedule' => 'required|string'
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'error' => $validator->errors()->first()
            ];
    
    
            return response($response, 201);
        }

        $subject = new Subject();

        $subject->name = $request->name;
        $subject->instructor = $request->instructor;
        $subject->lecture_schedule = $request->lecture_schedule;
        $subject->lab_schedule = $request->lab_schedule;

        $subject->save();

        $response = [
            'success' => true
        ];


        return response($response, 201);
    }
}
