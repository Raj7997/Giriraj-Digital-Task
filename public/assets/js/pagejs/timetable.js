$(document).ready(function(){
    $("#information_div").show();
    $('#timeTableInformation').parsley().reset();
    $("#total_hours_for_week").html('');
    $("#total_hours_for_week_hidden").val('');
    $("#subject_information_div").hide();
});

$(document).on('click', '#submitTimeTableInfo', function () {
    var form = $("#timeTableInformation");
    var formData = new FormData($('#timeTableInformation')[0]);
    formData.append('_token', csrfToken);
    form.parsley().validate();
    if (form.parsley().isValid()) {
        $.ajax({
            async: false,
            url: storeInformation,
            dataType: 'json',
            data: formData,
            type: "POST",
            processData: false,
            contentType: false,
            success: function (result) {
                if (result.success == true) {
                    toastr.success('', result.message, {
                        timeOut: 5000,
                        closeButton: false
                    });
                    $("#information_div").hide();
                    $("#subject_information_div").show();
                    $.ajax({
                        url: getInformation,
                        dataType: 'json',
                        type: "GET",
                        success: function (result) {
                            var html = '<div>'+
                                '<form class="pt-3" id="subjectInformation">'+
                                    '<input type="hidden" id="working_days_info" value="'+result.data.no_of_working_days+'">'+
                                    '<input type="hidden" id="subjects_per_day_info" value="'+result.data.no_of_subjects_per_day+'">'+
                                    '<input type="hidden" id="total_subjects_info" value="'+result.data.total_subjects+'">'+
                                    '<input type="hidden" id="total_hours_for_week_info" value="'+result.data.total_hours_for_week+'">'+
                                    '<div id="subject_information"></div>'+
                                    '<div class="form-group row">'+
                                        '<div class="col-6 offset-6">'+
                                            '<div class="form group">'+
                                                '<button type="button" id="submitSubjectInfo" class="mt-3 submitSubjectInfo">Generate</button>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</form>';
                            $("#subject_information_div").append(html);
                            var subjects = '';
                            for(var i=0;i<result.data.total_subjects;i++){
                                subjects += 
                                    '<div class="form-group row">'+
                                        '<div class="col-6">'+
                                            '<div class="form group">'+
                                                '<input type="text" id="subjects_name'+i+'" name="subjects_name[]" class="form-control mb-2" placeholder="Enter Subjects Name" required data-parsley-required-message="Please enter Subject Name" data-parsley-errors-container="#subject_name_error'+i+'">'+
                                                '<span id="subject_name_error'+i+'" class="errmsg"></span>'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="col-6">'+
                                            '<div class="form group">'+
                                                '<input type="text" id="total_hours_of_subject" name="total_hours_of_subject[]" class="form-control allowDigits mb-2" placeholder="Enter Total Hours Of Subjects" required data-parsley-required-message="Please enter Total Hours Of Subjects" data-parsley-errors-container="#total_hours_error'+i+'">'+
                                                '<span id="total_hours_error'+i+'" class="errmsg"></span>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>';
                            }
                            $("#subject_information").append(subjects);
                        }
                    });
                } else {
                    toastr.error('', result.message, {
                        timeOut: 5000,
                        closeButton: false
                    });
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                if (jqXHR.responseJSON.message.no_of_working_days) {
                    $("#no_of_working_days_error").html(jqXHR.responseJSON.message.no_of_working_days[0]);
                } else {
                    $("#no_of_working_days_error").html('');
                }
                if (jqXHR.responseJSON.message.no_of_subjects_per_day) {
                    $("#no_of_subjects_per_day_error").html(jqXHR.responseJSON.message.no_of_subjects_per_day[0]);
                } 
                else {
                    $("#no_of_subjects_per_day_error").html('');
                }
                if (jqXHR.responseJSON.message.total_subjects) {
                    $("#total_subjects_error").html(jqXHR.responseJSON.message.total_subjects[0]);
                } else {
                    $("#total_subjects_error").html('');
                }
            }
        });
    } 
});

$(document).on('change', '#no_of_working_days', function () {
    totalHoursForWeek();
});

$(document).on('change', '#no_of_subjects_per_day', function () {
    totalHoursForWeek();
});

function totalHoursForWeek(){
    var workingDays = $("#no_of_working_days").val();
    var subjectsPerDay = $("#no_of_subjects_per_day").val();
    var totalHours = 0;
    totalHours = (workingDays * subjectsPerDay); 
    $("#total_hours_for_week").html(totalHours);
    $("#total_hours_for_week_hidden").val(totalHours);
}

$(document).on('keypress', '.allowDigits', function (event) {
    return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57));
});

$(document).on('click', '#submitSubjectInfo', function () {
    var form = $("#subjectInformation");
    form.parsley().validate();
    if (form.parsley().isValid()) {
        var noOfWorkingDays = $("#working_days_info").val();
        var subjectsPerDay = $("#subjects_per_day_info").val();
        var tableColumn = '';
        for(var column=0;column<noOfWorkingDays;column++){
            tableColumn += '<td>1</td>';
        }
        var table = '';
        for(var row=0;row<subjectsPerDay;row++){
            table += '<tr>'+tableColumn+'</tr>';     
        }
        var html = '';
        html += '<div>'+
            '<table border="1" width="100%">'+table+
            '</table>'+
        '</div>';
        $("#timetable_div").append(html);
    }
});