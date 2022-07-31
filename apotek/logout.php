<?php
	session_start();
	session_destroy();
	echo "<script>alert('Anda telah keluar dari akun anda.'); window.location = 'index.php'</script>";
?>
