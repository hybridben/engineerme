<?php

if (isset($_POST['submit'])){
 
    $newFileName = $_POST['filename'];
    if (empty($_POST['filename'])){
        $newFileName = "gallery";
        
    }else{
        $newFileName = strtolower(str_replace(" ", "-", $newFileName));
    }
    $imageTitle = $_POST['filetitle'];
    $imageDesc = $_POST['filedesc'];
    $imageAuthor = $_POST['fileauthor'];
    $file = $_FILES['files'];

   $rand = substr(uniqid('', true), -5);
 
        foreach ($file['name'] as $key => $value) {
            $fileName = $file['name'][$key];
           
            $fileExt = explode(".",$fileName);
           
            $fileActualExt = strtolower(end($fileExt));  
           
            $fileType =  $file['type'][$key]; 

            $fileTempName = ($file['tmp_name'][$key]); 
            
            $fileError = ($file['error'][$key]);
            
            $fileSize = ($file['size'][$key]);
            
            
    $allowed = array("jpg","jpeg", "png","zip","pdf","webp");

    if(in_array($fileActualExt, $allowed)){
        if ($fileError===0) {
            if ($fileSize < 50000000 ) {
                if ($fileActualExt === "pdf") {
                    $imageFullName1 = $newFileName . "." . uniqid("",true) . "." .$fileActualExt;
                    
                    $fileDestination = "../img/pdf/" . $imageFullName1;
                    include_once "dbh.inc.php";
                    if (empty($imageTitle) || empty($imageDesc)) {
                        header("Location:../index.php?upload=empty");
                        exit();
                        
                    }
                    else {
                        $sql1 = "SELECT * FROM pdfs";
                        $stmt1 = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt1,$sql1)) {
                            echo"SQL statement failed!";
                        }else {
                            mysqli_stmt_execute($stmt1);
                            $result1 = mysqli_stmt_get_result($stmt1);
                            $rowCount1 = mysqli_num_rows($result1);
                            $setImageOrder1 = $rowCount1 + 1;
                            $sql1 = "INSERT INTO pdfs ( imgFullNameGallery1,tittleGallery, orderGallery1,authorGallery,uniId) VALUE ( ?,?, ?,?,?);";
                            if (!mysqli_stmt_prepare($stmt1,$sql1)) {
                                echo"SQL statement failed!";}
                                else {
                                    mysqli_stmt_bind_param($stmt1,"sssss", $imageFullName1,$imageTitle, $setImageOrder1,$imageAuthor,$rand);
                                    mysqli_stmt_execute($stmt1);
    
                                    move_uploaded_file($fileTempName, $fileDestination);
    
                                    header("Location:../index.php?upload=success");
                                    
                                }
                        }
                    }
                }
                elseif ($fileActualExt === "zip") {
                    $imageFullName2 = $newFileName . "." . uniqid("",true) . "." .$fileActualExt;
                    
                    $fileDestination = "../img/zip/" . $imageFullName2;
                    include_once "dbh.inc.php";
                    if (empty($imageTitle) || empty($imageDesc)) {
                        header("Location:../index.php?upload=empty");
                        exit();
                        
                    }
                    else {
                        $sql2 = "SELECT * FROM zips";
                        $stmt2 = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt2,$sql2)) {
                            echo"SQL statement failed!";
                        }else {
                            mysqli_stmt_execute($stmt2);
                            $result2 = mysqli_stmt_get_result($stmt2);
                            $rowCount2 = mysqli_num_rows($result2);
                            $setImageOrder2 = $rowCount2 + 1;
                            $sql2 = "INSERT INTO zips ( imgFullNameGallery2,tittleGallery, orderGallery2,authorGallery,uniId) VALUE ( ?, ?,?,?,?);";
                            if (!mysqli_stmt_prepare($stmt2,$sql2)) {
                                echo"SQL statement failed!";}
                                else {
                                    mysqli_stmt_bind_param($stmt2,"sssss",  $imageFullName2, $imageTitle, $setImageOrder2,$imageAuthor,$rand);
                                    mysqli_stmt_execute($stmt2);
    
                                    move_uploaded_file($fileTempName, $fileDestination);
    
                                    header("Location:../index.php?upload=success");
                                    
                                }
                        }
                    }
                }
               else{
                $imageFullName = $newFileName . "." . uniqid("",true) . "." .$fileActualExt;
                
                $fileDestination = "../img/gallery/" . $imageFullName;
               

                include_once "dbh.inc.php";
                if (empty($imageTitle) || empty($imageDesc)) {
                    header("Location:../index.php?upload=empty");
                    exit();
                    
                }
                else {
                    $sql = "SELECT * FROM gallery;";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt,$sql)) {
                        echo"SQL statement failed!";
                    }else {
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        $rowCount = mysqli_num_rows($result);
                        $setImageOrder = $rowCount + 1;
                        $sql = "INSERT INTO gallery (tittleGallery,desGallery, imgFullNameGallery, orderGallery,authorGallery,uniId) VALUE (? , ?, ?, ?,?,?);";
                        if (!mysqli_stmt_prepare($stmt,$sql)) {
                            echo"SQL statement failed!";}
                            else {
                                mysqli_stmt_bind_param($stmt,"ssssss", $imageTitle, $imageDesc, $imageFullName, $setImageOrder,$imageAuthor,$rand);
                                mysqli_stmt_execute($stmt);

                                move_uploaded_file($fileTempName, $fileDestination);

                                header("Location:../index.php?upload=success");
                                
                            }
                    }
                }

            }

            }else {
                echo" File size is too big";
                exit();
            }
        }else {
            echo" You had an error";
            exit();
        }

    }else {
            echo" You need to upload a proper file type!";
            exit();
        } 
    

    

    }


}
