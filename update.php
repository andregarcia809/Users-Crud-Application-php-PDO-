<?php
    require 'database.php';

    // Get user by id
    if (isset($_GET['id'])) {
        // validate URL parameter
       if ($id = filter_var($_GET['id'], FILTER_VALIDATE_INT))  {
            $sql = 'SELECT * FROM users WHERE id = :id';
            $stmt = $conn->prepare($sql);
            $stmt->execute(['id' => $id]);
            $user = $stmt->fetch();
        } else {
            exit('Invalid URL parameter');
        }
    }  else {
        exit('Something went wrong.');
    }

    //Update user info
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        if (!empty($name) && !empty($email) && !empty($phone)) {
            $sql = 'UPDATE users SET name = :name, email = :email, phone = :phone WHERE id = :id';
            $stmt = $conn->prepare($sql);
            $stmt->execute(['name' => $name, 'email' => $email, 'phone' => $phone, 'id' => $id]);
            $successMsg = 'User ' . $name . ' has been updated';
        }  else {
            $errorMsg = 'Oops, something went wrong';
        }
    }
?>

<?php require 'includes/header.php'; ?>
<form method="post" class="mx-auto mt-5 pt-5">
    <?php if(!empty($errorMsg)) : ?>
    <div class="bg-danger text-white py-2 rounded text-center"><?php echo $errorMsg; ?></div>
    <?php elseif(!empty($successMsg)) :?>
    <div class="bg-success text-white py-2 rounded text-center"><?php echo $successMsg; ?></div>
    <?php endif; ?>
    <h1 class="mt-5">Update Your User</h1>
    <p class="lead">Please use the form below to edit user</p>
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" id="name" value="<?php echo $user->name?>">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" name="email" id="email" value="<?php echo $user->email?>">
    </div>
    <div class="form-group">
        <label for="phone">Phone Number</label>
        <input type="phone" class="form-control" name="phone" id="phone" value="<?php echo $user->phone?>">
    </div>
    <button type="submit" class="btn btn-primary btn-lg btn-block">Update User</button>
</form>
<?php require 'includes/footer.php'; ?>