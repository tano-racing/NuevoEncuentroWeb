<?php
//require_once "./backend/config.php";
//require_once "entities/Usuarios.php";
//require_once "entities/Actividades.php";
//
//$usuariosRepo = $entityManager->getRepository('Usuarios');
//$actividadesRepo = $entityManager->getRepository('Actividades');
//
//$dojos = $usuariosRepo->findAll();
//$starters = $actividadesRepo->findAll();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="Nuevo Encuentro">
        <meta name="author" content="Julian Lionti - No fue magia">
        <link rel="icon" href="../../favicon.ico">

        <title>Nuevo Encuentro - Comuna 10</title>

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/estilo.css" rel="stylesheet">
        
        <script src="js/jquery-3.0.0.js"></script>
        <script src="js/jquery-ui.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/bootstrap-table.js"></script>
        <script src="js/bootstrap-table-es-ES.js"></script>
        <script src="js/jquery.validationEngine.js"></script>
        <script src="js/jquery.validationEngine-es.js"></script>
        <script src="js/tano.js"></script>
        <script src="js/magyp.js"></script>
        
        
    </head>

    <body>

        <div class="container">
            <div class="header clearfix">
                <nav>
                    <ul class="nav nav-pills pull-right">
                        <li role="presentation" class="active"><a href="index.php">Inicio</a></li>
                        <li role="presentation"><a href="actividades.php">Actividades</a></li>
                        <li role="presentation"><a href="talleres.php">Talleres</a></li>
                    </ul>
                </nav>
                <h3 class="text-muted">Nuevo Encuentro</h3>
            </div>

            <div class="jumbotron">
                <h1>Nuevo Encuentro</h1>
                <p class="lead"></p>
                <!--<p><a class="btn btn-lg btn-success" href="#" role="button">Sign up today</a></p>-->
            </div>

            <form id="NotificacionesForm" method="POST">
                <div class="row">
                    <div class="col-lg-12" >
                        <p>Mandar un mensaje a todos los usuarios</p>
                    </div>	
                </div>
                <div class="row">
                    <div class="col-lg-6" >
                        <div class="form-group">
                            <label for="titulo">Titulo</label>
                            <input type="text"  class="form-control" id="titulo" placeholder="Titulo">
                        </div>
                    </div>
                    <div class="col-lg-6" >
                        <div class="form-group">
                            <label for="cuerpo">Cuerpo</label>
                            <textarea type="text"  class="form-control" id="cuerpo" placeholder="Cuerpo"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12" >
                        <input type="submit" class="btn btn-primary" value="Mandar" style="float: right;"/>
                    </div>	
                </div>			
            </form>

            <div class="container">
                <div class="row">
                    <h2 class="puchi blue_dark">Usuarios</h2>
                    <div class="col-md-12">
                        <table id="tabla" class="table table-bordered bg_blanco table-hover"></table>
                        <div id="abm"></div>
                    </div>
                </div>
            </div>

            <!--<div class="row">
              <div class="col-lg-4">
              </div>
              <div class="col-lg-8">
              </div>
            </div>-->

            <footer class="footer">
                <p>&copy; 2016 No fue magia.</p>
            </footer>

        </div>

        <script type="text/javascript">

            $(document).ready(function () {
                var inputs = $('#NotificacionesForm :input');
                inputs.prop('disabled', false);
                inputs.not("input[type=submit]").val("");
            });

            var columnas = [
                {
                    //estos son de bootstrap table
                    field: "idUsuario",
                    align: 'center',
                    valign: 'middle',
                    title: "Id usuario",
                    sortable: "true",
                    visible: false,
                },
                {
                    field: "nombreApellido",
                    align: 'center',
                    valign: 'middle',
                    title: "Nombre Apellido",
                    sortable: "true"
                },
                {
                    field: "email",
                    align: 'center',
                    valign: 'middle',
                    title: "EMail",
                    sortable: "true"
                },
                {
                    field: "facebookId",
                    align: 'center',
                    valign: 'middle',
                    title: "FacebookId",
                    sortable: "true"
                },
                {
                    field: "creadoEl",
                    align: 'center',
                    valign: 'middle',
                    title: "CreadoEl",
                    sortable: "true",
                }
            ];

            var tabla = $("#tabla");
            tabla.bootstrapTable({
                url: "backend/usuarios/listUsuarios.php?fid=-1",
                method: "POST",
                columns: columnas,
                pagination: "client"
            });


            $("#NotificacionesForm").submit(function (e) {
                e.preventDefault();
                var inputs = $('#NotificacionesForm :input');
                inputs.prop('disabled', 'disabled');

                var titulo = $("#titulo").val();
                var cuerpo = $("#cuerpo").val();

                $.post('enviar.php', {titulo: titulo, cuerpo: cuerpo}, function (data) {
                    inputs.prop('disabled', false);
                });
            });


        </script>
    </body>
</html>
