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
      $lang = $this->session->userdata('site_lang');
      $lang = $this->config->item('language');

//$this->load->view('helpers/alumni_search_view');
?>

    <table class="sortable" border='1' style='text-align:center;font-weight:bold' >
      <thead>
       <tr>
          <td><?= $this->lang->line('name')?></td>
          <td><?= $this->lang->line('level')?></td>
          <td><?= $this->lang->line('faculty')?></td>
       </tr>
      <thead>
        
       <tbody>
        <?php $i = 0?>
        <?php foreach ($students as $student) { ?>
          <?php $class = ($i%2 == 0)?'even':'odd'?>
        <tr class="<?= $class ?>">
            <td>
              <a href='<?php echo site_url("alumni/show_alumni/")?>'>
                  <?php  echo $student->name ?>
              </a>
            </td>
            <td>
             </td>
            <td><?php echo $student->faculty ?></td>
            <td><?php echo $student->level_id ?></td>
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
