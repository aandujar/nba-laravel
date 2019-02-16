<?php
    setcookie("cookieUsuario",null,-1);
    session_destroy();
    header("Location: /");
