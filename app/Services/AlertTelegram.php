<?php
namespace App\Services;

use TelegramBot\Api\BotApi;

// Para pegar o ID do chat https://api.telegram.org/bot TELEGRAM_BOT_TOKEN /getUpdates 

class AlertTelegram {
    /**
     * Token de acesso do bot
     */
    const TELEGRAM_BOT_TOKEN = '';
    /**
     * ID do chat do bot
     */
    const TELEGRAM_CHAT_ID = 0;
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