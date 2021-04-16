<?php

function make_alert($type = "succes", $msg ="Done") {
    echo "
    <div class='alert alert-$type' role='alert'>
        $msg
    </div>";
}