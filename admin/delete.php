<?php
require "peminjaman.php";

if (count($_GET) && isset($_GET['id_peminjaman'])) {
	$product = new Peminjaman($_GET['id_peminjaman']);
	$res = $product->delete();
	if ($res) {
		Header("Location: index.php");
	}
}