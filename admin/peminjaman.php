<?php

class Peminjaman
{
	private $row = null;
 
	public function __construct($id_peminjaman = null)
	{
		$conn = Peminjaman::get_db_connection();
		$query = "";
		if ($id_peminjaman) {
			$query = "SELECT * FROM peminjaman WHERE id_peminjaman = " . $id_peminjaman;
		}

		if ($query != "") {
			$stmt = $conn->query($query);
			$this->row = $stmt->fetch();
		}
	}

	public function delete()
	{
		$q = "DELETE FROM peminjaman WHERE id_peminjaman = " . $this->row['id_peminjaman'] . ";";
		$res = Peminjaman::get_db_connection()->exec($q);
		return $res;
	}

	public static function get_all()
	{
		$conn = Peminjaman::get_db_connection();
		$query = "SELECT * FROM peminjaman ORDER BY tanggal_peminjaman";
		$stmt = $conn->query($query);
		return $stmt->fetchAll();
	}

	protected static function get_db_connection()
	{
		$servername = "localhost";
		$username = "root";
		$password = "";
		$database = "projektekweb";
		$conn = null;
	
		try {
			$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $conn;
		} catch (PDOException $e) {
			echo "Connection failed: " . $e->getMessage();
			die;
		}
	}
}