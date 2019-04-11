jQuery(document).ready(function() {
    "use strict";
    var $ = jQuery;

    // Disable Empty Links
    $("[href=#]").click(function(event){
        event.preventDefault();
    });

    // Remove outline in IE
    jQuery("a, input, textarea").attr("hideFocus", "true").css("outline", "none");
});


/**
 * Forms
 */
jQuery(function($) {
    "use strict";
    var formErrorMessageClass = 'form-error',
        formErrorHideEventNamespace = '.form-error-hide',
        errorTemplate = '<p class="'+ formErrorMessageClass +'" style="color: red;">{message}</p>'; // todo: customize this (add class="" instead of style="")

    function showFormError($form, inputName, message) {
        var inputSelector = '[name="'+ inputName +'"]',
            $input = $form.find(inputSelector).last(),
            $message = $(errorTemplate.replace('{message}', message));

        if ($input.length) {
            $input.parent().after($message);

            $form.one('focusout'+ formErrorHideEventNamespace, inputSelector, function(){
                $message.slideUp(function(){ $(this).remove(); });
            });
        } else {
            // if input not found, show message in form
            $form.prepend($message);
        }
    }

    function themeGenerateFlashMessagesHtml(types) {
        var html = [], typeHtml = [];

        $.each(types, function(type, messages){
            typeHtml = [];

            $.each(messages, function(messageId, messageData){
                /*typeHtml.push(messageData.message);*/
                typeHtml.push(messageData);
            });

            if (typeHtml.length) {
                html.push(
                    '<ul class="flash-messages-'+ type +'">'+
                    '    <li>'+ typeHtml.join('</li><li>') +'</li>'+
                    '</ul>'
                );
            }
        });

        if (html.length) {
            return html.join('');
        } else {
            return '<p>Success</p>';
        }
    }

    /**
     * Display FW_Form errors
     */
    do {
        if (typeof _fw_form_invalid == 'undefined') {
            break;
        }

        var $form = $('form.fw_form_'+ _fw_form_invalid.id).first();

        if (!$form.length) {
            console.error('Form not found on the page');
            break;
        }

        $.each(_fw_form_invalid.errors, function(inputName, message){
            showFormError($form, inputName, message);
        });
    } while(false);

    /**
     * Ajax submit
     */
    {
        $(document.body).on('submit', 'form[data-fw-ext-forms-type="contact-forms"]', function(e){
            e.preventDefault();

            var $form = $(this);

            // todo: show loading

            jQuery.ajax({
                type: "POST",
                url: FwPhpVars.ajax_url,
                data: $(this).serialize(),
                dataType: 'json'
            }).done(function(r){
                if (r.success) {
                    // prevent multiple submit
                    $form.on('submit', function(e){ e.preventDefault(); e.stopPropagation(); });

                    $form.html(
                        themeGenerateFlashMessagesHtml(r.data.flash_messages)
                    );
                } else {
                    // hide all current error messages
                    $form.off(formErrorHideEventNamespace)
                        .find('.'+ formErrorMessageClass).remove();

                    // add new error messages
                    $.each(r.data.errors, function(inputName, message) {
                        showFormError($form, inputName, message);
                    });
                }
            }).fail(function(){
                // todo: show server error
            });
        });
    }
});