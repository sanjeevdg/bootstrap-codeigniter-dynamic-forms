<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('make_jqxgrid_xhtml')) {

function make_jqxgrid_xhtml($rs, $ngc,$fnm,$width) {

	$CI  = & get_instance();
	if ($ngc==12) $mysa= '12';
                  	else if ($ngc==11) $mysa= '12';
                  	else if ($ngc==10) $mysa= '12';
                  	else if ($ngc==9) $mysa= '12';
                  	else if ($ngc==8) $mysa= '12';
                  	else if ($ngc==7) $mysa= '12';
                  	else if ($ngc==6) $mysa= '12';
                  	else if ($ngc==5) $mysa= '10';
                  	else if ($ngc==4) $mysa= '8';
                  	else if ($ngc==3) $mysa= '6';
                  	else if ($ngc==2) $mysa= '4';
                  	else if ($ngc==1) $mysa= '3';
	
	$outstr = "<div class='col-md-".$mysa."  droppedField ui-draggable draggableField' id='myjqxgrid_".$rs."'>
	<link rel='stylesheet' href='".base_url()."assets/css/jqx.base.css' type='text/css' />
    <script type='text/javascript' src='".base_url()."assets/js/jqxcore.js'></script>
    <script type='text/javascript' src='".base_url()."assets/js/jqxdata.js'></script> 
    <script type='text/javascript' src='".base_url()."assets/js/jqxbuttons.js'></script>
    <script type='text/javascript' src='".base_url()."assets/js/jqxscrollbar.js'></script>
    <script type='text/javascript' src='".base_url()."assets/js/jqxmenu.js'></script>
    <script type='text/javascript' src='".base_url()."assets/js/jqxgrid.js'></script>
    <script type='text/javascript' src='".base_url()."assets/js/jqxgrid.edit.js'></script>  
    <script type='text/javascript' src='".base_url()."assets/js/jqxgrid.selection.js'></script> 
    <script type='text/javascript' src='".base_url()."assets/js/jqxlistbox.js'></script>
    <script type='text/javascript' src='".base_url()."assets/js/jqxdropdownlist.js'></script>
    <script type='text/javascript' src='".base_url()."assets/js/jqxcheckbox.js'></script>
    <script type='text/javascript' src='".base_url()."assets/js/jqxgrid.pager.js'></script>
	<script type='text/javascript' src='".base_url()."assets/js/jqxgrid.sort.js'></script>
	<script type='text/javascript' src='".base_url()."assets/js/jqxcalendar.js'></script>
    <script type='text/javascript' src='".base_url()."assets/js/jqxnumberinput.js'></script>
    <script type='text/javascript' src='".base_url()."assets/js/jqxdatetimeinput.js'></script>
    <script type='text/javascript' src='".base_url()."assets/js/globalize.js'></script>
    <script type='text/javascript' src='".base_url()."assets/js/gettheme.js'></script>
    
    <script type='text/javascript'>
    $('#createform').trigger('click');
        $(document).ready(function () {
            var theme = getDemoTheme();

    var data = [{";
			for ($i=0;$i<$ngc;$i++) {
                $outstr .= $CI->input->post('header_'.$i).": ''";
                if ($i!=($ngc-1)) $outstr .= ",";
                 // ".$.": 352, ".$.": 75.95 ";
			}
              $outstr .= "}];
        
            var source =
            {
                localdata: data,
                datatype: 'json',
                updaterow: function (rowid, rowdata, commit) {
                    commit(true);
                },
                datafields:
                [";
                    for ($i=0;$i<$ngc;$i++) {
                    if (($CI->input->post('field_type_'.$i)=='dropdownlist')|| ($CI->input->post('field_type_'.$i)=='textbox')) {
						
				$outstr .= "{ name: '".$CI->input->post('header_'.$i)."', type: 'string' }";
			}
                 else if (($CI->input->post('field_type_'.$i)=='numberinput')|| ($CI->input->post('field_type_'.$i)=='numberinput_c2')) {
						
				$outstr .= "{ name: '".$CI->input->post('header_'.$i)."', type: 'number' }";
			}
			else if (($CI->input->post('field_type_'.$i)=='datetimeinput')) {
						
				$outstr .= "{ name: '".$CI->input->post('header_'.$i)."', type: 'date' }";
			}
            else if (($CI->input->post('field_type_'.$i)=='checkbox')) {
						
				$outstr .= "{ name: '".$CI->input->post('header_'.$i)."', type: 'bool' }";
			}
			if ($i!=($ngc-1)) $outstr .= ",";
		}
			   $outstr .= "                         
                ]
            };
            
var generaterow = function (i) {
                var row = {};";
                    for ($i=0;$i<$ngc;$i++) {
						
						if (($CI->input->post('field_type_'.$i)=='dropdownlist')|| ($CI->input->post('field_type_'.$i)=='textbox')) {
				$outstr .= "row['".$CI->input->post('header_'.$i)."'] = '';";
					}
				else if (($CI->input->post('field_type_'.$i)=='numberinput')|| ($CI->input->post('field_type_'.$i)=='numberinput_c2')) {
				$outstr .= "row['".$CI->input->post('header_'.$i)."'] = 0;";			
						
					}
            else if (($CI->input->post('field_type_'.$i)=='datetimeinput')) {
				$outstr .= "row['".$CI->input->post('header_'.$i)."'] = '';";			
			}
			    else if (($CI->input->post('field_type_'.$i)=='checkbox')) {
				$outstr .= "row['".$CI->input->post('header_'.$i)."'] = false;";			
			}    
			} 
                $outstr .= "return row;
            }
            
            var dataAdapter = new $.jqx.dataAdapter(source);";
                for ($i=0;$i<$ngc;$i++) {
                if (($CI->input->post('field_type_'.$i)=='dropdownlist')) {
                $outstr .= "	var ddopts = [";
                $x=1;
                $numtoks = count(explode("\n",trim($CI->input->post('select_options_'.$i))));
					foreach (explode("\n",trim($CI->input->post('select_options_'.$i))) as $kk => $vv){
						
				$outstr .= "{ value: '".$vv."', label: '".$vv."' }";
				if ($x!=($numtoks)) $outstr .= ",";
				$x++;
              }
                             
                 $outstr .= "  ];
                 var ddsrc =
            {
                 datatype: 'array',
                 datafields: [
                     { name: 'label', type: 'string' },
                     { name: 'value', type: 'string' }
                 ],
                 localdata: ddopts
            };
            var ddAdapter = new $.jqx.dataAdapter(ddsrc, {
                autoBind: true
            });";
        
	}
			}
            
                  	$outstr .= "
            $('#jqxgrid_".$rs."').jqxGrid(
            {
                source: dataAdapter,
                editable: true,
                sortable: true,
                theme: theme,
                pageable: true,
                pagermode:'default',
                width: ".$width.",
                autoheight: true,
                selectionmode: 'multiplecellsadvanced',
                virtualmode: true,
                rendergridrows: function()
                {
                      return dataAdapter.records;
                },
                columns: [";
                
            
                
                    for ($i=0;$i<$ngc;$i++) {
						if (($CI->input->post('field_type_'.$i)=='textbox')) {
					$outstr .= "{ text: '".$CI->input->post('header_'.$i)."', columntype: 'textbox', datafield: '".$CI->input->post('header_'.$i)."', width: 80 }";
							
                }
                else	if (($CI->input->post('field_type_'.$i)=='dropdownlist')) {
				
        
            $outstr .= "{ text: '".$CI->input->post('header_'.$i)."', datafield: '".$CI->input->post('header_'.$i)."', displayfield: '".$CI->input->post('header_'.$i)."', columntype: 'dropdownlist',width: 175,
                        createeditor: function (row, value, editor) {
                            editor.jqxDropDownList({ source: ddAdapter, displayMember: 'label', valueMember: 'value' });
						}}";
              
        
        
        
                  // $outstr .= "{ text: '".$this->input->post('header_'.$i)."', columntype: 'dropdownlist', datafield: '".$this->input->post('header_'.$i)."', width: 195 }";
                }
                  else	if (($CI->input->post('field_type_'.$i)=='checkbox')) {
                  $outstr .= "{ text: '".$CI->input->post('header_'.$i)."', datafield: '".$CI->input->post('header_'.$i)."', columntype: 'checkbox', width: 67 }";
			  }
			      else	if (($CI->input->post('field_type_'.$i)=='datetimeinput')) {
					  $outstr .= "{ text: '".$CI->input->post('header_'.$i)."', datafield: 'date', columntype: 'datetimeinput', width: 110, align: 'right', cellsalign: 'right', cellsformat: 'd',
                  validation: function (cell, value) {
                          if (value == '')
                             return true;

                          var year = value.getFullYear();
                          if (year >= 2039) {
                              return { result: false, message: 'Date should be before 1/1/2039' };
                          }
                          return true;
                      } }";
			  }
			  
			      else	if (($CI->input->post('field_type_'.$i)=='numberinput')) {
                  
                  $outstr .= "{text: '".$CI->input->post('header_'.$i)."', datafield: '".$CI->input->post('header_'.$i)."', width: 70, align: 'right', cellsalign: 'right', columntype: 'numberinput',
                      validation: function (cell, value) {
                          if (value < 0 || value > 150) {
                              return { result: false, message: 'Quantity should be in the 0-150 interval' };
                          }
                          return true;
                      },
                      createeditor: function (row, cellvalue, editor) {
                          editor.jqxNumberInput({ decimalDigits: 0, digits: 3 });
                      }
                  }";
			  }
                  else	if (($CI->input->post('field_type_'.$i)=='numberinput_c2')) {
					
					$outstr .= "
                  { text: '".$CI->input->post('header_'.$i)."', datafield: '".$CI->input->post('header_'.$i)."', align: 'right', cellsalign: 'right', cellsformat: 'c2', columntype: 'numberinput',
                      validation: function (cell, value) {
                          if (value < 0 || value > 15) {
                              return { result: false, message: 'Price should be in the 0-15 interval' };
                          }
                          return true;
                      },
                      createeditor: function (row, cellvalue, editor) {
                          editor.jqxNumberInput({ digits: 3 });
                      }

                  }";  
				  }
				  if ($i!=($ngc-1)) $outstr .= ",";
			  }
				  $outstr .= "
			  
                ]
            });

$('#addrowbutton_".$rs."').jqxButton({ theme: theme });
            $('#deleterowbutton_".$rs."').jqxButton({ theme: theme });
            
            $('#addrowbutton_".$rs."').on('click', function () {
                var datarow = generaterow();
                var commit = $('#jqxgrid_".$rs."').jqxGrid('addrow', null, datarow);
            });
            
            $('#deleterowbutton_".$rs."').on('click', function () {
                var selectedrowindex = $('#jqxgrid_".$rs."').jqxGrid('getselectedrowindex');
                var rowscount = $('#jqxgrid_".$rs."').jqxGrid('getdatainformation').rowscount;
                if (selectedrowindex >= 0 && selectedrowindex < rowscount) {
                    var id = $('#jqxgrid_".$rs."').jqxGrid('getrowid', selectedrowindex);
                    var commit = $('#jqxgrid_".$rs."').jqxGrid('deleterow', id);
                }
            });
            
            
        });
    </script>





    <div id='jqxWidget_".$rs."'>
           <div class='box-icon' style='float:right;'>
	
	<a id='remove_field_myjqxgrid_".$rs."'><img src='".base_url()."assets/img/cancel-on.png' width='10px' height='10px'/></a>
						</div>
    
        <div id='jqxgrid_".$rs."' class='jqxgrid'></div>
        <div style='margin-left: 10px; float: left;'>
            
                <input id='addrowbutton_".$rs."' type='button' value='Add New Row' />
            
            
            
                <input id='deleterowbutton_".$rs."' type='button' value='Delete Selected Row' />
            
            </div>
        
       </div>";
    
    
    $outstr .= "<script> 
			$('#remove_field_myjqxgrid_".$rs."').click(function (e) {
				e.preventDefault();
				bootbox.confirm('Are you sure?', function(result) {
			if (result) {
				window.location.assign('".site_url('create_form/remove_field/myjqxgrid_'.$rs.'/jq_gd_'.$rs.'/'.$fnm)."');
			}	else { bootbox.hideAll(); return false; }
		});
	});
		 </script></div>";
	
    return $outstr;
	
	
	
	
}
// end function
}
