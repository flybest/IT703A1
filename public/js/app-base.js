var App=function(){
    return {

        blockUI: function(options) {
            options = $.extend(true, {}, options);
            var html = '';
            if (options.animate) {
                html = '<div class="loading-message ' + (options.boxed ? 'loading-message-boxed' : '') + '">' + '<div class="block-spinner-bar"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>' + '</div>';
            } else if (options.iconOnly) {
                html = '<div class="loading-message ' + (options.boxed ? 'loading-message-boxed' : '') + '"><img src="' + this.getGlobalImgPath() + 'loading-spinner-grey.gif" align=""></div>';
            } else if (options.textOnly) {
                html = '<div class="loading-message ' + (options.boxed ? 'loading-message-boxed' : '') + '"><span>&nbsp;&nbsp;' + (options.message ? options.message : 'LOADING...') + '</span></div>';
            } else {
                html = '<div class="loading-message ' + (options.boxed ? 'loading-message-boxed' : '') + '"><img src="' + this.getGlobalImgPath() + 'loading-spinner-grey.gif" align=""><span>&nbsp;&nbsp;' + (options.message ? options.message : 'LOADING...') + '</span></div>';
            }

            if (options.target) { // element blocking
                var el = $(options.target);
                if (el.height() <= ($(window).height())) {
                    options.cenrerY = true;
                }
                el.block({
                    message: html,
                    baseZ: options.zIndex ? options.zIndex : 1000,
                    centerY: options.cenrerY !== undefined ? options.cenrerY : false,
                    css: {
                        top: '10%',
                        border: '0',
                        padding: '0',
                        backgroundColor: 'none'
                    },
                    overlayCSS: {
                        backgroundColor: options.overlayColor ? options.overlayColor : '#555',
                        opacity: options.boxed ? 0.05 : 0.1,
                        cursor: 'wait'
                    }
                });
            } else { // page blocking
                $.blockUI({
                    message: html,
                    baseZ: options.zIndex ? options.zIndex : 1000,
                    css: {
                        border: '0',
                        padding: '0',
                        backgroundColor: 'none'
                    },
                    overlayCSS: {
                        backgroundColor: options.overlayColor ? options.overlayColor : '#555',
                        opacity: options.boxed ? 0.05 : 0.1,
                        cursor: 'wait'
                    }
                });
            }
        },

        // wrApper function to  un-block element(finish loading)
        unblockUI: function(target) {
            if (target) {
                $(target).unblock({
                    onUnblock: function() {
                        $(target).css('position', '');
                        $(target).css('zoom', '');
                    }
                });
            } else {
                $.unblockUI();
            }
        },

        scrollTo: function(el, offeset) {
            var pos = (el && el.length > 0) ? el.offset().top : 0;

            if (el) {
                if ($('body').hasClass('page-header-fixed')) {
                    pos = pos - $('.page-header').height();
                } else if ($('body').hasClass('page-header-top-fixed')) {
                    pos = pos - $('.page-header-top').height();
                } else if ($('body').hasClass('page-header-menu-fixed')) {
                    pos = pos - $('.page-header-menu').height();
                }
                pos = pos + (offeset ? offeset : 0);
            }

            $('html,body').animate({
                scrollTop: pos
            }, 'slow');
        },

        webQuery: function(func_url, params, onSuccess, onError, retryTimes){
            var onSuccess = arguments[2]?arguments[2]:function(){};
            var onError = arguments[3]?arguments[3]:function(){};
            var retryTimes = arguments[4]?arguments[4]:3;
            var request= $.ajax(func_url, {
                data:params,
                dataType:'json',
                type:'post',
                timeout:600000,
                success:function(data){
                    if(data.err === 'ok'){
                        onSuccess(data);
                    }
                    else{
                        onError(data.code);
                    }
                },
                error:function(xhr,type,errorThrown){
                    retryTimes--;
                    if(retryTimes > 0) return App.webQuery(func_url, params, onSuccess, onError, retryTimes);
                    if(!xhr.responseJSON){
                        onError('');
                    }else{
                        onError(xhr.responseJSON.message);
                    }

                }
            });
            return request;
        },

        alertInfo: function(target, message){
            $(target).html(message);
            if(message=='')
                $(target).addClass('hidden');
            else
                $(target).removeClass('hidden');
        },

        convertToMeridian: function(time){
            var sections=time.split(':');
            var meridian='';
            var suffix='';
            if(sections.length>=0){

                var hour = Number(sections[0]);
                if(hour<12){
                    suffix=' AM';
                }
                else{
                    hour-=12;
                    suffix=' PM';
                }
                meridian+=hour;

                if(sections.length>=2)
                    meridian+=':'+sections[1];
                else
                    meridian+=':00';

                meridian+=suffix;
                return meridian;
            }
            return time;
        }
    }
}();


