
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ENGINEERME</title>
    <link rel="stylesheet" href="main.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="crossorigin="anonymous"></script>
   
    
    <script src="main.js"></script>
    <script src="https://kit.fontawesome.com/a71a47edce.js" crossorigin="anonymous"></script>
</head>

<body>
    <script>
        $(document).ready(function(){

        $('.upfield').click(
    function() {
        $('.gallery-upload').toggle();

    })
})
    </script>
     <script>
        $(document).ready(function(){

        $('.instructions').click(
    function() {
        $('.tooltiptext').toggle();

    })
})
    </script>
    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <label class="logo">ENGINEERME</label>
        <ul>
            <li><a class="active" href="index.php">HOME</a></li>
            <li><a class="active" href="index.html">INFO</a></li>
            <li><button  style="border:none" class="upfield">UPLOAD</button></li>
          
        </ul>
       
    </nav>
    <main>
    <div>
        <form action="search.inc.php" method="POST">
        <input  class = "input2" type="text" name="search" placeholder="search" >
        <button class = 'button' type ="submit" name="submit_search">SEARCH</button>
        </form>
       
        </div>
        <section class="gallery-links">
            <div class="wrapper">
                <h2>Gallery</h2>
                <div class="gallery-container">
                  <?php
                  include_once 'includes/dbh.inc.php';

                  $sql = "SELECT * FROM gallery ORDER BY orderGallery Desc" ;
                
                  $stmt = mysqli_stmt_init($conn);
                  if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo "SQL statement Failed!";
                  }
                  else {
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo' <a href="#" class="img">
                        <div style= "background-image: url(img/gallery/'.$row["imgFullNameGallery"].');" class ="img2">
                    
                        
                              >
                        </div>
                        <div class="imagetext">
                            <h3>'.$row["tittleGallery"].'</h3>
                            <p>'.$row["desGallery"].'</P>
                            <p>MADE BY:'.$row["authorGallery"].'</P>
                            <h4 style="display: none">'.$row["uniId"].'</h4>
                        </div>

                    </a>';
                    }
                  }
                  
                   ?>
                  
                   
                </div>
                
                    
                    <div style="display: none" class="gallery-upload">
                    <button class="instructions">VIEW UPLOAD INSTUCTIONS</button>
                    <div style="display: none" class="tooltiptext">
                    <p>CHOOSE THREE FILES AT A TIME AND FILES MUST BE IN THE ORDER OF: </p>
                    <p>1. An image file(jpg,jpeg,png,webp)</p>
                    <p>2.A PDF document </p>
                    <p>3.A zip file of the CAD</p>
                    

                    </div>
                        <form id = "field_upload" action="includes/gallery-upload.inc.php" method="post" enctype="multipart/form-data">
                            <input class = "input1" type="text" name="filename" placeholder="File Name..."></br>
                            <input class = "input1" type="text" name="filetitle" placeholder="Repeat File Name"></br>
                            <input class = "input1" type="text" name="fileauthor" placeholder="AUTHOR"></br>
                            <input  class = "input1" type="text" name="filedesc" placeholder="File description..."></br>
                            <input id = "image_upload" type="file"  name="files[]"   multiple></br>
                            <button type="submit" name="submit" class ="button">UPLOAD</button>




                        </form>

                    </div>

                    
                    
            </div>

        </section>
    </main>

   
    
</body>

</html>