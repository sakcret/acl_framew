<style>
    .mn_icon i{font-size: 70px;}
    .mn_modulo_txt{ font-weight: bolder}
    #div_menu{margin: 20px 0px;}
    #div_menu .btn{border-left: 2px solid;   min-height: 118px;}
    #bar_menu button.btn { border-radius: 0px; min-height: 122px;}
</style>
<div id="bar_menu" class="row">
    <div id="bar_menu" class="col-md-12">
        <?php
        if (isset($modulos_inicio)) {
            foreach ($modulos_inicio as $mod) {
                $clickOn = "redirect_to('" . $mod['url'] . "');";
                $icon_tmp = $mod['icon'];
                $img_tmp = $mod['imagen'];
                $icon = '<i class="fa fa-square"></i>';
                if ($icon_tmp != '') {
                    $icon = '<i class="fa ' . $icon_tmp . '"></i>';
                } else if ($img_tmp != '') {
                    $icon = '<img src="./images/' . $img_tmp . '"/>';
                }
                $clave_mod = $mod['clave'];
                //determinar permisos de modulo
                if (array_key_exists($clave_mod, $permisos_inicio)) {
                    ?>
                    <button class="col-md-3 col-lg-2 col-sm-4 col-xs-6 btn btn-primary" onclick="<?php echo $clickOn; ?>">
                        <div class="mn_icon"><?php echo $icon; ?></div> 
                        <div class="mn_modulo_txt"><?php echo $mod['nombre']; ?></div> 
                    </button>
                    <?php
                }
            }
        }
        ?>
    </div>
</div>
