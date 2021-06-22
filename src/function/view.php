<?php
class view
{
    private $dbConn;
    private $pItem_tableName = 'tbl_proditem';
    private $pItemReq_tableName = 'tbl_proditem_req';


    function __construct()
    {
        require_once('connection.php');
        $db = new  Connection();
        $this->dbConn = $db->Connect();
    }

    //   ############################## DISPLAYING DATA #################################

    public function login()
    {
        $stmt = $this->dbConn->prepare("SELECT * FROM tbl_users");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function product_data()
    {
        $stmt = $this->dbConn->prepare("SELECT a.proditem_code, a.proditem_name, a.proditem_desc, a.proditem_price, b.imgOne, b.proditemReq_size, b.proditemReq_qty, b.proditemReq_color FROM $this->pItem_tableName a inner JOIN $this->pItemReq_tableName b ON a.proditem_code = b.proditem_code");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }

    


    // public function product_dataV()
    // {
    //     $stmt = $this->dbConn->prepare("SELECT a.proditem_code, a.proditem_name, a.proditem_price b.proditemReq_size, b.proditemReq_qty, b.proditemReq_color FROM $this->pItem_tableName a inner JOIN $this->pItemReq_tableName b ON a.proditem_code = b.proditem_code");
    //     $stmt->execute();
    //     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    //     return $result;
    // }
}
?>