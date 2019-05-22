<?php
require 'database.php';

$sql = 'SELECT * FROM users';
$stmt = $conn->query($sql);
?>

<?php require 'includes/header.php'; ?>
<h1 class="mt-5">CRUD Application</h1>
<p class="lead">This app allows you to create, update and delete your users.</p>
<div class="table-responsive-sm">
    <table class="table table-bordered table-dark">
        <thead>
            <tr>
                <th scope="col" class="text-white">id</th>
                <th scope="col" class="text-white">Name</th>
                <th scope="col" class="text-white">Email</th>
                <th scope="col" class="text-white">Phone Number</th>
                <th scope="col" class="text-white">Action</th>
            </tr>
        <tbody>
            <?php while($row = $stmt->fetch()) :?>
            <tr>
                <th><?php echo $row->id; ?></th>
                <th><?php echo $row->name; ?></th>
                <th><?php echo $row->email; ?></th>
                <th><?php echo $row->phone; ?></th>
                <th class="d-lg-flex justify-content-between text-center">
                    <a href="update.php?id=<?php echo $row->id; ?>" class="btn btn-primary px-5 my-3 my-lg-0 text-uppercase">Update</a>
                    <a onclick="return confirm('Are you sure you want to delete this user?')" href="delete.php?id=<?php echo $row->id; ?>" class="btn btn-danger px-5 text-uppercase">Delete</a>
                </th>
            </tr>
            <?php endwhile; ?>
        </tbody>
        </thead>
    </table>
</div>
</div>
<?php include './includes/footer.php'; ?>