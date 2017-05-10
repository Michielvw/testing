var forgotPassword = (function () {
  var elms    = {};
  var $elms   = {};
  var events  = {};
  var ajax    = {};
  var data    = {};



  function init() {
    _registerElements();
    _registerEvents();
  }


  function _registerElements() {
    elms.main     = document.querySelector('.forgot_form');

    //$elms.result  = $('.login-popup');
  }


  function _registerEvents() {
    elms.main.addEventListener('submit', events.onSubmit);
  }


  events.onSubmit = function (e) {
    e.preventDefault();
    data.email   = this.querySelector('[name="email"]').value;

    data.action = forgotPasswordObject.action
    ajax.get();
  };

  ajax.get = function () {
    $.ajax({
      type      : 'POST',
      url       : forgotPasswordObject.url,
      dataType  : 'json',
      data      : data
    }).done(function (response) {
      $('.info-email-forgot').text(response.message);
      $('.info-email-forgot').css("display", "block");

    }).fail(function (jqXHR, textStatus) {
      console.log(textStatus);
    });
  };



  return {
    init: init
  }

})();
