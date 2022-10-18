<?php 
require_once('db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title> Users list </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-3">
  <h2>User List</h2>
  
  <table class="table table-striped">
    <thead>
      <tr>
        <th>S.no</th>
        <th>Name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Gender</th>
        <th>Images</th>
        <th>Date</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        <?php
            $stmt = $conn->prepare("SELECT * FROM users ORDER BY id DESC");
            $stmt->execute();
            $data = $stmt->fetchAll();
            $i = 1;
            foreach($data as $row){ ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= $row['name']; ?></td>
                <td><?= $row['email']; ?></td>
                <td><?= $row['mobile']; ?></td>
                <td><?= $row['gender']; ?></td>
                <td><?= $row['images']; ?></td>
                <td><?= $row['created_on']; ?></td>
                <td><button class="btn btn-danger btn-sm">Delete</button></td>
                
            </tr>
        <?php } ?>
    </tbody>
  </table>
</div>

</body>
</html>