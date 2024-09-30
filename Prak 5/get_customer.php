<?php

require_once('./lib/db_login.php');

// TODO 1: Ambil value dari query string parameter id
$customerId = $_GET['id'];

// TODO 2: Tuliskan dan eksekusi query untuk mendapatkan informasi customer
$query = "SELECT * FROM customers WHERE customerid = $customerId";
$result = $db->query($query);

if (!$result) {
    die("Could not query the database: <br>" . $db->error);
}

// TODO 3: Tuliskan response
while ($row = $result->fetch_object()){
    echo 'Name: ' . $row->name . '<br>';
    echo 'Address: ' . $row->address . '<br>';
    echo 'City: ' . $row->city . '<br>';
}

// TODO 4: Dealokasi variabel dan tutup koneksi database
$result->free();
$db->close();
