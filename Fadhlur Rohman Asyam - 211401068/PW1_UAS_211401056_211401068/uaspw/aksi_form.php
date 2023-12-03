<?php
    include("config.php");
    if (isset($_POST['submit'])) {
        $Id = $_POST['Id'];
        $name = $_POST['name'];
        $place = $_POST['place'];
        $date = $_POST['date'];
        $phone = $_POST['phone'];
        $bayar = $_POST['bayar'];

        $result = mysqli_query($conn,"INSERT INTO form values ('$Id','$name','$place','$date','$phone','$bayar')");
    }
    if ($result) {
        header ("location:index.html");
    }else {
        echo "failed";
    }

// if (isset($_POST['submit'])) {
//     $foto = $_FILES['picture']['name'];
// $lokasi = $_FILES['picture']['tmp_name'];
// $tipefile = $_FILES['picture']['type'];
// $ukuranfile = $_FILES['picture']['size'];

// $error = "";
// if ($foto == "") {
//     $query = mysqli_query($conn, "INSERT INTO form SET name = '$_POST[name]',
//         place = '$_POST[place]',
//         date = '$_POST[date]',
//         phone = '$_POST[phone]'");
// } else {
//     if ($tipefile != "image/jpeg" AND $tipefile != "image/jpg" AND $tipefile != "image/png") {
//         $error = "tipe file tidak didukung!";
//     }else if ($ukuranfile >= 1000000) {
//         echo $ukuranfile;
//         $error = 'ukuran file terlalu besar (lebih dari 1MB)!"';
//     }else {
//         move_uploaded_file($lokasi, "img/".$foto);
//         $query = mysqli_query($conn, "INSERT INTO form SET
//             picture = '$foto',
//             name = '$_POST[name]',
//             place = '$_POST[place]',
//             date = '$_POST[date]',
//             phone = '$_POST[phone]'");
//     }
// }

// if ($error != "") {
//     echo $error;
//     echo "<meta http-equiv='refresh' content='2;url=?hal=pegawai_tambah'>";
// }else if ($query) {
//     echo "Data berhasil disimpan!";
//     // echo "<meta http-equiv='refresh' content='1;url=index.html'>";
// }else {
//     echo "tidak dapat menyimpan data!<br/>";
// }
// }



