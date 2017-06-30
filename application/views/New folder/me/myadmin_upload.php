<style type="text/css" media="all">
  input[type=text]{
     width: 74px;
    height: 29px;
    padding: initial;
}
#main{
  margin: 3em 27%;
}
#main tr{
  border:solid 1px;
}

</style>
<table id='main'>
<?php

echo form_open_multipart('my_admin/upload_file');?>

<tr><td><?php echo form_upload('alumni_file');?></td></tr>

<tr><td>سنة التخرج</td><td><input type="text" name="year" placeholder='سنة التخرج' /></td></tr>




<tr><td>الكلبة          </td><td><?php echo form_dropdown('faculty', $faculties);?></td></tr>
<tr><td>الاسم عربي       </td><td><input type="text" name="name_ar_pos"     placeholder='الاسم عربي    '/>    </td></tr>
<tr><td>الاسم انجليزي    </td><td><input type="text" name="name_en_pos"     placeholder='الاسم انجليزي '/>    </td></tr>
<tr><td>التقدير    </td><td><input type="text" name="gid_pos"     placeholder='التقدير'/>    </td></tr>
<tr><td>القسم           </td><td><input type="text" name="department_pos"  placeholder='القسم        '/>    </td></tr>
<tr><td>الشعبة          </td><td><input type="text" name="division_pos"     placeholder='الشعبة       '/>    </td></tr>
<!--<tr><td>نوع الشهادة(بكاليوس, ماجيستير, دكتوراه)</td><td><input type="text" name="cert_type_pos" placeholder='نوع الشهادة' /></td></tr>-->
<tr><td>البريد الالكتروني</td><td><input type="text" name="email_pos"       placeholder='email'/>    </td></tr>
<tr><td>تاريخ الميلاد    </td><td><input type="text" name="bdate_pos"       placeholder='تاريخ الميلاد '/>    </td></tr>
<tr><td>الوظيفة         </td><td><input type="text" name="job_pos"      placeholder='الوظيفة      '/>    </td></tr>
<tr><td>العنوان         </td><td><input type="text" name="address_pos"     placeholder='العنوان      '/>    </td></tr>
<tr><td>المدينة         </td><td><input type="text" name="city_pos"         placeholder='المدينة      '/>    </td></tr>
<tr><td>الدولة          </td><td><input type="text" name="country_pos" placeholder='الدولة       '/>    </td></tr>
<tr><td>تليفون          </td><td><input type="text" name="phone_pos"       placeholder='تليفون       '/>    </td></tr>

<tr><td>موبايل          </td><td><input type="text" name="mobile_pos"       placeholder='موبايل       '/>    </td></tr>
<tr><td>الرقم القومي    </td><td><input type="text" name="nationalnum_pos"       placeholder='الرقم القومي '/>    </td></tr>
<tr><td>مرتبة الشرف</td><td><input type="text" name="honor_pos"       placeholder='سمرتبة الشرف' />    </td></tr>
<tr><td><input type="checkbox" name="insert">تنفيذ</input></td></tr>
<tr><td> <?php echo form_submit('upload', 'OK'); ?>

<?php echo form_close(); ?>
</table>
