var ajaxLogin = (function () {
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
    elms.main     = document.querySelector('.login');
    elms.username = elms.main.querySelector('[name="username"]');
    elms.password = elms.main.querySelector('[name="password"]');
    //$elms.result  = $('.login');
  }


  function _registerEvents() {
    elms.main.addEventListener('submit', events.onSubmit);
  }



  events.onSubmit = function (e) {
    e.preventDefault();
    //data.wpnonce    = this.querySelector('[name="security"]').value;
    data.username   = elms.username.value;
    data.password   = elms.password.value;

    data.action = ajaxLoginObject.action
    ajax.get();
  };

  ajax.get = function () {
    $.ajax({
      type      : 'POST',
      url       : ajaxLoginObject.url,
      dataType  : 'json',
      data      : data
    }).done(function (response) {
      $('.info-login').text(response.message);
      $('.info-login').css("display", "block");
          if (response.loggedin == true){
              $('.info-login').css("color", "#00a0b2");
              setTimeout(function(){
                document.location.href = response.redirecturl;
              }, 2000);
          } else {
              alert(response.message);
              $('.info-login').css("color", "red");
              setTimeout(function(){
                $('.info-login').css("display", "none");
              }, 3000);
          }

    }).fail(function (jqXHR, textStatus) {
      console.log(textStatus);
    });
  };



  return {
    init: init
  }

})();

ajaxLogin.init();
