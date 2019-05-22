<?php
require 'database.php';

// Initialize errors variables
$successMsg = $errorMsg ='';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    if (!empty($name) && !empty($email) && !empty($phone)) {
        $sql ='INSERT INTO users(name, email, phone) VALUES(:name, :email, :phone)';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['name' => $name, 'email' => $email, 'phone' => $phone]);
        $successMsg = 'User ' . $name . ' has been created';
    }  else {
        $errorMsg = 'Please fill in all fields';
    }
}
// // Define errors variables and set to empty values
// $nameError = $emailError = $phoneError = '';

// function cleanData($data) {
//     $data = trim($data);
//     $data = stripslashes($data);
//     $data = htmlspecialchars($data);
//     return $data;
// }

// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     echo 'running';
//     if (empty($_POST['name'])) {
//        echo $nameError = 'Name is required';
//     } else {
//         $name = cleanData($_POST['name']);

//         // Validate name
//         if (!preg_match('/^[a-zA-Z ]*$/', $name)) {
//             $nameError = 'Only letters and white space allowed';
//         }
//     }

//     // Validate email
//     if (empty($_POST['email'])) {
//         $emailError = 'Email is required';
//     } else {
//         $email =  cleanData($_POST['email']);

//          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//             $nameError = 'Invalid email format';
//         }
//     }

//      // Validate mobile number
//     if (empty($_POST['phone'])) {
//         $phoneError = 'Phone number is required';
//     } else {
//         $phone =  cleanData($_POST['phone']);

//         if (!preg_match('/^[0-9]{10}+$/', $phone)) {
//             $phoneError = 'Only numbers allowed';
//         }
//         if (strlen($phone) < 10) {
//             $phoneError = 'Phone number must contain 10 digits';
//         }
//     }
// }

?>
<?php require 'includes/header.php'; ?>
<form action="" method="post" class="mx-auto mt-5 pt-5">
    <?php if(!empty($errorMsg)) : ?>
    <div class="bg-danger text-white py-2 rounded text-center"><?php echo $errorMsg; ?></div>
    <?php elseif(!empty($successMsg)) :?>
    <div class="bg-success text-white py-2 rounded text-center"><?php echo $successMsg; ?></div>
    <?php endif; ?>
    <h1 class="mt-5">Create Your User</h1>
    <p class="lead">Please fill in the fields below to Create your user</p>
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Enter full Name">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" name="email" id="email" placeholder="someone@youremail.com">
    </div>
    <div class="form-group">
        <label for="phone">Phone Number</label>
        <input type="phone" class="form-control" name="phone" id="phone" placeholder="xxx-xxx-xxxx">
    </div>
    <button type="submit" class="btn btn-primary btn-lg btn-block">Create User</button>
</form>

<?php require './includes/footer.php'; ?>