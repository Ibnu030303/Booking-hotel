<?php
function base_url($path = '')
{
    return 'http://' . $_SERVER['HTTP_HOST'] . '/Sewa Hotel/' . $path;
}
