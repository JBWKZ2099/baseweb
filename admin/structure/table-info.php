<div class="table-responsive">
    <table class="table table-hover table-striped table-bordered">
        <tody>
            <?php
                $html_resp = "";
                foreach( $titles as $key => $title ) {
                    $html_resp .= "
                        <tr>
                            <th>".$title."</th>
                            <td ".( isset($colspan) && !empty($colspan) ? "colspan=".$colspan : "" ).">".$row[ $fields[$key] ]."</td>
                        </tr>
                    ";
                }

                if( isset($extra) && !empty($extra) )
                    $html_resp .= $extra;

                echo $html_resp;
            ?>
        </tody>
    </table>
</div>

<a class="btn btn-success" href="<?php echo $env->APP_URL_ADMIN.$collapse; ?>">
    <i class="fa fa-arrow-left me-2"></i> Volver
</a>