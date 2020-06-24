<?php 
include 'includes/session.php';
include 'includes/header.php';
include 'includes/top.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Manage Users</title>

</head>
<body>
            <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Manage Users</h1>
        

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">All Users</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Image</th>
                      <th>Email</th>
                      <th>Name</th>
                      <th>Status</th>
                      <th>Added on</th>
                      <th>Edit</th>
                    </tr>
                  </thead>
                
                  <tbody>
                    <tr>
                      <?php
                    $conn = $pdo->open();

                    try {
                      $stmt = $conn->prepare("SELECT * FROM users where status=:status and type=0");
                      $stmt->execute(['status'=>1]);
                      foreach ($stmt as $row) {
                        $image = (!empty($row['photo'])) ? '../images/' . $row['photo'] : '../images/profile.webp';
                        $status = ($row['status']) ? '<span class="label label-success">active</span>' : '<span class="label label-danger">not verified</span>';
                        $active = (!$row['status']) ? '<span class="pull-right"><a href="#activate" class="status" data-toggle="modal" data-id="' . $row['id'] . '"><i class="fa fa-check-square-o"></i></a></span>' : '';
                        echo "
                          <tr>
                            <td>
                              <img src='" . $image . "' height='30px' class='img-circle' width='30px'>
                              <span class='pull-right'><a href='#edit_photo' class='photo' data-toggle='modal' data-id='" . $row['id'] . "'><i class='fa fa-edit'></i></a></span>
                            </td>
                            <td>" . $row['email'] . "</td>
                            <td>" . $row['firstname'] . ' ' . $row['lastname'] . "</td>
                                                        <td><h5 style='background:green;text-align:center;color:white;border-radius:20px;'>" .  $status. "</h5>
                                                            <h5 style='background:red;text-align:center;color:white;border-radius:20px;'>   " . $active . "</h5>     
                                                        </td>

                            <td>" . date('M d, Y', strtotime($row['created_on'])) . "</td>
                            <td>
                             
                              <button class='btn btn-success btn-sm edit btn-flat'  id='quickview' data-id='" . $row['id'] . "'><i class='fa fa-edit'></i> Edit</button>
                              <button class='btn btn-danger btn-sm delete btn-flat'  data-id='" . $row['id'] . "'><i class='fa fa-trash'></i> Delete</button>
                            </td>
                          </tr>
                        ";
                      }
                    } catch (PDOException $e) {
                      echo $e->getMessage();
                    }

                    $pdo->close();
                    ?>
                    </tr>
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
          <a href=" #addnew" id="a-plus" data-toggle="modal"><i class="fa fa-plus"></i></a>

            <?php include 'includes/user_modal.php'; ?>

        <script>
                $(function() {

      $(document).on('click', '.edit', function(e) {
        e.preventDefault();
        $('#edit').modal('show');
        var id = $(this).data('id');
        getRow(id);
      });
}
        </script>
</body>
</html>