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
        <input id="BtnBuscar" type="file" name="imagen_img" accept="image/jpeg, image/jpg" style="position: absolute; left: 90999900px">
        <div class="container">
            <div class="header clearfix">
                <nav>
                    <ul class="nav nav-pills pull-right">
                        <li role="presentation"><a href="index.php">Inicio</a></li>
                        <li role="presentation"><a href="actividades.php">Actividades</a></li>
                        <li role="presentation" class="active"><a href="talleres.php">Talleres</a></li>
                    </ul>
                </nav>
                <h3 class="text-muted">Nuevo Encuentro</h3>
            </div>

            <div class="jumbotron">
                <h1>Nuevo Encuentro</h1>
                <p class="lead"></p>
                <!--<p><a class="btn btn-lg btn-success" href="#" role="button">Sign up today</a></p>-->
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h2 style="margin-top: 0px">Talleres</h2>
                    </div>
                    <div class="col-md-6">
                        <a id="AgregarNuevo" class="btn btn-primary" style="float: right;"><span class="glyphicon glyphicon-plus"></span> Nuevo Taller</a>
                    </div>
                    <div class="col-md-12">
                        <table id="tabla" class="table table-bordered bg_blanco table-hover"></table>
                        <div id="abm"></div>
                    </div>
                </div>
            </div>

            <footer class="footer">
                <p>&copy; 2016 No fue magia.</p>
            </footer>

        </div>

        <script type="text/javascript">

            var dias = [
                {DisplayText: "Lunes", Value: 1},
                {DisplayText: "Martes", Value: 2},
                {DisplayText: "Miercoles", Value: 3},
                {DisplayText: "Jueves", Value: 4},
                {DisplayText: "Viernes", Value: 5},
                {DisplayText: "Sabado", Value: 6},
                {DisplayText: "Doming", Value: 7}
            ]

            var repe = [
                {DisplayText: "Cada 1 Semana", Value: 1},
                {DisplayText: "Cada 2 Semanas", Value: 2},
                {DisplayText: "Cada 3 Semanas", Value: 3},
                {DisplayText: "Cada 4 Semanas", Value: 4}
            ];

            var columnas = [
                {
                    //estos son de bootstrap table
                    field: "idActividad",
                    align: 'center',
                    valign: 'middle',
                    title: "Id usuario",
                    sortable: "true",
                    visible: false,
                    edit: true,
                    opciones: {
                        diseño: {
                            cssDiv: {display: "none"}
                        },
                    }
                },
                {
                    field: "nombre",
                    align: 'center',
                    valign: 'middle',
                    title: "Titulo",
                    sortable: "true",
                    width: "20%",
                    create: true,
                    edit: true,
                    opciones: {
                        editar: {
                            atributos: {readonly: true}
                        }
                    }
                },
                {
                    field: "descripcion",
                    align: 'center',
                    valign: 'middle',
                    title: "Descripcion",
                    sortable: "true",
                    width: "30%",
                    create: true,
                    edit: true,
                    opciones: {
                        tipo: "input",
                        atributos: {input: {required: true}}
                    }
                },
                {
                    field: "imagen",
                    align: 'center',
                    valign: 'middle',
                    title: "Imagen",
                    sortable: "true",
                    formatter: function (val, row, i) {
                        return '<img height="auto" width="100%" src="imagenes/' + val + '"/>';
                    },
                    width: "30%",
                    create: true,
                    edit: true,
                    opciones: {
                        tipo: "imagen",
                        fileId: "BtnBuscar",
                        atributos: {input: {required: true}}
                    }
                },
                {
                    field: "cuando",
                    align: 'center',
                    valign: 'middle',
                    title: "Dia",
                    sortable: "true",
                    width: "10%",
                    create: true,
                    formatter: function (val, row, i) {
                        var obg = $.grep(dias, function (n) {
                            return n.Value === val;
                        });
                        return obg[0].DisplayText;
                    },
                    edit: true,
                    opciones: {
                        tipo: "select",
                        source: dias,
                        atributos: {input: {required: true}}
                    }
                },
                {
                    field: "repeticion",
                    align: 'center',
                    valign: 'middle',
                    title: "Repite cada",
                    sortable: "true",
                    width: "10%",
                    formatter: function (val, row, i) {
                        var obg = $.grep(repe, function (n) {
                            return n.Value === val;
                        });
                        return obg[0].DisplayText;
                    },
                    create: true,
                    edit: true,
                    opciones: {
                        tipo: "select",
                        source: repe,
                        atributos: {input: {required: true}}
                    }
                },
                {
                    field: 'editar',
                    title: 'Editar',
                    valign: 'middle',
                    align: 'center',
                    width: '5%',
                    events: {
                        'click .Editar': function (e, value, row, index) {
                            abm.Magyp("Mostrar", true, row, index);
                        }
                    },
                    formatter: function operateFormatter(value, row, index) {
                        return "<a style='cursor:pointer' class='Editar' title='Editar'><i class='glyphicon glyphicon-edit'></i></a>";

                    }
                },
                {
                    field: 'borrar',
                    title: 'Borrar',
                    valign: 'middle',
                    align: 'center',
                    width: '5%',
                    events: {
                        'click .Borrar': function (e, value, row, index) {
                            confirm("¿Estas seguro que queres borrar la actividad '" + row.nombre + "'?", function () {
                                $.post("backend/actividades/borrarActividad.php", row, function () {
                                    tabla.bootstrapTable('remove', {field: 'idActividad', values: [row.idActividad]});
                                });
                            })
                        }
                    },
                    formatter: function operateFormatter(value, row, index) {
                        return "<a style='cursor:pointer' class='Borrar' title='Borrar'><i class='glyphicon glyphicon-trash'></i></a>";

                    }
                }
            ];

            var tabla = $("#tabla");
            tabla.bootstrapTable({
                url: "backend/actividades/listActividades.php?fid=-1&esTaller=true",
                method: "POST",
                columns: columnas,
                pagination: "client"
            });

            var abm = $("#abm").Magyp({
                nombre: "Nueva Actividad",
                fields: columnas,
                boostrap: true,
                unico: true,
                url: 'backend/actividades/crearActividad.php?esTaller=true',
                urlEditar: 'backend/actividades/editarActividad.php',
                grabado: function (editando, data, index) {
                    tabla.bootstrapTable("refresh");
                }
            });

            $("#AgregarNuevo").on("click", function () {
                abm.Magyp("Mostrar", false);
            });


        </script>
    </body>
</html>
