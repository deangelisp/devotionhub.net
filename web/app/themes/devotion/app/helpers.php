<?php

//ACF Builder: PAGE BUILDER: Check if the current post is a page and if it has a page template
function page_builder_condition_page_displays($block)
{
    // check if is admin  page
    if (! is_admin() || $_SERVER['REQUEST_METHOD'] == 'POST') {
        return true;
    }

    $blockPageDisplay = isset($block->pageDisplay) ? $block->pageDisplay : false;

    if (! $blockPageDisplay) {
        return true;
    }

    $blockPageDisplay = get_option($blockPageDisplay);

    $postID       = false;
    $pageTemplate = false;

    if (isset($_GET['post'])) {
        $postID = $_GET['post'];
    }

    if ($postID && $postID == $blockPageDisplay) {
        return true;
    }

    return false;
}

//Convert a phone number into a "tel:" URL
function generate_tel_url($phoneNumber)
{
    $cleanedNumber = preg_replace('/[^0-9+]/', '', $phoneNumber);

    $telURL = 'tel:' . $cleanedNumber;

    return $telURL;
}

//Identify the social media based on the URL
function identify_social_media($url)
{
    $social_medias = [
        'instagram',
        'facebook',
        'youtube',
        'twitter',
        'linkedin',
        'vimeo',
        'pinterest',
        'tiktok',
    ];

    $host = parse_url($url, PHP_URL_HOST);

    foreach ($social_medias as $key => $value) {
        if (strpos($host, $value) !== false) {
            return $value;
        }
    }

    return 'default';
}

/*
 * WordPress Menu in Array Format
 *
 * This function retrieves menu items from a given location and converts them into
 * an array structure. It also provides the option for nesting the menu items.
 */
function get_menu_items_by_location($location, $keys = ['ID', 'title', 'url', 'target', 'classes', 'xfn', 'children'], $nest = true)
{
    $locations  = get_nav_menu_locations();
    $menu_id    = $locations[$location] ?? null;
    $menu_items = wp_get_nav_menu_items($menu_id);

    $menu_items = nest_menu_items($menu_items, $keys);
    // if ($nest && $menu_items) {
    // }

    return $menu_items;
}

function nest_menu_items($menu_items, $keys = false, $parent_id = 0, $nest = true)
{
    $nested_menu_items = [];

    foreach ($menu_items as $i => $menu_item) {
        if ($menu_item->menu_item_parent == $parent_id) {
            unset($menu_items[$i]);

            if ($nest) {
                $menu_item->children = nest_menu_items($menu_items, $keys, $menu_item->ID);
            }

            if ($keys) {
                $menu_item = (array) $menu_item;
                $menu_item = array_intersect_key($menu_item, array_flip($keys));

                if (isset($menu_item['classes']) && ! empty($menu_item['classes'])) {
                    $menu_item['classes'] = implode(' ', $menu_item['classes']);
                }
            }

            $nested_menu_items[] = $menu_item;
        }
    }

    return $nested_menu_items;
}

/*
 * Get the current post ID.
 *
 * This function is a custom version of WordPress's get_the_ID() function.
 */
function get_true_post_id()
{
    global $wp_query;

    if ($wp_query->is_archive && $wp_query->is_post_type_archive) {
        $post_type = $wp_query->get('post_type');
        $page_id   = get_option("page_for_{$post_type}");

        if ($page_id) {
            return $page_id;
        }
    }

    $post_id = $wp_query->get_queried_object_id();

    // check if is 404 page
    if (is_404()) {
        $pages = get_pages([
            'meta_key'   => '_wp_page_template',
            'meta_value' => 'template-404-page.blade.php',
        ]);

        if ($pages) {
            $post_id = $pages[0]->ID;
        }
    }

    // check if is_woocommerce function exists
    if (function_exists('is_woocommerce') && is_woocommerce()) {

        if (is_woocommerce() && ! is_search()) {
            $post_id = get_option('woocommerce_shop_page_id');
        }
    }

    return $post_id;
}

/*
 * Get a array of the available forms from Forminator
 */
function get_forminator_forms()
{
    if (! class_exists('Forminator_API')) {
        return [];
    }

    $forms = Forminator_API::get_forms();

    $form_list = [];
    foreach ($forms as $form) {
        $form_list[] = [
            $form->id => $form->settings['formName'],
        ];
    }

    return $form_list;
}

// Get a array of all post type people roles
function get_people_roles()
{

    $args = [
        'post_type'      => 'people',
        'posts_per_page' => -1,
        'orderby'        => 'title',
        'order'          => 'ASC',
    ];

    $query = new WP_Query($args);

    $roles = [];

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $role = get_post_meta(get_the_ID(), 'role', true);

            if (! in_array($role, $roles)) {
                $roles[$role] = $role;
            }
        }
    }

    wp_reset_postdata();

    ksort($roles);

    return $roles;
}

