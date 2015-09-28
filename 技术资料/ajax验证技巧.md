#Ajax验证技巧
 
 http://www.yiiframework.com/forum/index.php/topic/61412-invoke-client-side-validation-on-link-click/
 
## 1.提交表单 	
 	$("form").on("submit", function(event) {
        event.preventDefault();
        var $form = $(this);
        if ($form.data('yiiActiveForm').validated)
        {
        	//验证通过后，才真正提交
            enviarForm($form, url);

        }
        else {
            //wrong form not submit
        }

    });



## 2.Ajax提交
	function enviarForm($form, url, modal) {
    $.ajax({
        type: 'post',
        url: url,
        data: $form.serialize(),
        success: function(datos) {
            //server validation errors
            if ($(datos).find(".has-error").length)
            {
                //reload form
                modal.find(".modal-body").html(datos);
            }
            else {
                //real success 
                modal.modal('hide');
            }
        },
        error: function(datos) {
            modal.find(".modal-body").html(datos);
        }
    });
	}