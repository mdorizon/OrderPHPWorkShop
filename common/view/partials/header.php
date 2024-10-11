<!DOCTYPE html>
<html>
	<head>
		<title>Eshop au top</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
		<script defer src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.min.js" integrity="sha512-WW8/jxkELe2CAiE4LvQfwm1rajOS8PHasCCx+knHG0gBHt8EXxS6T6tJRTGuDQVnluuAvMxWF4j8SNFDKceLFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	</head>
	<body>

	<?php $orderRepository = new OrderRepository(); $order = $orderRepository->find();?>
	<header class="bg-light py-3">
		<div class="container">
			<h1 class="text-center text-primary font-weight-bold">Le Eshop au top</h1>
			<nav class="navbar navbar-expand-lg navbar-light">
				<div class="collapse navbar-collapse d-flex justify-content-between" id="navbarNav">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item">
							<a class="nav-link text-dark font-weight-bold" href="http://localhost:8888/workshopmethodo/">Liste des produits</a>
						</li>
						<li class="nav-item">
							<a class="nav-link text-dark font-weight-bold" href="http://localhost:8888/workshopmethodo/create-product">Créer un produit</a>
						</li>
					</ul>
					<ul class="navbar-nav ml-auto">
						<li class="nav-item">
							<a class="nav-link text-dark font-weight-bold" href="http://localhost:8888/workshopmethodo/cart"><i class="fa-solid fa-basket-shopping"></i></a>
						</li>
						<li class="nav-item">
							<p class="nav-link text-dark font-weight-bold">connecté en tant que: <?= $customerName = $order ? $order->getCustomerName() : null; ?></p>
						</li>
					</ul>
				</div>
			</nav>
		</div>
	</header>