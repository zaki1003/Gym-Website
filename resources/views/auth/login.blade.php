<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Mon GYM UP</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
 	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" href="css/slickbar.css" type="text/css">
 
</head>
<body>
	
	<div class="limiter">
		<div class="container-log" style="background-image: url('img/hero/hero-1.jpg');">
			<div class="logintn">
				<form method="POST" action="{{ route('login') }}">
					@csrf
<img src="log.png">
					


          <div class="wrap-input100 validate-input" data-validate = "Adresse mail">
						<input class="input100" type="email" name="email" placeholder="Adresse mail" value="{{ old('email') }}" autocomplete="off">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
						@error('login')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
					@error('email')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
					</div>




					<div class="wrap-input100 validate-input" data-validate="Mot de passe">
						<input class="input100" type="password" name="password" placeholder="Mot de passe" required autocomplete="current-password">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
						@error('password')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
					</div>




					<div class="contact100-form-checkbox">
						<input class="input-checkbox100" id="ckb1" type="checkbox"  name="remember" id="remember"     {{ old('remember') ? 'checked' : '' }}>
						<label class="label-checkbox100" for="ckb1">
						Se souvenir de moi
						</label>
					</div>




					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">
						CONNEXION
						</button>
					</div>



					<div class="container-login100-form-btn">
						

					<a style="text-decoration:none ;color:white"  href="{{ route('register') }}">Inscription</a>
				
				</div>

			
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
 
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
 
	<script src="vendor/animsition/js/animsition.min.js"></script>
 
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
 
	<script src="vendor/select2/select2.min.js"></script>
 
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
 
	<script src="vendor/countdowntime/countdowntime.js"></script>
 
	<script src="js/main.js"></script>

</body>
</html>