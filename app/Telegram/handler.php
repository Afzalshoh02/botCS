<?php

namespace App\Telegram;

use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use Illuminate\Support\Stringable;

class handler extends WebhookHandler
{
    public function hello($name)
    {
        $this->reply('Hello ' . $name);
    }
    protected function handleUnknownCommand(Stringable $text): void
    {
        if ($text->value() == '/start') {
            $this->reply('рад тебя выдеть');
        } else {
            $this->reply('Неизвестная команда');
        }
    }
    protected function handleChatMessage(Stringable $text): void
    {
        $this->reply($text);
    }

    public function help()
    {
        $this->reply('*Приветь!* Пока я умею говорить только приветь');
    }

    public function action()
    {
        Telegraph::message('Выбори какое действие')->keyboard(Keyboard::make()->buttons([
            Button::make('Перейти на сайт')->url('https://telegram.me/start'),
            Button::make('Поставить лайк')->action('like'),
            Button::make('Подписаться')->action('subscribe')->param('channel_name', "@afzalshoh"),
        ]))->send();
    }

    public function like()
    {
//        $this->reply('Спасибо за твой крутой лайк!');
        Telegraph::message('Спасибо за твой крутой лайк!')->send();
    }

    public function subscribe(): void
    {
        $this->reply("Спасибо за подписку на {$this->data->get('channel_name')}");
    }
}
