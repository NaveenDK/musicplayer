<?php include ("includes/header.php");
if(isset($_GET['id'])){
   $albumId = $_GET['id'];
   //echo $albumId;'
}


else{
    header("Location:index.php"); //Redirect to index page
}

// $albumQuery = mysqli_query($con,"SELECT * FROM albums WHERE id='$albumId'");
// $album = mysqli_fetch_array($albumQuery);

//instead of the above we will use the below


$album =  new Album($con,$albumId);

//$artistId = $album['artist'];
//echo $artistId;
//$artist = new Artist($con,$artistId);
$artist = $album->getArtist();

//echo $album ->getTitle()."<br>";
//echo $artist ->getName();

?>

<div class="entityInfo">
   <div class="leftSection">
      <img src="<?php echo $album->getArtworkPath();?>" />
   </div>
   <div class= "rightSection">
      <h2> <?php echo $album->getTitle(); ?> </h2>
      <span> By <?php echo $artist->getName();  ?></span>
   </div>
</div>

<?php include("includes/footer.php"); ?>
