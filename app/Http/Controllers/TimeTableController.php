<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use App\Models\TimeTable;

class TimeTableController extends Controller
{
    public function index(){
        $pageTitle = 'Time Table';
        return view('timetable.timetable',compact('pageTitle'));
    }

    public function store(Request $request){
        $rules = [
            'no_of_working_days' => 'required|numeric|min:1|max:7',
            'no_of_subjects_per_day' => 'required|numeric|min:1|max:9',
            'total_subjects' => 'required',
        ];

        $messages = [
            'no_of_working_days.required' => 'Please enter No. of Workings Days',
            'no_of_working_days.min' => 'No. of Workings Days allow minimum 1',
            'no_of_working_days.max' => 'No. of Workings Days allow maximum 7',
            'no_of_subjects_per_day.required' => 'Please enter No. of Subjects Per Day',
            'no_of_subjects_per_day.min' => 'No. of Subjects Per Day allow minimum 1',
            'no_of_subjects_per_day.max' => 'No. of Subjects Per Day allow maximum 9',
            'total_subjects.required' => 'Please enter Total Subjects',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors(), 'status' => 0], 400);
        } else {
            $timeTable = new TimeTable();
            $timeTable->no_of_working_days = $request->no_of_working_days;
            $timeTable->no_of_subjects_per_day = $request->no_of_subjects_per_day;
            $timeTable->total_subjects = $request->total_subjects;
            $timeTable->total_hours_for_week = $request->total_hours_for_week;
            $store = $timeTable->save();
            if($store){
                return response()->json(['success' => true, 'message' => 'Successfully Inserted']);
            } else {
                return response()->json(['success' => false, 'message' => 'Oops!Something went wrong']);
            }
        }
    }

    public function getLatestInformation(){
        $informationData = TimeTable::getLatestInformation();
        return response()->json(['data' => $informationData]);
    }
}
