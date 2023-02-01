<?php
function handle_callback_query_transfer($botdata){
    if(!empty($botdata["data"]) 
    and f("str_is_diawali")($botdata["data"], "tf_")
    and !empty($botdata["message"])){
        f("bot_kirim_perintah")('answerCallbackQuery',[
            'callback_query_id' => $botdata['id'],
            'text' => "under",
            'show_alert' => true,
        ]);
        return true;
    }
    return false;
}