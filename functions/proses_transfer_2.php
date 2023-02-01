<?php
function proses_transfer_2($botdata) {
    $text = $botdata["text"] ?? "";
    $chat_id = $botdata["chat"]["id"];
    $usertujuan = f("get_user")($text);
    if($usertujuan){
        $textsend = "*PROSES TRANSFER (2/4)*\n";
        $textsend .= "Masukkan nominal coin yang ingin ditransfer untuk: `$usertujuan` (".$usertujuan['first_name'].")\n";
        f("bot_kirim_perintah")("sendMessage",[
            "chat_id"=>$chat_id,
            "text"=>$textsend,
            "parse_mode"=>"MarkDown",
            'reply_markup' => [
                'force_reply'=>true,
                'input_field_placeholder'=>'Tulis angka saja',
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