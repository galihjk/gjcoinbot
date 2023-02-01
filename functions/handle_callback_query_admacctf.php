<?php
function handle_callback_query_admacctf($botdata){
    if(!empty($botdata["data"]) 
    and f("str_is_diawali")($botdata["data"], "admacctf_")
    and !empty($botdata["message"])){
        $admacctfdata = explode("_",$botdata["data"]);
        f("bot_kirim_perintah")('answerCallbackQuery',[
            'callback_query_id' => $botdata['id'],
            'text' => "under".print_r($admacctfdata,true),
            'show_alert' => true,
        ]);
        return true;
    }
    return false;
}