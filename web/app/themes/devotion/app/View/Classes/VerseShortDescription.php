<?php

namespace App\View\Classes;

use Orhanerday\OpenAi\OpenAi;

class VerseShortDescription
{

    public $excerpt;

    public function __construct($verse)
    {

        $open_ai_key = env('OPENAI_API_KEY');
        $open_ai = new OpenAi($open_ai_key);

        $chat = $open_ai->chat([
            'model' => 'gpt-4o',
            'messages' => [
                [
                    "role" => "system",
                    "content" => "You will be provided with a bible verse. Your task is create a deep short analisys for the verse.\n
                                - Return only the short analisys of the verse. \n
                                - The analysis should be from 200 to 300 characters long., \n
                                - Use a tone with passion and reverence for the Bible., \n
                                - Only use the Bible NIV version to get the verses.\n
                                - The analysis should be original and unique, offering a fresh perspective on the text., \n
                                - The analysis is pro bible and should not contain any negative or offensive content., \n

                    ",
                ],
                [
                    "role" => "user",
                    "content" => "Genesis 1:1",
                ],
                [
                    "role" => "assistant",
                    "content" => "Genesis 1:1 boldly declares God's sovereign act of creation, where every part of the universe springs from His divine will and purpose. This verse invites us to marvel at a world intentionally crafted by the Creator’s boundless power and creativity.",
                ],
                [
                    "role" => "user",
                    "content" => $verse,
                ],
            ],
            // 'max_tokens' => 100,
        ]);

        $d = json_decode($chat);

        $this->excerpt = $d->choices[0]->message->content;
    }

}
