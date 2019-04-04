<?php
//Thiis is a simple contact form in which we send the eamil using php.
    $msg = '';
    $msgClass ='';
    //check for form submit
    if(filter_has_var(INPUT_POST,'submit')){
        //get form data
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['message']);

        //check for required fields
        if(!empty($name) && !empty($email) && !empty($message)){
            //passed
            //check for email
            if(filter_var($email,FILTER_VALIDATE_EMAIL)===false){
                //failed
                $msg = 'Please fill required field';
                $msgClass = 'alert-danger';
            }
            else{
                //passed
                $toEmail = 'support@ravi.com';
                $subject = 'Request from'.$name;
                $body = '<h3> Contact Request </h3>
                <h4>Name</h4>'.$name.'</p>
                <h4>Email</h4>'.$email.'</p>
                <h4>Message<h4>'.$message.'</p>';

              if(mail($toEmail,$subject,$body,"FROM: {$_POST['email']}")){
                  //Email sent
                  $msg = 'Your message has been sent';
                  $msgClass = 'alert-success';
              }  
                $_POST = [];  //If the mail was sent there no need to show the value again in the form so,$_POST[] will clear these values.
              else{
                  //sending failed
                $msg = 'Your email was not sent';
                $msgClass = 'alert-danger';
              }
            }
    }
        else{
            //failed
            $msg = 'Please fill the required fields';
            $msgClass = 'alert-danger';
        
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Contact Us</title>
<link rel="stylesheet" href="https://bootswatch.com/4/
cosmo/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">My Website</a>
            </div>
        </div>
    </nav>
    <div class="container">
    <?php if($msg !=''): ?>
        <div class="alert <?php echo $msgClass;?>"><?php
            echo $msg;?>
            </div>
    <?php endif;?>
      <form method="post" action="<?php 
       echo $_SERVER['PHP_SELF'];?>">
        <div class="form-group">
          <label>Name</label>
            <input type="text" name="name" class="form-control" 
            value="<?php echo isset($_POST['name'])?$name:'';?>">
        </div>
        <div class="form-group">
          <label>Email</label>
            <input type="text" name="email" class="form-control" 
            value="<?php echo isset($_POST['email'])?$email:'' ;?>">
        </div>
        <div class="form-group">
          <label>Message</label>
            <textarea name="message" class="form-control">
            <?php echo isset($_POST['message'])?$message:'';?></textarea>
        </div>
        <br>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
</body>
</html>
