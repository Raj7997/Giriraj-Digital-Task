@extends('layouts.master')
@section('content')
    <div class="container border">
        <center><h1>Dynamic Time Table</h1></center>
        <div id="information_div">
            {!! Form::open(['id' => 'timeTableInformation','enctype' => 'multipart/form-data','class'=> 'pt-3','data-parsley-validate']); !!}
                <div class=" form-group row">
                    <div class="col-6 offset-4">
                        {!! Form::label('no_of_working_days_label','No. of Working Days'); !!}
                        <div class="form group">
                            {!! Form::text('no_of_working_days','',[
                                'id' => 'no_of_working_days',
                                'autocomplete' => 'off',
                                'class' => 'form-control change_control allowDigits',
                                'required' => 'required',
                                'data-parsley-required-message' => 'Please enter No. of Workings Days',
                                'data-parsley-min' => '1',
                                'data-parsley-min-message' => 'No. of Workings Days allow minimum 1',
                                'data-parsley-max' => '7',
                                'data-parsley-max-message' => 'No. of Workings Days allow maximum 7',
                                'data-parsley-errors-container' => '#no_of_working_days_error',
                            ]); !!}
                            <span id="no_of_working_days_error" class="errmsg"></span>
                        </div>
                    </div>
                </div>
                <div class=" form-group row">
                    <div class="col-6 offset-4">
                        {!! Form::label('no_of_subjects_per_day_label','No. of Subjects Per Day'); !!}
                        <div class="form group">
                            {!! Form::text('no_of_subjects_per_day','',[
                                'id' => 'no_of_subjects_per_day',
                                'autocomplete' => 'off',
                                'class' => 'form-control change_control allowDigits',
                                'required' => 'required',
                                'data-parsley-required-message' => 'Please enter No. of Subjects Per Day',
                                'data-parsley-min' => '1',
                                'data-parsley-min-message' => 'No. of Subjects Per Day allow minimum 1',
                                'data-parsley-max' => '9',
                                'data-parsley-max-message' => 'No. of Subjects Per Day allow maximum 9',
                                'data-parsley-errors-container' => '#no_of_subjects_per_day_error',
                            ]); !!}
                            <span id="no_of_subjects_per_day_error" class="errmsg"></span>
                        </div>
                    </div>
                </div>                
                <div class=" form-group row">
                    <div class="col-6 offset-4">
                        {!! Form::label('total_subjects_label','Total Subjects'); !!}
                        <div class="form group">
                            {!! Form::text('total_subjects','',[
                                'id' => 'total_subjects',
                                'autocomplete' => 'off',
                                'class' => 'form-control change_control allowDigits',
                                'required' => 'required',
                                'data-parsley-required-message' => 'Please enter Total Subjects',
                                'data-parsley-errors-container' => '#total_subjects_error',
                            ]); !!}
                            <span id="total_subjects_error" class="errmsg"></span>
                        </div>
                    </div>
                </div>
                <div class=" form-group row">
                    <div class="col-6 offset-4">
                        {!! Form::label('total_hours_for_week_label','Total Hours For Week:'); !!}
                        {!! Form::label('','',['class' => 'total_hours_for_week','id' => 'total_hours_for_week']); !!}
                        {!! Form::hidden('total_hours_for_week','',['id' => 'total_hours_for_week_hidden']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-6 offset-4">
                        <div class="form group">
                            <button type="button" id="submitTimeTableInfo"  class="mt-3 submitTimeTableInfo" id="">Submit</button>
                        </div>
                    </div>
                </div>
            {!! Form::close(); !!}
        </div>
        <div id="subject_information_div">
            
        </div>
        <div id="timetable_div">
            
        </div>
    </div>
@endsection
@section('pagejs')
    <script>
        let csrfToken = "{{csrf_token()}}";
        let storeInformation = "{{route('store-information')}}";
        let getInformation = "{{route('get-information')}}";
    </script>
    <script src="{{asset('assets/js/pagejs/timetable.js')}}"></script>
@endsection