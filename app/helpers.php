<?php

    function is_current_route($path,$route){
        $current_menu_level = explode('/',$path);
        return '/'.$current_menu_level[0] == $route ? 'class=active':'';
    }