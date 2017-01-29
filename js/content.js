$(document).ready(function() {

checkme = [ ];

var picvar = '';
var userdata = '';
$('#passport').change(function(event) {
  var picpas = this.files[0];
  picname = picpas.name;
  picsize = picpas.size;
  pictype = picpas.type;

  var acceptedpic = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif']
  if (!$.inArray(pictype, acceptedpic)) {
    var imgwn = 'Only Image format is allowed, Thank You';
    } else {
    var formData = new FormData();
    formData.append('file', $('input[type=file]')[0].files[0]);
    $.ajax({
    url: "/php/imageupload.php", // Url to which the request is send
    type: "POST",             // Type of request to be send, called as method
    data: formData, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
    contentType: false,       // The content type used when sending data to the server.
    cache: false,             // To unable request pages to be cached
    processData:false,        // To send DOMDocument or non processed data file it is set to false
    success: function(data)   // A function to be called if request succeeds
      {
        $('#loading').hide();
        $("#message").html(data);
        picvar = data;
      }
    });
  }
});
      // process the form
      $('form').submit(function(event) {

          // get the form data
          // there are many ways to get this data using jQuery (you can use the class or id also)
          // process the form

          $.ajax({
              type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
              url         : '/php/register.php', // the url where we want to POST
              data        : {
                'passport'        : picvar,
                'yearserved'      : $('input[name=yearserved]').val(),
                'surname'         : $('input[name=surname]').val(),
                'othername'       : $('input[name=othername]').val(),
                'gender'          : $('select[name=gender]').val(),
                'marital'         : $('select[name=marital]').val(),
                'tribe'           : $('input[name=tribe]').val(),
                'stateOrigin'     : $('select[name=stateOrigin]').val(),
                'dateofbirth'     : $('input[name=dateofbirth]').val(),
                'local_govt'      : $('select[name=lga]').val(),
                'phone'           : $('input[name=phone]').val(),
                'phone2'          : $('input[name=phone2]').val(),
                'email'           : $('input[name=email]').val(),
                'country'         : $('select[name=country]').val(),
                'res_address'     : $('textarea[name=res_address]').val(),
                'employment'      : $('select[name=employment]').val(),
                'employer'        : $('input[name=employer]').val(),
                'designation'     : $('input[name=designation]').val(),
                'office_address'  : $('textarea[name=office_address]').val(),
                'locatthem'       : $('input[name=locatthem]').val(),
                'accuracy'        : $('input[name=accuracy]').val(),
                'UserAgent'       : $('input[name=UserAgent]').val()
              }, // our data object
              dataType: 'json'
          }).done(function (data) {
            if (!data.success) {
              if (data.error.length >= 3) {
                $('#theerror').css('border', '2px #8B0000 solid');
                $('#theerror').css('borderRadius', '15px');
                $('#theerror').html('<p>Please Form</p>');
              } else {
                for (var i = 0; i < data.error.length; i++) {
                  $('#theerror').css('border', '2px #8B0000 solid');
                  $('#theerror').css('borderRadius', '15px');
                  $('#theerror').html('<p>'+data.error[i]+'</p>');
                }
              }

            } else {
              $('#theerror').html('<p style="color:green; font-weight:bolder;">'+data.message+'</p>');
              $('#submit').attr('disabled', '');
              $('#submit').val('Successful...');
              userdata = data.user;
              setTimeout(function() {
                window.location.href = 'confirmed.html?p='+userdata+' ';
              }, 3000);

            }
          });
          // stop the form from submitting the normal way and refreshing the page
          event.preventDefault();
      });

      // to get file location of confirmed

      // this is to check for user confirmed registered
      if(window.location.href.indexOf("confirmed") > -1) {
        function getQueryVariable(variable)
        {
               var query = window.location.search.substring(1);
               var vars = query.split("&");
               for (var i=0;i<vars.length;i++) {
                       var pair = vars[i].split("=");
                       if(pair[0] == variable){return pair[1];}
               }
               return(false);
        }
        var pickit = getQueryVariable("p");
        if (pickit == '') {
          window.location.href = 'index.html';
        }
        $.ajax({
          url: '/php/getit.php',
          type: 'POST',
          dataType: 'json',
          data: {'user_auth': pickit}
        })
        .done(function(data) {
          if (data.success !== true) {
            $('#usernames').html('Please that user does not exit <a href="register.html">Click Here to register</a>');
          }
            $('#usernames').html(data.userdatas.surname + ', ' + data.userdatas.othername);
            $('#userstate').html(data.userdatas.local_govt + ', ' + data.userdatas.stateOrigin + ' State');
            $('#userimage').attr('src', 'upload/'+ data.userdatas.picture);
        });
      }
    // checking if phone f already exist
    var x_timer;
       $("#phone").change(function (e){
           clearTimeout(x_timer);
           var phone = $(this).val();
           x_timer = setTimeout(function(){
               check_username_ajax(phone);
           }, 1000);
       });


   function check_username_ajax(pnum){
       $("#user-result").html('<img src="img/45.gif" width="20px" height="20px" />');
       if ($.isNumeric(pnum)) {
       $.ajax({
         url: 'php/checking.php',
         type: 'POST',
         dataType: 'json',
         data: {'phone': pnum}
       })
       .done(function(data) {
          $("#user-result").html(data.message);
          if (data.success == true) {
            setTheBT('withme');
          }
       });

      } else {
        $("#user-result").html("<em style='color: red; font-weight:bold;'>Use Numbers Please</em>");
      }

   }

// checking if phone f already exist
       $("#phone2").change(function (e){
           clearTimeout(x_timer);
           var phone = $(this).val();
           x_timer = setTimeout(function(){
               check_username_ajax2(phone);
           }, 1000);
       });

   function check_username_ajax2(pnums){
       $("#user-result2").html('<img src="img/45.gif" width="20px" height="20px" />');
       if ($.isNumeric(pnums)) {
       $.ajax({
         url: 'php/checking2.php',
         type: 'POST',
         dataType: 'json',
         data: {'phone2': pnums}
       })
       .done(function(data) {
          $("#user-result2").html(data.message);
          if (data.success == true) {
            setTheBT('NiceMe');
          }
       });

     } else {
       $("#user-result2").html("<em style='color: red; font-weight:bold;'>Use Numbers Please</em>");
     }

   }

// checking if email f already exist
       $("#email").change(function (e){
           clearTimeout(x_timer);
           var phone = $(this).val();
           x_timer = setTimeout(function(){
               check_username_email(phone);
           }, 1000);
       });

   function check_username_email(pnum){
       $("#user-email").html('<img src="img/45.gif" width="20px" height="20px" />');
      $.ajax({
        url: 'php/emailcheck.php',
        type: 'POST',
        dataType: 'json',
        data: {'email': pnum}
      })
      .done(function(data) {
         $("#user-email").html(data.message);
         if (data.success == true) {
           setTheBT('NewWorld');
         }
      });

   }


   function setTheBT(action) {
     if (action) {
       checkme.push(action);

     }
     checkme = $.unique(checkme);
     if (checkme.length >= 1 && $.inArray('withme', checkme) !== -1) {
       $('#submit').removeAttr('disabled');
     }

   }

  //  the logo hieght edit

  var theHeight = $('.about figure').width();
  var newHeight =  theHeight + 'px';
  $('.about figure').height(newHeight);
  //// This is to work with the toggling of menu in mobile

  $("#MoNav").on("click", function() {
      if ($("nav ul").css("display") == "block") {
          //$("menu ul").css("display", "none");
          $("nav ul").slideUp("very-slow");

        } else {
          //$("menu ul").css("display", "block");
          $("nav ul").slideDown("very-slow");
      }
  });

  $('nav ul li').on('click', function() {
    var docWidth = $(window).width();
    if($('nav ul').css('display') == 'block' && docWidth <= '900') {
      $('nav ul').slideUp('slow');
    }
    /* Act on the event */
  });

  $('body').click(function(event) {
    if(!$(event.target).is('nav ul')) {
      $('nav.ul').slideUp('slow');
    }
  });

  $('#infos').on('click', function() {
    $('#datepicker').val('Prefer Not To Mention')
  });

});
