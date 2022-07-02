<br>
<br>
<br>
<br>

<div class="container">
<h2>
HALAMAN UBAH PRODUK </h2>

<?php
$ambil = $koneksi->query("select * from produk where id_produk='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
?>

<form method="post" enctype="multipart/form-data">
<div class="form-group">
    <label> Nama Produk </label>
    <input type="text" class="form-control" name="nama" 
    value="<?php echo $pecah['nama_produk']; ?>">
</div>
<div class="form-group">
    <label> Harga (Rp) </label>
    <input type="number" class="form-control" name="harga"
    value="<?php echo $pecah['harga_produk']; ?>">
</div>
<div class="form-group">
    <label> Berat (gr) </label>
    <input type="number" class="form-control" name="berat"
    value="<?php echo $pecah['berat_produk']; ?>">
</div>
<div class="form-group">
    <img src=".../foto_produk/<?php echo $pecah['foto_produk'] ?>" width="200">
</div>
<div class="form-group">
    <label> Ganti Foto </label>
    <input type="file" name="foto" class="form-control">
    </div>
<div class="form-group">
    <label> Deskripsi </label>
    <textarea class="form-control" name="deskripsi" rows="10">
    <?php echo $pecah['deskripsi_produk']; ?>
    </textarea>
</div>


<button class="btn btn-primary" name="ubah">Ubah</button>
</form>

<?php
if (isset($_POST['ubah']))
{
    $namafoto = $_FILES['foto']['name'];
    $lokasifoto = $_FILES['foto']['tmp_name'];
    if(!empty($lokasifoto))
    {
        move_uploaded_file($lokasifoto, "../foto_produk/$namafoto");

        $koneksi->query("update produk set nama_produk='$_POST[nama]',
        harga_produk ='$_POST[harga]', berat_produk='$_POST[berat]',
        foto_produk='$namafoto', deskripsi_produk='$_POST[deskripsi]'
        where id_produk='$_GET[id]'");
    }
    else
    {
        $koneksi->query("update produk set nama_produk='$_POST[nama]',
        harga_produk ='$_POST[harga]', berat_produk='$_POST[berat]',
        deskripsi_produk='$_POST[deskripsi]' where id_produk='$_GET[id]'"); 
    }
    echo  "<script> alert('Data Produk Telah Dirubah'); </script>";
    echo "<script> location='index.php?halaman=produk'; </script>";
}
?>
</div>