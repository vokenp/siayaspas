DELIMITER $$
CREATE  FUNCTION `getminfo`(MemNo varchar(255)) RETURNS varchar(255) 
    DETERMINISTIC
BEGIN
     DECLARE FullName VARCHAR(255);
      select MemberName into FullName from tbl_members where MemberNo = MemNo;
     RETURN FullName;
    END$$
DELIMITER ;



DELIMITER $$
DROP FUNCTION if exists getuinfo;
CREATE  FUNCTION `getuinfo`(login_id varchar(255)) RETURNS varchar(255) 
    DETERMINISTIC
BEGIN
     DECLARE Full_Name VARCHAR(255);
      select Fullname into Full_Name from dh_users where loginid = login_id ;
     RETURN Full_Name;
    END$$
DELIMITER ;


create view vw_churchdistricts as select * , getuinfo(DistrictLeader) as LeaderName,
getuinfo(Deacon1) as Deacon1Name,getuinfo(Deacon2) as Deacon2Name from tbl_districts d;


CREATE FULLTEXT INDEX fx_tbldistricts ON tbl_districts (DistrictLeader,Deacon1,Deacon2);