// Get a array of all post type people departments
function get_people_departments()
{

    $args = [
        'post_type'      => 'people',
        'posts_per_page' => -1,
        'orderby'        => 'title',
        'order'          => 'ASC',
    ];

    $query = new WP_Query($args);

    $departments = [];

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $department = get_post_meta(get_the_ID(), 'department', true);

            if (! in_array($department, $departments)) {
                $departments[] = $department;
            }
        }
    }

    wp_reset_postdata();

    sort($departments);

    return $departments;
}

// Check if Woocommerce is active
function isWoocommerceActive($return = true)
{
    return class_exists('WooCommerce') ? $return : false;
}

// Get Custom Post Archive Page Data
function get_post_type_archive($post_type = null)
{
    if (! $post_type) {
        $post_type = get_post_type();
    }

    $post_name = get_post_type_object($post_type)->name;

    $post_id = get_field("settings_links_{$post_name}_page", 'option');

    if ($post_id) {
        return [
            'title' => get_the_title($post_id),
            'link'  => get_the_permalink($post_id),
        ];
    }

    return false;
}

// Remove P tag from shortcodes
function shortcode_content_filter($content)
{
    // Backup current registered filters
    global $wp_filter;
    $backup    = $wp_filter;
    $wp_filter = [];

    // Apply 'the_content' filters
    $content = apply_filters('the_content', $content);

    // Restore original filters
    $wp_filter = $backup;

    return $content;
}

// Trim Text to Length
function trim_text_to_length($text, $limit = 98)
{
    if ($text) {
        if (strlen($text) > $limit) {
            $text = substr($text, 0, $limit);
            $text = substr($text, 0, strrpos($text, ' '));
            $text .= '...';
        }
    }

    return $text;
}

// Get All blocks instances for ACF Building
$GLOBALS['blockInstancesCache'] = [];
function getAllBlockInstances()
{
    // Use the global array
    global $blockInstancesCache;

    $blockInstances = [];

    foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator(get_template_directory() . '/app/Fields/Blocks')) as $filename) {

        // Filter out directories and the BaseBlock.php
        if ($filename->isDir() || $filename->getFilename() == 'BaseBlock.php') {
            continue;
        }

        $parentDir = basename($filename->getPath());

        if ($parentDir == 'Footer' || $parentDir == 'Navbar') {
            continue;
        }

        // Include only PHP files
        if (pathinfo($filename, PATHINFO_EXTENSION) == 'php') {
            // Use include_once to avoid redeclaration of classes
            include_once $filename;
            $className = basename($filename, '.php');

            // Check if the instance already exists in the global array
            if (! isset($blockInstancesCache[$className])) {
                // If not, create a new instance and add it to the cache
                $blockInstancesCache[$className] = new $className();
            }

            // Add the instance (new or cached) to the blockInstances array
            $blockInstances[] = $blockInstancesCache[$className];
        }
    }

    return $blockInstances;
}

// Convert Sbake Case to Title
function convertSnakeCaseToTitle($input)
{
    $words = explode('_', $input);

    $words = array_map('ucwords', $words);

    return implode(' ', $words);
}

// Convert string to Camel Case
function toCamelCase($input)
{
    $words = explode(' ', strtolower($input));

    $words = array_map('ucwords', $words);

    return implode('', $words);
}

// Use on BackgroundBlock to get the text color
function getTextColorFromBackgroundBlock($block)
{
    $color = '';

    if ($block['background_element'] !== 'none') {
        $color = 'text-white';

        if ($block['background_element'] === 'color') {
            $color = match ($block['background_color']) {
                'primary' => 'text-white',
                'secondary' => 'text-white',
                default => '',
            };
        }
    }

    return $color;
}

// Get Post Thumbnail or Default
function getTheThumbnail($post_ID, $size = 'medium', $className = 'thumbnail')
{
    $attachment_id = false;

    if ($post_ID && has_post_thumbnail($post_ID)) {
        $attachment_id = get_post_thumbnail_id($post_ID);
    } else {
        $attachment_id = get_field('settings_general_default_thumbnail', 'option');
    }

    return wp_get_attachment_image($attachment_id, $size, false, ['class' => $className]);
}

//Convert Social medias to Array
function convertSocialMediasToArray($social_medias)
{

    if (! $social_medias) {
        $social_medias = get_field('settings_general_social_medias', 'options');
    }

    if (! $social_medias) {
        return false;
    }

    $links = [];

    foreach ($social_medias as $item) {

        $url          = $item['url'];
        $social_media = identify_social_media($url);

        $links[] = [
            'url'   => $url,
            'media' => $social_media,
        ];

    }

    return $links;

}

