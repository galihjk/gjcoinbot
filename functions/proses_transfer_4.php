<?php
function proses_transfer_4($botdata){
    $tfdata = explode("_",$botdata["data"]);
    $dari_id = $botdata["from"]["id"];
    $untuk_id = $tfdata[1];
    $nominal = $tfdata[2];
    $nominal_txt = number_format($nominal);
    $chat_id = $botdata["message"]["chat"]["id"];
    $my_coin = f("get_user")($dari_id)["coin"]??0;
    if($my_coin<$nominal){
        f("bot_kirim_perintah")('answerCallbackQuery',[
            'callback_query_id' => $botdata['id'],
            'text' => "Koin anda tidak cukup! \n($my_coin)",
            'show_alert' => true,
        ]);
    }
    else{
        f("bot_kirim_perintah")('answerCallbackQuery',[
            'callback_query_id' => $botdata['id'],
        ]);
        f("bot_kirim_perintah")("sendMessage",[
            "chat_id"=>f("get_config")("admin_chat_id"),
            "text"=>"`$dari_id` ingin mengirim koin kepada `$untuk_id` sejumlah $nominal_txt",
            'reply_markup'=>f("gen_inline_keyboard")([
                ['✅ Setuju', 'admacctf_'.$dari_id.'_'.$untuk_id.'_'.$nominal.'_'.$chat_id.'_'.$botdata["message"]["message_id"]],
                ['❌ Batalkan', 'admnoacc_'.$chat_id.'_'.$botdata["message"]["message_id"]],
            ]),
            "parse_mode"=>"MarkDown",
        ]);
        $usertujuan_nama = f("get_user")($untuk_id)["first_name"] ?? "";
        $textsend = "<b>PROSES TRANSFER (4/4)</b>\n";
        $textsend .= "Menunggu Konfirmasi Admin\n";
        $textsend .= "Dari: [$dari_id]\n(".$botdata["from"]["first_name"].")\n";
        $textsend .= "Tujuan: [$untuk_id]\n($usertujuan_nama)\n";
        $textsend .= "Nominal: [$nominal_txt]\n";
        f("bot_kirim_perintah")("editMessageText",[
            "chat_id"=>$chat_id,
            "text"=>$textsend,
            "message_id"=>$botdata["message"]["message_id"],
            "parse_mode"=>"HTML",
        ]);
    }
}