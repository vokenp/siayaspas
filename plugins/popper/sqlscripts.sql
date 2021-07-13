create view vw_departments as select dp.*,dd.DirectorateCode,dd.DirectorateName,dd.HeadedBy   from tbl_departments dp inner join tbl_directorates dd on dp.DirectorateID = dd.S_ROWID;

  
update dh_modules set TableName='vw_departments',ParentTable='tbl_departments' where S_ROWID=61
