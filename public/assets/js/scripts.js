(function (window, undefined) {
  'use strict';

  /*
  NOTE:
  ------
  PLACE HERE YOUR OWN JAVASCRIPT CODE IF NEEDED
  WE WILL RELEASE FUTURE UPDATES SO IN ORDER TO NOT OVERWRITE YOUR JAVASCRIPT CODE PLEASE CONSIDER WRITING YOUR SCRIPT HERE.  */
  $.fn.form_submit = function (options) {
    var settings = $.extend({
      file: false,
      datatable: false,
      url: false,
      method: 'POST',
      form_id: 'form'
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
          $this.html(button_text);
        }
      })
    });
  }


})(window);
// 