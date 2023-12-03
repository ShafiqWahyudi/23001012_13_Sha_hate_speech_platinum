<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
</head>
<body>

<div class="container mt-5">
<table id="example" class="table table-striped" style="width: 100%;">

<thead>
    <tr>
        <th>NIK</th>
        <th>Name</th>
        <th>Place</th></th>
        <th>Date</th>
        <th>Phone</th>
        <th>Paying Method</th>
        <th>Action</th>
    </tr>
</thead>

<?php
    include "config.php";
    $no=1;
    $ambildata = mysqli_query($conn, "SELECT * FROM form");
    while ($tampil = mysqli_fetch_array($ambildata)) {
        echo"
            <tbody>
            <tr>
                <td>$tampil[Id]</td>
                <td>$tampil[name]</td>
                <td>$tampil[place]</td>
                <td>$tampil[date]</td>
                <td>$tampil[phone]</td>
                <td>$tampil[bayar]</td>
                <td><a href='update.php?kode=$tampil[Id]' class='btn btn-success'>Update</a> <a href='?kode=$tampil[name]' class='btn btn-danger'>Delete</a></td>
                
            </tr>
            </tbody>";

            $no++;
    }
?>

    <tfoot>
        <tr>
            <th>NIK</th>
            <th>Name</th>
            <th>Place</th>
            <th>Date</th>
            <th>Phone</th>
            <th>Paying Method</th>
        </tr>
    </tfoot>
</table>

<?php
if (isset($_GET['kode'])) {
    mysqli_query($conn, "DELETE FROM form WHERE name='$_GET[kode]'");

    echo "<meta http-equiv=refresh content=2;URL='dashboard.php'>";
}
?>
</div>



<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function () {
    $('#example').DataTable();
});
</script>
</body>
</html>

