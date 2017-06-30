<style type="text/css" >


</style>
<?php
//var_dump($alumni);
//echo $this->db->last_query();
?>

      <table class='single' >
        <tr>
          <td colspan='2'>
          <img src='<?php echo base_url()?>/images/info-m.png'  />
          </td>
        </tr>
        <tr>
        <td class='label'><?= $this->lang->line('alumni_id')?></td>
          <td class='data'><?php echo $alumni->alumni_id?></td>
        </tr>
        <tr>
          <td class='label'> <?= $this->lang->line('alumni_name')?></td>
          <td class='data'><?php echo $alumni->name?></td>
        </tr>

        <tr>
        <td class='label'><?= $this->lang->line('alumni_faculty')?></td>
          <td class='data'><?php echo $alumni->faculty?></td>
        </tr>
        <tr>
        <td class='label'><?= $this->lang->line('alumni_department')?></td>
          <td class='data'><?php echo $alumni->department?></td>
        </tr>
        <tr>
        <td class='label'><?= $this->lang->line('alumni_division')?></td>
           <td class='data'><?php echo $alumni->division?></td>
        </tr>

        <tr>
        <td class='label'><?= $this->lang->line('alumni_ac_degree')?></td>
          <td class='data'><?php echo $alumni->scientific_degree?></td>
        </tr>
        <tr>
        <td class='label'><?= $this->lang->line('alumni_graduation_year')?></td>
          <td class='data'><?php echo $alumni->graduation_year?></td>
        </tr>
        <tr>
        <td class='label'><?= $this->lang->line('alumni_degree')?></td>
           <td class='data'><?php echo $alumni->degree?></td>
        </tr>
<?php
  $loggedin_user_id = $this->session->userdata('user_id');
  $current_user_id = $this->uri->segment(3);
?>
<?php if($loggedin_user_id == $current_user_id) { ?>
        <tr>
          <td colspan='2'>
          <a style='margin-right: 48%' href="<?php echo site_url('alumni/edit')?>"><?= $this->lang->line('edit_data')?></a>
          </td>
        </tr>
<?php } else { ?>
<?php }?>
        <tr>
          <td  colspan='2'>
          <input class='back' type='button' value='<?= $this->lang->line('back'); ?>' onclick='history.go(-1);'/>
          </td>
        </tr>
      </table>
</div>
