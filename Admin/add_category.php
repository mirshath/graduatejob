<?php
include "headerFiles/header.php";
// include "Database/connection.php";
include '../Database/connection.php';

// add category PHP code 
if (isset($_POST['category_adding_btn'])) {
    $category_name = $_POST['category_name'];

    // Handle image upload
    $target_dir = "uploads/category_image/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $image_name = basename($_FILES["category_image"]["name"]);
    $target_file = $target_dir . $image_name;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["category_image"]["tmp_name"]);
    if ($check === false) {
        $_SESSION['message'] = "File is not an image.";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }

    // Check if file already exists
    // if (file_exists($target_file)) {
    //     $_SESSION['message'] = "Sorry, file already exists.";
    //     header("Location: " . $_SERVER['PHP_SELF']);
    //     exit;
    // }

    // Check file size (5MB maximum)
    // if ($_FILES["category_image"]["size"] > 5000000) {
    //     $_SESSION['message'] = "Sorry, your file is too large.";
    //     header("Location: " . $_SERVER['PHP_SELF']);
    //     exit;
    // }

    // Allow certain file formats
    $allowed_types = array("jpg", "png", "jpeg", "gif");
    if (!in_array($imageFileType, $allowed_types)) {
        $_SESSION['message'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }

    // Try to upload file
    if (!move_uploaded_file($_FILES["category_image"]["tmp_name"], $target_file)) {
        $_SESSION['message'] = "Sorry, there was an error uploading your file.";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }

    // Insert category and image name into the database
    $sql = "INSERT INTO category (category_name, category_image) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        $_SESSION['message'] = "Error preparing statement: " . $conn->error;
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
    $stmt->bind_param("ss", $category_name, $image_name);

    if ($stmt->execute() === TRUE) {
        $_SESSION['message'] = "Category added successfully";
    } else {
        $_SESSION['message'] = "Error adding category: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!-- Page Wrapper -->
<div id="wrapper">

    <?php require "nav.php"; ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <?php include("topNav.php"); ?>

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Categories</h1>

                <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addJobModal">Add New Job</button>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Category Listing</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Category Name</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Fetch data from the database
                                    $sql = "SELECT * FROM category ORDER BY id DESC";
                                    $sql_run = mysqli_query($conn, $sql);

                                    // Check if there are any results
                                    if ($sql_run->num_rows > 0) {
                                        // Output data rows
                                        while ($row = mysqli_fetch_array($sql_run)) {
                                    ?>
                                            <tr>
                                                <td> <?= $row["category_name"]; ?></td>
                                                <td> <?= $row["created_at"]; ?></td>
                                                <td>
                                                    <!-- Edit and View buttons -->
                                                    <a href="delete.php?type=category&id=<?= urlencode($row['category_name']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this category?')">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Add Modal -->
                <div class="modal fade" id="addJobModal" tabindex="-1" role="dialog" aria-labelledby="addJobModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addJobModalLabel">Add New Category</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Add your form for adding a new category here -->
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="category_name">Category Name</label>
                                                <input type="text" class="form-control" id="category_name" name="category_name" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="category_image">Category Image</label>
                                                <input type="file" class="form-control" id="category_image" name="category_image" required>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" name="category_adding_btn" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>

<script>
    <?php
    if (isset($_SESSION['message'])) {
    ?>
        alertify.set('notifier', 'position', 'top-right');
        alertify.success('<?= $_SESSION['message'] ?>');
    <?php
        unset($_SESSION['message']);
    }
    ?>
</script>
