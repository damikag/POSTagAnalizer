$(document).ready(function(){

    var startdate_input=$('input[name="start_date"]'); //our date input has the name "date"
    // var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
    var datepickerstart=new Date();
    var selectedStartDate=new Date();
    var selectedEndDate=new Date();
    if($("#start_date_hidden").val()){
        if(datepickerstart > new Date($("#start_date_hidden").val())){
            datepickerstart=new Date($("#start_date_hidden").val());
        }
        selectedStartDate=new Date($("#start_date_hidden").val());
    }

    if($("#end_date_hidden").val()){
        selectedEndDate=new Date($("#end_date_hidden").val());
    }
    var options1={
        // format: 'mm/dd/yyyy',
        format: 'yyyy/mm/dd',
        // container: container,
        todayHighlight: true,
        autoclose: true,
        // startDate: min(new Date(),new Date($("#start_date_hidden").val()))
        // startDate: new Date($("#start_date_hidden").val()),
        startDate: datepickerstart
        // Default: new Date(),
        // Default: '2019/05/22',
        // minDate: $.datepicker.formatDate('mm/dd/yyyy', new Date()),
    };
    startdate_input.datepicker(options1);

    // $("#title").val($("#start_date_hidden").val());

    var enddate_input=$('input[name="end_date"]'); //our date input has the name "date"
    var options2={
        // format: 'mm/dd/yyyy',
        format: 'yyyy/mm/dd',
        // container: container,
        todayHighlight: true,
        autoclose: true,
        startDate: datepickerstart
        // defaultDate: new Date(),
        // minDate: $.datepicker.formatDate('mm/dd/yyyy', new Date()),
    };
    enddate_input.datepicker(options2);


    // var today = new Date().toISOString().slice(0, 10).replace('-','/').replace('-','/');
    //   $("#startdate").attr("value",today);
    $('#start_date').datepicker('update',selectedStartDate);
    $('#end_date').datepicker('update', selectedEndDate);

    // $('#enddate').datepicker('setStartDate',new Date());


})


$(function () {

    $("#start_date").on('changeDate', function (e) {
        $('#end_date').datepicker('setStartDate',e.date);

        if(new Date($('#end_date').val())<e.date){
            // $('enddate').datepicker('setDate',$('#startdate').datepicker('getDate'));
            $('#end_date').datepicker('update', e.date);

        }
    });

});

