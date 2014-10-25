 </div><!-- /#wrap -->
    <div id="footer">
		
		<p>External links to go in here 
		
		
		
      <p>2013 &copy; Metis Admin</p>
    </div>

    	<!-- #helpModal -->
    <div id="helpModal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Modal title</h4>
          </div>
          <div class="modal-body">
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
              in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal --><!-- /#helpModal -->
    
<script type="text/javascript">
	$(document).ready(function(){
$('#help_modal_btn').click ( function() {       
alert('here');
		 $('#helpModal').modal({show:true});	

    });


	});

</script>

    
    
    <!--<script type="text/javascript" src="<?php //echo base_url()?>assets/js/style-switcher.js"></script>-->
    <script src="<?php echo base_url()?>assets/js/main.js"></script>
    <script src="<?=base_url()?>assets/js/bootbox.js"></script> 
    <script>
		$('#close_field_modal').click(function () {
          $('#myModal3').modal('hide');
        });
        $('#close_field_modal2').click(function () {
         
              $('#myModal3').modal('hide');
        }); 
        $("#close_fdback2_modal2").click(function () {
		$('#myModal_fdback2').modal('hide');
	});
        </script>	
        <script>



// run when page is ready
$(document).ready(function(){





 jQuery.validator.addMethod("alphanumeric", function(value, element) {
   return this.optional(element) || /^\w+$/i.test(value);
}, "Letters, numbers, and underscores only please");

jQuery.validator.addMethod("notEqual", function(value, element, param) {
 // return $('#field_namea').val() != $('#field_nameb').val();
 return this.optional(element) || value != $(param).val();
 }, "Field names have to be unique");	

jQuery.validator.addMethod("noSpace", function(value, element) { 
     return value.indexOf(" ") < 0 && value != ""; 
  }, "Space is not allowed here");
});
	</script>
<script>
	$(document).ready(function(){	
		
$('#new_form').validate({
		    
		     errorClass: 'customerr'
	});
	 });
</script>

<script>

	$('#first_form_btn').click ( function() {       
	
        if($("#first_form").valid()) {
        
        $.ajax({
            url     : '<?=site_url('admin/create_field_modal')?>',
            type    : 'POST',
            dataType: 'html',
            data    : $('#first_form').serialize(),
            success : function( data ) {
					$("#tab2").html(data);
            },
            error   : function( xhr, err ) {
                         alert('Error');     
            }
        }); 
           
	}
        return false;
    });



</script>


  




<script type="text/javascript">



	$(document).ready(function() {

	$('#register_form').validate({
	
	errorClass: 'customerr'
	
})

});
</script>

<script type="text/javascript">

	$(document).ready(function(){
		$("#email").blur(function(){
var str = $(this).serialize();
$.ajax({
type: "POST",
url: "<?=site_url('my_users/check_duplicate_email')?>",
data: str,
success: function(msg){
 
$('#emdup').html(msg);
return false;

}
}); 
});

});
</script>
<script type="text/javascript">
	$(document).ready(function(){

	//animating menus on hover
	$('ul.main-menu li:not(.nav-header)').hover(function(){
		$(this).animate({'margin-left':'+=5'},300);
	},
	function(){
		$(this).animate({'margin-left':'-=5'},300);
	});
});
</script>

  </body>
</html>
