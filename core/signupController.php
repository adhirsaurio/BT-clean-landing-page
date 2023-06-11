<?php
  include('./dbcon.php');
  include('./functions.php');
  
  if($_POST["action"] == "formRegistration"){
    $password  = trim($_POST['entryPass']);
    $passHash  = password_hash($password, PASSWORD_DEFAULT, array("cost"=>12));
    $userImage = makeImage(strtoupper($_POST["userName"][0]));
    $query     = "INSERT INTO users (userName,email,pass,userImg,createdAt) VALUES (:userName, :email, '$passHash', '$userImage', now() )";
    $statement = $connect->prepare($query);
    $statement->bindParam(':userName', $_POST["userName"]);
    $statement->bindParam(':email', $_POST["email"]);
    $result    = $statement->execute();

    echo $result?'ok':'err'; 
  }

 //Load data
  if($_POST["action"] == "Load"){

    $qry = "SELECT * FROM users ORDER BY id DESC LIMIT 1";
    $statement = $connect->prepare($qry);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    
    if(sizeof($result) > 0){
      foreach($result as $row){
        $output .= '
          <picture>
            <img src="'.$row["userImg"].'" class="img-fluid img-thumbnail bd-placeholder-img rounded-circle" width="140" height="140" alt="...">
          </picture>
          <p>User name:</p>
          <h2 class="fw-normal text-capitalize">"'.$row["userName"].'"</h2>
          <a href="../index.html" class="btn btn-primary">Return</a> 
        ';
      }
    }else{
      $output .= '
        <div class="col-sm-12 col-md-12">
            <div class="alert alert-danger"> 
                <strong>Error</strong>
                <hr class="message-inner-separator">
                <p>No info to show</p>
                <p>"'.$max.'"</p>
            </div>
        </div>';
    }

    echo $output;

  }
?>