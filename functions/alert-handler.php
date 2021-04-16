<?php

function make_alert($type = "success", $msg ="Done") {
    echo "
    <div class='alert alert-$type' role='alert'>
        $msg
    </div>";
}