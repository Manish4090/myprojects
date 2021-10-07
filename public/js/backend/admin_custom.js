$('#billingadd').click(function(){
var checked = $('#billingadd').is(':checked'); 
	if (checked == true){
		$('#billingadd').val('1');
	}else {
		$('#billingadd').val('0');
	}
})

//hide messages
$('.alert').delay(5000).fadeOut('slow');

$( function(){
	  $( "#datepicker" ).datepicker();
  });
  $( function(){
	  $( "#datepicker1" ).datepicker();
  });


// Generate a password string
function randString(id){
  var dataSet = $(id).attr('data-character-set').split(',');  
  var possible = '';
  if($.inArray('a-z', dataSet) >= 0){
    possible += 'abcdefghijklmnopqrstuvwxyz';
  }
  if($.inArray('A-Z', dataSet) >= 0){
    possible += 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  }
  if($.inArray('0-9', dataSet) >= 0){
    possible += '0123456789';
  }
  if($.inArray('#', dataSet) >= 0){
    possible += '![]{}()%&*$#^<>~@|';
  }
  var text = '';
  for(var i=0; i < $(id).attr('data-size'); i++) {
    text += possible.charAt(Math.floor(Math.random() * possible.length));
  }
  return text;
}
// Create a new password
$(".getNewPass").click(function(){
  var field = $(this).closest('div').find('input[rel="gp"]');
  field.val(randString(field));
});

// Auto Select Pass On Focus
$('input[rel="gp"]').on("click", function () {
   $(this).select();
});

// delete customer

       
