<?php 

class Album{
    private $con;
    private $id;
    private $name;

    public function __construct($con,$id){
        $this->con = $con;
        $this->id = $id;
    }
  
    public function getTitle(){
      $query = mysqli_query($this->con,"SELECT title FROM albums where id='$this->id'");
      $album = mysqli_fetch_array($query);
      return $album['title'];

    }
    

}