// Check if page has a gallery
function hasGallery($post_id = null)
{
    if (defined('DOING_AJAX') && DOING_AJAX) {
        $action = $_POST['action'] ?? null;
        if ($action && strpos($action, 'acf/fields') === false) {
            return;
        }
    }

    if (! $post_id) {
        $post_id = get_true_post_id();
    }

    $page_builder = get_field('page_builder_blocks', $post_id);

    if ($page_builder || is_array($page_builder)) {
        foreach ($page_builder as $block) {

            if (! is_array($block)) {
                continue;
            }

            foreach ($block as $key => $content) {
                if ($key == 'content') {
                    if (strpos($content, 'id="gallery') !== false || strpos($content, "id='gallery") !== false) {
                        return true;
                    }
                }

            }
        }
    }

    return false;
}

// Get taxonomy terms in array choices format
function getTaxonomyTermsInChoicesFormat($taxonomy, $placeholder = 'Select')
{
    $terms = get_terms([
        'taxonomy'   => $taxonomy,
        'hide_empty' => false,
    ]);

    $choices = ['' => $placeholder];

    if (is_wp_error($terms)) {
        return $choices;
    }

    foreach ($terms as $term) {
        $choices[$term->slug] = $term->name;
    }

    return $choices;
}

//Covert Repeater to Array
function convertRepeaterToArray($repeater, $key)
{
    $array = [];

    if ($repeater) {
        foreach ($repeater as $item) {
            $array[] = $item[$key];
        }
    }

    return $array;
}

//Check if string has tags
function containsHTML($string)
{
    $strippedString = strip_tags($string);
    if ($strippedString !== $string) {
        return true;
    } else {
        return false;
    }
}

// get acf repeater field when its not working properly
function get_acf_option_repeater_field($field, $sub_fields = [], $group = false)
{
    $repeater       = [];
    $number_of_rows = get_option('options_' . $field);

    if (! $number_of_rows) {
        foreach ($sub_fields as $sub_field) {
            // Construct the key according to how ACF stores data
            $option               = "options_{$field}_{$sub_field}";
            $repeater[$sub_field] = get_option($option);
        }
    } else {

        for ($i = 0; $i < $number_of_rows; $i++) {
            $row_data = [];
            foreach ($sub_fields as $sub_field) {
                // Construct the key according to how ACF stores data
                $option_key           = "options_{$field}_{$i}_{$sub_field}";
                $row_data[$sub_field] = get_option($option_key);
            }
            $repeater[] = $row_data;
        }
    }

    return $repeater;
}

//
// Bible
//

function getPreviousChapter($chapter)
{
    $previousChapter = $chapter - 1;

    if ($previousChapter < 1) {
        return false;
    }

    return $previousChapter;
}

function getNextChapter($bookID, $chapter)
{
    $bookTerm      = get_term($bookID, 'book');
    $totalChapters = get_field('total_chapters', "book_{$bookTerm->term_id}");

    $nextChapter = $chapter + 1;

    if ($nextChapter > $totalChapters) {
        return false;
    }

    return $nextChapter;
}

function getPreviousBook($bookID)
{
    $bookTerm = get_term($bookID, 'book');
    $order    = get_field('book_order', "book_{$bookTerm->term_id}");

    global $wpdb;

    $previousBook = $order - 1;

    $previousBook = $wpdb->get_row("SELECT * FROM {$wpdb->terms} WHERE term_id = (SELECT term_id FROM {$wpdb->termmeta} WHERE meta_key = 'book_order' AND meta_value = {$previousBook})");

    if (isset($previousBook->term_id)) {
        return [
            'id'    => $previousBook->term_id,
            'title' => $previousBook->name,
            'url'   => '/bible/' . $previousBook->slug . '/',
        ];
    }

    return false;
}

function getNextBook($bookID)
{
    $bookTerm = get_term($bookID, 'book');
    $order    = get_field('book_order', "book_{$bookTerm->term_id}");

    global $wpdb;

    $nextBook = $order + 1;

    $nextBook = $wpdb->get_row("SELECT * FROM {$wpdb->terms} WHERE term_id = (SELECT term_id FROM {$wpdb->termmeta} WHERE meta_key = 'book_order' AND meta_value = {$nextBook})");

    if (isset($nextBook->term_id)) {
        return [
            'id'    => $nextBook->term_id,
            'title' => $nextBook->name,
            'url'   => '/bible/' . $nextBook->slug . '/',
        ];
    }

    return false;

}

