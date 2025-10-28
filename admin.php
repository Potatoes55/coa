<?php $koneksi=mysqli_connect("localhost","root","","cobajoin"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>laman admin</title>
</head>
    <h4>tambah mahasiswa</h4>
    <form method="POST">
        <input type="text" name="nama_mhs" placeholder="masukan nama mhs">
        <input type="text" name="nim" placeholder="masukan nim mhs">
        <select name="prodi">
            <option value="">--pilih prodi--</option>
            <option value="informatika">informatika</option>
            <option value="agribisnis">agribisnis</option>
            <option value="teknin mesin">teknik mesin</option>
        </select>
        <?php  $query_mk="SELECT * FROM matkul";
               $result_mk=mysqli_query($koneksi,$query_mk);
               ?>
        <select name="kode_mk">
            <option value="">--pilih matkul--</option>

            <?php 
            while($mk=mysqli_fetch_assoc($result_mk)){
                ?>
                <option value=<?="{$mk['kode_mk']}"?>><?="{$mk['nama_matkul']}"?></option>
                <?php
            }
            ?>
        </select>
        <button type="submit" name="tambah_mhs">tambah</button>
    </form>
    <?php if(isset($_POST['tambah_mhs'])){
        $nama_mhs=mysqli_real_escape_string($koneksi,$_POST['nama_mhs']);
        $nim=mysqli_real_escape_string($koneksi,$_POST['nim']);
        $prodi=mysqli_real_escape_string($koneksi,$_POST['prodi']);
        $kode_mk=mysqli_real_escape_string($koneksi,$_POST['kode_mk']);

        $sql="INSERT INTO mhs (nim,nama_mhs,prodi,kode_mk)
                VALUES ('$nim','$nama_mhs','$prodi','$kode_mk')";
    
    if(mysqli_query($koneksi,$sql)) {
        
    } else
        echo"error" . $sql . "<br>" . mysqli_error($koneksi);

    }
    
    
    ?>

<!-- query tampil data -->
<body>
    <table border="1">
    <h4>tabel mahasiswa</h4>
    <tr>
        <th>nama</th>
        <th>nim</th>
        <th>prodi</th>
        <th>matkul</th>
        <th>dosen</th>
    </tr>

    <?php 
        $query="SELECT * FROM mhs,matkul,dosen WHERE mhs.kode_mk = matkul.kode_mk AND matkul.id_dosen = dosen.id_dosen";
        $result=mysqli_query($koneksi,$query);
        while($ambil=mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?= $ambil['nama_mhs']?></td>
                <td><?= $ambil['nim']?></td>
                <td><?= $ambil['prodi']?></td>
                <td><?= $ambil['nama_matkul']?></td>
                <td><?= $ambil['nama_dosen']?></td>

            </tr>

<?php
        }
    
    
    
    ?>

</table>

<br>

<!-- dosen -->

<h3>masukan dosen pengampu</h3>
<form method="POST">
    <input type="text" name="nama_dosen" placeholder="masukan nama dosen">
    <input type="text" name="id_dosen" placeholder="masukan id dosen">
   
    </select>
    <button type="submit" name="tambah_dosen">tambah</button>
    <?php
    if(isset($_POST['tambah_dosen'])) {
        $nama_dosen=mysqli_real_escape_string($koneksi,$_POST['nama_dosen']);
        $id_dosen=mysqli_real_escape_string($koneksi,$_POST['id_dosen']);
       

        $sql="INSERT INTO dosen (id_dosen,nama_dosen)
            VALUES ('$id_dosen','$nama_dosen')";

            if(mysqli_query($koneksi,$sql)) {

            } else
            echo "error" . $sql . "<br>" . mysqli_error($koneksi);
    }


    ?>


<!-- tabel -->
</form>
<table border="1">
    <h4>tabel dosen</h4>
    <tr>
        <th>nama dosen</th>
        <th>id dosen</th>
        <th>matkul diampu</th>
        <th>nama mahasiswa</th>
    </tr>

<?php 
    $query_dosen="SELECT * from mhs,matkul,dosen WHERE mhs.kode_mk = matkul.kode_mk AND matkul.id_dosen = dosen.id_dosen";
    $result_dosen=mysqli_query($koneksi,$query_dosen);

    while($ambil_dosen=mysqli_fetch_assoc($result_dosen)) {
        ?>
        
            <tr>
                <td><?="{$ambil_dosen['nama_dosen']}"?></td>
                <td><?="{$ambil_dosen['id_dosen']}"?></td>
                <td><?="{$ambil_dosen['nama_matkul']}"?></td>
                <td><?="{$ambil_dosen['nama_mhs']}"?></td>

            </tr>

        
        <?php
    }
    ?>

</table>
<br>

<!-- matkul -->
 <br>

 <h4>masukan matkul</h4>
<form method="POST">
    <input type="text" name="kode_mk" placeholder="masukan kode matkul">
    <input type="text" name="nama_matkul" placeholder="masukan matkul">

    <?php
     $matkul="SELECT * FROM dosen";
     $result_matkul=mysqli_query($koneksi,$matkul);
     ?>

     <select name="dosen">   
     <option value="">dosen pengampu</option>

     <?php 
     while($ambil_mk=mysqli_fetch_assoc($result_matkul)) {
        ?>
        <option value=<?="{$ambil_mk['id_dosen']}"?>><?="{$ambil_mk['nama_dosen']}"?></option>

        <?php
     }
     
     ?>

     </select>
     <button type="submit" name="tambah_matkul">tambah</button>

     <?php
     if (isset($_POST['tambah_matkul']))  {
        $nama_matkul=mysqli_real_escape_string($koneksi,$_POST['nama_matkul']);
        $id_dosen=mysqli_real_escape_string($koneksi,$_POST['id_dosen']);
        $kode_matkul=mysqli_real_escape_string($koneksi,$_POST['kode_mk']);

        $sql="INSERT INTO matkul (kode_mk,nama_matkul,id_dosen)
                VALUES ('$kode_matkul','$nama_matkul','$id_dosen')";
        
        if(mysqli_query($koneksi,$sql)) {

        } else 
        echo "error" . $sql . "<br>" . mysqli_error($koneksi);
     }

?>

</form>
<!-- tabel -->
<table border="1"> 
    <h4>tabel matkul</h4>
    <tr>
        <th>kode matakul</th>
        <th>nama matkul</th>
        <th>dosen pengampu</th>
    </tr>
    
    <?php 
    $query_matkul="SELECT * FROM matkul,dosen WHERE matkul.id_dosen = dosen.id_dosen";
    $result=mysqli_query($koneksi,$query_matkul);

    while($hasil=mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?="{$hasil['kode_mk']}"?></td>
                <td><?="{$hasil['nama_matkul']}"?></td>
                <td><?="{$hasil['nama_dosen']}"?></td>

            </tr>

            <?php
    }
    ?>


</body>
</html>