<?php

namespace App\Http\Traits;

use Telegram\Bot\Api;

/**
 * For obtaining telegram chat details and sending messages.
 *
 * Class TelegramTrait
 */
trait TelegramTrait
{
    protected $telegram;

    public function __construct()
    {
        $this->telegram = new Api(env('TELEGRAM_BOT_TOKEN'));
    }

    /**
     * Checking if there are any conversations to the bot.
     *
     * @return bool
     */
    public function checkChatID()
    {
        $response = $this->telegram->getUpdates();

        return is_null($response) ? false : true;
    }

    /**
     * if there are conversations returning the chat id.
     *
     * @return mixed
     */
    public function getChatID()
    {
        $response = $this->telegram->getUpdates();
        if (count($response)>0) {
            return $response[0]['message']['chat']['id'];
        }
    }

    /**
     * Send message to user's telegram.
     *
     * @param string $msg Order related message e.g. Order no
     *
     * @return int
     */
    public function sendTelegram($msg)
    {
        $chatID = $this->getChatID();
        $response = $this->telegram->sendMessage([
            'chat_id' => $chatID,
            'text' => $msg,
        ]);

        return $response->getMessageId();
    }
}
