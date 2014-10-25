<div id="content">
        <div class="outer">
          <div class="inner">
<? if ($this->session->flashdata('message')) { 
						echo $this->session->flashdata('message');
						 } ?>

            &nbsp;	<h2><i class="icon-info-sign"></i> <?=$my_form['display_name']?> </h2>
						
					
					<div class="box-content">


<?=$my_form['form_text']?>

						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			
							<!-- content ends -->
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		<hr>
		
		<script>
	$(document).ready(function(){
	
	$('.box-icon').hide();
	
	});
	</script>
