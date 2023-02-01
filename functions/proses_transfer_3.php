<?php
function proses_transfer_3($botdata) {
    $text = $botdata["text"] ?? "";
    $chat_id = $botdata["chat"]["id"];
    $explode = explode("untuk: ", $text);
    $explode2 = explode(" (", $explode[1]);
    $usertujuan_id = $explode2[0];
    $usertujuan_nama = explode(")",$explode2[1]);
    $textsend = "<b>PROSES TRANSFER (3/4)</b>\n";
    $textsend .= "Konfirmasi\n";
    $nominal = $text;
    $nominal_txt = number_format($nominal);
    $textsend .= "$usertujuan_id~$usertujuan_nama~$nominal_txt\n";
    $chat_id = $botdata["chat"]["id"];
    f("bot_kirim_perintah")("sendMessage",[
        "chat_id"=>$chat_id,
        "text"=>$textsend,
        "parse_mode"=>"HTML",
    ]);
    return true;
}