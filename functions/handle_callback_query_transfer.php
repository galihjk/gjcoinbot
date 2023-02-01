<?php
function handle_callback_query_transfer($botdata){
    if(!empty($botdata["data"]) 
    and f("str_is_diawali")($botdata["data"], "tf_")
    and !empty($botdata["message"])){
        $data = explode("_",$botdata["data"]);
        f("bot_kirim_perintah")('answerCallbackQuery',[
            'callback_query_id' => $botdata['id'],
            'text' => "under".print_r($data,true),
            'show_alert' => true,
        ]);
        f("bot_kirim_perintah")("sendMessage",[
            "chat_id"=>$chat_id,
            "text"=>print_r($botdata,true),
            "parse_mode"=>"HTML",
        ]);
        return true;
    }
    return false;
}