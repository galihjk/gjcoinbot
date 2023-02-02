<?php
function update_user($userdata, $is_private){
    $userdataq = f("str_dbq")($userdata,true);
    $id = $userdataq["id"];
    $first_name = $userdataq["first_name"] ?? "''";
    $last_name = $userdataq["last_name"] ?? "''";
    $username = $userdataq["username"] ?? "''";
    $bot_active = f("str_dbtime")();
    $user_exist = f("get_user")($userdata['id']);
    if(empty($user_exist)){
        if($is_private){
            f("db_q")("INSERT INTO users 
            (id, first_name, last_name, username, bot_active) VALUES 
            ($id, $first_name, $last_name, $username, $bot_active)");
        }
        else{
            f("db_q")("INSERT INTO users 
            (id, first_name, last_name, username) VALUES 
            ($id, $first_name, $last_name, $username)");
        }
    }
    else{
        $last_bot_active = $user_exist['bot_active'];
        $need_refresh = false;
        if(date("Y-m-d") != date("Y-m-d", strtotime($last_bot_active))){
            $need_refresh = true;
        }
        if($is_private){
            f("db_q")("update users set
            first_name=$first_name, 
            last_name=$last_name,
            username=$username,
            bot_active=$bot_active
            where id=$id");
        }
        else{
            f("db_q")("update users set
            first_name=$first_name, 
            last_name=$last_name,
            username=$username
            where id=$id");
        }
        if($need_refresh) unset($GLOBALS['global_user_got'][$userdata['id']]);
    }
}