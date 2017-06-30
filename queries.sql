select  u.id, u.name, u.email, deg.arabic, ac.arabic from lk9v6_users u
left join lk9v6_alumni_main m on m.user_id=u.id
left join lk9v6_alumni_data d on d.alumni_id=m.id
left join lk9v6_alexu_alumni_degrees deg on deg.id=d.gid
left join lk9v6_academic_degrees ac on d.certificate_type_id=ac.id
where u.id>152040
