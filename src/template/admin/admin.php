<?php

class admin
{
    // ###################### PRODUCT LINE ###################################
    protected $Name;
    private $dbConn;
    private $pl_tableName = 'tbl_prodline';
    private $c_tableName = 'tbl_categ';
    private $sc_tableName = 'tbl_subcateg';
    private $pItem_tableName = 'tbl_proditem';
    private $pItemReq_tableName = 'tbl_proditem_req';

    function setName($prodL_Name) 
    { 
        $this->prodL_Name = $prodL_Name; 
    }
    function getName() 
    { 
        return $this->prodL_Name; 
    }

    function setId($prodL_Code) 
    { 
        $this->prodL_Code = $prodL_Code; 
    }
    
    function getId() 
    { 
        return $this->prodL_Code; 
    }

    function __construct()
    {
        require_once('./functions/connection.php');
        $db = new  Connection();
        $this->dbConn = $db->Connect();
    }

    public function insert_pl()
    {
        $sql = "INSERT INTO $this->pl_tableName (`prodL_Code`, `prodL_Name`) VALUES(null, :name)";
        $stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam(':name', $this->prodL_Name);
        
        if($stmt->execute())
        {
            return true;
        }
        else 
        {
            return false;
        }
    }

    public function fetchData_pl()
    {
        $stmt = $this->dbConn->prepare("SELECT * FROM $this->pl_tableName");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    public function update_pl()
    {
        $sql = "UPDATE $this->pl_tableName SET prodL_Name = :name WHERE prodL_Code = :id";
        $stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam(':name', $this->prodL_Name);
        $stmt->bindParam(':id', $this->prodL_Code);
        
        if($stmt->execute())
        {
            return true;
        }
        else 
        {
            return false;
        }
    }

    public function delete_pl()
    {
        $sql = "DELETE FROM $this->pl_tableName WHERE prodL_Code = :id";
        $stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam(':id', $this->prodL_Code);
        
        if($stmt->execute())
        {
            return true;
        }  
        else 
        {
            return false;
        }
    }

     // ###################### CATEGORY ###################################

     function setc_name($categ_Name) 
     { 
         $this->categ_Name = $categ_Name; 
     }

     function getc_name() 
     { 
         return $this->categ_Name; 
     }

     function setc_id($categ_Code) 
     { 
         $this->categ_Code = $categ_Code; 
     }

     function getc_id() 
     { 
         return $this->categ_Code; 
     }
    
     public function insert_c()
    {
        $sql = "INSERT INTO $this->c_tableName (`categ_Code`, `categ_Name`, `prodL_Code`) VALUES(null, :cname, :pcode)";
        $stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam(':cname', $this->categ_Name);
        $stmt->bindParam(':pcode', $this->prodL_Code);
        if($stmt->execute())
        {
            return true;
        }
        else 
        {
            return false;
        }
    }

    public function fetchData_c()
    {
        $stmt = $this->dbConn->prepare("SELECT a.categ_Code, a.categ_Name, b.prodL_Code, b.prodL_Name FROM $this->c_tableName a inner join $this->pl_tableName b on a.prodL_Code=b.prodL_Code");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function fetchDataCombobox_c()
    {
        $stmt = $this->dbConn->prepare("SELECT prodL_Code, prodL_Name FROM $this->pl_tableName");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    public function update_c()
    {
        $sql = "UPDATE $this->c_tableName SET categ_Name = :name, prodL_Code = :pcode WHERE categ_Code = :id";
        $stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam(':name', $this->categ_Name);
        $stmt->bindParam(':id', $this->categ_Code);
        $stmt->bindParam(':pcode', $this->prodL_Code);
        
        if($stmt->execute())
        {
            return true;
        }
        else 
        {
            return false;
        }
    }

    public function delete_c()
    {
        $sql = "DELETE FROM $this->c_tableName WHERE categ_Code = :id";
        $stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam(':id', $this->categ_Code);
        
        if($stmt->execute())
        {
            return true;
        }  
        else 
        {
            return false;
        }
    }

    // ###################### SUB CATEGORY ###################################

    function setscName($subcateg_Name) 
    { 
        $this->subcateg_Name = $subcateg_Name; 
    }
    function getscName() 
    { 
        return $this->subcateg_Name; 
    }

    function setscId($subcateg_Code) 
    { 
        $this->subcateg_Code = $subcateg_Code; 
    }
    function getscId() 
    { 
        return $this->subcateg_Code; 
    }
    
    public function insert_sc()
   {
       $sql = "INSERT INTO $this->sc_tableName (`subcateg_Code`, `subcateg_Name`, `categ_Code`) VALUES(null, :cname, :pcode)";
       $stmt = $this->dbConn->prepare($sql);
       $stmt->bindParam(':cname', $this->subcateg_Name);
       $stmt->bindParam(':pcode', $this->categ_Code);
       if($stmt->execute())
       {
           return true;
       }
       else 
       {
           return false;
       }
   }

   public function fetchData_sc()
   {
       $stmt = $this->dbConn->prepare("SELECT a.subcateg_Code, a.subcateg_Name, b.categ_Code, b.categ_Name, c.prodL_Code, c.prodL_Name FROM $this->sc_tableName a inner join $this->c_tableName b on a.categ_Code=b.categ_Code inner join $this->pl_tableName c on b.prodL_Code=c.prodL_Code");
       $stmt->execute();
       $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
       return $result;
   }

   public function fetchDataCombobox_sc($pidmenu)
   {
       $stmt = $this->dbConn->prepare("SELECT categ_Code, categ_Name FROM $this->c_tableName WHERE prodL_Code = $pidmenu" );
       $stmt->execute();
       $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
       return $result;
   }


   public function update_sc()
   {
       $sql = "UPDATE $this->sc_tableName SET categ_Name = :name, prodL_Code = :pcode WHERE categ_Code = :id";
       $stmt = $this->dbConn->prepare($sql);
       $stmt->bindParam(':name', $this->categ_Name);
       $stmt->bindParam(':id', $this->categ_Code);
       $stmt->bindParam(':pcode', $this->prodL_Code);
       
       if($stmt->execute())
       {
           return true;
       }
       else 
       {
           return false;
       }
   }

   public function delete_sc()
   {
       $sql = "DELETE FROM $this->sc_tableName WHERE subcateg_Code = :id";
       $stmt = $this->dbConn->prepare($sql);
       $stmt->bindParam(':id', $this->subcateg_Code);
       
       if($stmt->execute())
       {
           return true; 
       }  
       else 
       {
           return false;
       }
   }


       // ###################### ITEM PRODUCT ###################################

       function setpitmCode($proditem_code) 
       { 
           $this->proditem_code = $proditem_code; 
       }
       function getpitmCode() 
       { 
           return $this->proditem_code; 
       }
       function setpitmName($prodItem_name) 
       { 
           $this->prodItem_name = $prodItem_name; 
       }
       function getpitmName() 
       { 
           return $this->prodItem_name; 
       }
   
       function setpitmDesc($proditem_desc) 
       { 
           $this->proditem_desc = $proditem_desc; 
       }
       function getpitmDesc() 
       { 
           return $this->proditem_desc; 
       }

       function setpitmPric($proditem_price) 
       { 
           $this->proditem_price = $proditem_price; 
       }
       function getpitmPric() 
       { 
           return $this->proditem_price; 
       }

       function setimgOne($imgOne) 
       { 
        $this->imgOne = $imgOne;
       }
       function getimgOne() 
       { 
           return $this->imgOne; 
       }    
   
       function setimgTwo($imgTwo) 
       { 
           $this->imgTwo = $imgTwo; 
       }
       function getimgTwo() 
       { 
           return $this->imgTwo; 
       }

       function setimgThree($imgThree) 
       { 
           $this->imgThree = $imgThree; 
       }
       function getimgThree() 
       { 
           return $this->imgThree; 
       }

       function setproditmReqSize($proditemReq_size) 
       { 
           $this->proditemReq_size = $proditemReq_size; 
       }
       function getproditmReqSize() 
       { 
           return $this->proditemReq_size; 
       }

       function setproditmReqQty($proditemReq_qty) 
       { 
           $this->proditemReq_qty = $proditemReq_qty; 
       }
       function getproditmReqQty() 
       { 
           return $this->proditemReq_qty; 
       }

       function setproditmReqColor($proditemReq_color) 
       { 
           $this->proditemReq_color = $proditemReq_color; 
       }
       function getproditmReqColor() 
       { 
           return $this->proditemReq_color; 
       }
   
    public function insert_pdItem()
    {
        $sql = "INSERT INTO $this->pItem_tableName (`proditem_code`, `proditem_name`, `proditem_desc`, `proditem_price`, `categ_Code`, `subCateg_Code`) VALUES(:pdItemCode, :pdItemName, :pdItemDesc, :pdItemPrice, :categCode, :subCategCode); 
        INSERT INTO $this->pItemReq_tableName(`proditemReq_Code`, `imgOne`, `imgTwo`, `imgThree`, `proditemReq_size`, `proditemReq_qty`, `proditemReq_color`, `proditem_code`) VALUES (null, :imgOne, :imgTwo, :imgThree, :pdItemReqSize, :pdItemReqQty, :pdItemReqColor, :pdItemCode);
        ";
        $stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam(':pdItemCode', $this->proditem_code);
        $stmt->bindParam(':pdItemName', $this->prodItem_name);
        $stmt->bindParam(':pdItemDesc', $this->proditem_desc);
        $stmt->bindParam(':pdItemPrice', $this->proditem_price);
        $stmt->bindParam(':categCode', $this->categ_Code);
        $stmt->bindParam(':subCategCode', $this->subcateg_Code);
        $stmt->bindParam(':imgOne', $this->imgOne);
        $stmt->bindParam(':imgTwo', $this->imgTwo);
        $stmt->bindParam(':imgThree', $this->imgThree);
        $stmt->bindParam(':pdItemReqSize', $this->proditemReq_size);
        $stmt->bindParam(':pdItemReqQty', $this->proditemReq_qty);
        $stmt->bindParam(':pdItemReqColor', $this->proditemReq_color);

        if($stmt->execute())
        {
            return true;
        }
        else 
        {
            return false;
        }
    }
    
   
   
      public function fetchData_sbc()
      {
          $stmt = $this->dbConn->prepare("SELECT a.proditem_code, a.proditem_name, b.proditemReq_size, b.proditemReq_qty, b.proditemReq_color FROM $this->pItem_tableName a LEFT JOIN $this->pItemReq_tableName b ON a.proditem_code = b.proditem_code");
          $stmt->execute();
          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          return $result;
      }
   
   
      public function fetchDataCombobox_sbc($scidmenu)
      {
          $stmt = $this->dbConn->prepare("SELECT subCateg_Code, subCateg_Name FROM $this->sc_tableName WHERE categ_Code = $scidmenu" );
          $stmt->execute();
          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          return $result;
      }
   
   
      public function update_pItem()
      {
          $sql = "UPDATE $this->sc_tableName SET categ_Name = :name, prodL_Code = :pcode WHERE categ_Code = :id";
          $stmt = $this->dbConn->prepare($sql);
          $stmt->bindParam(':name', $this->categ_Name);
          $stmt->bindParam(':id', $this->categ_Code);
          $stmt->bindParam(':pcode', $this->prodL_Code);
          
          if($stmt->execute())
          {
              return true;
          }
          else 
          {
              return false;
          }
      }
   
      public function delete_pItem()
      {
          $sql = "DELETE FROM $this->sc_tableName WHERE subcateg_Code = :id";
          $stmt = $this->dbConn->prepare($sql);
          $stmt->bindParam(':id', $this->subcateg_Code);
          
          if($stmt->execute())
          {
              return true; 
          }  
          else 
          {
              return false;
          }
      }

}

?>