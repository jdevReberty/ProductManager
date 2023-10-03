<?php

use app\auth\SessionControl;

    $base_url = SessionControl::getBaseUrl();
    if($this->e($sessionActive) != 200) {
        header("Location: {$base_url}/login");
    }
?>