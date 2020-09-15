	function new_approval_setting(){
    "use strict";
      appValidateForm($('#approval-setting-form'),{name:'required', related:'required'});

      $('#approval_setting_modal input[name="name"]').val('');
      $('select[name="related"]').val('').change();
      
      $.post(admin_url + 'warehouse/get_html_approval_setting').done(function(response) {
         response = JSON.parse(response);

          $('.list_approve').html('');
          $('.list_approve').append(response);
          init_selectpicker();

      });

      $('#approval_setting_modal').modal('show');
      $('#approval_setting_modal .add-title').removeClass('hide');
      $('#approval_setting_modal .edit-title').addClass('hide');
   }