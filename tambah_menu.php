<?php
error_reporting(E_ALL & ~E_NOTICE);
@include 'config.php';

if (isset($_POST['tambah_menu'])) {

    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $gambar = $_FILES['gambar']['name'];
    $nama_gambar = $_FILES['gambar']['tmp_name'];
    $folder_gambar = 'uploaded_img/' . $gambar;

    if (empty($nama) || empty($harga) || empty($gambar)) {
        $message[] = 'tolong isi semua kolom';
    } else {
        $insert = "INSERT INTO produk(nama, harga, gambar) VALUES('$nama', '$harga', '$gambar')";
        $upload = mysqli_query($conn, $insert);
        if ($upload) {
            move_uploaded_file($nama_gambar, $folder_gambar);
            $message[] = 'Menu baru berhasil ditambahkan';
        } else {
            $message[] = 'Tidak bisa menambahkan menu baru';
        }
    }
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tambah menu</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">



</head>

<body>

    <?php

    if (isset($message)) {
        foreach ($message as $message) {
            echo '<span class="message">' . $message . '</span>';
        }
    }

    ?>

    <div class="container">

        <div class="admin-product-form-container">

            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                <h3>Menambahkan menu</h3>
                <input type="text" placeholder="Masukan nama menu" name="nama" class="box">
                <input type="number" placeholder="Masukkan harga" name="harga" class="box">
                <input type="file" accept="image/png, image/jpeg, image/jpg" name="gambar" class="box">
                <input type="submit" class="btn" name="tambah menu" value="tambah menu">
            </form>

        </div>

        <?php

        $select = mysqli_query($conn, "SELECT * FROM produk");

        ?>
        <div class="product-display">
            <table class="product-display-table">
                <thead>
                    <tr>
                        <th>Gambar Produk</th>
                        <th>Nama Produk</th>
                        <th>Harga Produk</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <?php while ($row = mysqli_fetch_assoc($select)) { ?>
                    <tr>
                        <td><img src="uploaded_img/<?php echo $row['gambar']; ?>" height="100" alt=""></td>
                        <td><?php echo $row['nama']; ?></td>
                        <td>Rp.<?php echo $row['harga']; ?></td>
                        <td>
                            <a href="edit_menu.php?edit=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-edit"></i> edit </a>
                            <a href="delete.php?delete=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-trash"></i> delete </a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
            <br><br>
            <a href="index.php" class="back"> Kembali</a>
        </div>

    </div>


</body>

</html>