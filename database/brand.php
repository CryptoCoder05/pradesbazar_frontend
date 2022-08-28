<?php

// php brand class...
class Brand
{
  public $db = null;
  public function __construct(DBController $db)
  {
    if (!isset($db->con)) {
      return null;
    }
    $this->db = $db;
  }

// get brand name...
  public function getBrandName($id = null, $table = "brand"){
    if ($this->db->con != null) {
      if ($id != null) {
        foreach ($id as $b_id) {
          $brand_Q = "SELECT * FROM $table WHERE id = '$b_id'";
          $brand_res = $this->db->con->query($brand_Q);
          $item = mysqli_fetch_assoc($brand_res);
          $brand_name[] = $item['brand'];
        }
        return $brand_name;
      }
    }
  }
  
}
 ?>
