<?php
 include 'includes/dbh.inc.php'
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CADHUB</title>
    <link rel="stylesheet" href="search.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="crossorigin="anonymous"></script>
   
    
    <script src="main.js"></script>
    <script src="https://kit.fontawesome.com/a71a47edce.js" crossorigin="anonymous"></script>
</head>
<body>
    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <label class="logo">CADHUB</label>
        <ul>
            <li><a class="active" href="index.php">HOME</a></li>
            <li><a class="active" href="ABOUT.html">INFO</a></li>
            <li><a class="active" href="CONTACT.html">HELP</a></li>
           
           
        </ul>
       
    </nav>
    <div>
        <form action="search.inc.php" method="POST">
        <input type="text" name="search" placeholder="search" >
        <button type="submit" name="submit_search">SEARCH</button>
        </form>
       
        </div>
    <main>
    
<?php
    if (isset($_POST['submit_search'])){
       $search = mysqli_real_escape_string($conn, $_POST['search']);
        $sql =  "SELECT * FROM gallery WHERE tittleGallery like  '%$search%' OR desGallery like  '%$search%' or authorGallery like  '%$search%'  " ;
        $result = mysqli_query($conn,$sql);
        $queryResult = mysqli_num_rows($result);
        if ( $queryResult > 0) {
            while ($rows = mysqli_fetch_assoc($result))
            echo ' <a href="#" class="wrapper">
            <div style= "background-image: url(img/gallery/'.$rows["imgFullNameGallery"].');" class ="imgcontainer">
        
            
                  >
            </div>
            <div class="imagetext">
                <h3>'.$rows["tittleGallery"].'</h3>
                <p>'.$rows["desGallery"].'</P>
                <p>MADE BY:'.$rows["authorGallery"].'</P>
                <h4 style="display: none">'.$rows["uniId"].'</h4>
            </div>

        </a>';

        }
        else {
           echo"THERE IS NO RESULTS MATCHING YOUR QUERY";
        }
    }

?>
 </main>

   
    
</body>

</html>