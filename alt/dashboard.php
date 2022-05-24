	<?php
	ini_set('display_errors', 0);
	ini_set('log_errors', 0);
	error_reporting(E_ALL & ~E_NOTICE);
	session_start();
	include('header.php');
	include("funcs.php");
	if (!isset($_SESSION['username'])) {
		header('location:./logout.php');
		exit();
	}
	?>
	<html>
	<head>
	<title>User Login</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="jsfunc.js"></script>
	<script src="idle.js"></script>
	<style>
		.item{
			/* background-image: url('./imgs/ham-logo.png'); */
			display:table-cell;
			text-align: center;
        	/* vertical-align: middle; */
			padding: 50% 0 50%;
			background-size: cover;
			background-position: center center;
			background-color: #FFF7F9;
			line-height: normal;
			 /* whitesmoke; */
		}
		SquareGrid{
			/* // The content width you use on your website */
			--content-width: 80vw;
			/* // The size of the gutter   */
			--gutter: 40px;
			/* // The amount of columns */
			--columns: 1;
			/* // This is the calculation for the row height.    */
			--row-size: calc(
				( var(--content-width) - (var(--gutter) * (var(--columns) - 1))
				) / var(--columns)
			);
			display: grid;

			width: 100%;
			max-width: var(--content-width);
			
			grid-template-columns: repeat(var(--columns), 1fr);
			grid-auto-rows: var(--row-size);

			grid-column-gap: var(--gutter);
			grid-row-gap: var(--gutter);
		}
		span {
			display: inline-block;
			vertical-align: middle;
			line-height: normal;
		}
		@media (min-width: 450px){
		SquareGrid{
			--columns: 2;
		}
		}
		@media (min-width: 750px){
		SquareGrid{
			--columns: 3;
		}
		}
		@media (min-width: 1200px){
		SquareGrid{
			--columns: 4;
		}
		}
	</style>
	</head>
	<body>		
		<!-- mostar las opciones del menu en enlaces dentro de un grid en cuadros. 
			opcion temporera, a futueo incluir algun kpi o dashboard-->
			<?php 
				$c = count($_SESSION['links']);
				$html = '<SquareGrid style="--gutter: 10px">';
				for ($i=0; $i < $c; $i++) {
					$x = $_SESSION['links'][$i];
					$html .= '<div class="item"><span><a href="'.strtolower($x).'.php">'.$x.'</a></span></div>';
				}
				$html.= '</SquareGrid>';
				echo $html;
			?>
			
	</body>
	</html>
<script>
    $(document).inactivityTimeout();
</script>