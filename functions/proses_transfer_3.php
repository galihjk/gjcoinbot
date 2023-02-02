<?php
function proses_transfer_3($botdata) {
    if(is_numeric($botdata["text"]) and $botdata["text"] > 0){
        $text = $botdata["text"] ?? "";
        $chat_id = $botdata["chat"]["id"];

        $explode = explode("untuk: ", $botdata['reply_to_message']['text']);
        $explode2 = explode(" (", $explode[1]);
        $usertujuan_id = $explode2[0];
        $usertujuan_nama = explode(")",$explode2[1])[0];

        $nominal = $text;
        $nominal_txt = number_format($nominal);

        $textsend = "<b>PROSES TRANSFER (3/4)</b>\n";
        $textsend .= "Konfirmasi\n";
        $textsend .= "Tujuan: [$usertujuan_id]\n($usertujuan_nama)\n";
        $textsend .= "Nominal: [$nominal_txt]\n";
        // $textsend .= "$usertujuan_id~$usertujuan_nama~$nominal_txt\n";
        $chat_id = $botdata["chat"]["id"];
        f("bot_kirim_perintah")("sendMessage",[
            "chat_id"=>$chat_id,
            "text"=>$textsend,
            "parse_mode"=>"HTML",
            'reply_markup'=>f("gen_inline_keyboard")([
                ['✅ Kirim', 'tf_'.$usertujuan_id.'_'.$nominal],
                ['❌ Batal', 'cancel'],
            ]),
        ]);
    }
    else{
        f("bot_kirim_perintah")("sendMessage",[
            "chat_id"=>$chat_id,
            "text"=>"Format salah.",
        ]);
    }
    return true;
}