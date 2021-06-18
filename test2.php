CREATE DEFINER=`root`@`localhost` FUNCTION `getuinfo`(UserID int) RETURNS varchar(255) CHARSET utf8mb4
    DETERMINISTIC
BEGIN
     DECLARE FullName VARCHAR(255);
      select concat_ws(' ',FirstName,OtherNames,concat('(',PhoneNo,')')) into FullName from tbl_saccousers where S_ROWID = UserID;
     RETURN FullName;
    END