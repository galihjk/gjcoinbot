<?php
function proses_transfer_acc($botdata){
    $admacctfdata = explode("_",$botdata["data"]);
    $chat_id = $botdata["message"]["chat"]["id"];
    $dari_id = $admacctfdata[1];
    $dari_userdata = f("get_user")($dari_id);
    $dari_nama = $dari_userdata["first_name"] ?? "";
    $untuk_id = $admacctfdata[2];
    $untuk_userdata = f("get_user")($untuk_id);
    $untuk_nama = $untuk_userdata["first_name"] ?? "";
    $nominal = $admacctfdata[3];
    $nominal_txt = number_format($nominal);

    $dari_coin = $dari_userdata["coin"] ?? 0;
    if($dari_coin < $nominal){
        f("bot_kirim_perintah")('answerCallbackQuery',[
            'callback_query_id' => $botdata['id'],
        ]);
        f("bot_kirim_perintah")("editMessageText",[
            "chat_id"=>$chat_id,
            "text"=>"❌GAGAL: Coin tidak cukup ($dari_coin)\n".$botdata["from"]["id"]." (".date("Y-m-d H:i:s").")\n\n".$botdata["message"]["text"],
            "message_id"=>$botdata["message"]["message_id"],
        ]);
        f("bot_kirim_perintah")("sendMessage",[
            "chat_id"=>$admacctfdata[4],
            "text"=>"❌GAGAL: Coin tidak cukup ($coin)",
            "parse_mode"=>"HTML",
            "reply_to_message_id"=>$admacctfdata[5],
        ]);
    }
    else{
        $last_transaction = f("data_load")("trans $dari_id to $untuk_id $nominal",0);
        if(abs(time()-$last_transaction) <= 5 * 60){
            f("bot_kirim_perintah")('answerCallbackQuery',[
                'callback_query_id' => $botdata['id'],
                'text' => "Pengiriman Koin dari $dari_id ke $untuk_id sebesar $nominal sudah dilakukan pada ".date("Y-m-d H:i:s",$last_transaction).". Tunggu 5 menit jika ingin melakukan transaksi yang sama.",
                'show_alert' => true,
            ]);
        }
        else{
            f("data_save")("trans $dari_id to $untuk_id $nominal",time());
            f("bot_kirim_perintah")('answerCallbackQuery',[
                'callback_query_id' => $botdata['id'],
            ]);
            $dari_coin -= $nominal;
            f("db_q")("update users set coin=$dari_coin where id='$dari_id'");
            $untuk_coin = $untuk_userdata["coin"] ?? 0;
            $untuk_coin += $nominal;
            f("db_q")("update users set coin=$untuk_coin where id='$untuk_id'");
            f("bot_kirim_perintah")("editMessageText",[
                "chat_id"=>$chat_id,
                "text"=>"✅ Disetujui\n".$botdata["from"]["id"]." (".date("Y-m-d H:i:s").")\n\n".$botdata["message"]["text"],
                "message_id"=>$botdata["message"]["message_id"],
            ]);
            f("bot_kirim_perintah")("deleteMessage",[
                "chat_id"=>$admacctfdata[4],
                "message_id"=>$admacctfdata[5],
            ]);
            $textsend = "<b>PROSES TRANSFER</b>\n✅ BERHASIL!\n";
            $textsend .= "Dari: [$dari_id]\n($dari_nama)\n";
            $textsend .= "Tujuan: [$untuk_id]\n($untuk_nama)\n";
            $textsend .= "Nominal: [$nominal]\n";
            $textsend .= "Waktu: [".date("Y-m-d H:i:s")."]\n\n/start";
            f("bot_kirim_perintah")("sendMessage",[
                "chat_id"=>$admacctfdata[4],
                "text"=>$textsend,
                "parse_mode"=>"HTML",
            ]);
            if(!empty($untuk_userdata['bot_active'])){
                f("bot_kirim_perintah")("sendMessage",[
                    "chat_id"=>$untuk_id,
                    "text"=>$textsend,
                    "parse_mode"=>"HTML",
                ]);
            }
        }
    }


}