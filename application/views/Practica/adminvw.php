<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en" >
	<head>
		<meta charset="utf-8">
		<title>Practica codeigniter</title>
		<link rel="stylesheet" type="text/css" href="../../estils/chat.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	</head>
	<body>

		
		
		
		<div class="row" style="background-color:#363636;border-radius:15px; padding:35px;">
		<h1>ADMIN VIEW</h1>
		</div>
		
		<br/>
		<hr style="width:95%;"/>


	<div class="container d-flex justify-content-end">
		<form action='' method="post" class="d-flex">
			<select class="form-control col-sm-4" name='fcat'>
				<?php
					foreach ($cat as $p) {
						echo "<option value='$p->id'>" . $p->nom . "</option>";
					}
				?>
			</select>
			<div class="ml-5 col-m-4">
				<button type="submit" class="btn btn-primary" style="width: 200px;" name="bpdf">Generar informe en PDF</button>
			</div>
			<div class="ml-5 col-sm-4">
				<button type="submit" class="btn btn-danger" name="blogout">Log out</button>
			</div>
		</form>
	</div>



		
		<div class="row">
			<?php
				$url = base_url('/imgs');
				foreach ($prods as $p) {
					$elementId = 'xxx_' . $p->id;
					
					echo "<div id='$elementId' class='fup'>";
						echo "<img style='height:200px; width:200px' src='$url/$p->img'/>";
						echo "<h3>" . $p->nom . "</h3>";
						if ($p->categoria) {
							echo "<h6>" . "<span class='cate'>" . "CATEGORIAS: " . "</span>";
						
							$qtcat = count($p->categoria);
							foreach ($p->categoria as $key => $c) {
								echo $c;

								if ($key < $qtcat - 1) {
									echo ", ";
								}
							}
						
							echo "</h6>";
						} else {
							echo "<h6>" . "<span>" . "CATEGORIA: " . "</span>" . "SENSE CATEGORIA" . "</h6>";
						}
						
						
						echo "<h6>" . "<span>" . "REF: " . "</span>" . $p->ref  . "</h6>";
						echo "<h6>" . "<span>" .  "STOCK: " . "</span>" . $p->stock  . "</h6>";
						echo "<br/>";
					
						echo "<form action='admin/crud' method='post'>";
						echo "<input type='hidden' name='product_id' value='$p->id' />";
						echo "<button id='bt' class='btn btn-dark' type='submit' name='del' value='Delete'><i class='fa fa-trash' aria-hidden='true'></i></button>";
						echo "<button class='btn btn-warning' type='submit' name='mod' value='mod'>Modificar</button>";
						echo "</form>";
					echo "</div>";
				}
			?>
		
		</div>
				
		<hr/>

		<form class="fup2 citems" action="" method="post" name="falta">
			<input type="hidden" name="product_id_mod" id="product_id_mod" value="<?php echo ($mod_product_data) ? $mod_product_data->id : ''; ?>">
			<div class="form-group">

				<label for="fcat" >Categoria</label>
				<div class="form-group d-flex justify-content-between">
					<select class="form-control col-sm-7" name='fcat'>
						<?php
							foreach ($cat as $p) {
								echo "<option value='$p->id'>" . $p->nom . "</option>";
							}
						?>
					</select>
					<button type="submit" class="btn btn-primary col-sm-2" name="badd">Add</button>
					<button type="submit" class="btn btn-danger col-sm-2" name="bdell">Del</button>
				</div>
				
			</div>
				
				<div class="form-group">
					<label for="fimg">Imatge</label>
					<select class="form-control" name='fimg'>
						<option value="naruto.jpg" <?php echo ($mod_product_data && $mod_product_data->img === 'naruto.jpg') ? 'selected' : ''; ?>>Naruto</option>
						<option value="dbz.jpg" <?php echo ($mod_product_data && $mod_product_data->img === 'dbz.jpg') ? 'selected' : ''; ?>>Dragon Ball Z</option>
						<option value="onepiece.jpg" <?php echo ($mod_product_data && $mod_product_data->img === 'onepiece.jpg') ? 'selected' : ''; ?>>One piece</option>
						<option value="hellfire.jpg" <?php echo ($mod_product_data && $mod_product_data->img === 'hellfire.jpg') ? 'selected' : ''; ?>>Hell fire club</option>
						<option value="gunsnroses.jpg" <?php echo ($mod_product_data && $mod_product_data->img === 'gunsnroses.jpg') ? 'selected' : ''; ?>>Guns N' Roses</option>
						<option value="metallica.jpg" <?php echo ($mod_product_data && $mod_product_data->img === 'metallica.jpg') ? 'selected' : ''; ?>>Metallica</option>
						<option value="camiseta_queen.jpg" <?php echo ($mod_product_data && $mod_product_data->img === 'camiseta_queen.jpg') ? 'selected' : ''; ?>>Queen</option>
						<option value="chaqueta_lp.jpg" <?php echo ($mod_product_data && $mod_product_data->img === 'chaqueta_lp.jpg') ? 'selected' : ''; ?>>Linkin Park</option>
						<option value="harrypotter.jpg" <?php echo ($mod_product_data && $mod_product_data->img === 'harrypotter.jpg') ? 'selected' : ''; ?>>Harry Potter</option>
					</select>
					
				</div>
				<div class="form-group">
					<label for="fnom">Nom del producte</label>
					<input type="text" class="form-control" name="fnom" placeholder="Nom" value="<?php echo ($mod_product_data) ? $mod_product_data->nom : ''; ?>">
				</div>
				<div class="form-group">
					<label for="fref">Referencia</label>
					<input type="text" class="form-control" name="fref" placeholder="Ref" value="<?php echo ($mod_product_data) ? $mod_product_data->ref : ''; ?>">
				</div>
				<div class="form-group">
					<label for="fstoc">Stock</label>
					<input type="number" class="form-control" name="fstock" placeholder="Stock" value="<?php echo ($mod_product_data) ? $mod_product_data->stock : '0'; ?>">
				</div>
				<div class="form-group">
					<button type="submit" id="b4" class="btn btn-success" name="bfalta">Submit</button>
					<button type="submit" id="b5" class="btn btn-info" name="bfmod">Modify</button>
				</div>
				
			</form>

			

			<div class="wrapper">
				<div class="fup3">
					<form  method="post" name="loadfile" action="admin/do_upload" enctype="multipart/form-data">
						<div class="form-group">
							<input type="file" name="userfile" size="15"/>
							<br><input class="btn btn-warning" type="submit" value="Upload file" size='20'/>
						</div>
					</form>
				</div>
				
			</div>

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


