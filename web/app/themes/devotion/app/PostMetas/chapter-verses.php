<?php

namespace App\PostMetas;

class ChapterVerses
{
    public $id = 'chapter-verses-fields';
    public $title = 'Chapter Verses';
    public $postType = ['chapter'];

    public function render($post)
    {
        wp_nonce_field(basename(__FILE__), "ssu-post-additional-fields-nonce");

        $verses = get_field('verses', $post->ID);

        if (!$verses) {
            return;
        }

        $table = '<table class="form-table">';
        $table .= '<tr>';
        $table .= '<th style="width: 30px">Verse</th>';
        $table .= '<th style="width: auto">Text</th>';
        $table .= '</tr>';

        foreach ($verses as $verse) {
            $table .= '<tr>';
            $table .= '<td style="width: 30px"><strong>' . $verse['verse'] . '</strong></td>';
            $table .= '<td>' . $verse['text'] . '</td>';
            $table .= '</tr>';
        }

        $table .= '</table>';

        echo $table;
    }
}

return new ChapterVerses;
