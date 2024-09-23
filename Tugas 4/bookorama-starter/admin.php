<!--
    Saat kita panggil file admin.php tanpa melakukan login terlebih dahulu,
    file admin.php tidak dapat ditampilkan.
    Hal ini dikarenakan saat kita memanggil file admin.php,
    kita akan lakukan pengecekan terhadap session 'username'.
    Yang mana session tersebut baru akan diset setelah kita berhasil login.
    Sehingga jika tidak melakukan login terlebih dahulu,
    session 'username' akan tidak ter-set sehingga kita akan ter-redirect
    ke halaman login.php berdasarkan kondisional yang dibuat.

    Seteleah diklik logout pada file admin.php, lalu panggil kembali file admin.php,
    file admin.php tidak dapat ditampilkan.
    Hal ini karena saat kita klik logout, kita akan meng-unset session 'username' lalu
    menghancurkan session-nya. Sehingga ketika kita memanggil kembali file admin.php,
    maka kita akan ter-redirect ke halaman login.php.
-->

<?php 
// TODO 1: Inisialisasi session
session_start();

// TODO 2: Periksa apakah session dengan key username terdefinisi
if(!isset($_SESSION['username'])){
    header('Location: login.php');
    exit;
}

include('./header.php');
?>
<br>
<div class="card">
    <div class="card-header">Admin Page</div>
    <div class="card-body">
        <p>Welcome...</p>
        <p>You are logged in as <b><?= $_SESSION['username']; ?></b></p>
        <br><br>
        <a class="btn btn-primary" href="logout.php">Logout</a>
    </div>
</div>
<?php include('./footer.php') ?>