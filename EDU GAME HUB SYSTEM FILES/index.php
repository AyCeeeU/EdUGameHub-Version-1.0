<?php
session_start();
include("db_conn.php");

// Check if the user is logged in and is an admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {  
    header("HTTP/1.0 403 Forbidden");
    header("Location: Login1.php");
    exit;
}

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
  <title>Admin Panel</title>
</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container">
    <a class="navbar-brand" href="#">
      <img src="images/admin.png" width="30" height="30" class="d-inline-block align-top" alt="">
      Admin Panel
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
       
        <li class="nav-item">
        <form method="post" action="logout.php">
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
            <h2 class="text-center">EduGame Hub Admin Panel</h2>
            <hr>
          </div>
          <div class="col-md-3 float-left add-new-button">
            <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#addModal">
              <i class="fas fa-plus"></i> Add New Record
            </a>
          </div>

          <?php
    include_once 'db_conn.php';
if(!empty($_GET['status'])){
    switch($_GET['status']){
        case 'succ':
            $statusType = 'alert-success';
            $statusMsg = 'Members data has been imported successfully.';
            break;
        case 'err':
            $statusType = 'alert-danger';
            $statusMsg = 'Some problem occurred, please try again.';
            break;
        case 'invalid_file':
            $statusType = 'alert-danger';
            $statusMsg = 'Please upload a valid CSV file.';
            break;
        default:
            $statusType = '';
            $statusMsg = '';
    }
}    

?>

          <!-- Import Export Button -->
          <div class="col-md-12 head">
    <div class="float-right">
    <a href="archive.php" class="btn btn-dark">Visit Archive</a>

        <a href="exportData.php" class="btn btn-success"><i class="dwn"></i> Export</a>
        <a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm');"><i class="plus"></i> Upload CSV</a>
    </div>
</div>

    <div class="col-md-12" id="importFrm" style="display: none;">
        <form action="importData.php" method="post" enctype="multipart/form-data">
            <input type="file" name="file" />
            <input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
        </form>
    </div>
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
                <th>Active Status</th>
                <th>Days Since Last Login</th>  
                <th>View</th>
                <th>Update</th>
                <th>Archive</th>
              </tr>
            </thead>
            <tbody>

            <?php
//  the inactivity threshold (60 days)
$inactivityThreshold = 60;

// Calculate the date 60 days ago
$thresholdDate = date('Y-m-d H:i:s', strtotime("-$inactivityThreshold days"));

$sql = "SELECT
    u.id,
    u.firstname,
    u.lastname,
    u.email,
    u.username,
    u.section,
    u.grade_level,
    u.account_type,
    u.password,
    u.created_date,
    CASE
        WHEN a.last_login_timestamp IS NULL THEN 'Inactive'
        WHEN a.last_login_timestamp < '$thresholdDate' THEN 'Inactive'
        ELSE 'Active'
    END AS activity_status,
    DATEDIFF(NOW(), a.last_login_timestamp) AS days_since_last_login
FROM
    tbl_accdb u
LEFT JOIN
    (SELECT user_id, MAX(CASE WHEN action = 'Login' THEN timestamp ELSE NULL END) AS last_login_timestamp
     FROM tbl_activity_log
     GROUP BY user_id
    ) a
ON
    u.id = a.user_id";

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
        <td><?php echo $row['activity_status']; ?></td>
        <td><?php echo $row['days_since_last_login']; ?> Days Ago</td>

        <td>
            <button type="button" class="btn btn-info viewBtn"> <i class="fas fa-eye"></i> View </button>
        </td>
        <td>
            <button type="button" class="btn btn-warning updateBtn"> <i class="fas fa-edit"></i> Update </button>
        </td>
        
        <td>
            <!-- Archive Button -->
            <button type="button" class="btn btn-danger archiveBtn" data-toggle="modal" data-target="#archiveModal" data-record-id="<?php echo $row['id']; ?>">
                <i class="fas fa-archive"></i> Archive
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

  <!-- ADD RECORD MODAL -->
  <div class="modal fade" id="addModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Add New Record</h5>
                <button class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="insert.php" method="POST">
    <div class="form-group">
        <label for="title">First Name</label>
        <input type="text" name="firstname" class="form-control" placeholder="Enter first name" maxlength="50" required>
    </div>
    <div class="form-group">
        <label for="title">Last Name</label>
        <input type="text" name="lastname" class="form-control" placeholder="Enter last name" maxlength="50" required>
    </div>
    <div class="form-group">
        <label for="title">Email</label>
        <input type="text" name="email" class="form-control" placeholder="Enter email" maxlength="50" required>
    </div>
    <div class="form-group">
        <label for="title">Username</label>
        <input type="text" name="username" class="form-control" placeholder="Enter username" maxlength="50" required>
    </div>
    <!-- Dropdown Menu -->
    <div class="form-group">
        <label for="section">Section</label>
        <select name="section" class="form-control">
            <option value="section" disabled selected>Select Section</option>
            <option value="Saphire">Saphire</option>
            <option value="Mercury">Mercury</option>
            <option value="Venus">Venus</option>
            <option value="Saturn">Saturn</option>
        </select>
    </div>
    <div class="form-group">
        <label for="grade_level">Grade Level</label>
        <select name="grade_level" class="form-control">
            <option value="grade_level" disabled selected>Select Grade Level</option>
            <option value="Grade 3">Grade 3</option>
            <option value="Grade 4">Grade 4</option>
            <option value="Grade 5">Grade 5</option>
            <option value="Grade 6">Grade 6</option>
        </select>
    </div>
    <div class="form-group">
        <label for="account_type">Account Type</label>
        <select name="account_type" id="accountTypeSelect" class="form-control" required>
    <option value="" disabled selected>Select Account Type</option>
    <option value="Admin">Admin</option>
    <option value="Teacher">Teacher</option>
    <option value="Student">Student</option>
