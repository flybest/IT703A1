$(document).ready(function(){

    $('[data-hint="tooltip"]').tooltip()

    $(document).on('click','.contact', function(){

        var target=$(this).attr('data-target');

        var container=$(".table");
        var contentContainer = $('#contact-'+ target);
        var alertContainer=$('#contact-'+ target +' .info-message');
        var dataContainer=$('#contact-' + target +' .info-contact');

        dataContainer.html('');
        App.alertInfo(alertContainer,'');
        App.blockUI({
            target: container,
            animate: true
        });

        var token=$("input[name=_token]").val();
        App.webQuery('actions/query_contacts',{id:target,_token:token},function(msg){
            App.unblockUI(container);
            contentContainer.removeClass('hidden');

            if(!msg.contacts || msg.contacts.length == 0){
                App.alertInfo(alertContainer,'Sorry, no contact available.');
            }else{
                try{
                    $.each(msg.contacts, function(){

                        var contactBlock=$('<div class="row"></div>');
                        contactBlock.append('<div class="col-md-4">'+ this.name +'</div>');
                        contactBlock.append('<div class="col-md-4">'+ this.email +'</div>');
                        contactBlock.append('<div class="col-md-4">'+ this.phone_work +'</div>');
                        contactBlock.appendTo(dataContainer);
                    });
                }
                catch(e){
                    App.alertInfo(alertContainer,'Sorry, data format error.');
                }
            }
        },function(err){
            var msg= (err=="")?'Sorry, can\'t acquire data.':err;
            contentContainer.removeClass('hidden');
            App.alertInfo(alertContainer,msg);
            App.unblockUI(container);
        },1)
    });
});