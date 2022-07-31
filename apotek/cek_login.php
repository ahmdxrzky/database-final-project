<?php
	// load koneksi
	include "config/koneksi.php";

	// untuk menghindari injeksi
	function anti_injection($data){
		$filter  = stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)));
		return $filter;
	}

	// menangkap username dan password yang dikirim dari form login
	$username = anti_injection($_POST['txt_user']);
	$password = anti_injection(($_POST['txt_pass']));

	// menghindari sql injection
	$injeksi_username = pg_escape_string($koneksi, $username);
	$injeksi_password = pg_escape_string($koneksi, $password);

	// untuk memastikan username dan password hanya berupa huruf dan angka
	if(!ctype_alnum($injeksi_username) OR !ctype_alnum($injeksi_password)){
		echo "<script type=\"text/javascript\"> alert(\"LOGIN TIDAK BISA DIINJEKSI.\"); window.location.href=\"index.php\"; </script>";
	}
	else{
		// Apabila username dan password benar
		if(($username=="AR") AND ($password=="password")){

			session_start();

			// membuat variabel session
			$_SESSION['ses_username'] = "Admin";
			$_SESSION['ses_password'] = "123456";
			$_SESSION['ses_nama'] = "Ahmad Rizky";
			$_SESSION['ses_level'] = "Manajemen Data Apotek";
			
			// dairek link
			header("location:media.php?page=home");
		}
		elseif(($username=="SAW") AND ($password=="password")){

			session_start();

			// membuat variabel session
			$_SESSION['ses_username'] = "Admin";
			$_SESSION['ses_password'] = "123456";
			$_SESSION['ses_nama'] = "Syuhaira Asyva Winanda";
			$_SESSION['ses_level'] = "Manajemen Data Apotek";
			
			// dairek link
			header("location:media.php?page=home");
		}
		elseif(($username=="FN") AND ($password=="password")){

			session_start();

			// membuat variabel session
			$_SESSION['ses_username'] = "Admin";
			$_SESSION['ses_password'] = "123456";
			$_SESSION['ses_nama'] = "Faridatun Nisa";
			$_SESSION['ses_level'] = "Manajemen Data Apotek";
			
			// dairek link
			header("location:media.php?page=home");
		}
		elseif(($username=="WL") AND ($password=="password")){

			session_start();

			// membuat variabel session
			$_SESSION['ses_username'] = "Admin";
			$_SESSION['ses_password'] = "123456";
			$_SESSION['ses_nama'] = "Widya Luthfiani";
			$_SESSION['ses_level'] = "Manajemen Data Apotek";
			
			// dairek link
			header("location:media.php?page=home");
		}
		// Apabila username dan password salah
		else{
			echo "<script>alert('LOGIN GAGAL! Harap masukkan Username dan Password yang sesuai.'); window.location = 'index.php'</script>";
		}
	}
?>