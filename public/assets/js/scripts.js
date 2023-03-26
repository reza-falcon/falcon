(function (window, undefined) {
  'use strict';

  /*
  NOTE:
  ------
  PLACE HERE YOUR OWN JAVASCRIPT CODE IF NEEDED
  WE WILL RELEASE FUTURE UPDATES SO IN ORDER TO NOT OVERWRITE YOUR JAVASCRIPT CODE PLEASE CONSIDER WRITING YOUR SCRIPT HERE.  */
  function notify($status, $meessage, $title) {
    var isRtl = $('html').attr('data-textdirection') === 'rtl';
    toastr[$status]($meessage, $title, {
      closeButton: true,
      tapToDismiss: false,
      progressBar: true,
      hideDuration: 3000,
      rtl: isRtl
    });
  }
  // form submit by ajax
  $.fn.form_submit = function (options) {
    var settings = $.extend({
      file: false,
      datatable: false,
      url: false,
      method: 'POST',
      form_id: 'form',
      title: 'Notification'
    }, options)
    let request_url = '';
    let button_text = 'Submit';
    let $this = this;
    this.on('click', function () {
      button_text = $(this).text();
      let loader_id = $(this).data('loader');
      let loader = $("#" + loader_id).data('loader');
      $(this).html(loader);
      $("#" + settings.form_id).submit();
    })
    $(document).on('submit', "#" + settings.form_id, function (e) {
      let request_url = '';
      if (settings.url == false) {
        request_url = $(this).attr('action');
      } else {
        request_url = settings.url;
      }
      let form_data = new FormData(this);
      e.preventDefault();
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        url: request_url,
        method: settings.method,
        processData: false,
        contentType: false,
        dataType: 'json',
        data: form_data,
        success: function (data) {
          if (data.status) {
            notify('success', data.message, settings.title);
            $("#" + settings.form_id).trigger('reset');
            // check has any datatable
            if (settings.datatable != false) {
              settings.datatable.draw();
            }
          }
          else {
            notify('error', data.message, settings.title);
          }
          $("#" + settings.form_id).z_validation({
            errors: data.errors,
          });
          $this.html(button_text);
        }
      })
    });
  }

  // validation 
  $.fn.z_validation = function (options) {
    var settings = $.extend({
      errors: [],
    }, options);
    let $this = this;
    // all input validation
    let error_element = '<span class="error">This field is required.</span>';
    this.find('input').each(function (index, obj) {
      let field_name = $(obj).attr('name');
      // check has input errors
      if (settings.errors.hasOwnProperty(field_name)) {
        $("input[name='" + field_name + "']").addClass('is-invalid');
        $("input[name='" + field_name + "']").next('.error').remove();
        $("input[name='" + field_name + "']").after('<span class="error invalid-feedback">' + settings.errors[field_name][0] + '</span>');
      } else {
        $("input[name='" + field_name + "']").removeClass('is-invalid');
        $("input[name='" + field_name + "']").closest('.input-wrapper').find('.error').remove();
      }
    })
  }

})(window);
// 