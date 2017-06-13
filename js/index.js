//Nodrošina ievades lauku izskata funkcionālo daļu
$('.field-wrap').find('input, textarea').on('mousedown keyup blur focus', function (e) {
  
  var $this = $(this),
      label = $this.prev('label');

	  if (e.type === 'mousedown') {
			if ($this.val() !== '') {
          label.addClass('active highlight');
        } else {
          label.addClass('active highlight');
        }
      } else if (e.type === 'keyup') {
      if( $this.val() === '' ) {
        label.addClass('active highlight'); 
      } else {
        label.addClass('active highlight');   
      } 
    } else if (e.type === 'blur') {
    	if( $this.val() === '' ) {
    		label.removeClass('active highlight'); 
			} else {
		    label.removeClass('highlight');   
			}   
    } else if (e.type === 'focus') {
      
      if( $this.val() === '' ) {
    		label.removeClass('highlight'); 
			} 
      else if( $this.val() !== '' ) {
		    label.addClass('highlight');
			}
    }

});

//Nodrošina pārvietošanos pa tab menu joslu
$('.tab a').on('click', function (e) {
  
  e.preventDefault();
  
  $(this).parent().addClass('active');
  $(this).parent().siblings().removeClass('active');
  
  target = $(this).attr('href');

  $('.tab-content > div').not(target).hide();
  
  $(target).fadeIn(600);
  
});

//Nodrošina profila bildes nomaiņu uz klikšķa
$("#filee").on("change", function() {
    $("#submitt").click();
    $("#formaa").submit();
});

//Nodrošina tikai ciparu un + ievadi
function validate(evt) {
  var theEvent = evt || window.event;
  var key = theEvent.keyCode || theEvent.which;
  key = String.fromCharCode( key );
  var regex = /[0-9]|\+/;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}

//Nodrošina ciparu un . ievadi
function validate_cena(evt) {
  var theEvent = evt || window.event;
  var key = theEvent.keyCode || theEvent.which;
  key = String.fromCharCode( key );
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}

//Ielādē konkrēto sludinājumu
$(document).ready(function(){
  $("#sludinajumi-cover").load("sludinajumi.php");
  //$("#sludinajumi-cover").load("mekletie-sludinajumi.php");
  $("#mani-sludinajumi-cover").load("mani-sludinajumi.php");

$("search").click(function() {

  $("#mekletie-sludinajumi-cover").load("mekletie-sludinajumi.php");
  //return false;

  //document.getElementById('mekletie-sludinajumi-cover').style.display = "block";
  //document.getElementById('sludinajumi-cover').style.display = "none";

});
});



$(".sludinajuma-info").click(function() {
  window.location = $(this).find("a").attr("href"); 
  //return false;
});

$(document).ready(function() {

    $('input.city').typeahead({
        name: 'city',
        remote: 'city.php?query=%QUERY'
    });
});

