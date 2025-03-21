<?php

    session_start();
    session_destroy();
    header("location: index.php");// location redireciona para a pagina - index.php
?>