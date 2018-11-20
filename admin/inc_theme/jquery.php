
   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo ADDRESS ?>js/bootstrap.min.js"></script>
 
    <!-- Go top -->
	<script>
    	$(document).ready(function(){
     
        // hide #back-top first
        $(".go-top").hide();
         
        // fade in #back-top
        $(function () {
            $(window).scroll(function () {
                if ($(this).scrollTop() > 250) {
                    $('.go-top').fadeIn();
                } else {
                    $('.go-top').fadeOut();
                }
         });
     
        // scroll body to 0px on click
		$('.go-top a').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
        });    
    	});
    </script>
    <!-- File input Select-->
    <script>
		$(function() {
  // We can attach the `fileselect` event to all file inputs on the page
	  $(document).on('change', ':file', function() {
		var input = $(this),
			numFiles = input.get(0).files ? input.get(0).files.length : 1,
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [numFiles, label]);
	  });

	  // We can watch for our custom `fileselect` event like this
	  $(document).ready( function() {
		  $(':file').on('fileselect', function(event, numFiles, label) {
			  var input = $(this).parents('.input-group').find(':text'),
				  log = numFiles > 1 ? numFiles + ' files selected' : label;

			  if( input.length ) {
				  input.val(log);
			  } else {
				  if( log ) alert(log);
			  }
		  });
	  });

	});
	</script>
	<!-- Tooltip -->
    <script>
		$(function () {
		  $('[data-toggle="tooltip"]').tooltip()
		})
	</script>