</select>
    </div>  
    <div class="form-group">
        <label for="title">Password</label>
        <input type="password" name="password" class="form-control" placeholder="Enter Password" maxlength="50" required>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="insertData">Save</button>
    </div>
</form>
            </div>
        </div>
    </div>
</div>

  <!-- VIEW MODAL -->
  <div class="modal fade" id="viewModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header bg-info text-white">
          <h5 class="modal-title">View Record Information</h5>
          <button class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-5 col-xs-6 tital " >
              <strong>First Name:</strong>
            </div>
            <div class="col-sm-7 col-xs-6 ">
              <div id="viewFirstname"></div>
            </div>
            <div class="col-sm-5 col-xs-6 tital " >
              <strong>Last Name:</strong>
            </div>
            <div class="col-sm-7 col-xs-6 ">
              <div id="viewLastname"></div>
            </div>
            <div class="col-sm-5 col-xs-6 tital " >
              <strong>Email:</strong>
            </div>
            <div class="col-sm-7 col-xs-6 ">
              <div id="viewEmail"></div>
            </div>
            <div class="col-sm-5 col-xs-6 tital " >
              <strong>Username:</strong>
            </div>
            <div class="col-sm-7 col-xs-6 ">
              <div id="viewUsername"></div>
            </div>
            <div class="col-sm-5 col-xs-6 tital " >
              <strong>Section:</strong>
            </div>
            <div class="col-sm-7 col-xs-6 ">
              <div id="viewSection"></div>
            </div>
            <div class="col-sm-5 col-xs-6 tital " >
              <strong>Grade Level:</strong>
            </div>
            <div class="col-sm-7 col-xs-6 ">
              <div id="viewGradeLevel"></div>
              </div>
            <div class="col-sm-5 col-xs-6 tital " >
              <strong>Account Type:</strong>
            </div>
            <div class="col-sm-7 col-xs-6 ">
              <div id="viewAccountType"></div>
              </div>
              
            
              
            <div class="col-sm-5 col-xs-6 tital " >
              <strong>Created Date:</strong>
            </div>
            <div class="col-sm-7 col-xs-6 ">
              <div id="viewCreatedDate"></div>
              
            </div>          
          </div>
          <br>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>

    <!-- UPDATE MODAL -->
    <div class="modal fade" id="updateModal">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header bg-warning text-white">
            <h5 class="modal-title">Edit Record</h5>
            <button class="close" data-dismiss="modal">
              <span>&times;</span>
            </button>
          </div>

          
          <div class="modal-body">
            <form action="update.php" method="POST">
              <input type="hidden" name="updateId" id="updateId">
              <div class="form-group">
                <label for="title">First Name</label>
                <input type="text" name="updateFirstname" id="updateFirstname" class="form-control" placeholder="Enter first name" maxlength="50"
                  >
              </div>
              <div class="form-group">
                <label for="title">Last Name</label>
                <input type="text" name="updateLastname" id="updateLastname" class="form-control" placeholder="Enter last name" maxlength="50"
                  >
              </div>
              <div class="form-group">
                <label for="title">Email</label>
                <input type="text" name="updateEmail" id="updateEmail" class="form-control" placeholder="Enter Email Address" maxlength="50"
                  >
              </div>
              <div class="form-group">
                <label for="title">Username</label>
                <input type="text" name="updateUsername" id="updateUsername" class="form-control" placeholder="Enter Username" maxlength="50"
                  >
              </div>
              <div class="form-group">
                <label for="title">Section</label>
                <input type="text" name="updateSection" id="updateSection" class="form-control" placeholder="Enter Section" maxlength="50" >
              </div>
              <div class="form-group">
                <label for="title">Grade Level</label>
                <input type="text" name="updateGradeLevel" id="updateGradeLevel" class="form-control" placeholder="Enter Grade Level" maxlength="50"
                  >
              </div>
              <div class="form-group">
                <label for="title">Account Type</label>
                <input type="text" name="updateAccountType" id="updateAccountType" class="form-control" placeholder="Enter Account Type" maxlength="50"
                  >
              </div>
              <div class="form-group">
    <label for="title">Password</label>
    <div class="input-group">
        <input type="password" name="updatePassword" id="updatePassword" class="form-control" placeholder="Enter Password" maxlength="50">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                <i class="fa fa-eye" id="eyeIcon"></i>
            </button>
        </div>
    </div>