// Bible Super Search
function superSearch($input, $schema = false)
{

    if (! $schema) {
        $schema = get_books_schema();
    }

    $input = strtolower($input);
    $input = preg_replace('/[^\w\s:\-\/]/', '', $input);

    // Replace ordinals
    $input = str_replace(['1st', '2nd', '3rd'], ['1', '2', '3'], $input);

    $stopwords = [
        "explain", "explained", "meaning", "of", "study", "commentary",
        "seeking", "scripture", "describe", "description", "in", "your",
        "salvation", "and", "is", "rest", "repentance", "pure", "devotion",
        "verse", "verses", "that", "support", "has", "bible", "virsus", "the",
        "deep", "dive", "what", "does", "mean", 'chapter', // add these
    ];

    $words    = array_filter(explode(' ', $input));
    $newWords = [];
    foreach ($words as $w) {
        // Match something like "1samuel" or "2corinthians" where the book might start after a digit
        if (preg_match('/^(\d+)([a-z]+)/i', $w, $matches)) {
                                       // Insert a space between the digits and letters
                                       // e.g. "1samuel" → "1 samuel"
            $newWords[] = $matches[1]; // the digits, e.g. "1"
            $newWords[] = $matches[2]; // the letters, e.g. "samuel"
        } else {
            $newWords[] = $w;
        }
    }
    $words = $newWords;

    $filtered = [];

    $newFiltered = [];
    for ($i = 0; $i < count($filtered); $i++) {
        $w = $filtered[$i];
        if (in_array($w, $multiVolumeRoots)) {
            // Check next word
            if (isset($filtered[$i + 1]) && in_array($filtered[$i + 1], ['1', '2', '3'])) {
                // Combine into e.g. "1-kings"
                $newFiltered[] = $filtered[$i + 1] . '-' . $w;
                $i++; // skip next word as it's used
            } else {
                // Default to 1 if no number is given
                $newFiltered[] = '1-' . $w;
            }
        } else {
            $newFiltered[] = $w;
        }
    }
    $filtered = $newFiltered;

    foreach ($words as $w) {
        if (! in_array($w, $stopwords)) {
            $filtered[] = $w;
        }
    }

    // Synonyms map
    $synonyms = [
        'psalm'       => 'psalms',        // singular to plural
        'songs'       => 'song of songs', // "songs" to "song of songs"
        'psalm'       => 'psalms',
        'psa'         => 'psalms',
        'ps'          => 'psalms',
        'proverbes'   => 'proverbs',
        'proverbe'    => 'proverbs',
        'mathew'      => 'matthew',
        'mathewes'    => 'matthew',
        'revalations' => 'revelation',
        'revalation'  => 'revelation',
        'revalations' => 'revelation',
        'revelations' => 'revelation',
        'isaish'      => 'isaiah',
        'isiah'       => 'isaiah',
        'isaih'       => 'isaiah',
        'exdous'      => 'exodus',
        'deut'        => 'deuteronomy',
        '1 cor'       => '1 corinthians',
        '2 cor'       => '2 corinthians',
        '1 thes'      => '1 thessalonians',
        '2 thes'      => '2 thessalonians',
        '1 tim'       => '1 timothy',
        '2 tim'       => '2 timothy',
        '1 pet'       => '1 peter',
        '2 pet'       => '2 peter',
        '1 jon'       => '1 john',
        '2 jon'       => '2 john',
        '3 jon'       => '3 john',
        'lamenations' => 'lamentations',
        'gênesis'     => 'genesis',
        'gen'         => 'genesis',
        'zech'        => 'zechariah',
    ];

    // Apply synonyms
    $expanded = [];
    foreach ($filtered as $w) {
        if (isset($synonyms[$w])) {
            $synParts = explode(' ', $synonyms[$w]);
            foreach ($synParts as $part) {
                $expanded[] = $part;
            }
        } else {
            $expanded[] = $w;
        }
    }

    $filtered = $expanded;

    $bookSlug = findBookNameInAnyPosition($filtered, $schema);

    if (! $bookSlug) {
        return ['url' => '/the-books-of-the-bible/'];
    }

    $bookTitle  = strtolower($schema[$bookSlug]['title']);
    $titleParts = explode(' ', $bookTitle);

    $multiVolumeRoots = [
        'kings', 'chronicles', 'samuel', 'corinthians', 'thessalonians', 'timothy', 'john', 'peter',
    ];
    $newFiltered = [];
    for ($i = 0; $i < count($filtered); $i++) {
        $w = $filtered[$i];
        if (in_array($w, $multiVolumeRoots)) {
            // Check next word
            if (! (isset($filtered[0]) && in_array($filtered[0], ['1', '2', '3']))) {
                // add 1 to the beginning
                $newFiltered[] = '1';
                break;
            }
        }
    }
    $filtered = array_merge($newFiltered, $filtered);

    $pos = findBookPosition($filtered, $titleParts);
    if ($pos === false) {
        return ['url' => '/the-books-of-the-bible/'];
    }

    array_splice($filtered, $pos, count($titleParts));
    $remaining = implode(' ', $filtered);

    $chapter    = null;
    $verseStart = null;
    $verseEnd   = null;

    if (preg_match('/(\d+)\s+(\d+)-(\d+)/', $remaining, $m)) {
        // Handle space-separated chapter and verse range, e.g., "60 2-3"
        $chapter    = (int) $m[1];
        $verseStart = (int) $m[2];
        $verseEnd   = (int) $m[3];
    } elseif (preg_match('/(\d+)\s+(\d+)/', $remaining, $m)) {
        // Handle space-separated chapter and single verse, e.g., "60 2"
        $chapter    = (int) $m[1];
        $verseStart = (int) $m[2];
    } elseif (preg_match('/(\d+):(\d+)(?:-(\d+))?/', $remaining, $m)) {
        // Handle colon-separated chapter and verse range, e.g., "60:2-3"
        $chapter    = (int) $m[1];
        $verseStart = (int) $m[2];
        if (isset($m[3]) && $m[3] !== '') {
            $verseEnd = (int) $m[3];
        }
    } elseif (preg_match('/(\d+)\/(\d+)/', $remaining, $m)) {
        // Handle slash-separated chapter and verse, e.g., "60/2"
        $chapter    = (int) $m[1];
        $verseStart = (int) $m[2];
    } elseif (preg_match('/(\d+)\s*-\s*(\d+)/', $remaining, $m)) {
        // Handle dash-separated chapter and single verse, e.g., "60-2"
        $chapter    = (int) $m[1];
        $verseStart = (int) $m[2];
    } else {
        // Fallback: Parse numbers from the input if no pattern matched
        $nums = [];
        foreach (explode(' ', $remaining) as $w) {
            if (ctype_digit($w)) {
                $nums[] = (int) $w;
            } elseif (preg_match('/(\d+)-(\d+)/', $w, $mm)) {
                $nums[] = (int) $mm[1];
                $nums[] = (int) $mm[2];
            }
        }

        if (! empty($nums)) {
            if (count($nums) === 1) {
                $chapter = $nums[0];
            } elseif (count($nums) === 2) {
                $chapter    = $nums[0];
                $verseStart = $nums[1];
            } else {
                $chapter    = $nums[0];
                $verseStart = $nums[1];
                $verseEnd   = end($nums);
            }
        }
    }

    return validateAndBuildResult($bookSlug, $chapter, $verseStart, $verseEnd, $schema);
}

