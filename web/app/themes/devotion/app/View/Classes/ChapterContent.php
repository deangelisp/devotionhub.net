<?php

namespace App\View\Classes;

use Orhanerday\OpenAi\OpenAi;

class ChapterContent
{
    public function __construct($book, $chapter, $postID)
    {

        $page_builder_blocks = get_field('page_builder_blocks', $postID);

        if ($page_builder_blocks) {
            return;
        }

        $open_ai_key = env('OPENAI_API_KEY');
        $open_ai = new OpenAi($open_ai_key);

        $chat = $open_ai->chat([
            'model' => 'gpt-4o',
            'messages' => [
                [
                    "role" => "system",
                    "content" => "You will be provided with a bible chapter from the book of {$book}. Your task is to generate a deep insightful analysis of the chapter, providing detailed explanations and interpretations of the verses. Your response should be thorough and informative, offering a unique perspective on the text. Please ensure that your analysis is accurate and relevant to the content of the chapter.\n
                                - The analysis should be at least 2000 words long., \n
                                - The analysis should be written in a clear and concise manner, making it easy to understand for readers., \n
                                - The analysis should be well-organized and structured, with a logical flow of ideas and arguments., \n
                                - The analysis should be original and unique, offering a fresh perspective on the text., \n
                                - The analysis has to support the content of the chapter, providing relevant explanations and interpretations of the verses., \n
                                - The analysis is pro bible and should not contain any negative or offensive content., \n\n

                                Use only the HTML tags <p>, <h2> to <h4>, <ul>, <ol>, <strong>, <blockquote>, and <i> where appropriate, without overusing tags unnecessarily. The analysis should not include <h1> tags and should begin with an <h2> title in the format: 'Analysis of {$book} Chapter {$chapter}'.
                    ",
                ],
                [
                    "role" => "user",
                    "content" => "Chapter {$chapter}",
                ],
            ],
        ]);

        $d = json_decode($chat);
        $content = $d->choices[0]->message->content;

        if (!$content) {
            dd($d);
        }

        update_field('page_builder_blocks', [
            [
                'acf_fc_layout' => 'content',
                "block_category_name" => "LongFormContentSections",
                "uppertitle" => "",
                "title" => "",
                "content" => $content,
                "content_width" => "narrow",
                "full_width_images" => true,
            ],
        ], $postID);
    }
}
