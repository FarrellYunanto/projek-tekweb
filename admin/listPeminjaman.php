<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script>
	var btn_getPeminjaman = document.querySelector("#btn_getPeminjaman");

	function get_request(url, callback) {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				callback(JSON.parse(this.responseText));
			}
		};
		xhttp.open("GET", url, true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send();
	}

	if (btn_getPeminjaman) {
		btn_getPeminjaman.addEventListener("click", () => {
			get_request(
				"http://localhost/projektekweb/admin/ajax.php",
				(response) => {
					var tbl = document.querySelector("#tbl_peminjaman > tbody");
					var tbl_res = '';
					response.forEach((row) => {
						var keterangan = row['keterangan'];
						tbl_res += `<tr>
							<td>${row['id_peminjaman']}</td>
							<td>${row['id_ruangan']}</td>
							<td>${row['id_user']}</td>
							<td>${row['id_admin']}</td>
                            <td>${row['tanggal_peminjaman']}</td>
                            <td>${row['start']}</td>
                            <td>${row['end']}</td>
                            <td> ${keterangan[0]} </td>
                            <td> ${keterangan[1]}</td>
							<td>
							<a class="btn btn-danger" href="delete.php?id_peminjaman=${row['id_peminjaman']}">Delete</a>
							</td>
						</tr>`
					});
					tbl.innerHTML = tbl_res;
				});
		});
	}
</script>

</html>