function findBookNameInAnyPosition($words, $schema)
{
    $bookList = [];
    foreach ($schema as $slug => $data) {
        $bookList[] = [$slug, strtolower($data['title'])];
    }

    $bestSlug     = null;
    $bestDistance = 999;
    $bestPos      = null;
    $bestLength   = 0;

    $count = count($words);
    for ($i = 0; $i < $count; $i++) {
        $oneWord = $words[$i];

        // One-word match
        foreach ($bookList as [$slug, $title]) {
            $dist = levenshtein($oneWord, $title);
            if ($dist < $bestDistance) {
                $bestDistance = $dist;
                $bestSlug     = $slug;
                $bestPos      = $i;
                $bestLength   = 1;
            }
        }

        // Two-word match if possible
        if ($i < $count - 1) {
            $twoWords = $oneWord . ' ' . $words[$i + 1];
            foreach ($bookList as [$slug, $title]) {
                $dist = levenshtein($twoWords, $title);
                if ($dist < $bestDistance) {
                    $bestDistance = $dist;
                    $bestSlug     = $slug;
                    $bestPos      = $i;
                    $bestLength   = 2;
                }
            }
        }

        // Three-word match if possible
        if ($i < $count - 2) {
            $threeWords = $oneWord . ' ' . $words[$i + 1] . ' ' . $words[$i + 2];
            foreach ($bookList as [$slug, $title]) {
                $dist = levenshtein($threeWords, $title);
                if ($dist < $bestDistance) {
                    $bestDistance = $dist;
                    $bestSlug     = $slug;
                    $bestPos      = $i;
                    $bestLength   = 3;
                }
            }
        }
    }

    // If you specifically want to handle "song of songs" more directly:
    // Check if "song", "of", "songs" appear in sequence:
    for ($i = 0; $i < $count - 2; $i++) {
        if ($words[$i] === 'song' && $words[$i + 1] === 'of' && $words[$i + 2] === 'songs') {
            // Directly map to "song-of-songs" if it exists in schema
            if (isset($schema['song-of-songs'])) {
                return 'song-of-songs';
            }
        }
    }

    // Optional threshold check
    if ($bestDistance > 10) {
        return null;
    }

    return $bestSlug;
}

function findBookPosition($words, $titleParts)
{
    // Find where titleParts appear in $words
    // For simplicity, just do a sliding window exact match:
    $length = count($titleParts);
    for ($i = 0; $i <= count($words) - $length; $i++) {
        $segment = array_slice($words, $i, $length);
        // Compare fuzzy or exact?
        // Let's do a lowercase exact match since we've matched fuzzy above.
        if (array_map('strtolower', $segment) === array_map('strtolower', $titleParts)) {
            return $i;
        }
    }

    // If exact not found (due to fuzzy replaced?), return the best fuzzy position found from findBookNameInAnyPosition
    // In practice, store bestPos and bestLength from that function and reuse here.

    // This code assumes we have the best position from findBookNameInAnyPosition.
    // You'd modify findBookNameInAnyPosition to return also position and length, or store them globally.
    // For now, just do a fallback fuzzy match here again or return false if not found.
    return false;
}

