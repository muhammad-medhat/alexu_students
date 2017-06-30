<style type="text/css" >
table{
border-collapse:collapse;
}
table thead tr td{  padding: 8px 45px;}
  table td{
    vertical-align:top;
padding: 2px
  }

.even{background-color: #e6f3f8;}  
.odd{background-color: #e1e1e1;}  

</style>

<div id='all'>
<?php
$this->load->view('helpers/alumni_search_view');
?>

    <table class="sortable" border='1' style='text-align:center;font-weight:bold' >
      <thead>
       <tr>
          <td><?php echo $this->lang->line('name')?></td>
          <td><?php echo $this->lang->line('graduation_year')?></td>
          <td><?php echo $this->lang->line('faculty')?></td>
          <td><?php echo $this->lang->line('scientific_degree')?></td>
       </tr>
      <thead>
        
       <tbody>
        <?php $i = 0?>
        <?php foreach ($alumni_list as $single_alumni) { ?>
          <?php $class = ($i%2 == 0)?'even':'odd'?>
        <tr class="<?php echo $class ?>">
            <td>
              <a href='<?php echo site_url("alumni/show_alumni/$single_alumni->alumni_id")?>'>
                  <?php  echo $single_alumni->name ?>
              </a>
            </td>
            <td>
              <?php  
                if($single_alumni->graduation_year=='')
                  echo $this->lang->line('na');
                else
                  echo "$single_alumni->graduation_year	 ";
                //$_username = $this->alumni_model->get_username($single_discussion->user_id);
               // echo ( $_username);
              ?></td>
            <td><?php echo $single_alumni->faculty ?></td>
            <td><?php echo $single_alumni->scientific_degree ?></td>
          </tr>

        
        <?php $i++; }//end foreach ?>
          <tr>
            <td colspan='4'>
               <?php echo $pagination ;?>
            </td>
          </tr>
      </tbody>
    </table>
</div> <?php //end div class='all'?>
