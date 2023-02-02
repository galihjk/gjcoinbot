<?php
function handle_callback_query_transfer($botdata){
    if(!empty($botdata["data"]) 
    and f("str_is_diawali")($botdata["data"], "tf_")
    and !empty($botdata["message"])){
        f("proses_transfer_4")($botdata);
        return true;
    }
    elseif(!empty($botdata["data"]) 
    and f("str_is_diawali")($botdata["data"], "admacctf_")
    and !empty($botdata["message"]) and !empty($botdata["from"]["id"])){
        if(!in_array($botdata["from"]["id"],f("get_config")("bot_admins",[]))){
            f("bot_kirim_perintah")('answerCallbackQuery',[
                'callback_query_id' => $botdata['id'],
                'text' => "Kamu bukan admin!",
                'show_alert' => true,
            ]);
        }
        else{
            f("proses_transfer_acc")($botdata);
        }
        return true;
    }
    elseif(!empty($botdata["data"]) 
    and f("str_is_diawali")($botdata["data"], "admnoacc_")
    and !empty($botdata["message"]) and !empty($botdata["from"]["id"])){
        if(!in_array($botdata["from"]["id"],f("get_config")("bot_admins",[]))){
            f("bot_kirim_perintah")('answerCallbackQuery',[
                'callback_query_id' => $botdata['id'],
                'text' => "Kamu bukan admin!!",
                'show_alert' => true,
            ]);
        }
        else{
            f("proses_transfer_noacc")($botdata);
        }
        return true;
    }
    return false;
}