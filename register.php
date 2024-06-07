<?php
$name=$_POST['name'];
$email=$_POST['email'];
$password=$_POST['pwd'];
$conpassword=$_POST['cfpwd'];
$conn=new mysqli('localhost','root','','userdetails');
if($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}
else {
    if($password!=$conpassword)
    {
        echo'<script>
                alert("Password did not match");
                window.location.assign("homelogin.html")
            </script>';
    }
    $sql = "SELECT email FROM register WHERE email='$email' ";
    $result = $conn->query($sql);
    if(mysqli_num_rows($result) != 0) { 
        echo '<script>
                alert("Account Already Exists");
                window.location.assign("homelogin.html")
            </script>';
    }
    else{
        $stmt = $conn->prepare("insert into register(name,email,password)values(?,?,?)");
        $stmt->bind_param("sss",$name,$email,$password);
        $stmt->execute();
        echo '<script>
                alert("Thanks ! Your account has been successfully created");
                window.location.assign("homelogin.html")
            </script>';
    }
}
?>