<div id="content">
        <div class="outer">
          <div class="inner">

			<? if ($this->session->flashdata('message')) { 
				
				echo $this->session->flashdata('message');
				
			}
				?>
			

		<h2>Form Data for <?=$form->form_name?></h2>
					<div class="box-content">

					
					
					
					<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								 <? foreach ($form_fields as $f => $ff) { ?>
								  <th><?=$ff?></th>
								<? } ?>
								<th>Actions</th>
								
							  </tr>
						  </thead>   
						  <tbody id='my_tbody'>
							
								<? foreach ($form_data as $fo => $fd) { ?>
							<tr>		
								<?	foreach ($form_fields as $fi => $ffd) {
									
									?>
								
								<td class="center"><?=$fd->$ffd?></td>
								
								<? } ?>

								<td nowrap class='center'><a class="btn btn-success" href="<?=site_url('members/view_form/'.$form->id.'/'.$fd->id)?>"><i class='icon-zoom-in icon-white'></i>View</a>	
<a class="btn btn-info" href="<?=site_url('members/edit_form/'.$form->id.'/'.$fd->id)?>"><i class='icon-edit icon-white'></i>Edit</a>									
<a class='btn btn-danger' href="<?=site_url('members/delete_row/'.$form->id.'/'.$fd->id)?>"><i class='icon-trash icon-white'></i>Delete</a></td>
							</tr>
							<? } ?>
							</tbody>
							
			<tfoot id='paginator'>	<tr><td><?=$page_links?>	</td></tr>		</tfoot>
							
							</table>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			</div>
				
		
		
<script type="text/javascript">

	$(document).ready(function(){
		$("#search").keyup(function(){
	// var str = $(this).serialize();
$.ajax({
type: "POST",
dataType:"json",
url: "<?=site_url('members/show_search_results/'.$this->uri->segment(3))?>",
data: $('#search_form').serialize(),
success: function(msg){
 
 // var oarr = $.parseJSON(msg);
$('#my_tbody').html(msg.html);
$('#paginator').html('<tr><td>'+msg.page_links+'</td></tr>');
return false;

}
}); 
});

});
</script>
