$("#registerForm").on('submit', function(e){
    e.preventDefault();

    $.ajax({
        type: 'POST',
        url: './core/signupController.php',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        success: function(msg){
            if(msg == 'ok'){
                window.location = "core/home.html";
            }else{
                alert('Something went wrong');
            }
        }
    });
});

fetchUser(); 

function fetchUser(){
  let action = "Load";
  $.ajax({
   url : "../core/signupController.php", 
   method:"POST", 
   data:{action:action}, 
   beforeSend: function () {
        $('.loading-overlay').show();
    },
   success:function(data){
        $('#result').html(data);  
   }
  });
}