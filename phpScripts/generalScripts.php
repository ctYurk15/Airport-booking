<?php

    function gotoURL($url)
    {
        echo "
            <script>location.replace('{$url}')</script>
        ";
    }

    function alert($msg)
    {
        echo "
            <script>alert('{$msg}')</script>
        ";
    }

    function print_console($msg)
    {
        echo "
            <script>console.log('{$msg}')</script>
        ";
    }
        
?>