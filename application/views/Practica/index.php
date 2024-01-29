<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Practica codeigniter</title>
	<link rel="stylesheet" type="text/css" href="../../estils/chat.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>

<?php echo validation_errors(); ?>




<h1>HERE'S WHERE U LOG IN</h1>
<form class="fup" style="width:40%; height:300px; text-align:left; padding:30px; margin-top:100px" name='f' method='post' action="<?= site_url('Practica/login'); ?>" >

        <div class="form-group">
            <label for="fnom">Username</label>
            <input type="text" class="form-control" name="username" placeholder="Mail">
        </div>
        <div class="form-group">
            <label for="fref">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Contrasenya">
        </div>      
        <button type="submit" id="b4" name="submit" class="btn btn-warning">Login</button>
</form>
    

    <script>
		document.addEventListener('DOMContentLoaded', function () {
			var boxes = document.querySelectorAll('.fup');

			boxes.forEach(function (box) {
				box.addEventListener('mouseover', function () {
					box.classList.remove('fup');
					box.classList.add('box');
				});

				box.addEventListener('mouseout', function () {
					box.classList.remove('box');
					box.classList.add('fup');
				});
			});
		});	
    </script>

</body>
</html>