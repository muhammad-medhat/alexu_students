<?php
$data_gt = array(
  'name'    => 'year-r',
  'value'   => 'gt',
  'checked' => FALSE,
  'style'   => 'margin:10px',
);
$data_lt = array(
  'name'    => 'year-r',
  'value'   => 'lt',
  'checked' => false,
  'style'   => 'margin:10px',
);
$data_eq = array(
  'name'    => 'year-r',
  'value'   => 'eq',
  'checked' => true,
  'style'   => 'margin:10px',
);
$radios_arr = array(
  'gt' => array($data_gt, $this->lang->line('after_year')   ), 
  'eq' => array($data_eq, $this->lang->line('at_year')     ),
  'lt' => array($data_lt, $this->lang->line('before_year') )
);
  
  $faculty_field = $this->alumni_model->translate_field('arabic', $this->faculties_table, true); 
  $ad_field = $this->alumni_model->translate_field('arabic', $this->degrees_table, true); 
  ?>

<div id='info'>
    <?php if($num_rows!=0){
      echo $this->lang->line('alumni_result') ." $num_rows";  
    } else {
      echo $this->lang->line('no_result') ;
    }
    ?>
</div>

    <div id='search_box' >
        <h4 style='header'><?=$this->lang->line('search_form')?></h4>
      <?php echo form_open('alumni/search')?>
        <table>
            <tr>
              <td>
                <div class='panel'>
                  <table>
                    <tr>
                      <td class='data'><?= $this->lang->line('alumni_id')?></td>
                      <td><?php echo form_input('alumni_id', $this->input->get('alumni_id'))?></td>
                      <td>&nbsp;</td>
                    </tr>
                  </table>
                </div>
              </td>
            </tr>


<tr>
  <td>
    <div class='panel'>
      <table>
          <tr>
            <td class='data'><?php echo $this->lang->line('name') ?></td>
            <td><input type="text" value='<?php echo $this->input->get("name")?>' name="name" placeholder='<?php echo $this->lang->line('first_letters_from_name') ;?>' /></td>
            <td></td>
          </tr>
    
    
           <tr>
             <td class='data'><?php echo $this->lang->line('graduation_year') ;?></td>
             <td>
               <select name="year">
                 <?php foreach ($years as $y) { 
                    $selected = ($y->graduation_year == $this->input->get('year'))? 'selected': ''; ?>
                   <option value="<?php echo $y->graduation_year?>" <?php echo $selected?> ><?php echo $y->graduation_year?></option>
                 <?php } ?> 
               </select>
              </td>
              <td></td>
             </tr>

             
             <tr>
               <td class='data'><?php echo $this->lang->line('show_results')?></td>
               <td>
                 <?php
               //$selected = ($f->id == $this->input->get('faculties'))? 'selected': '';
           
                  echo "<div class='radios'>";
                    foreach ($radios_arr as $key=>$value) {
                      echo "<div class='radio'>" .form_radio($value[0]). $value[1]."</div>";
                    }
                  echo "</div>";
                 ?>
               </td>
               <td></td>
             </tr>
           
           <tr>
             <td class='data'><?php echo $this->lang->line('graduation_faculty') ;?></td>
             <td>
               <select name="faculties" id="">
                 <option value=''>...</option>
                   <?php foreach ($faculties_list as $f) { 
                     $selected = ($f->id == $this->input->get('faculties'))? 'selected': '';
                     $field = $f->$faculty_field; 
                   ?>
           
                   <option value="<?php echo $f->id?>" <?php echo $selected?>><?php echo $field?></option>
                 <?php } ?>  
               </select>
             </td>
             <td></td>
           </tr>
           
           <tr>
             <td class='data'><?php echo $this->lang->line('scientific_degree') ;?></td>
             <td>
                   <select name="ac_deg" id="">
                    <option>...</option>
                    <?php foreach ($ac_degrees as $ad) { 
                      $selected = ($ad->id == $this->input->get('ac_deg'))? 'selected': '';
                      $field = $ad->$ad_field;
                    ?>
                    <option value="<?php echo $ad->id?>" <?php echo $selected?>><?php echo $field ?></option>
                   <?php } ?>  
                   </select>
              </td>
              <td></td>
            </tr>
            <tr>
             <td colspan='3'>
                <input type="submit" value='<?php echo $this->lang->line('btn_search')?>' class='search_button' />
             </td>
           </tr>
        </table>
      </div>
    </td>
  </tr>
</table>
    
    <?php echo form_close(); ?>
    </div>

