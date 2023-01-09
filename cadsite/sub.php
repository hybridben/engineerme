<?php 
   if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
   $url = "https://";   
 else  
   $url = "http://";   
 // Append the host(domain name, ip) to the URL.   
 $url.= $_SERVER['HTTP_HOST'];   
 
 // Append the requested resource location to the URL   
 $url= $_SERVER['REQUEST_URI'];    
 $components = parse_url($url);
 parse_str($components['query'], $results);
 $name = $results['first'];
 
  ?>

    
   
      
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ENGINEERME</title>
    
    <link rel="stylesheet" href="sub.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/a71a47edce.js" crossorigin="anonymous"></script>
    <script src="main.js"></script>
</head>

<body>
  
 
    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <label class="logo">ENGINEERME</label>
        <ul>
            <li><a class="active" href="index.php">HOME</a></li>
            <li><a class="active" href="ABOUT.html">INFO</a></li>
            
            
        </ul>
    </nav>
    <main>
    <section class="gallery-links">
            <div class="wrapper">
                
                <div class="imgcontainer">
                <?php
                  include_once 'includes/dbh.inc.php';
                  
                  $sql = "SELECT * FROM gallery WHERE uniId = $name " ;
                
                  $stmt = mysqli_stmt_init($conn);
                  if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo "SQL statement Failed!";
                  }
                  else {
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo' <a href="download.php?path=img/gallery/'.$row["imgFullNameGallery"].'" >
                        
                        <img src = "img/gallery/'.$row["imgFullNameGallery"].'"  > 
                      
                    
                        
                              
                        
                        

                    </a>';
                    }
                  }
                  
                   ?>
                </div>
                <div class="pdfcontainer">
                <?php
                  include_once 'includes/dbh.inc.php';
                  
                  $sql1 = "SELECT * FROM pdfs WHERE uniId = $name " ;
                
                  $stmt1 = mysqli_stmt_init($conn);
                  if (!mysqli_stmt_prepare($stmt1, $sql1)) {
                    echo "SQL statement Failed!";
                  }
                  else {
                    mysqli_stmt_execute($stmt1);
                    $result1 = mysqli_stmt_get_result($stmt1);

                    while ($row = mysqli_fetch_assoc($result1)) {
                        echo' <a href="download.php?path=img/pdf/'.$row["imgFullNameGallery1"].'" >
                        <div  class="text">
                    
                          <h3> DOWNLOAD PDF</h3>
                              
                        </div>
                        

                    </a>';
                    }
                  }
                  
                   ?>
                </div><div class="zipcontainer">
                <?php
                  include_once 'includes/dbh.inc.php';
                  
                  $sql2 = "SELECT * FROM zips WHERE uniId = $name " ;
                
                  $stmt2 = mysqli_stmt_init($conn);
                  if (!mysqli_stmt_prepare($stmt2, $sql2)) {
                    echo "SQL statement Failed!";
                  }
                  else {
                    mysqli_stmt_execute($stmt2);
                    $result2 = mysqli_stmt_get_result($stmt2);

                    while ($row = mysqli_fetch_assoc($result2)) {
                        echo' <a href="download.php?path=img/zip/'.$row["imgFullNameGallery2"].'" >
                        <div class="text" >
                    
                        <h3>DOWNLOAD ZIP</h3>
                              
                        </div>
                        

                    </a>';
                    }
                  }
                  
                   ?>
                </div>



            </div>
    </section>
</main>

    </body>

</html>