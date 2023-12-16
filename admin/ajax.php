<?php
require "peminjaman.php";

if ($_SERVER['REQUEST_METHOD'] == "GET") {
	$data_peminjaman = Peminjaman::get_all();

	$result = [
		"msg" => "",
		"data" => $data_peminjaman
	];

	echo json_encode($data_peminjaman);
}