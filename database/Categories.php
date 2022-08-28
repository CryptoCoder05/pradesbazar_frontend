<?php
// use to fetch data from category

class Category{
  public $db = null;
  public function __construct(DBController $db)
  {
    if (!isset($db->con)) {
      return null;
    }
    $this->db = $db;
  }

// fetch parent data
public function getParent($table = 'categories'){
  $result = $this->db->con->query("SELECT * FROM {$table} WHERE parent = 0");
  $resultArray = array();

  // fetch product data one by one...
  while ($item = mysqli_fetch_assoc($result)) {
    $resultArray[] = $item;
  }
  return $resultArray;
}

// fetch child data
public function getChild($parent_id,$table = 'categories'){
  $result = $this->db->con->query("SELECT * FROM {$table} WHERE parent = $parent_id ORDER BY categories");
  $resultArray = array();

  // fetch product data one by one...
  while ($item = mysqli_fetch_assoc($result)) {
    $resultArray[] = $item;
  }
  return $resultArray;
}

//get category parent ~ child name
public function getParentChild($cat_id, $table = 'categories'){
  // get child name from categories id.
  $child_qry = $this->db->con->query("SELECT * FROM {$table} WHERE id = $cat_id");
  $child_qry_run = mysqli_fetch_assoc($child_qry);
  $child_name = $child_qry_run['categories'];
  $par_id = $child_qry_run['parent'];
  // get patrent name from child.
  $parent_qry = $this->db->con->query("SELECT * FROM {$table} WHERE id = $par_id");
  $parent_qry_run = mysqli_fetch_assoc($parent_qry);
  $parent_name = $parent_qry_run['categories'];
  // return parent ~ child
  return $parent_name.' ~ '. $child_name;
}

} // end of main class

 ?>
