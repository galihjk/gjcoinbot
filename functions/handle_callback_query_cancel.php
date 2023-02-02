<?php
function handle_callback_query_cancel($botdata){
    if(!empty($botdata["data"]) 
    and $botdata["data"] == "cancel"){
        $data = explode("_",$botdata["data"]);
        f("bot_kirim_perintah")('answerCallbackQuery',[
            'callback_query_id' => $botdata['id'],
        ]);
        $chat_id = $botdata["message"]["chat"]["id"];
        f("bot_kirim_perintah")("editMessageText",[
            "chat_id"=>$chat_id,
            "text"=>"❌DIBATALKAN\n".$botdata["from"]["id"]." (".date("Y-m-d H:i:s").")\n\n".$botdata["message"]["text"],
            "message_id"=>$botdata["message"]["message_id"],
        ]);
        return true;
    }
    return false;
}