<?php

function get_post_values($fields, $post_values) {
	for($i=0; $i<count($fields); $i++) {
		$data[$fields[$i]['name']] = $_POST[$fields[$i]['name']];
	}
	return $data;
}

//display admin control
function display_forms($criteria=array()) {
	$fields = $criteria['fields'];
	$submit = $criteria['submit'];
	
	if($submit['name']=='') $submit['name']='submit';
	if($submit['value']=='') $submit['value']='Save';
	
	echo '<form method="post" id="'.$criteria['form']['name'].'" name="'.$criteria['form']['name'].'">';
	
		for($i=0; $i<count($fields); $i++) {
			
			if($fields[$i]['class']!='') $fields[$i]['class'] = 'class="'.$fields[$i]['class'].'"';
			
			if($fields[$i]['type']=='select') {
				echo '<label>'.$fields[$i]['title'].'</label>';
				echo '<p><select '.$fields[$i]['class'].' name="'.$fields[$i]['name'].'">';
				echo '<option value=""></option>';
				foreach($fields[$i]['select_values'] as $ind=>$value) {
					if($ind==$fields[$i]['value']) echo '<option value="'.$ind.'" selected>'.$value.'</option>';
					else echo '<option value="'.$ind.'">'.$value.'</option>';
				}
				echo '</select></p>';
			}
			elseif($fields[$i]['type']=='checkbox') {
				echo '<label>';
				if($options[$fields[$i]['value']]=='on') $checked='checked';
				else $checked='';
				echo '<input '.$fields[$i]['class'].' type="checkbox" name="'.$fields[$i]['name'].'" '.$checked.' style="margin-bottom:4px;" style="width:100%">';
				echo ' '.$fields[$i]['title'];
				echo '</label>';
			}
			elseif($fields[$i]['type']=='checkboxes') {
				$values = $fields[$i]['values'];
				$selected = $fields[$i]['select_values'];
				echo '<label>'.$fields[$i]['title'].'</label>';
				if(count($values)>0) {
					echo '<p>';
					foreach($values as $ind => $value) {
						if(count($selected)>0) {
							if(in_array($ind, $selected)) $checked='checked';
							else $checked='';
						}
						echo '<label style="margin-right:15px;">';
						echo '<input '.$fields[$i]['class'].' type="checkbox" name="'.$fields[$i]['name'].'[]" value="'.$ind.'" '.$checked.' style="margin-bottom:4px;" style="width:100%">';
						echo ' '.$value;
						echo '</label>';
					}
					echo '</p>';
				}
			}
			elseif($fields[$i]['type']=='textarea') {
				if($fields[$i]['rows']!='') $fields[$i]['rows'] = 'rows="'.$fields[$i]['rows'].'"';
				echo '<label>'.$fields[$i]['title'].'</label>';
				echo '<p><textarea '.$fields[$i]['class'].' name="'.$fields[$i]['name'].'" style="width:100%" '.$fields[$i]['rows'].'>'.$fields[$i]['value'].'</textarea></p>';
			}
			elseif($fields[$i]['type']=='hidden') {
				echo '<input '.$fields[$i]['class'].' type="hidden" id="'.$fields[$i]['name'].'" name="'.$fields[$i]['name'].'" style="width:100%" value="'.$fields[$i]['value'].'"></p>';
			}
			elseif($fields[$i]['type']=='password') {
				echo '<label>'.$fields[$i]['title'].'</label>';
				echo '<p><input '.$fields[$i]['class'].' type="password" id="'.$fields[$i]['name'].'" name="'.$fields[$i]['name'].'" style="width:100%" value="'.$fields[$i]['value'].'" class="form-control"></p>';
			}
			else {
				echo '<label>'.$fields[$i]['title'].'</label>';
				echo '<p><input '.$fields[$i]['class'].' type="text" id="'.$fields[$i]['name'].'" name="'.$fields[$i]['name'].'" style="width:100%" value="'.$fields[$i]['value'].'" class="form-control"></p>';
			}
		}
		
		echo '<p>';
		echo '<input type="submit" class="btn btn-primary" id="'.$submit['name'].'" name="'.$submit['name'].'" value="'.$submit['value'].'">';
		echo '</p>';
	
	echo '</form>';
}

?>