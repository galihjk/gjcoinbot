<?php
function handle_userstopbot($botdata){
    if(!empty($botdata["chat"]["id"])
    and !empty($botdata["from"]["id"])
    and $botdata["from"]["id"] == $botdata["chat"]["id"]
    and !empty($botdata["new_chat_member"]["status"])
    and $botdata["new_chat_member"]["status"] == "kicked"
    ){
        f("db_q")("update users set bot_active=null where id='".$botdata["from"]["id"]."'");
        return true;
    }
    return false;
}