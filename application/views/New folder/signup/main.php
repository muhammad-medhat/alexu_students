<fieldset>
<legend><?php echo $this->lang->line('academic_info') ;?></legend>
<?php
  $name       = $this->session->userdata('name'); 
  $fid        = $this->session->userdata('faculty'); 
  $gid        = $this->session->userdata('grade_id'); 
  $year       = $this->session->userdata('graduation_year'); 
  $department = $this->session->userdata('department'); 
  $division   = $this->session->userdata('division'); 
  $certificate_type_id = $this->session->userdata('ac_level'); 

//var_dump($this->session->userdata);
/*  $reg = array(
       'name' =>$name, 
       'fid'=>$fid,
       'gid'=>$gid, 
       'year'=>$year,
       'department'=>$department, 
       'div'=>$division, 
       'ac_level'=>$certificate_type_id 
     );
  var_dump($reg)*/;
 $field = $this->alumni_model->translate_field('arabic', $this->faculties_table, true); 

  echo form_input( 'name', set_value('name', $name), 
        'placeholder="' .$this->lang->line('full_name') .'"'
    );
  
  echo "<select name='faculty'>";
  echo "<option value=''>...</option>";
    foreach ($faculties_list as $f) {
      $selected='';
      if($fid == $f->id)
        $selected='selected';
      $name = $f->$field;
      echo "<option value='$f->id' $selected>$name</option>";
    }
  echo "</select>";

  echo form_input('year', set_value('year', $year), 'class="year" maxlength="4" onkeypress="return isNumber(event)" placeholder="'.$this->lang->line('graduation_year').'" style="width:60px"');
    echo "<select name='grade_id'><option value=''>...</option>";
 $grades_field = $this->alumni_model->translate_field('arabic', $this->academic_degrees_table, true); 

  foreach ($grades as $gr) {
    $selected='';
    if($gid==$gr->id)
      $selected='selected';
    $name = $gr->$grades_field;
    echo "<option value='$gr->id' $selected>$name</option>";
  }
    echo "</select>";

  echo form_input('department', set_value('department', $department), 'placeholder="'.$this->lang->line('department').'"');
  echo form_input('division', set_value('division', $division), 'placeholder="'.$this->lang->line('division').'"');
 $certificate_field = $this->alumni_model->translate_field('arabic', $this->academic_degrees_table, true); 

  echo "<select name='ac_level'><option value=''>...</option>";
  $selected='';
    foreach ($ac_degrees as $ac) {
      $selected='';
      if($certificate_type_id == $ac->id){
        $selected='selected';
      }
      $name = $ac->$certificate_field;
      echo "<option value='$ac->id' $selected>$name</option>";
    }
  echo "</select>";
  //var_dump($this->session->userdata('') );

  
    ?>
  </fieldset>
