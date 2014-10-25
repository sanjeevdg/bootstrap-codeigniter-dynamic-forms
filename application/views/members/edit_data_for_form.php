<style>
	label.customerr {

	background-color: white;
    color: #9b0823;
    

}
</style>
<div id="content">
        <div class="outer">
          <div class="inner">
			
<h2><?php echo $my_form['form_name']?> - edit data</h2>
			
					<div class="box-content">
<form id='target' action="<?php echo site_url('members/edit_form_data')?>" method="post" enctype="multipart/form-data">
		  <fieldset>
						<?php $ftxt = str_replace('hasDatepicker', ' ', $my_form['form_text']);
						echo $ftxt ?>
						</div>
						<input type='hidden' name='table_name' id='table_name' value='<?php echo $my_form['form_name']?>'/>
					<input type='hidden' name='form_id' id='form_id' value='<?php echo $my_form['form_name']?>'/>
					<input type='hidden' name='form_dtbl_id' id='form_dtbl_id' value='<?php echo $form_data['id']?>'/>
<?php
// $fields = $this->db->list_fields('dtbl_'.$my_form['form_name']);
//print_r($form_fields['form_structure']['form_structure']);

foreach ($form_fields['form_structure'] as $f => $fd) {
	// echo $form_fields[$xx];
	$posh = strpos($fd,"col_jqxgrid");
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
<? //print_r($form_data['content']) ?>
<script>
	$(document).ready(function(){

	<?php foreach ($form_fields['form_structure'] as $ff => $ffv) { 
		
		$pos = is_array($form_data['content'][$ffv])?true:false;
		//strpos($form_data['content'][$ffv],"|"); 
	//	print_r($form_data['content'][$ffv]);
		//$pos2 = strpos($form_data['content'][$ffv],"http://"); 
		$pos2=false;
		$pos3 = strpos($ffv,"grid");
		$pos4 = strpos($ffv,"col_jqxgrid");
		
		$pos5 = strpos($ffv,"txa_");
		
		if ($pos4 !== false) {
			$jqxid = substr($ffv,4);
			$jqxdef = $this->forms_model->get_jqxgrid_definition_by_colid($ffv);
			$jqxdef = $jqxdef['source'];
			$gv = $form_data['content'][$ffv];
			print_r($gv);
			 ?>
			 
			 
			 
			 
			 var parent = $("#<?php echo $jqxid?>").parent();
            $("#<?php echo $jqxid?>").jqxGrid('destroy');
            $("<div id='<?php echo $jqxid?>'></div>").appendTo(parent);
			 var data = <?php echo $gv?>;
			 //alert(data);
			 <?php echo $jqxdef?>
			 $("#<?php echo $jqxid?>").jqxGrid('updatebounddata');
                
	<?php	}
		else if ($pos3!==false) {
			$gv = json_decode($form_data['content'][$ffv],TRUE);
			$gv = $gv["data"];
			$gv = json_encode($gv);
			$r=0;
		?>
	
	
<?php		
	}  	else if ($pos !== false) {
		
		$arv = $form_data['content'][$ffv];
		$js_arv = json_encode($arv);	?>
		$(":input[name='<?=$ffv?>[]']").val(<?=$js_arv?>);

	<?php	} else if ($pos2!==false) { 	$nar = explode("_",$ffv);
		
		
		?>
		
	$("#<?php $nar[1]?>").append("<a href='<?php echo $form_data['content'][$ffv]?>'><?php echo $form_data['content'][$ffv]?></a>");	
	
<?php 	} else if ($pos5!==false) { 
		
	
	$vla = implode('\n',explode("\n",$form_data['content'][$ffv]));
	
	?>
		$("textarea[name=<?php echo $ffv?>]").val("<?php echo $vla?>");
		
	<?php
}
	
	else {
				 ?>
		
	$(":input[name='<?php echo $ffv?>']").val(['<?php echo $form_data['content'][$ffv]?>']);

<?php } } ?>
	});
</script>

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
//$fields = $this->db->list_fields('dtbl_'.$my_form->form_name);
foreach ($form_fields['form_structure'] as $f => $fd) { 
	$posh = strpos($fd,"col_jqxgrid");
	if ($posh !== false) {
		$jqxid = substr($fd,4);
	?>
var griddata = $('#<?php echo $jqxid?>').jqxGrid('getdatainformation');
var rows = [];
for (var i = 0; i < griddata.rowscount; i++)
rows.push($('#<?php echo $jqxid?>').jqxGrid('getrenderedrowdata', i));



$('#input_<?php echo $fd?>').val(JSON.stringify(rows));

<?php   } } ?>


$('#target').submit();




	}
        return false;

});

	
	</script>
	<div class="clearfix"></div>
					</div>
				</div>
			</div></div>
