<?php
function handle_message($botdata){
    $chat_id = $botdata["chat"]["id"];
    $banned = false;
    if(!empty($botdata["from"])){
        $userdata = f("get_user")($botdata["from"]["id"]);
        if(!empty($userdata["banned"])){
            f("bot_kirim_perintah")("sendMessage",[
                "chat_id"=>$chat_id,
                "text"=>"Your user account (".$botdata["from"]["id"].") is banned. Please contact administrator.",
            ]);
            $banned = true;
        }
        else{
            f("update_user")($botdata["from"]);
        }
    }
    if(!$banned){
        f("handle_botdata_functions")($botdata,[
            "handle_message_others",
        ]);
    }
}