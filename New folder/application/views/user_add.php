<!DOCTYPE html>
<html>
	<head>
		<title>Membuat Form</title>
	</head>
	<body>
		<center>
			<h2>Form Input data RT / RW</h2>
			<form method="post" action="<?= base_url('user/save'); ?>">
				<table border="1">
					<tr>
						<td>RT</td>
						<td><input type="text" name="rt"></td>
					</tr>
					
					<tr>
						<td>RW</td>
						<td><input type="text" name="rw"></td>
					</tr>
					<tr>
						<td colspan="2"><input type="submit" name="kirim" value="Masukkan Data"></td>
					</tr>
				</table>
			</form>
		</center>
	</body>
</html>