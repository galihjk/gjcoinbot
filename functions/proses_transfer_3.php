<?php
function proses_transfer_3($botdata) {
    $textsend = "<b>PROSES TRANSFER (3/4)</b>\n";
    $textsend .= "Konfirmasi";
    $chat_id = $botdata["chat"]["id"];
    f("bot_kirim_perintah")("sendMessage",[
        "chat_id"=>$chat_id,
        "text"=>$textsend,
        "parse_mode"=>"HTML",
    ]);
    return true;
}