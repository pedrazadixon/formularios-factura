<?php require('vistas/header.html'); ?>

<div class="container">
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">Facturas</h1>
            <p class="lead text-muted">Universidad Cooperativa de Colombia </p>
        </div>
    </section>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <div class="card text-center" style="width: 18rem;">
                        <img src="assets/modulo_facturas.gif"
                            height="210" class="card-img" alt="CLIENTES">
                        <div class="card-body">
                            <h5 class="card-title">Modulo Facturas</h5>
                            <p class="card-text">Crear y ver facturas.
                            </p>
                            <a href="facturas" class="btn btn-primary">FACTURAS</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center" style="width: 18rem;">
                    <img src="assets/modulo_productos.gif" height="210"
                        class="card-img" alt="CLIENTES">
                    <div class="card-body">
                        <h5 class="card-title">Modulo Productos</h5>
                        <p class="card-text">Crear, Modificar y Eliminar.
                        </p>
                        <a href="productos" class="btn btn-primary">PRODUCTOS</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center" style="width: 18rem;">
                    <img src="assets/modulo_clientes.gif" height="210" class="card-img" alt="CLIENTES">
                    <div class="card-body">
                        <h5 class="card-title">Modulo Clientes</h5>
                        <p class="card-text">Crear, Modificar y Eliminar
                        </p>
                        <a href="clientes" class="btn btn-primary">CLIENTES</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>