<!DOCTYPE html>
<html lang="en">
	<head>
	<meta charset="utf-8">
	<title>BULK-PDF-GEN</title>
	<meta name="author" content="">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/skeleton.css">
		<style>
		html, body 
		{
		height: 100%;
		}
		body 
		{
			background: #f7f7f7;
			margin: auto;
		}
		.form-box 
		{
			max-width: 500px;
			margin: auto 20px auto auto;
			padding: 50px;
			background: #ffffff;
			border: 10px solid #f2f2f2;
		}
		h1, p 
		{
			text-align: center;
		}
		input, textarea 
		{
			width: 100%;
		}
		.table-container 
		{
		display: table;
		height: 100%;
		width: 100%;
		}
		.table-block 
		{
		display: table-row;
		height: 1px;
		}
		.footer-push 
		{
		height: auto;
		}
		.alwvis {
		}
		@media (min-width: 1000px) {
			.alwvis {
				position: fixed;
				right: 10px;
			}
		}
		#footer 
		{
		text-align: center;
		}
		</style>
	</head>
	<body>
		<div class="table-container">
			<div class="table-block footer-push">
				<h1>Bulk pdf gen</h1>
				<div class="row">
					<div class="eight columns">
						<div class="form-box">
							<form action="gen.php" method="post">
								<label for="name">Name</label>
								<input id="name" type="text" name="name" value="">
								<hr/>
								<?php
									for ($i=0; $i < 10 ; $i++) 
									{ 
										echo '<label for="date'.$i.'">Datum</label>
										<input id="date'.$i.'" type="date" name="vars['.$i.'][date]" value="">
									
										<label for="bt'.$i.'">Tätigkeit</label>
										<textarea id="bt'.$i.'" name="vars['.$i.'][bt]"></textarea>

										<label for="bt'.$i.'">Unterweisungen</label>
										<textarea id="uw'.$i.'" name="vars['.$i.'][uw]"></textarea>
									
										<label for="school'.$i.'">Schule</label>
										<textarea id="school'.$i.'" name="vars['.$i.'][school]"></textarea>
										<hr>';
									}
								?>
								<label for="code">Code</label>
								<input id="code" type="text" name="code">
								<input class="button-primary" type="submit" value="Abschicken" />
							</form>
						</div>
						<div class="form-box">
							<div class="container">
								<footer id="footer" class="twelve columns">
									Bulk pdf gen with (F) by nsk
									<br />
									<a href="https://github.com/nsk95/bulkberichtsheftegen/" target="_blank">Git</a>
								</footer>
							</div> 
						</div>
					</div>
					<div class="four columns alwvis">
						<div class="form-box">
							<h2>Benutzung:</h2>
							<hr/>
							<h5>Datum wird automatisch ergänzt</h5>
							<br/>
							<h5>Tätigkeit und Unterweisung werden wie folgt befüllt:</h5>
							<code>- Tätigkeit1 - Tätigkeit2</code>
							<code>- Unterweisung1 - Unterweisung2</code>
							<br/>
							<br/>
							<h5>Schule wird wie folgt befüllt:</h5>
							<code>#Montag - Fach1 #Dienstag - Fach2</code>
							<br/>
							<br/>
							<h7>Alle Felder eines Form-Abschnitts müssen befüllt werden, sonst wird er übersprungen.</h7>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
