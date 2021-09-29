create view vw_departments as select dp.*,dd.DirectorateCode,dd.DirectorateName,dd.HeadedBy   from tbl_departments dp inner join tbl_directorates dd on dp.DirectorateID = dd.S_ROWID;


update dh_modules set TableName='vw_departments',ParentTable='tbl_departments' where S_ROWID=61;


  create view vw_sections as select s.*,dp.DepartmentName,dp.DirectorateName   from tbl_sections s inner join vw_departments dp on s.DepartmentID = dp.S_ROWID;

SET PERSIST information_schema_stats_expiry = 0;

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

    DROP TABLE IF EXISTS `tbl_appraisalperiods`;
    CREATE TABLE `tbl_appraisalperiods` (
      `S_ROWID` int NOT NULL AUTO_INCREMENT,
      `CreatedBy` varchar(255) DEFAULT 'ADMIN',
      `DateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
      `ModifiedBy` varchar(255) DEFAULT NULL,
      `DateModified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
      `PeriodName` varchar(255) DEFAULT NULL,
      `PeriodBegins` date DEFAULT NULL,
      `PeriodEnds` date DEFAULT NULL,
      `Remarks` varchar(255) DEFAULT NULL,
      PRIMARY KEY (`S_ROWID`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


    create view vw_directorates as select d.*,d.getuinfo(d.HeadedBy) as HeadofDirectorate from tbl_directorates d

  create view vw_individualtargets as select it.*,ap.PeriodName,ap.PeriodBegins,ap.PeriodEnds,getuinfo(it.UserID) as Appraisee from tbl_individualtargets it inner join tbl_appraisalperiods ap on it.PeriodID=ap.S_ROWID;



    create view vw_depttargets as select dt.*,ap.PeriodName,ap.PeriodBegins,ap.PeriodEnds,wd.DepartmentName,wd.HeadofDept from tbl_departmentstargets dt inner join tbl_appraisalperiods ap on dt.PeriodID=ap.S_ROWID  inner join vw_departments wd on dt.DeptID=wd.S_ROWID


      alter view vw_appraisals as select aps.*,u.Fullname,u.Phone,u.Email,u.Department,u.Section,u.Position,app.PeriodName,app.PeriodBegins,app.PeriodEnds,getuinfo(aps.SupervisorUserID) as SupervisorName
      from tbl_appraisals aps inner join vw_userslist u on aps.AppraiseeUserID=u.loginid
      inner join tbl_appraisalperiods app on app.S_ROWID=aps.AppPeriodID;



create view vw_targetlists  as select *,getuinfo(AssignedTo) as AssignedUser from tbl_targetlists


  create view vw_depttargetlists as select tl.*,dt.DeptID,dt.PeriodID,getuinfo(tl.AssignedTo) as AssignedName,dt.PeriodName,dt.PeriodBegins,dt.PeriodEnds,dt.DepartmentName,dt.HeadofDept from tbl_targetlists tl inner join vw_depttargets dt on tl.TargetID=dt.S_ROWID
  where tl.SourceType='Departmental';


  alter table tbl_section1 add AppraisalID int;
  alter table tbl_section2 add AppraisalID int;
  alter table tbl_section3 add AppraisalID int;
  alter table tbl_section4 add AppraisalID int;
  alter table tbl_section8 add AppraisalID int;
  alter table tbl_section9 add AppraisalID int;
  alter table tbl_section10 add AppraisalID int;


  create view vw_section10 as select  ap.S_ROWID as AppraisalID,AppraiseeUserID,getuinfo(ap.AppraiseeUserID) as Appraisee,ap.AppPeriodID,p.PeriodName,p.PeriodBegins,p.PeriodEnds,
   (select round(sum(PA_Ratings)*0.7,2) from tbl_section3 where AppraisalID=ap.S_ROWID)  as Section3,
   (select round(sum(SR_ScoreValue)*0.5,2) from tbl_section5a where AppraisalID=ap.S_ROWID)  as Section5A,
   (select round(sum(PA_Ratings)*0.5,2) from tbl_section3 where AppraisalID=ap.S_ROWID)  as Section3SP,
   (select round(sum(SR_ScoreValue)*0.5,2) from tbl_section5a where AppraisalID=ap.S_ROWID)  as Section5ASP,
   (select round(sum(SR_ScoreValue)*0.5,2) from tbl_section5b where AppraisalID=ap.S_ROWID)  as Section5BSP
   from  tbl_appraisals ap inner join tbl_appraisalperiods p on ap.AppPeriodID=p.S_ROWID where ap.ApplicationStatus='Closed'
