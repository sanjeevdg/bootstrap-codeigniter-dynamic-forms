if ($this->input->post('field_type_'.$i)=='checkbox' || $this->input->post('field_type_'.$i)=='select') {
						$varr = array();
						foreach (explode("\n",$this->input->post('select_options_'.$i)) as $kk => $vv){
              					$varr[] = $vv;
						}		
				$outstr .=				"{
                  type: 'handsontable',
      handsontable: {
        colHeaders: false,
        data: ".json_encode($varr)."
      } }";
      if ($i!=($ngc-1)) $outstr .= ",";
					}
					else
