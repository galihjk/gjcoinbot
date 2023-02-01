<?php
function handle_callback_query_transfer($botdata){
    if(!empty($botdata["data"]) 
    and f("str_is_diawali")($botdata["data"], "tf_")
    and !empty($botdata["message"])){
        $tfdata = explode("_",$botdata["data"]);
        f("bot_kirim_perintah")('answerCallbackQuery',[
            'callback_query_id' => $botdata['id'],
        ]);
        $dari_id = $botdata["from"]["id"];
        $untuk_id = $tfdata[1];
        $nominal = $tfdata[2];
        $nominal_txt = number_format($nominal);
        $chat_id = $botdata["message"]["chat"]["id"];
        
        f("bot_kirim_perintah")("sendMessage",[
            "chat_id"=>f("get_config")("admin_chat_id"),
            "text"=>"`$dari_id` ingin mengirim koin kepada `$untuk_id` sejumlah $nominal_txt",
            'reply_markup'=>f("gen_inline_keyboard")([
                ['✅ Setuju', 'admacctf_'.$dari_id.'_'.$untuk_id.'_'.$nominal_txt],
                ['🗙 Batalkan', 'cancel'],
            ]),
        ]);

        // f("bot_kirim_perintah")("sendMessage",[
        //     "chat_id"=>$chat_id,
        //     "text"=>print_r($botdata,true),
        //     "parse_mode"=>"HTML",
        // ]);
        return true;
    }
    return false;
}