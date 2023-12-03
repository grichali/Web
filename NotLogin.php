<?php session_start();
if(isset($_SESSION["username"])){
    header('location: Favorites.php');
}
else{
    ?>
    <!DOCTYPE html>
<html>
            <head>
                <script>
                    alert("You need to be logged in to perform this action.");
                    window.location.href = "login.php";
                </script>
            </head>
            <body>
            <!-- Your HTML content here -->
            </body>
</html>

<?php } ?>

