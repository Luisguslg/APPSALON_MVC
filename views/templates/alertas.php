<?php
foreach ($alertas as $key => $value) :
    foreach ($value as $v) :
?>
        <div class="alerta <?php echo $key; ?> ">
            <?php echo  $v;  ?>
        </div>
<?php
    endforeach;
endforeach;
?>