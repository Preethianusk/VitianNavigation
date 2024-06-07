<?php 
$username=$_POST['username']; 
$password=$_POST['password']; 
//connection 
$conn=new mysqli('localhost','root','','userdetails');
if($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}
else { 
    $usrname = "SELECT email FROM register WHERE email='$username' ";
    $result1 = $conn->query($usrname);
    $pwd = "SELECT register.password FROM register WHERE email='$username' ";
    $result2 = $conn->query($pwd);
    $check1 = "empty";
    $check2 = "empty";
    if ($result1->num_rows > 0) {
        while($row = $result1->fetch_assoc()) {
          $GLOBALS['check1']=$row["email"];
        }
    }
    if ($result2->num_rows > 0) {
        while($row = $result2->fetch_assoc()) {
          $GLOBALS['check2']=$row["password"];
        }
    }
    
    if($check1==$username && $check2!=$password)
    {
        echo'<script type="text/javascript">
                alert("incorrect password");
                window.location.assign("homelogin.html")
            </script>';
    }
    if($check1!=$username)
    {
        echo'<script type="text/javascript">
                alert("invaild user");
                window.location.assign("homelogin.html")
            </script>';
    }
    if($check1==$username && $check2==$password)
    {
 $stmt = $conn->prepare("insert into login(username,password)values(?,?)"); 
 $stmt->bind_param("ss",$username,$password); 
 $stmt->execute(); 
 echo '<script>
    alert("logged in");
    window.location.assign("index.html") 
    </script>';
}
}
?>