</div>
              <div class="form-group">
                <label for="title">Created Date</label>
                <input type="text" name="updateCreatedDate" id="updateCreatedDate" class="form-control" placeholder="Enter Created Date" maxlength="50"
                  >
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary" name="updateData">Save Changes</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  <!-- DELETE MODAL 
  <div class="modal fade" id="deleteModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="exampleModalLabel">Delete Record</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="delete.php" method="POST">

          <div class="modal-body">

            <input type="hidden" name="deleteId" id="deleteId">

            <h4>Are you sure want to delete?</h4>

          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
          <button type="submit" class="btn btn-primary" name="deleteData">Yes</button>
        </div>

        </form>
      </div>
    </div>
  </div>-->



<!-- Archive Modal -->
<div class="modal fade" id="archiveModal" tabindex="-1" role="dialog" aria-labelledby="archiveModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title" id="archiveModalLabel">Archive Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="archive.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="archiveId" id="archiveId">
                    <h4>Are you sure you want to archive this record?</h4>
                    <p>This action will move the record to the archive.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning" name="archiveData">Archive</button>
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
 let dropdown = document.getElementById('yourDropdownId'); // Replace 'yourDropdownId' with the actual ID
  let optionList = dropdown.querySelector('.option-list');
  let icon = dropdown.querySelector('.icon');

  dropdown.onclick = function () {
    optionList.classList.toggle('active');
    icon.innerHTML = "&#9660";
  };
for(op of options){
op.onclick = function(){
selectEle.innerText = this.innerText
optionList.classList.toggle('active');
icon.innerHTML ="&#9650"
}
}
</script>

<script>
$(document).ready(function () {
    //  the click event of the "Archive" button
    $('.archiveBtn').on('click', function () {
      
        var recordId = $(this).data('record-id');

        $('#archiveId').val(recordId);
    });
});


</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.querySelector("form");
        const accountTypeSelect = document.getElementById("accountTypeSelect");

        form.addEventListener("submit", function(event) {
            if (accountTypeSelect.value === "account_type") {
                event.preventDefault();
                alert("Please select an account type.");
            }
        });
    });
</script>



  <script>
function formToggle(ID){
    var element = document.getElementById(ID);
    if(element.style.display === "none"){
        element.style.display = "block";
    }else{
        element.style.display = "none";
    }
}
</script>


  <script>
    $(document).ready(function () {
      $('.updateBtn').on('click', function(){

        $('#updateModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        console.log(data);

        $('#updateId').val(data[0]);
        $('#updateFirstname').val(data[1]);
        $('#updateLastname').val(data[2]);
        $('#updateEmail').val(data[3]);
        $('#updateUsername').val(data[4]);
        $('#updateSection').val(data[5]);
        $('#updateGradeLevel').val(data[6]);
        $('#updateAccountType').val(data[7]);
        //$('#updatePassword').val(data[8]);
        $('#updateCreatedDate').val(data[9]);
                  

        });
        
    });
  </script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const passwordInput = document.getElementById('updatePassword');
        const eyeIcon = document.getElementById('eyeIcon');

        document.getElementById('togglePassword').addEventListener('click', function () {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        });
    });
</script>



  <script>
    
    $(document).ready(function () {
      $('.viewBtn').on('click', function(){

        $('#viewModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        console.log(data);

        $('#viewFirstname').text(data[1]);
        $('#viewLastname').text(data[2]);
        $('#viewEmail').text(data[3]);
        $('#viewUsername').text(data[4]);
        $('#viewSection').text(data[5]);
        $('#viewGradeLevel').text(data[6]);
        $('#viewAccountType').text(data[7]);
        $('#viewCreatedDate').text(data[9]);              

        });
    
    });
  </script>

  <script>
    $(document).ready(function () {
      $('.deleteBtn').on('click', function(){

        $('#deleteModal').modal('show');
        
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        console.log(data);

        $('#deleteId').val(data[0]);

        });
    
    });
  </script>

  <script>
    $(document).ready(function () {
        //  the click event of the "Archive" button
        $('.archiveBtn').on('click', function () {
            var recordId = $(this).data('record-id');
            
            $('#archiveId').val(recordId);
        });
    });
</script>



</body>

</html>