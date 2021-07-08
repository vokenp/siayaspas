create view vw_pesatrans as select S_ROWID,CreatedBy,DateCreated,ModifiedBy,DateModified,TransactionType,TransID,TransTime,TransAmount,BusinessShortCode,BillRefNumber,InvoiceNumber,OrgAccountBalance,ThirdPartyTransID,MSISDN,concat_ws(' ',FirstName,MiddleName,LastName) as FullName,IsProcessed,DateProcessed,AccountType from pesatrans;


create view vw_pesatrans_nc as select S_ROWID,CreatedBy,DateCreated,ModifiedBy,DateModified,TransactionType,TransID,TransTime,TransAmount,BusinessShortCode,BillRefNumber,InvoiceNumber,OrgAccountBalance,ThirdPartyTransID,MSISDN,concat_ws(' ',FirstName,MiddleName,LastName) as FullName,IsProcessed,DateProcessed,AccountType from pesatrans where AccountType='NoneCategory';


  DELIMITER $$
  DROP FUNCTION if exists getmpinfo;
  CREATE  FUNCTION getmpinfo(Trans_ID varchar(255)) RETURNS varchar(255)
      DETERMINISTIC
  BEGIN
       DECLARE Full_Name VARCHAR(255);
        select concat_ws(' ',FirstName,MiddleName,LastName) into Full_Name from pesatrans where TransID = Trans_ID ;
       RETURN Full_Name;
      END$$
  DELIMITER ;


  create view vw_airtimetopup_success as select  S_ROWID,CreatedBy,DateCreated,ModifiedBy,DateModified,TransID,PKRefNo,TimeCompleted,StatusCode,StatusDescription,TopUpPhoneNo,TopUpAmount,PaymentMethod,TopUpNetwork,PaymentChannel,TransRefNo,MobileOperator,Commission,AgentBal
  ,ifnull(getmpinfo(left(TransID,10)),'Anonymous') as FullName  from tbl_airtimetopup where StatusCode='Success';

  create view vw_airtimetopup_success as select  S_ROWID,CreatedBy,DateCreated,ModifiedBy,DateModified,TransID,PKRefNo,TimeCompleted,StatusCode,StatusDescription,TopUpPhoneNo,TopUpAmount,PaymentMethod,TopUpNetwork,PaymentChannel,TransRefNo,MobileOperator,Commission,AgentBal
  ,ifnull(getmpinfo(left(TransID,10)),'Anonymous') as FullName  from tbl_airtimetopup where StatusCode='Success';


  create view vw_airtimetopup_error as select  S_ROWID,CreatedBy,DateCreated,ModifiedBy,DateModified,TransID,PKRefNo,TimeCompleted,StatusCode,StatusDescription,TopUpPhoneNo,TopUpAmount,PaymentMethod,TopUpNetwork,PaymentChannel,TransRefNo,MobileOperator,Commission,AgentBal
  ,ifnull(getmpinfo(left(TransID,10)),'Anonymous') as FullName  from tbl_airtimetopup where StatusCode='Error';
