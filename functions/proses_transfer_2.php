<?php
function proses_transfer_2($botdata) {
    $text = $botdata["text"] ?? "";
    $chat_id = $botdata["chat"]["id"];
    $usertujuan = f("get_user")($text);
    if($usertujuan){
        $textsend = "*PROSES TRANSFER (2/4)*\n";
        $tujuanNama = $usertujuan['first_name'] . (!empty($usertujuan['last_name']) ? " " . $usertujuan['last_name'] : "");
        $textsend .= "Masukkan nominal coin yang ingin ditransfer untuk: `$text` ($tujuanNama)\n";
        f("bot_kirim_perintah")("sendMessage",[
            "chat_id"=>$chat_id,
            "text"=>$textsend,
            "parse_mode"=>"MarkDown",
            "reply_to_message_id"=>$botdata["message_id"],
            'reply_markup' => [
                'force_reply'=>true,
                'input_field_placeholder'=>'Tulis angka saja',
                'selective'=>true,
            ],
        ]);
    }
    else{
        f("bot_kirim_perintah")("sendMessage",[
            "chat_id"=>$chat_id,
            "text"=>"Pengguna dengan ID '$text' tidak ditemukan.",
            "parse_mode"=>"HTML",
        ]);
    }
    return true;
}