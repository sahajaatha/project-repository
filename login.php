<?php
	session_start();
	require_once './config/koneksi.php';
	if (isset($_SESSION['user_login'])) {
		if ($_SESSION['user_level']=='admin') {
			echo '<script language="javascript">
	            alert ("Anda sudah login!");
	            window.open("./admin/","_self");
	            </script>';
	            exit();
		}else
		if($_SESSION['user_level']=='guest'){
			echo '<script language="javascript">
	            alert ("Anda sudah login!");
	            window.open("./web/","_self");
	            </script>';
	            exit();
		}
	}

	if (isset($_POST['login'])) {
		$uname = $_POST['uname'];
		$passw = md5($_POST['passw']);
		$sql = "SELECT * FROM tb_user WHERE user_username='$uname' AND user_password='$passw'";
		$query = $con -> query($sql);
		if(mysqli_num_rows($query)>0){
			$data = $query -> fetch_assoc();
			$_SESSION['id_user']=$data['id_user'];
			$_SESSION['user_nama']=$data['user_nama'];
			$_SESSION['user_login'] = true;
			if($data['user_level']=="admin"){
				$_SESSION['user_username']=$uname;
				$_SESSION['user_level']=$data['user_level'];
	            echo '<script language="javascript">
		              alert ("Selamat datang Admin!");
		              window.open("./admin/","_self");
		              </script>';
	            exit();
			}else{
				$_SESSION['user_username'] = $username;
				$_SESSION['user_level'] = $data['level'];
	            echo '<script language="javascript">
            		alert ("Anda berhasil login!");
            		window.open("./web/","_self");
            		</script>';
	            exit();
			}
		}else{
			echo '<script language="javascript">
            	alert ("Username atau Password salah!");
            	window.open("./login.php?username=false&password=false","_self");
            	</script>';
            exit();
		}
	}
	$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
	<link rel="icon" type="image/gif" href="./assets/img/logo.png" sizes="8x16">
	<title>Login - Relawan Purbalingga Peduli</title>
	<link rel="stylesheet" type="text/css" href="./assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="./assets/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="./assets/css/style.css">
	<style type="text/css">
		.cpyrght{
			position: absolute;
			bottom: 0;
			right: 0;
		}
		@media (max-width: 884px){
			.cpyrght{
				position: relative;
			}
		}
	</style>
</head>
<body>
	<header class="">
		<div class="shadow">
			<div class="container navbar">
				<div class="navbar-brand text-center w-100">
					<a href="./web/"><img src="./assets/img/logo.png" width="150"></a>
				</div>
			</div>
		</div>
	</header>
	<section class="container my-5">
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<div class="text-center">
					<div class="card shadow">
						<div class="card-header">
							<h1 class="h3 my-2">Login</h1>
						</div>
						<div class="card-body">
							<form class="text-left" action="" method="POST">
								<div class="form-group">
									<label class="form-text">Username</label>
									<input class="form-control" type="text" name="uname" placeholder="contoh123" required>
								</div>
								<div class="form-group">
									<label class="form-text">Password</label>
									<input class="form-control" type="password" name="passw" placeholder="********" required>
								</div>
								<div class="form-group text-right">
									<input class="btn btn-danger" type="reset" name="reset" value="Reset">
									<input class="btn btn-success" type="submit" name="login" value="Login">
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4"></div>
		</div>
	</section>
	<footer class="">
		<div class="">
			<div class="container-fluid">
				<span class="cpyrght mr-3">Copyright &copy 2020 Relawan Purbalingga Peduli</span>
			</div>
		</div>
	</footer>
</body>
</html>