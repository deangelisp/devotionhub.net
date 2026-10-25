<?php

namespace App\View\Classes;

use Orhanerday\OpenAi\OpenAi;

class MetaDescription
{

    public $data;

    public function __construct($book, $chapter)
    {

        $open_ai_key = env('OPENAI_API_KEY');
        $open_ai = new OpenAi($open_ai_key);

        $chat = $open_ai->chat([
            'model' => 'gpt-4o',
            'messages' => [
                [
                    "role" => "system",
                    "content" => "You will be provided with a Bible chapter from the book of {$book}. Your task is to generate a compelling meta description for the chapter analysis that is engaging and encourages readers to click. The meta description should be no more than 180 characters long and should capture the essence of the chapter and the analysis in an enticing way.",
                ],
                [
                    "role" => "user",
                    "content" => "Chapter {$chapter}",
                ],
            ],
        ]);

        $d = json_decode($chat);
        $data = $d->choices[0]->message->content;

        update_field('last_meta_desc', $d, 'option');

        if (!$data) {
            dd($d, 'A');
        }

        $this->data = $data;

    }

}
