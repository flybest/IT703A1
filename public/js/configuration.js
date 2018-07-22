$(document).ready(function () {
    if($("#open_hour_start").length>0){
        $("#open_hour_start").timepicker({
            showMeridian:false
        });
    }
    if($("#open_hour_end").length>0) {
        $("#open_hour_end").timepicker({
            showMeridian: false
        });
    }
    if($('#date_range').length>0){
        $('#date_range').daterangepicker({
            autoUpdateInput: false,
            maxSpan: {
                "days": 50
            },
            opens:'center',
            locale:{
                format:'YYYY-MM-DD',
                cancelLabel: 'Clear'
            }
        });

        $('input[name="date_range"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
        });
        $('input[name="date_range"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
    }
});