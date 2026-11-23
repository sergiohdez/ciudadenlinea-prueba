<html>
    <head>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-113996723-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-113996723-1');
        </script>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="SergioLuisHA website" />
        <meta name="author" content="Sergio Luis Hernández Aguilar" />
        <meta name="keywords" content="SergioLuisHA,python example,codeigniter usage,test ciudadenlinea" />
        <title>Prueba ciudadenlinea</title>
        <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>" />
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="container">
            <div class="masthead">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="#">Prueba ciudadenlinea</a>
                        </div>
                        <div id="navbar" class="navbar-collapse collapse">
                            <ul class="nav navbar-nav">
                                <li <?php echo ($page == 'home') ? 'class="active"' : ''; ?>>
                                    <a href="<?php echo base_url(); ?>">Home</a>
                                </li>
                                <li <?php echo ($page == 'registro') ? 'class="active"' : ''; ?>>
                                    <a href="<?php echo base_url('estudiantes/create'); ?>">Registrar</a>
                                </li>
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                <li>
                                    <a onMouseOver="window.status='Host your site iFastNet!'; return true" onMouseOut="window.status=''; " href="https://ifastnet.com/portal/aff.php?aff=28480" target="_blank" class="bg-success"><span class="glyphicon glyphicon-globe" aria-hidden="true"></span>&nbsp;<strong>Web Hosting By iFastNet</strong></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>