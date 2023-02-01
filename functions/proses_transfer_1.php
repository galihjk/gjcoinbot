<?php
function proses_transfer_1($botdata) {
    $textsend = "<b>PROSES TRANSFER (1/4)</b>\n";
    $textsend .= "Masukkan ID Pengguna tujuan\n";
    $chat_id = $botdata["chat"]["id"];
    f("bot_kirim_perintah")("sendMessage",[
        "chat_id"=>$chat_id,
        "text"=>$textsend,
        "parse_mode"=>"HTML",
        "reply_to_message_id"=>$botdata["message_id"],
        'reply_markup' => [
            'force_reply'=>true,
            'input_field_placeholder'=>'ID Pengguna',
            'selective'=>true,
        ],
    ]);
    return true;
}