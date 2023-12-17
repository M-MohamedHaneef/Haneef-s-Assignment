<?php
session_start();

// Check if the user is not logged in, redirect to the login page
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Include the database connection script
include 'db.php';

// Retrieve course data based on the session variables
$email = $_SESSION['email'];
$sql = "SELECT * FROM Lecturer WHERE Email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $lecturer = $result->fetch_assoc();
    $courseID = $lecturer['CourseID'];

    // Retrieve course details based on the CourseID
    $courseSql = "SELECT * FROM Course WHERE CourseID = $courseID";
    $courseResult = $conn->query($courseSql);

    if ($courseResult->num_rows == 1) {
        $course = $courseResult->fetch_assoc();
    } else {
        // Course not found, handle as needed (e.g., redirect to an error page)
        header("Location: error.php");
        exit();
    }
} else {
    // Lecturer not found, redirect to login page
    header("Location: login.php");
    exit();
}

$conn->close();
?>



    <!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Dashboard</title>
    <style>
      /* Add some basic CSS styles */
      body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #101820;
        
      }

      #sidebar {
        height: 100vh;
        padding: 20px;
        background-color: #FEE715;
        float: left;
        width: 250px;
        
        
      }

      #sidebar h2 {
        margin-top: 0;
      }

      #content {
        padding: 100px;
        text-align: center;
        width: calc(100% - 250px);
        color: red;
        
      }

      /* Style the navigation links */
      #sidebar a {
        color: #333;
        display: block;
        margin-bottom: 10px;
        text-decoration: none;
      }
      #sidebar a:hover {
        text-decoration: underline;
      }
    </style>
  </head>
  <body>
    <div id="sidebar">
      <h2><?php echo $lecturer['Name']; ?>! Dashboard</h2>
      <a href="#">Profile</a>
      <a href="#">Subjects</a>
      <a href="#">Events</a>
      <a href="#">calander</a>
      <a href="#">Settings</a>
      <a href="logout.php">Logout</a>
    </div>
    <div id="content">
      <h1>Welcome back, <?php echo $lecturer['Name']; ?>!</h1>
      <p >
        This is your Dashboard where you can manage your account , settings and much more.
      </p>
      
    </div>
  </body>
</html>

    
</body>
</html>
