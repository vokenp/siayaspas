create view vw_departments as select dp.*,dd.DirectorateCode,dd.DirectorateName,dd.HeadedBy   from tbl_departments dp inner join tbl_directorates dd on dp.DirectorateID = dd.S_ROWID;


update dh_modules set TableName='vw_departments',ParentTable='tbl_departments' where S_ROWID=61;


  create view vw_sections as select s.*,dp.DepartmentName,dp.DirectorateName   from tbl_sections s inner join vw_departments dp on s.DepartmentID = dp.S_ROWID;


    alter table dh_users add JobGroup varchar(255) after Position;


    DELIMITER $$
    DROP FUNCTION IF EXISTS getuinfo;
    CREATE FUNCTION getuinfo(UserID varchar(255)) RETURNS varchar(255) CHARSET utf8mb4
        DETERMINISTIC
    BEGIN
         DECLARE FullName1 VARCHAR(255);
          select concat(Fullname,' (',loginid,')') into FullName1 from dh_users where loginid = UserID;
         RETURN FullName1;
        END$$
    DELIMITER ;




    create view vw_directorates as select d.*,d.getuinfo(d.HeadedBy) as HeadofDirectorate from tbl_directorates d