function validateAndBuildResult($bookSlug, $chapter, $verseStart, $verseEnd, $schema)
{
    $bookData   = $schema[$bookSlug];
    $chapters   = $bookData['chapters'];
    $maxChapter = count($chapters);

    if ($chapter !== null) {
        if ($chapter < 1 || $chapter > $maxChapter) {
            return ['book' => $bookSlug, 'url' => '/bible/' . $bookSlug . '/'];
        }
        $chapterData = $chapters[$chapter - 1];
        $maxVerses   = (int) $chapterData['verses'];
        if ($verseStart !== null) {
            if ($verseEnd === null) {
                $verseEnd = $verseStart;
            }

            if ($verseStart < 1 || $verseStart > $maxVerses || $verseEnd < 1 || $verseEnd > $maxVerses) {
                return ['book' => $bookSlug, 'chapter' => $chapter, 'url' => '/bible/' . $bookSlug . '/chapter-' . $chapter . '/'];
            }
            $segment = ($verseStart === $verseEnd) ? 'verse-' . $verseStart : 'verses-' . $verseStart . '-' . $verseEnd;
            return ['book' => $bookSlug, 'chapter' => $chapter, 'verses' => ($verseStart === $verseEnd ? (string) $verseStart : $verseStart . '-' . $verseEnd),
                'url'          => '/bible/' . $bookSlug . '/chapter-' . $chapter . '/' . $segment . '/'];
        } else {
            return ['book' => $bookSlug, 'chapter' => $chapter, 'url' => '/bible/' . $bookSlug . '/chapter-' . $chapter . '/'];
        }
    } else {
        return ['book' => $bookSlug, 'url' => '/bible/' . $bookSlug . '/'];
    }
}

//  Bible Super Search - Finish

function getBookFromSchema($bookID, $books = false)
{

    if (! $books) {
        $books = get_books_schema();
    }

    foreach ($books as $bookSlug => $bookData) {
        if ($bookData['id'] == $bookID) {
            return $bookData;
        }
    }

    return false;
}

// FAQ - Google Structured Data
function getFaqStructuredData($items)
{

    $script = '<script type="application/ld+json">' . PHP_EOL;
    $script .= '{' . PHP_EOL;
    $script .= '  "@context": "http://schema.org",' . PHP_EOL;
    $script .= '  "@type": "FAQPage",' . PHP_EOL;
    $script .= '  "mainEntity": [' . PHP_EOL;

    foreach ($items as $key => $item) {

        // $answer remove html
        $question = strip_tags($item['heading']);
        $answer   = strip_tags(($item['body']));

        $script .= '    {' . PHP_EOL;
        $script .= '      "@type": "Question",' . PHP_EOL;
        $script .= '      "name": "' . $question . '",' . PHP_EOL;
        $script .= '      "acceptedAnswer": {' . PHP_EOL;
        $script .= '        "@type": "Answer",' . PHP_EOL;
        $script .= '        "text": "' . $answer . '"' . PHP_EOL;
        $script .= '      }' . PHP_EOL;
        $script .= '    }' . PHP_EOL;

        if ($key < count($items) - 1) {
            $script .= ',' . PHP_EOL;
        }

    }

    $script .= '  ]' . PHP_EOL;
    $script .= '}' . PHP_EOL;
    $script .= '</script>' . PHP_EOL;

    return $script;
}

// Breadcrumb - Google Structured Data
function getBreadcrumbStructuredData($breadcrumbs)
{

    if (empty($breadcrumbs)) {
        return;
    }

    $url = home_url();

    $script = '<script type="application/ld+json">' . PHP_EOL;
    $script .= '{' . PHP_EOL;
    $script .= '  "@context": "http://schema.org",' . PHP_EOL;
    $script .= '  "@type": "BreadcrumbList",' . PHP_EOL;
    $script .= '  "itemListElement": [' . PHP_EOL;

    $pos = 1;
    foreach ($breadcrumbs as $name => $path) {

        $item = $url . $path;

        $script .= '    {' . PHP_EOL;
        $script .= '     "@type": "ListItem",' . PHP_EOL;
        $script .= "      \"position\": {$pos}," . PHP_EOL;
        $script .= "      \"name\": \"{$name}\"," . PHP_EOL;
        $script .= "      \"item\": \"{$item}\"" . PHP_EOL;
        $script .= '    }';

        if ($pos < count($breadcrumbs)) {
            $script .= ',';
        }
        $script .= PHP_EOL;
        $pos++;
    }

    $script .= '  ]' . PHP_EOL;
    $script .= '}' . PHP_EOL;
    $script .= '</script>' . PHP_EOL;

    return $script;
}

