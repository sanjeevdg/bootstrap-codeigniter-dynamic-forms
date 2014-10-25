<div id="content">
        <div class="outer">
          <div class="inner">

			<?php if ($this->session->flashdata('message')) { 
				
				echo $this->session->flashdata('message');
				
			}
				?>
<h2>Form Data for <?php echo $form['form_name']?></h2>			
<div style='float:right;width:330px;'><form id='search_form'><input type='text' name='search' id='search' placeholder='Enter search term'/></form></div>

					<div class="box-content">

					
					
					
					<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								
								  <th>Timestamp</th>
								  <th>Content</th>
								
								<th>Actions</th>
								
							  </tr>
						  </thead>   
						  <tbody id='my_tbody'>
							
								<?php foreach ($form_data as $fo => $fd) { ?>
							<tr>		
								<?php	
									$frd = $this->forms_model->get_form_data_by_id($form['form_name'],$fd);
									
									?>
								
								<td class="center"><?php print_r($frd)?></td>
								
								<?php  ?>

								<td nowrap class='center'>
	<!-- <a class="btn btn-success" href="<?// =site_url('members/view_form/'.$form['form_name'].'/'.$frd['id'])?>"><i class='icon-zoom-in icon-white'></i>View</a>	 -->
<a class="btn btn-info" href="<?php echo site_url('members/edit_form/'.$form['form_name'].'/'.$frd['id'])?>"><i class='icon-edit icon-white'></i>Edit</a>									
<a class='btn btn-danger' href="<?php echo site_url('members/delete_row/'.$form['form_name'].'/'.$frd['id'])?>"><i class='icon-trash icon-white'></i>Delete</a></td>
							</tr>
							<?php } ?>
							</tbody>
							

							
							</table>
					<div class="dataTables_paginate paging_bootstrap">
	<?// =$page_links?>
	</div>

					<div class="clearfix"></div>
					</div>
				</div>
			</div></div>
		
		
<script type="text/javascript">

	$(document).ready(function(){
		$("#search").keyup(function(){
	// var str = $(this).serialize();
$.ajax({
type: "POST",
dataType:"json",
url: "<?php echo site_url('members/show_search_results/'.$this->uri->segment(3))?>",
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
