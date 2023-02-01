<?php
function proses_transfer_2($botdata) {
    $textsend = "<b>PROSES TRANSFER (2/4)</b>\n";
    $textsend .= "Masukkan nominal coin yang ingin ditransfer\n";
    $chat_id = $botdata["chat"]["id"];
    f("bot_kirim_perintah")("sendMessage",[
        "chat_id"=>$chat_id,
        "text"=>$textsend,
        "parse_mode"=>"HTML",
        'reply_markup' => [
            'force_reply'=>true,
            'input_field_placeholder'=>'Tulis angka saja',
        ],
    ]);
    return true;
}