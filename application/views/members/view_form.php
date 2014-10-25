<div id="content">
        <div class="outer">
          <div class="inner">

<h2><?=$my_form->form_name?></h2>			
			
					<div class="box-content">

<form id="data_view" name="data_view">
<?=$my_form->form_text?>
</form>
						<div class="clearfix"></div>
					</div>
				</div>
			</div></div>
		

<script>

	 $('#data_view :input').attr('disabled','disabled');
	 $('#data_view input:checkbox').attr('disabled','disabled');
	 $('#data_view input:radio').attr('disabled','disabled');
	 $('#data_view select').attr('disabled','disabled');
	 $('#data_view input:file').attr('disabled','disabled');
	
	
	<? foreach ($form_fields as $ff => $ffv) { ?>	
		//alert('<?=$ffv?>');
		<? $pos = strpos($form_data->$ffv,"|"); 
		$pos2 = strpos($form_data->$ffv,"http://"); 
		$pos3 = strpos($ffv,"grid");
		$pos4 = strpos($ffv,"jq_gd");
		$pos5 = strpos($ffv,"txa_");
		
		if ($pos4 !== false) {
						$jqxid = substr($ffv,6);
			$jqxdef = $this->forms_model->get_jqxgrid_definition_by_colid($ffv);
			$jqxdef = $jqxdef->source;
			$gv = $form_data->$ffv;
			 ?>
			 
			 
			 
			 
			 var parent = $("#jqxgrid_<?=$jqxid?>").parent();
            $("#jqxgrid_<?=$jqxid?>").jqxGrid('destroy');
            $("<div id='jqxgrid_<?=$jqxid?>'></div>").appendTo(parent);
			 var data = <?=$gv?>;
			 <?=$jqxdef?>

		
	<?	}
		else if ($pos3!==false) {
			$gv = json_decode($form_data->$ffv,TRUE);
			$gv = $gv["data"];
			$gv = json_encode($gv);
			$r=0;
		?>
	
   var jsonObj = $.parseJSON('<?=$gv?>');
   for(var key in jsonObj){
	   var inc=0;
    for(var subKey in jsonObj[key]){
		
       var vstr = jsonObj[key][subKey];
       
			if (vstr.indexOf('|')!==-1) {
       var varr = vstr.split("|");
				if ($.isArray(varr)) {
						$(":input[name='"+inc+"_"+subKey+"_"+key+"[]']").val(varr);
				}
		}        else {
			$(":input[name='"+inc+"_"+subKey+"_"+key+"']").val([vstr]);
			}
       
       inc++;
   
       
    }
 }
	
<?		
	}  	else if ($pos !== false) {
		
		$arv = explode('|',$form_data->$ffv);
		$js_arv = json_encode($arv);	?>
		$(":input[name='<?=$ffv?>[]']").val(<?=$js_arv?>);

	<?	} else if ($pos2!==false) { 
			$nar = explode("_",$ffv);
		
		
		?>
		
	$("#<?=$nar[1]?>").html("<a href='<?=$form_data->$ffv?>'><?=$form_data->$ffv?></a>");	
	
<?	} else if ($pos5!==false) { 
		
	
	$vla = implode('\n',explode("\n",$form_data->$ffv));
	
	?>
		$("textarea[name=<?=$ffv?>]").val("<?=$vla?>");
		
	<?
}
	else {
				 ?>
		
	$(":input[name='<?=$ffv?>']").val(["<?=$form_data->$ffv?>"]);

<? } } ?>
 
</script>
<script>
	$(document).ready(function(){
	
	$('.box-icon').hide();
	
	});
	</script>
