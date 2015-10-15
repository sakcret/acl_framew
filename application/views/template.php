<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo $this->config->item('sis_nombre'); ?></title>
        <base href= "<?php echo $this->config->item('base_url'); ?>">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="./css/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="./css/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="./css/AdminLTE.min.css">
        <link rel="stylesheet" href="./css/skins/_all-skins.min.css">
        <link rel="stylesheet" href="./css/estilo_gral.css">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="./js/jQuery/jQuery-2.1.4.min.js"></script>
        <script src="./css/bootstrap/js/bootstrap.min.js"></script>
        <script src="./js/jquery.blockUI.js"></script>
        <script src="./js/app.min.js"></script>
        <script src="./js/utilerias.js"></script>
        <script type="text/javascript">
            var base_url = '<?php echo $this->config->item('base_url'); ?>';</script>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?php
            $show_header_bool = TRUE;
            if (isset($show_header) && $show_header == FALSE) {
                $show_header_bool = FALSE;
            }
            unset($show_header);
            //verificar siderbar
            $siderbar = '';
            if (isset($main_siderbar)) {
                $siderbar = $main_siderbar . PHP_EOL;
            }
            unset($main_siderbar);
            if ($show_header_bool) {
                ?>
                <header class="main-header">
                    <div class="logo">
                        <span class="logo-mini"><b>A</b>CL</span>
                        <span class="logo-lg"><b>ACL</b> Framework</span>
                    </div>
                    <nav class="navbar navbar-static-top" role="navigation">
                        <?php if ($siderbar != '') { ?>
                            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"><span class="sr-only">Toggle navigation</span></a>
                            <?php
                        }
                        $clv_sess = $this->config->item('clv_sess');
                        $user_id = $this->session->userdata('user_id' . $clv_sess);
                        if (!$user_id) {
                            $logueado = false;
                        } else {
                            $logueado = true;
                        }
                        if ($logueado) {
                            ?>
                            <div class="navbar-custom-menu">
                                <ul class="nav navbar-nav">
                                    <li class="dropdown messages-menu">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <i class="fa fa-envelope-o"></i>
                                            <span class="label label-success">0</span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li class="header">No hay mensajes</li>
                                            <li>
                                                <ul class="menu"></ul>
                                            </li>
                                            <li class="footer"><a href="#">Ver todos los mensajes</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown notifications-menu">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <i class="fa fa-bell-o"></i>
                                            <span class="label label-warning">0</span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li class="header">No hay notificaciones</li>
                                            <li>
                                                <ul class="menu"></ul> 
                                            </li>
                                            <li class="footer"><a href="#">Ver todas</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown tasks-menu">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <i class="fa fa-flag-o"></i>
                                            <span class="label label-danger">0</span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li class="header">No hay problemas</li>
                                            <li>
                                                <ul class="menu"></ul>
                                            </li>
                                            <li class="footer">
                                                <a href="#">Ver todo</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="dropdown user user-menu">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <img src="./img/user2-160x160.jpg" class="user-image" alt="User Image">
                                            <span class="hidden-xs"> <?php echo $this->session->userdata('nombre' . $clv_sess); ?></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li class="user-header">
                                                <img src="./img/user2-160x160.jpg" class="img-circle" alt="User Image">
                                                <p>
                                                    <?php echo $this->session->userdata('nombre' . $clv_sess); ?>
                                                    <small><?php echo $this->session->userdata('rol' . $clv_sess); ?></small>
                                                </p>
                                            </li>
                                            <li class="user-body">
                                            </li>
                                            <li class="user-footer">
                                                <div class="pull-left">
                                                    <a onclick="redirect_to('inicio');" class="btn btn-default btn-flat">Inicio</a>
                                                </div>
                                                <div class="pull-right">
                                                    <a onclick="redirect_to('acceso/logout');" class="btn btn-default btn-flat">Salir</a>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                                    </li>
                                </ul>
                            </div>
                        <?php } ?>
                    </nav>
                </header>
                <?php
            }
            echo $siderbar;
            $class_wrapper = '';
            if ($siderbar == '') {
                $class_wrapper = 'margin-left: 0px !important;';
            }
            unset($siderbar);
            ?>
            <div class="content-wrapper" style="<?php echo $class_wrapper; ?>" >
                <section class="content-header">
                    <h1><?php
                        if (isset($title_mod)) {
                            echo $title_mod . PHP_EOL;
                        }
                        ?>
                    </h1>
                    <?php if (isset($navigate_mod)) { ?>
                        <ol class="breadcrumb">
                            <?php echo $navigate_mod . PHP_EOL; ?>
                        </ol>
                    <?php } ?>
                </section>
                <section class="content">
                    <div class="box">
                        <?php
                        if (isset($title_page)) {
                            ?>
                            <div class="box-header with-border">
                                <h3 class="box-title"><?php echo $title_page . PHP_EOL; ?></h3>
                                <div class="box-tools pull-right">
                                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="box-body">
                            <?php
                            if (isset($content)) {
                                echo $content . PHP_EOL;
                            }
                            ?>
                        </div>
                        <?php
                        if (isset($footer_page)) {
                            ?>
                            <div class="box-footer"><?php echo $footer_page . PHP_EOL; ?></div>
                        <?php } ?>
                    </div>
            </div>
        </div>
        <?php
        $show_footer_bool = TRUE;
        if (isset($show_footer) && $show_footer == FALSE) {
            $show_footer_bool = FALSE;
        }
        unset($show_footer);

        if ($show_footer_bool) {
            ?>
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b><?php echo $this->config->item('sis_nombre'); ?></b> <?php echo $this->config->item('sis_version'); ?>
                </div>
                <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="<?php echo $this->config->item('emp_url'); ?>"><?php echo $this->config->item('emp_nombre'); ?></a>.</strong> Todos los derechos reservados.
            </footer>
        <?php }
        ?>
    </div><!-- ./wrapper -->
</body>
</html>