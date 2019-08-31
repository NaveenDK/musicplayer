<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
    include("includes/config.php");
    include("includes/classes/Artist.php");
    include("includes/classes/Album.php"); //havin album after-artist is important you know why
    include("includes/classes/Song.php");
}
else{
    include("includes/header.php");
    include("includes/footer.php");
    $url = $_SERVER['REQUEST_URI'];
   // echo "<script> openPage('')</script>"

    $url  = $_SERVER['REQUEST_URI'];

    echo "<script> openPage('$url')</script>";
    exit();//which prevents loading rest of the page

}
?>