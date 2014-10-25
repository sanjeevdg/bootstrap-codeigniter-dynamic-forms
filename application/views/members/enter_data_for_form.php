<style>
	label.customerr {

	background-color: white;
    color: #9b0823;
    

}
</style>
<div id="content">
        <div class="outer">
          <div class="inner">
<h2><?php echo $my_form->form_name?></h2>			
			
			
					<div class="box-content">
						<?php // echo site_url('members/submit_form_data/')?>
<form id='target' action="" method="post" enctype="multipart/form-data">
		  <fieldset>
						<?php $ftxt = str_replace('hasDatepicker', ' ', $my_form->form_text);
						echo $ftxt ?>
						</div>
						<input type='hidden' name='table_name' id='table_name' value='<?php echo $my_form->form_name?>'/>
<?php
$fields = $this->db->list_fields('dtbl_'.$my_form->form_name);
foreach ($fields as $f => $fd) {
	$posh = strpos($fd,"jq_gd_");
	if ($posh !== false) {
echo "<input type='hidden' name='".$fd."' id='input_".$fd."'/>";
}
}

	?>
						
						<div class="form-actions">
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
$fields = $this->db->list_fields('dtbl_'.$my_form->form_name);
foreach ($fields as $f => $fd) { 
	$posh = strpos($fd,"jq_gd_");
	if ($posh !== false) {
		 $tid = str_replace('jq_gd_','jqxgrid_',$fd);
	?>
	var griddata = $('#<?php echo $tid?>').jqxGrid('getdatainformation');
var rows = [];
for (var i = 0; i < griddata.rowscount; i++)
rows.push($('#<?php echo $tid?>').jqxGrid('getrenderedrowdata', i));



// alert(JSON.stringify(c));
$('#input_<?php echo $fd?>').val(JSON.stringify(rows));

//alert($('#input_<?=$fd?>').val());
<?php  } } ?>


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