function get_book_by_title($title)
{
    $books = get_books_schema();

    foreach ($books as $book) {
        if ($book['title'] == $title) {
            return $book;
        }
    }

    return false;
}

function get_chapter_by_title($bookID, $title)
{
    $book = getBookFromSchema($bookID);

    if (! isset($book['chapters']) || ! is_array($book['chapters'])) {
        dd($bookID, $title, $book, 'S');
    }

    foreach ($book['chapters'] as $chapter) {
        if ($chapter['chapter'] == $title) {
            return $chapter;
        }
    }

    return false;
}

function get_verse_from_chapter($chapter_id, $verse_id)
{
    $verses = get_field('verses', $chapter_id);

    $verse_id = explode('-', $verse_id);
    $verse_id = $verse_id[0];

    $verse = array_filter($verses, function ($verse) use ($verse_id) {
        return $verse['verse'] == $verse_id;
    });

    $verse = array_shift($verse);

    $text = $verse['text'];

    $text = str_replace('<br/>', ' ', $text);
    $text = str_replace('<br />', ' ', $text);
    $text = str_replace('<br>', ' ', $text);
    $text = str_replace('<br >', ' ', $text);
    $text = str_replace('\n', ' ', $text);
    $text = mb_strimwidth($text, 0, 98, '...');

    return $text;

}

function get_post_by_title($title, $post_type = 'page', $output = OBJECT)
{
    $args = [
        'post_type'      => $post_type,
        'title'          => $title,
        'posts_per_page' => 1,
    ];

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        $post = $query->post; // Get the first matched post

        // Return the post in the requested format
        if ($output === ARRAY_A) {
            $post = (array) $post;
        } elseif ($output === ARRAY_N) {
            $post = array_values((array) $post);
        }

        wp_reset_postdata(); // Reset post data
        return $post;
    }

    wp_reset_postdata(); // Reset post data
    return null;         // Return null if no post is found
}

//
// Email
//

function format_content_to_email($content, $display_name = false)
{
    $content = wpautop($content);
    $content = str_replace('<p', '<p style="margin: 0 0 10px 0; padding: 0; font-size: 16px; line-height: 1.7em;"', $content);
    $content = str_replace('<strong', '<strong style="font-weight: 600"', $content);

    $content = str_replace('<h2', '<h2 style="margin: 40px 0 10px 0; padding: 0; font-size: 24px; font-weight: 500"', $content);

    $content = str_replace('<h3', '<h3 style="margin: 30px 0 10px 0; padding: 0; font-size: 18px; font-weight: 500"', $content);

    $content = str_replace('<ul', '<ul style="margin: 0 0 30px 0; padding: 0 0 0 18px; list-style: disc; "', $content);
    $content = str_replace('<ol', '<ol style="margin: 0 0 30px 0; padding: 0 0 0 18px; list-style: decimal; "', $content);

    $content = str_replace('<li', '<li style="margin: 0 0 10px 0; padding: 0; font-size: 16px; line-height: 1.7em;"', $content);

    $content = str_replace('<hr', '<hr style="margin: 30px 0; padding: 0; border: 0; border-top: 1px solid #f0f0f0;"', $content);

    // small
    $content = preg_replace('/<small>(.*?)<\/small>/', '<small style="font-size: 12px; ">$1</small>', $content);

    // blockquote
    $content = styleBlockquoteContent($content);

    $content = str_replace('<blockquote', '<blockquote style="margin: 0 0 30px 0; padding: 20px 20px 10px 20px;  border-radius: 8px; background-color: #f9f9f9; font-size: 16px; line-height: 1.7em;"', $content);

    if ($display_name) {
        $content = str_replace('{{display_name}}', $display_name, $content);
    }

    return $content;
}

function styleBlockquoteContent($content)
{
    // Load the content into DOMDocument
    $dom = new DOMDocument();
    @$dom->loadHTML('<?xml encoding="utf-8" ?>' . $content); // Suppress warnings for invalid HTML

    // Create an XPath object to query specific elements
    $xpath = new DOMXPath($dom);

    // Find all <blockquote> elements
    $blockquotes = $xpath->query('//blockquote');

    foreach ($blockquotes as $blockquote) {
        // Get all <p> tags within the current <blockquote>
        $pTags = $blockquote->getElementsByTagName('p');

        // Loop through each <p> tag
        foreach ($pTags as $index => $p) {
            // Remove any existing style attribute
            $p->removeAttribute('style');

            // Apply centered style to all <p> tags initially
            $p->setAttribute('style', 'margin: 0 0 10px 0; text-align: center; font-size: 16px; line-height: 1.7em; font-weight: 500');

            if ($pTags->length > 1) {
                // If it's the last <p> tag, apply the right-aligned, italic style
                if ($index === $pTags->length - 1) {
                    $p->setAttribute('style', 'margin: 0 0 10px 0; text-align: right; font-style: italic; font-size: 14px;');
                }
            }
        }
    }

    // Save the modified HTML content
    $bodyContent = $dom->saveHTML($dom->getElementsByTagName('body')->item(0));
    return str_replace(['<body>', '</body>'], '', $bodyContent); // Remove the wrapping body tag added by DOMDocument
}

