<?php include ("includes/header.php");
if(isset($_GET['id'])){
   $albumId = $_GET['id'];
   //echo $albumId;'
}


else{
    header("Location:index.php"); //Redirect to index page
}

$albumQuery = mysqli_query($con,"SELECT * FROM albums WHERE id='$albumId'");
$album = mysqli_fetch_array($albumQuery);

$artistId = $album['artist'];
//echo $artistId;
$artist = new Artist($con,$artistId);

echo $album['title']."<br>";
echo $artist ->getName();

?>

<?php include("includes/footer.php"); ?>
