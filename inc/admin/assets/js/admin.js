(function($) {
    "use strict";
    var yhsshu_ajax_url = '', api_url = '', theme_slug = '';
    $(document).ready(function () {
        if( typeof merlin_params !== 'undefined'){
            yhsshu_ajax_url = merlin_params.ajaxurl;
            api_url = merlin_params.api_url;
            theme_slug = merlin_params.theme_slug;
        }
        if(  typeof yhsshu_admin !== 'undefined'){
            yhsshu_ajax_url = yhsshu_admin.ajaxurl;
            api_url = yhsshu_admin.api_url;
            theme_slug = yhsshu_admin.theme_slug;
        }
        initTabs();
        initDemo();
        initPlugin();
    });

    function initTabs(){
        $(document).on('click','.yhsshu-tab-nav > ul > li > a',function(){
            var data_filter = $(this).attr('data-filter');
            $(this).closest('ul').find('a').removeClass('active');
            $(this).addClass('active');
            $(this).closest('.yhsshu-demos').find('.yhsshu-col:not(.'+data_filter+')').css('display','none');
            $(this).closest('.yhsshu-demos').find('.yhsshu-col.'+data_filter).css('display','flex');
        });
    }

    function initDemo(){
        $('.yhsshu-demos').on('click', '.yhsshu-popup-import', function() {
            if ($('.yhsshu-error-message').length) {
                return;
            }
            var id = $(this).data('demo-id');
            var demo_file_url = api_url+'demos/'+theme_slug+'/'+id+'.zip';
            //demo = yhsshu_demos[id];
            $.ajax({
                url: yhsshu_ajax_url,
                type: 'GET',
                data: {
                    action: 'yhsshu_prepare_demo_package',
                    demo: id
                },
                beforeSend: function() {
                    $('.yhsshu-demo-loader').addClass('active');
                }
            }).done(function(resp) {  
                var jsonresp = JSON.parse(resp);  
                if (jsonresp.stat === 1) {
                    $('.yhsshu-demo-loader').removeClass('active');
                    $('.yhsshu-demo-content').addClass('active');
                    initPopUp(id);
                } else {
                    $('.yhsshu-demo-loader').removeClass('active');
                    var $content = 'Your server was unable to connect to theme API server';
                    if( ( jsonresp.stat === 0 ) && ( jsonresp.message != null ) ) {   
                        $content = jsonresp.message;
                    }
                    $('.yhsshu-demo-error-confirm').find('.message').html(yhsshu_esc_js($content));
                    $('.yhsshu-demo-error-confirm').addClass('is-active'); 
                    
                    $('.yhsshu-demo-error-confirm').find('.link-download-demo-manual').html('<a href="'+demo_file_url+'">Click Here</a>');

                    $('.yhsshu-form-upload-demo').on('click', '.btn-upload', function() {
                        var file_data = $('input[name="demo_filename"]').prop('files')[0];   
                        var form_data = new FormData();                  
                        form_data.append('file', file_data);
                        form_data.append('action', 'yhsshu_upload_demo_manual');
                        form_data.append('demo_id', id);
                        $.ajax({
                            url: yhsshu_ajax_url,
                            type: 'post',
                            contentType: false,
                            processData: false,
                            data: form_data, 
                            beforeSend: function() {
                                $('.yhsshu-demo-error-confirm .err').remove();
                                $('.yhsshu-demo-error-confirm .btn-upload').addClass('loading'); 
                            }
                        }).done(function(res) {
                            $('.yhsshu-demo-error-confirm .btn-upload').removeClass('loading'); 
                            if( res == '1'){
                                $('.yhsshu-demo-error-confirm').removeClass('is-active');
                                $('.yhsshu-demo-content').addClass('active');
                                initPopUp(id);
                            }else if(res == '2'){
                                $('.yhsshu-demo-error-confirm').find('.yhsshu-form-upload-demo').append('<p class="err">File upload incorect or not found</p>');
                            }else if(res == '3'){
                                $('.yhsshu-demo-error-confirm').find('.yhsshu-form-upload-demo').append('<p class="err">The setting for upload_max_filesize is smaller than file upload, try change upload max file size in php config from 64MB or greater</p>');
                            }else{
                                $('.yhsshu-demo-error-confirm').find('.yhsshu-form-upload-demo').append('<p class="err">File upload is false!</p>');
                            }
                        });
                    });
                }
            });

            return false;
        });

         
        $(document).on('click','.yhsshu-demo-error-confirm .confirm-footer .btn',function(){
            $(this).closest('.yhsshu-demo-error-confirm').removeClass('is-active');
        })
    }
 
    function initPopUp(demo) {
        $('.yhsshu-demo-content').on('click', '.yhsshu-imp-popup-close', function() {
            $('.yhsshu-demo-content').removeClass('active');
        });

        // Import Now
        $('.yhsshu-demo-content').on('click', '.yhsshu-import-btn', function() {
           
            var options = [];
            $(this).closest('.yhsshu-demo-content').find(' .yhsshu-imp-opt :checked').each(function() {
                options.push($(this).val());
            });

            var crop_img = 'yes';
            var skip_posts = 'yes';
            var crop_img_checked = $(this).closest('.yhsshu-demo-content').find(' .yhsshu-imp-opt-crop :checked').val();
            var skip_posts_existen = $(this).closest('.yhsshu-demo-content').find(' .yhsshu-imp-opt-skip-posts :checked').val();  
            if (typeof crop_img_checked === 'undefined') {
                crop_img = 'no';
            }
            if (typeof skip_posts_existen === 'undefined') {
                skip_posts = 'no';
            }
  
            var importer = new yhsshuImporter(demo, options, crop_img, skip_posts);

        });
    }

    var yhsshuImporter = function(id, options, crop_img, skip_posts) {
        var $this = this;
 
        $this.id = id;
         
        $this.options = options;
        
        $this.crop_img = crop_img;

        $this.skip_posts = skip_posts;

        this.init = function() {
           
            var self = this,
            message,
            actions = this.options.slice();
            $('.yhsshu-demo-content').removeClass('active');
            $('.yhsshu-progress-popup').addClass('active');
          
            var data = new FormData();
 
            data.append('selected', 2);
            data.append('selections', options);
            runImport($this.options, $this.id, $this.crop_img, $this.skip_posts);
            
        };

        this.init();

    };

    function runImport(options, id, crop_img, skip_posts) {

        $.ajax({
            url: yhsshu_ajax_url,
            type: 'POST',
            data: {
                action: 'yhsshu_import_start',
                demo: id,
                skip_posts: skip_posts
            }
        });

        var count = 0;  
        //options = ['import_media', 'import_content', 'import_theme_options', 'import_widgets', 'import_slider', 'import_settings'];
        options[count] && ajaxRun('yhsshu_' + options[options.length - options.length], options, id, count, crop_img, function() {
            count++;  
            options[count] && ajaxRun('yhsshu_' + options[count], options, id, count, crop_img, function() {
                count++;  
                options[count] && ajaxRun('yhsshu_' + options[count], options, id, count, crop_img, function() {
                    count++;
                    options[count] && ajaxRun('yhsshu_' + options[count], options, id, count, crop_img, function() {
                        count++;
                        options[count] && ajaxRun('yhsshu_' + options[count], options, id, count, crop_img, function() {
                            count++;
                            options[count] && ajaxRun('yhsshu_' + options[count], options, id, count, crop_img);
                        });
                    });
                });
            })
        });
    }
    
    function ajaxRun(action, options, demo, idx, crop_img, callback) {
        
        var ajaxupdater, ajaxprogress;

        ajaxupdater = setInterval(function () {
            var width = ((idx + 1) * 100) / options.length;
            width = Math.ceil(width);
            $('.yhsshu-loader').parent().css('width', width + '%');
            $('.yhsshu-loader').html( width + '%');
           
        }, 1000);
        
        $.ajax({
            url: yhsshu_ajax_url,
            type: 'POST',
            data: {
                action: action,
                demo: demo,
                content: ($('#yhsshu-imp-all').is(':checked') ? 1 : 0),
                media: ($('#yhsshu-imp-media').is(':checked') ? 1 : 0)
            },
            beforeSend: function(jq) {
                $.ajax({
                    url: yhsshu_ajax_url,
                    type: 'POST',
                    data: {
                        action: 'yhsshu_reset_logs',
                    },
                });
                ajaxprogress = setInterval(getProgress, 1000);

            },
            complete: function() {
                if (typeof callback === 'function' && !action.match('undefined')) {
                    callback();
                }
                clearInterval(ajaxupdater);
                clearInterval(ajaxprogress);
            },
        }).done(function(res) {
             
            if ('yhsshu_' + options[options.length - 1] === action) {
                clearInterval(ajaxupdater);
                clearInterval(ajaxprogress);
                runImportFinish(options, demo, crop_img);
                $('.yhsshu-loader').parent().css('min-width', '100%');
                $('.yhsshu-loader').text("100%");
                setTimeout(function() {
                    $('.yhsshu-imp-progress').append('<h4>Installed successfully</h4>');
                    setTimeout(function() { 
                        $('.yhsshu-progress-popup').removeClass('active');
                    }, 8000);
                }, 1200);

                if (typeof merlin_params !== 'undefined') {
                    var current_url = window.location.href;
                    current_url = current_url.replace("content", "ready");
                    window.location.href = current_url;
                }

                return false;
            }
        });
    }
    function runImportFinish(options, id, crop_img){
        $.ajax({
            url: yhsshu_ajax_url,
            type: 'POST',
            data: {
                action: 'yhsshu_import_finish',
                demo: id,
                crop_img: crop_img 
            },
            complete: function() {
                if (typeof merlin_params === 'undefined') {
                    reload();
                }
            },
        })

    }
    function getProgress() {
        $.ajax({
            url: yhsshu_ajax_url,
            type: 'GET',
            data: {
                action: 'yhsshu_progress_imported',
            },
        }).done(function(resp) {
            $('.yhsshu-progress').text(resp);
            return false;
        });
        return false;
    }
      
    function reload() {
        setTimeout(function(){ location.reload(); }, 5000);
    }

     
    function yhsshuPluginManager(){
        var complete;
        var items_completed     = 0;
        var current_item        = "";
        var $current_node;
        var current_item_hash   = "";

        function ajax_callback(response){  
            var currentSpan = $current_node.find("h3>span"); 
            var current_btn = $current_node.find(".yhsshu-button"); 
            var new_text = current_btn.attr('data-text-active');
            var new_href = current_btn.attr('data-deactive-url');

            if(typeof response === "object" && typeof response.message !== "undefined"){
                currentSpan.html('Active');
                current_btn.find('span').html(new_text);
                $current_node.removeClass( 'installing success error' ).addClass(response.message.toLowerCase());
                current_btn.attr('href',new_href);

                // The plugin is done (installed, updated and activated).
                if(typeof response.done != "undefined" && response.done){ 
                    $current_node.removeClass('current');
                    find_next();
                }else if(typeof response.url != "undefined"){
                    // we have an ajax url action to perform.
                    if(response.hash == current_item_hash){             
                        $current_node.removeClass( 'installing success' ).addClass("error");
                        current_btn.find('span').html('Error');
                        find_next();
                    }else {
                        current_item_hash = response.hash;
                        jQuery.post(response.url, response, ajax_callback).fail(ajax_callback);
                    }
                }else{
                    // error processing this plugin
                    find_next();
                }
            }else{
                // The TGMPA returns a whole page as response, so check, if this plugin is done.
                process_current();
            }
        }

        function process_current(){ 
            if(current_item){
                $current_node.addClass("current");    
                jQuery.post(yhsshu_ajax_url, {
                    action: "merlin_plugins",
                    wpnonce: yhsshu_admin.wpnonce,
                    slug: current_item,
                }, ajax_callback).fail(ajax_callback);
                
            }
        }

        function find_next(){  
            if($current_node){ 
                if(!$current_node.hasClass("yhsshu-dsb-plugin-active")){
                    items_completed++;
                    $current_node.addClass("yhsshu-dsb-plugin-active");
                }
            }

            var $plus_item = $('.yhsshu-plugin-inst');
            if( $plus_item.length > 0 ){
                $plus_item.each(function(){
                    var $item = $(this).closest('.yhsshu-dsb-plugin');

                    if ( $item.hasClass("yhsshu-dsb-plugin-active") ) {
                        return true;
                    }
                    
                    current_item = $item.data("slug");
                    $current_node = $item;
                    process_current();
                    return false;
                });
            }
            
            if(items_completed >= $plus_item.length){
                // finished all plugins!
                complete();
            }
        }

        return {
            init: function(){
 
                $('.yhsshu-install-all-plugin').addClass("installing");
                $('.yhsshu-dsb-plugin:not(.yhsshu-dsb-plugin-active)').addClass("installing");
                complete = function(){

                    setTimeout(function(){
                        $(".yhsshu-dashboard-wrap").addClass('js-plugin-finished');
                        $('.yhsshu-install-all-plugin').removeClass("installing");
                    },1000);
 
                };
                find_next();
            }
        }
    }

    function initPlugin(){
        $(".yhsshu-install-all-plugin").on( "click", function(e) {
            e.preventDefault();
            var plugins = new yhsshuPluginManager();
            plugins.init();
        });
    }

    function yhsshu_esc_js(str){
        return String(str).replace(/[^\w. ]/gi, function(c){
            return '&#'+c.charCodeAt(0)+';';
        });
    }

})(jQuery);
 

