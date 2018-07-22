$(document).ready(function(){
    if($('#date_range').length>0){
        $('#date_range').daterangepicker({
            autoApply:true,
            maxSpan: {
                "days": 10
            },
            minDate: new Date(),
            opens:'center',
            drops:'up',
            locale:{
                format:'YYYY-MM-DD'
            }
        });
    }

    $("#jump").click(function(){
       App.scrollTo($("#appointment_section"));
    });

    $("#search").click(function(){
        var container=$("#appointment_section");
        var alertContainer=$('.info-message');
        var dataContainer=$('.during');

        dataContainer.html('');
        App.alertInfo(alertContainer,'');
        App.blockUI({
            target: container,
            animate: true
        });
        var params=$("#date_range").val().split(' - ');
        var token=$("input[name=_token]").val();
        App.webQuery('actions/query_appointments',{start:params[0],end:params[1],_token:token},function(msg){
            App.unblockUI(container);

            if(!msg.durings || msg.durings.length==0){
                App.alertInfo(alertContainer,'Sorry, no appointments available during that date range.');
            }else{
                try{
                    $.each(msg.durings, function(){
                        var that=this;
                        var duringBlock=$('<div class="during-block"></div>');
                        duringBlock.append('<div class="during-block-date">'+ that.date +'</div>');
                        var row = $('<div class="row"></div>');
                        $.each(that.times,function(){
                            row.append('<div class="col-lg-3 col-md-4 col-sm-6 col-xs-6"><div class="during-block-time" data-start-time="'+ this.start_time +'" data-end-time="'+ this.end_time +'" data-date="'+that.date+'">'+ App.convertToMeridian(this.start_time) +'</div></div>');
                        });
                        duringBlock.append(row);
                        duringBlock.append('<div class="clearfix"></div>');
                        duringBlock.appendTo(dataContainer);
                    });
                }
                catch(e){
                    App.alertInfo(alertContainer,'Sorry, data format error.');
                }
            }
        },function(err){
            var msg= (err=="")?'Sorry, can\'t acquire data.':err;
            App.alertInfo(alertContainer,msg);
            App.unblockUI(container);
        },1)
    });

    $(document).on('click','.during-block-time', function(){
        $(".during-block-time").removeClass('selected');
        $(this).addClass('selected');

        var startTime = $(this).data('start-time');
        var endTime = $(this).data('end-time');
        var date = $(this).data('date');
        var modal = $('#appointment_model');
        modal.find('#modal_start').text(App.convertToMeridian(startTime));
        modal.find('#modal_end').text(App.convertToMeridian(endTime));
        modal.find('#modal_date').text(date);
        modal.find('#start_time').val(startTime);
        modal.find('#end_time').val(endTime);
        modal.find('#date').val(date);

        $('#appointment_model').modal({
            backdrop:'static'
        });
    });

    $('#submit_appointment').click(function(){
        var form=$('#submit_appointment_form');

        if(form.valid()){
            var alertContainer=$('.info-message');
            var modal = $('#appointment_model');
            App.alertInfo(alertContainer,'');

            App.blockUI({
                target: modal,
                animate: true
            });

            form.ajaxSubmit({
                url: 'actions/submit_appointments',
                type:'post',
                dataType:'json',
                // clearForm:'false',
                // resetForm:'false',
                // cache:'false',
                success:function(msg){
                    App.unblockUI(modal);
                    if(msg.err != 'ok'){
                        App.alertInfo(alertContainer, msg.code);
                    }else{
                        form.clearForm();
                        App.alertInfo(alertContainer,'Your appointment has been successfully submitted.');
                        $('.during').html('');
                    }
                    modal.modal('hide');
                },
                error:function(err){
                    App.unblockUI(modal);
                    App.alertInfo(alertContainer,'Unable to connect to the server.');
                    modal.modal('hide');
                }
            })
        }
    });

    $("#submit_appointment_form").validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block help-block-error', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        highlight: function (element) { // hightlight error inputs
            $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
        },

        unhighlight: function (element) { // revert the change done by hightlight
            $(element).closest('.form-group').removeClass('has-error'); // set error class to the control group
        },
        success: function (label) {
            label.closest('.form-group').removeClass('has-error'); // set success class to the control group
        }
    });
});