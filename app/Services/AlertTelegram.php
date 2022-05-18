<?php
namespace App\Services;

use TelegramBot\Api\BotApi;

// Para pegar o ID do chat https://api.telegram.org/bot TELEGRAM_BOT_TOKEN /getUpdates

class AlertTelegram {
    /**
     * Token de acesso do bot
     */
    const TELEGRAM_BOT_TOKEN = '5336330366:AAGyZWEnOomfzK_5VH8knMWu0Rx_wHI2YDg';
    /**
     * ID do chat do bot
     */
    const TELEGRAM_CHAT_ID = 5101354281;
    /**
     * Envia a mensagem de alerta
     * @return boolean
     */
    public static function sendMessage($message){
        //Instancia Bot
        $obBotApi = new BotApi(self::TELEGRAM_BOT_TOKEN);

        //Envia mensagem para o Telegram
        return $obBotApi->sendMessage(self::TELEGRAM_CHAT_ID, $message);
    }
}