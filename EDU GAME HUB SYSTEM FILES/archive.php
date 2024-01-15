<?php
  include('db_conn.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
    integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
    integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
  <title>Admin Archive</title>
</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container">
    <a class="navbar-brand" href="#">
      <img src="images/admin.png" width="30" height="30" class="d-inline-block align-top" alt="">
      Admin Archive
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
       
        <li class="nav-item">
          <form method="post" action="Login1.php">
            <button type="submit" name="logout" class="btn btn-danger">Logout</button>
          </form>
        </li>
      </ul>
    </div>
  </div>
</nav>
  <br><br><br>

  <div class="container">
    <div class="row">
      <div class="col-md-12 card">
        <div>
          <div class="head-title">
            <h2 class="text-center">EduGame Hub Archive</h2>
            <hr>
          </div>
          
          <div class="col-md-12 head">
    <div class="float-right">
    <a href="index.php" class="btn btn-dark">Admin Panel</a>

        
    </div>
</div>

    


          <?php
include('db_conn.php');

if (isset($_POST['archiveData'])) {
  $recordId = $_POST['archiveId'];

    // Retrieve the data to be archived
    $sql = "SELECT * FROM tbl_accdb WHERE id = $recordId";
    echo $sql; // Output the query for debugging
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Insert the data into the tbl_archive table
        $insertSql = "INSERT INTO tbl_archive (id, firstname, lastname, email, username, section, grade_level, account_type, password, created_date)
                     VALUES ('{$row['id']}', '{$row['firstname']}', '{$row['lastname']}', '{$row['email']}', '{$row['username']}', '{$row['section']}', '{$row['grade_level']}', '{$row['account_type']}', '{$row['password']}', '{$row['created_date']}')";
        
        if (mysqli_query($conn, $insertSql)) {
            // Data archived successfully, now you can delete it from tbl_accdb
            $deleteSql = "DELETE FROM tbl_accdb WHERE id = $recordId";
            if (mysqli_query($conn, $deleteSql)) {
                // Record deleted successfully
                header("Location: archive.php"); // Redirect back to your main page
                exit();
            } else {
                // Error deleting the record from tbl_accdb
                echo "Error deleting record: " . mysqli_error($conn);
            }
        } else {
            // Error archiving the record
            echo "Error archiving record: " . mysqli_error($conn);
        }
    } else {
        // Record not found in tbl_accdb
        echo "Record not found in tbl_accdb";
    }
}
?>
        
       <!-- Import Export Button -->
          <br><br><br>
          <table class="table table-striped">
            <thead class="bg-secondary text-white">
              <tr>
                <th>#</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Username</th>
                <th>Section</th>
                <th>Grade Level</th>
                <th>Account Type</th>                
                <th>Created Date</th>
                <th>Delete</th>
                
              </tr>
            </thead>
            <tbody>

            <?php

              $sql =   "SELECT * FROM tbl_archive";
              $result = mysqli_query($conn, $sql);

            if($result)
            {
              while($row = mysqli_fetch_assoc($result)){
            ?>
              <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['firstname']; ?></td>
                <td><?php echo $row['lastname']; ?></td>  
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['section']; ?></td>
                <td><?php echo $row['grade_level']; ?></td>
                <td><?php echo $row['account_type']; ?></td>
                <td class="hidden-password"><?php echo $row['password']; ?></td>
                <td><?php echo $row['created_date']; ?></td>
            
                <td>
                <button type="button" class="btn btn-danger deleteBtn" data-toggle="modal" data-target="#deleteModal">
    <i class="fas fa-trash-alt"></i> Delete
</button>
                </td>
                
              </tr>
            <?php
              }
            }else{
              echo "<script> alert('No Record Found');</script>";
            }
          ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- MODALS -->
  

  <!-- DELETE MODAL -->
<div class="modal fade" id="deleteModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="exampleModalLabel">Delete Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="delete_from_archive.php" method="POST"> <!-- Set the action to an empty string -->

                <div class="modal-body">

                <input type="hidden" name="archiveId" value="<?php echo $recordId; ?>">

                    <input type="hidden" name="deleteId" id="deleteId">

                    <h4>Are you sure you want to delete this record permanently from the archive?</h4>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary" name="deleteFromArchive">Yes</button>
                </div>

            </form>
        </div>
    </div>
</div>

  <script src="http://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
    integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
    crossorigin="anonymous"></script>
  <script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>

  <script>
  $(document).ready(function () {
    $('.deleteBtn').on('click', function () {
        $('#deleteModal').modal('show');
        
        // Get the table row data.
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        console.log("Record ID to be deleted: " + data[0]); // Check if this data is correct
        console.log("archiveData value: " + $('#deleteModal input[name="archiveData"]').val()); // Check if archiveData is set correctly

        $('#deleteId').val(data[0]);
        
        // Set the archiveData field to 1
        $('#deleteModal input[name="archiveData"]').val('1'); // Set archiveData to 1
        
        console.log("Updated archiveData value: " + $('#deleteModal input[name="archiveData"]').val()); // Check if archiveData is set correctly
    });
});
</script>

</body>


</html>