//
// Course
//

function get_user_lesson($course_id, $lesson_key)
{
    $lessons = get_field('lessons', $course_id);

    $lesson = array_filter($lessons, function ($lesson, $key) use ($lesson_key) {
        return $key == $lesson_key;
    }, ARRAY_FILTER_USE_BOTH);

    $lesson = array_shift($lesson);
    $lesson = $lesson['lesson'];

    return $lesson;
}

function get_string_between($string, $start, $end)
{
    $string = ' ' . $string;
    $ini    = strpos($string, $start);

    if ($ini == 0) {
        return '';
    }

    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;

    return substr($string, $ini, $len);
}

//set Session message
function set_session_message($title = 'Notification', $message = '', $type = 'success')
{
    $_SESSION['message'] = [
        'title'   => $title,
        'message' => $message,
        'type'    => $type,
    ];
}

function get_session_message()
{
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
        unset($_SESSION['message']);
        return $message;
    }
    return null;
}

// Create unsubscribe link
function create_unsubscribe_link($email, $course_id = null)
{
    $secret_key = $_ENV['UNSUBSCRIBE_SECRET_KEY'];
    $date       = date('Y-m-d');
    $token      = hash('sha256', $email . $secret_key . $date);

    $link = home_url('/?email=' . $email . '&token=' . $token . '&action=unsubscribe' . '&course_id=' . $course_id);
    return $link;
}

//generate Course structured data
function generate_course_structured_data($post_id)
{

    $title       = get_the_title($post_id);
    $description = get_the_excerpt($post_id);
    $image       = get_the_post_thumbnail_url($post_id, 'full');

    // freeCourse

    $script = '<script type="application/ld+json">' . PHP_EOL;
    $script .= '{' . PHP_EOL;
    $script .= '  "@context": "http://schema.org",' . PHP_EOL;
    $script .= '  "@type": "Course",' . PHP_EOL;
    $script .= '  "name": "' . $title . '",' . PHP_EOL;
    $script .= '  "description": "' . $description . '",' . PHP_EOL;
    $script .= '  "provider": {' . PHP_EOL;
    $script .= '    "@type": "Organization",' . PHP_EOL;
    $script .= '    "name": "' . get_bloginfo('name') . '",' . PHP_EOL;
    $script .= '    "sameAs": "' . home_url() . '"' . PHP_EOL;
    $script .= '  },' . PHP_EOL;
    $script .= '  "hasCourseInstance": {' . PHP_EOL;
    $script .= '    "@type": "CourseInstance",' . PHP_EOL;
    $script .= '    "name": "' . $title . '",' . PHP_EOL;
    $script .= '    "description": "' . $description . '",' . PHP_EOL;
    $script .= '    "courseMode": "online",' . PHP_EOL;
    $script .= '    "image": "' . $image . '",' . PHP_EOL;
    $script .= '    "courseSchedule": {' . PHP_EOL;
    $script .= '      "@type": "CourseInstance",' . PHP_EOL;
    $script .= '      "repeatCount": "90",' . PHP_EOL;
    $script .= '      "repeatFrequency": "Daily"' . PHP_EOL;
    $script .= '    }' . PHP_EOL;
    $script .= '  },' . PHP_EOL;
    $script .= '  "offers": [{' . PHP_EOL;
    $script .= '    "@type": "Offer",' . PHP_EOL;
    $script .= '    "price": "0",' . PHP_EOL;
    $script .= '    "priceCurrency": "USD",' . PHP_EOL;
    $script .= '    "category": "free"' . PHP_EOL;
    $script .= '  }]' . PHP_EOL;
    $script .= '}' . PHP_EOL;
    $script .= '</script>' . PHP_EOL;

    return $script;
}

// get extra data blocks
function get_extra_data_blocks($passage)
{

    $extraData = get_posts([
        'post_type'  => 'extra_data',
        'meta_query' => [
            [
                'key'     => 'passage',
                'value'   => $passage,
                'compare' => '=',
            ],
        ],
    ]);

    $blocks = [];

    foreach ($extraData as $data) {
        $blocks[] = [
            get_field('page_builder_blocks', $data->ID),
        ];
    }

    $blocks = array_filter($blocks);

    if (! $blocks) {
        return false;
    }

    // merge all blocks into one array
    $blocks = array_merge(...$blocks);
    $blocks = array_filter($blocks);
    $blocks = array_merge(...$blocks);

    return $blocks;
}
