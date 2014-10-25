<style>
	label.customerr {

	background-color: white;
    color: #9b0823;
    

}
</style>
<div id="content">
        <div class="outer">
          <div class="inner">
<h2><?php echo $my_form['form_name']?></h2>			
			
			
					<div class="box-content">
						
<form id='target' action="<?php echo site_url('members/submit_form_data/')?>" method="post" enctype="multipart/form-data">
		  <fieldset>
						<?php $ftxt = str_replace('hasDatepicker', ' ', $my_form['form_text']);
						echo $ftxt ?>
						</div>
						<input type='hidden' name='table_name' id='table_name' value='<?php echo $my_form['form_name']?>'/>
						<?php if (isset($my_jqxgrid_id)) { ?>
<input type='hidden' name="<?php echo 'col_'.$my_jqxgrid_id?>" id="<?php echo 'col_'.$my_jqxgrid_id?>"/>
						<?php } ?>
						<div class="form-actions pull-right">
							  <button type="submit" id="sub_btn" class="btn btn-primary">Save changes</button>
							  <button type="reset" class="btn">Cancel</button>
							</div>
							</fieldset>
</form>
<script>
	$(document).ready(function(){
	
	$('.box-icon').hide();
	
	});
	</script>
	
<script> $(document).ready(function(){ 
		$('#target').validate({
		    
		errorClass: 'customerr'
		
	});
	});
	  $("#sub_btn").click(function () {
		        if($("#target").valid()) {


<?php
	
	if (isset($my_jqxgrid_id)) {

	?>
	
	var griddata = $('#<?php echo $my_jqxgrid_id?>').jqxGrid('getdatainformation');
var rows = [];
for (var i = 0; i < griddata.rowscount; i++)
rows.push($('#<?php echo $my_jqxgrid_id?>').jqxGrid('getrenderedrowdata', i));




$('#<?php echo 'col_'.$my_jqxgrid_id?>').val(JSON.stringify(rows));
alert($('#<?php echo 'col_'.$my_jqxgrid_id?>').val());

<?php  }  ?>


$('#target').submit();




	}
        return false;

});
	
	</script>
				<div class="clearfix"></div>
					</div>
				</div>
			</div>
			</div>
				
