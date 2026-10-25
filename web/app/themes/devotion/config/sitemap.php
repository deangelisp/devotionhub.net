<?php
add_action('init', function () {
    // Posts
    handle_sitemap_request('post', 'post-sitemap.xml', 'Post Sitemap');
    handle_sitemap_request('page', 'page-sitemap.xml', 'Page Sitemap');

    // Taxonomy
    handle_taxonomy_sitemap('category', 'category-sitemap.xml', 'Category Sitemap');

    // Custom
    handle_books_sitemap('book', 'book-sitemap.xml', 'Book Sitemap');
    handle_chapters_sitemap('bible_chapter', 'bible-chapter-sitemap.xml', 'Bible Chapter Sitemap');
    handle_verses_sitemap('bible_verse', 'verses-sitemap.xml', 'Bible Verses Sitemap');
    handle_verses_page_sitemap();

    // Index
    html_sitemap_index();
});

/**
 * Detects whether the request is from a known bot.
 */
function is_a_bot()
{
    $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';

    return preg_match('/(bot|crawl|slurp|spider|Googlebot|Bingbot|SemrushBot|AhrefsBot|DotBot|MJ12bot)/i', $user_agent);
}

/**
 * Sitemap index page for both bots (XML) and users (HTML).
 */
function html_sitemap_index()
{
    if (strpos($_SERVER['REQUEST_URI'], 'sitemap.xml') === false) {
        return;
    }

    $sitemaps = [
        'post-sitemap.xml',
        'page-sitemap.xml',
        'bible-chapter-sitemap.xml',
        'category-sitemap.xml',
        'book-sitemap.xml',
        'verses-sitemap.xml',

    ];

    if (is_a_bot()) {
        header('Content-Type: application/xml; charset=utf-8');
        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        foreach ($sitemaps as $file) {
            echo '<sitemap><loc>' . esc_url(home_url($file)) . '</loc></sitemap>';
        }
        echo '</sitemapindex>';
        exit;
    }

    // HTML for users
    header('Content-Type: text/html; charset=utf-8');
    $home  = home_url();
    $count = count($sitemaps);

    echo '<!DOCTYPE html>';
    echo '<html><head><meta charset="UTF-8"><title>Sitemap</title>';
    echo '<style>
        body { font-family: Arial; padding: 40px; background: #f9f9f9; color: #333; }
        h1 { font-size: 24px; }
        ul { list-style: none; padding: 0; }
        li { margin: 8px 0; }
        a { color: #0073aa; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>';
    echo '</head><body>';
    echo '<h1>Sitemap Index</h1>';
    echo "<p>This sitemap index contains <strong>$count</strong> sitemaps.</p><ul>";

    foreach ($sitemaps as $file) {
        $url = esc_url($home . '/' . $file);
        echo "<li><a href=\"$url\">$url</a></li>";
    }

    echo '</ul>';
    echo '<p>This is a human-readable sitemap. For XML standards, visit <a href="https://sitemaps.org" target="_blank">sitemaps.org</a>.</p>';
    echo '</body></html>';

    exit;
}

/**
 * Handles sitemap rendering (XML for bots, HTML for users) for a given post type.
 */
function handle_sitemap_request($post_type, $endpoint, $human_title)
{
    if (strpos($_SERVER['REQUEST_URI'], $endpoint) === false) {
        return;
    }

    $args = [
        'post_type'      => $post_type,
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ];

    $posts = get_posts($args);

    if ($post_type === 'page') {
        $remove_ids = array_filter([
            get_option('woocommerce_checkout_page_id'),
            get_option('woocommerce_cart_page_id'),
            get_option('woocommerce_myaccount_page_id'),
        ]);

        foreach ($posts as $post_key => $post) {
            setup_postdata($post);

            if (
                in_array($post->ID, $remove_ids)
            ) {
                unset($posts[$post_key]);
            }
        }

        wp_reset_postdata();
    }

    if (is_a_bot()) {
        header('Content-Type: application/xml; charset=utf-8');

        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        foreach ($posts as $post) {
            $loc     = get_permalink($post->ID);
            $lastmod = get_the_modified_date('c', $post->ID);

            echo '<url>';
            echo '<loc>' . esc_url($loc) . '</loc>';
            echo '<lastmod>' . esc_html($lastmod) . '</lastmod>';
            echo '</url>';
        }

        echo '</urlset>';
        exit;
    }

    display_sitemap_table($posts, $human_title);
}

/**
 * Human-readable table display of sitemap.
 */
function display_sitemap_table($posts, $title)
{
    header('Content-Type: text/html; charset=utf-8');

    echo '<!DOCTYPE html>';
    echo '<html><head><meta charset="UTF-8"><title>' . esc_html($title) . '</title>';
    echo '<style>
        body { font-family: Arial, sans-serif; padding: 40px; background: #f9f9f9; color: #333; }
        h1 { font-size: 24px; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid #ccc; font-size: 14px; }
        th { background-color: #f2f2f2; text-align: left; }
        a { color: #0073aa; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>';
    echo '</head><body>';
    echo '<h1>' . esc_html($title) . '</h1>';
    echo '<table>';
    echo '<thead><tr><th>Title</th><th>URL</th><th>Last Modified</th></tr></thead>';
    echo '<tbody>';

    foreach ($posts as $post) {
        $url        = esc_url(get_permalink($post->ID));
        $post_title = esc_html(get_the_title($post->ID));
        $lastmod    = esc_html(get_the_modified_date('c', $post->ID));

        echo '<tr>';
        echo "<td>{$post_title}</td>";
        echo "<td><a href=\"{$url}\">{$url}</a></td>";
        echo "<td>{$lastmod}</td>";
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</body></html>';
    exit;
}

function handle_taxonomy_sitemap($taxonomy, $endpoint, $human_title)
{
    if (strpos($_SERVER['REQUEST_URI'], $endpoint) === false) {
        return;
    }

    $terms = get_terms([
        'taxonomy'   => $taxonomy,
        'hide_empty' => false,
    ]);

    if (is_wp_error($terms)) {
        return;
    }

    if (is_a_bot()) {
        header('Content-Type: application/xml; charset=utf-8');

        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        foreach ($terms as $term) {
            $loc     = get_term_link($term);
            $lastmod = current_time('c'); // Taxonomies don't have modification dates usually

            if (! is_wp_error($loc)) {
                echo '<url>';
                echo '<loc>' . esc_url($loc) . '</loc>';
                echo '<lastmod>' . esc_html($lastmod) . '</lastmod>';
                echo '</url>';
            }
        }

        echo '</urlset>';
        exit;
    }

    display_taxonomy_table($terms, $human_title);
}

function display_taxonomy_table($terms, $title)
{
    header('Content-Type: text/html; charset=utf-8');

    echo '<!DOCTYPE html>';
    echo '<html><head><meta charset="UTF-8"><title>' . esc_html($title) . '</title>';
    echo '<style>
        body { font-family: Arial, sans-serif; padding: 40px; background: #f9f9f9; color: #333; }
        h1 { font-size: 24px; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid #ccc; font-size: 14px; }
        th { background-color: #f2f2f2; text-align: left; }
        a { color: #0073aa; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>';
    echo '</head><body>';
    echo '<h1>' . esc_html($title) . '</h1>';
    echo '<table>';
    echo '<thead><tr><th>Name</th><th>URL</th></tr></thead>';
    echo '<tbody>';

    foreach ($terms as $term) {
        $url  = esc_url(get_term_link($term));
        $name = esc_html($term->name);

        if (! is_wp_error($url)) {
            echo '<tr>';
            echo "<td>{$name}</td>";
            echo "<td><a href=\"{$url}\">{$url}</a></td>";
            echo '</tr>';
        }
    }

    echo '</tbody>';
    echo '</table>';
    echo '</body></html>';
    exit;
}

/**
 * Handles the book sitemap.
 */
function handle_books_sitemap($taxonomy, $endpoint, $human_title)
{
    if (strpos($_SERVER['REQUEST_URI'], $endpoint) === false) {
        return;
    }

    $books = get_books_schema();

    if (is_a_bot()) {
        header('Content-Type: application/xml; charset=utf-8');

        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        foreach ($books as $book) {
            $loc = home_url('/bible/' . $book['slug'] . '/');
            if (is_wp_error($loc)) {
                continue;
            }

            echo '<url>';
            echo '<loc>' . esc_url($loc) . '</loc>';
            echo '<lastmod>' . current_time('c') . '</lastmod>';
            echo '</url>';
        }

        echo '</urlset>';
        exit;
    }

    display_books_table($books, $human_title);
}

/**
 * Displays the book sitemap in a human-readable table.
 */
function display_books_table($books, $title)
{
    header('Content-Type: text/html; charset=utf-8');
    echo '<!DOCTYPE html>';
    echo '<html><head><meta charset="UTF-8"><title>' . esc_html($title) . '</title>';
    echo '<style>
        body { font-family: Arial, sans-serif; padding: 40px; background: #f9f9f9; color: #333; }
        h1 { font-size: 24px; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid #ccc; font-size: 14px; }
        th { background-color: #f2f2f2; text-align: left; }
        a { color: #0073aa; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>';
    echo '</head><body>';
    echo '<h1>' . esc_html($title) . '</h1>';
    echo '<table>';
    echo '<thead><tr><th>Book</th><th>URL</th><th>Chapters</th></tr></thead>';
    echo '<tbody>';
    foreach ($books as $book) {
        $url      = esc_url(home_url('/bible/' . $book['slug'] . '/'));
        $name     = esc_html($book['title']);
        $chapters = count($book['chapters']);

        echo '<tr>';
        echo "<td>{$name}</td>";
        echo "<td><a href=\"{$url}\">{$url}</a></td>";
        echo "<td>{$chapters}</td>";
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</body></html>';
    exit;
}

/**
 * Handles the chapters sitemap.
 */
function handle_chapters_sitemap($post_type, $endpoint, $human_title)
{
    if (strpos($_SERVER['REQUEST_URI'], $endpoint) === false) {
        return;
    }

    $books    = get_books_schema();
    $chapters = [];

    foreach ($books as $book) {
        foreach ($book['chapters'] as $chapter) {
            $chapters[] = [
                'id'    => $chapter['id'],
                'title' => $chapter['title'],
                'url'   => home_url('/bible/' . $book['slug'] . '/chapter-' . $chapter['chapter'] . '/'),
            ];
        }
    }

    if (is_a_bot()) {
        header('Content-Type: application/xml; charset=utf-8');

        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        foreach ($chapters as $chapter) {
            $loc = esc_url($chapter['url']);
            if (is_wp_error($loc)) {
                continue;
            }

            echo '<url>';
            echo '<loc>' . $loc . '</loc>';
            echo '<lastmod>' . current_time('c') . '</lastmod>';
            echo '</url>';
        }

        echo '</urlset>';
        exit;
    }

    display_chapters_table($chapters, $human_title);
}

/**
 * Displays the chapters sitemap in a human-readable table.
 */
function display_chapters_table($chapters, $title)
{
    header('Content-Type: text/html; charset=utf-8');
    echo '<!DOCTYPE html>';
    echo '<html><head><meta charset="UTF-8"><title>' . esc_html($title) . '</title>';
    echo '<style>
        body { font-family: Arial, sans-serif; padding: 40px; background: #f9f9f9; color: #333; }
        h1 { font-size: 24px; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid #ccc; font-size: 14px; }
        th { background-color: #f2f2f2; text-align: left; }
        a { color: #0073aa; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>';
    echo '</head><body>';
    echo '<h1>' . esc_html($title) . '</h1>';
    echo '<table>';
    echo '<thead><tr><th>Chapter</th><th>Title</th><th>URL</th></tr></thead>';
    echo '<tbody>';

    foreach ($chapters as $chapter) {
        $url   = esc_url($chapter['url']);
        $title = esc_html($chapter['title']);
        $id    = esc_html($chapter['id']);

        echo '<tr>';
        echo "<td>{$id}</td>";
        echo "<td>{$title}</td>";
        echo "<td><a href=\"{$url}\">{$url}</a></td>";
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</body></html>';
    exit;
}

function handle_verses_sitemap($post_type, $endpoint, $human_title)
{
    if (strpos($_SERVER['REQUEST_URI'], $endpoint) === false) {
        return;
    }

    $books = get_books_schema();

    $all_verses = [];
    foreach ($books as $book_slug => $book_data) {
        $book_title = $book_data['title'];
        foreach ($book_data['chapters'] as $chapter_info) {
            $chapter_num = intval($chapter_info['chapter']);
            $verse_count = intval($chapter_info['verses']);
            for ($v = 1; $v <= $verse_count; $v++) {
                $all_verses[] = [
                    'book_slug'  => $book_slug,
                    'book_title' => $book_title,
                    'chapter'    => $chapter_num,
                    'verse'      => $v,
                ];
            }
        }
    }

    $pages = count($all_verses) / 100;
    $pages = ceil($pages);

    if (is_a_bot()) {
        header('Content-Type: application/xml; charset=utf-8');

        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        for ($page = 1; $page <= $pages; $page++) {
            $start = ($page - 1) * 100;
            $end   = min($start + 100, count($all_verses));
            $url   = home_url('/verses-page-' . $page . '-sitemap.xml');
            echo '<url>';
            echo '<loc>' . esc_url($url) . '</loc>';
            echo '<lastmod>' . current_time('c') . '</lastmod>';
            echo '</url>';
        }
        echo '</urlset>';
        exit;
    }

    display_verses_list_table($all_verses, $human_title, $pages);
}

/**
 * Displays a human-readable list of verse-sitemap pages.
 *
 * @param array  $verses All verse entries (not used for page listing but passed by caller).
 * @param string $title  The human-readable title (e.g., "Bible Verses Sitemap").
 * @param int    $pages  Total number of paginated sitemap pages.
 */
function display_verses_list_table($verses, $title, $pages)
{
    // Send correct header for HTML output:
    header('Content-Type: text/html; charset=utf-8');

    echo '<!DOCTYPE html>';
    echo '<html>';
    echo '<head><meta charset="UTF-8">';
    echo '<title>' . esc_html($title) . '</title>';
    echo '<style>
        body { font-family: Arial, sans-serif; padding: 40px; background: #f9f9f9; color: #333; }
        h1 { font-size: 24px; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ccc; font-size: 14px; }
        th { background-color: #f2f2f2; text-align: left; }
        a { color: #0073aa; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>';
    echo '</head>';
    echo '<body>';
    echo '<h1>' . esc_html($title) . '</h1>';
    echo '<p>There are <strong>' . intval($pages) . '</strong> pages of verse sitemaps. Click any link below to view that page:</p>';
    echo '<table>';
    echo '<thead><tr><th>Page #</th><th>Link</th></tr></thead>';
    echo '<tbody>';

    for ($i = 1; $i <= $pages; $i++) {
        $url = home_url('/verses-page-' . $i . '-sitemap.xml');
        echo '<tr>';
        echo '<td>' . $i . '</td>';
        echo '<td><a href="' . esc_url($url) . '">' . esc_html($url) . '</a></td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</body>';
    echo '</html>';
    exit;
}
/**
 * Outputs a <urlset> of 100 verses for requests matching
 * /verses-page-{N}-sitemap.xml. Example: /verses-page-1-sitemap.xml
 */
function handle_verses_page_sitemap()
{
    $request_uri = $_SERVER['REQUEST_URI'] ?? '';
    if (! preg_match('#/verses-page-([0-9]+)-sitemap\.xml$#', $request_uri, $matches)) {
        return;
    }

    // Determine requested page (clamp to >=1)
    $page = max(1, intval($matches[1]));

                                      // 1) Build flat array of all verses (~31,113 entries)
    $books      = get_books_schema(); // Your function returning all 66 books
    $all_verses = [];
    foreach ($books as $book_slug => $book_data) {
        $book_title = $book_data['title'];
        foreach ($book_data['chapters'] as $chapter_info) {
            $chapter_num = intval($chapter_info['chapter']);
            $verse_count = intval($chapter_info['verses']);
            for ($v = 1; $v <= $verse_count; $v++) {
                $all_verses[] = [
                    'book_slug'  => $book_slug,
                    'book_title' => $book_title,
                    'chapter'    => $chapter_num,
                    'verse'      => $v,
                ];
            }
        }
    }

                                        // 2) Calculate pagination
    $total_verses = count($all_verses); // e.g. 31113
    $per_page     = 100;
    $total_pages  = (int) ceil($total_verses / $per_page);

    // Clamp $page to $total_pages
    if ($page > $total_pages) {
        $page = $total_pages;
    }

    $offset = ($page - 1) * $per_page;
    $slice  = array_slice($all_verses, $offset, $per_page);

    // 3) Output XML <urlset> with 100 <url> entries (or fewer on last page)
    if (is_a_bot()) {
        header('Content-Type: application/xml; charset=utf-8');
        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        foreach ($slice as $entry) {
            $loc = home_url(
                sprintf(
                    '/bible/%s/chapter-%d/verse-%d/',
                    $entry['book_slug'],
                    $entry['chapter'],
                    $entry['verse']
                )
            );
            echo '<url>';
            echo '<loc>' . esc_url($loc) . '</loc>';
            echo '<lastmod>' . current_time('c') . '</lastmod>';
            echo '</url>';
        }

        echo '</urlset>';
        exit;
    }

    // 4) Output human-readable HTML table
    display_verses_page_table($slice, $page, $total_pages);
}

/**
 * Displays an HTML table of verses for a given page of the sitemap.
 *
 * @param array $slice       Array of verse entries for this page (each entry: ['book_slug','book_title','chapter','verse']).
 * @param int   $page        Current page number (1-based).
 * @param int   $total_pages Total number of pages.
 */
function display_verses_page_table($slice, $page, $total_pages)
{
    header('Content-Type: text/html; charset=utf-8');
    echo '<!DOCTYPE html>';
    echo '<html>';
    echo '<head><meta charset="UTF-8">';
    echo '<title>Bible Verses Sitemap – Page ' . intval($page) . ' of ' . intval($total_pages) . '</title>';
    echo '<style>
        body { font-family: Arial, sans-serif; padding: 30px; background: #f9f9f9; color: #333; }
        h1 { font-size: 24px; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ccc; font-size: 14px; text-align: left; }
        th { background-color: #f2f2f2; }
        a { color: #0073aa; text-decoration: none; }
        a:hover { text-decoration: underline; }
        .pagination { margin-top: 20px; font-size: 14px; }
        .pagination a { margin: 0 8px; text-decoration: none; color: #0073aa; }
        .pagination a.disabled { color: #999; pointer-events: none; }
    </style>';
    echo '</head>';
    echo '<body>';
    echo '<h1>Bible Verses Sitemap – Page ' . intval($page) . ' of ' . intval($total_pages) . '</h1>';
    echo '<table>';
    echo '<thead><tr><th>Book</th><th>Chapter</th><th>Verse</th><th>Link</th></tr></thead>';
    echo '<tbody>';
    foreach ($slice as $entry) {
        $url = home_url(
            sprintf(
                '/bible/%s/chapter-%d/verse-%d/',
                $entry['book_slug'],
                $entry['chapter'],
                $entry['verse']
            )
        );
        echo '<tr>';
        echo '<td>' . esc_html($entry['book_title']) . '</td>';
        echo '<td>' . intval($entry['chapter']) . '</td>';
        echo '<td>' . intval($entry['verse']) . '</td>';
        echo '<td><a href="' . esc_url($url) . '">' . esc_html($url) . '</a></td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';

    echo '<div class="pagination">';
    if ($page > 1) {
        echo '<a href="' . esc_url(home_url("/verses-page-" . ($page - 1) . "-sitemap.xml")) . '">&laquo; Previous</a>';
    } else {
        echo '<a class="disabled">&laquo; Previous</a>';
    }
    echo '<span>Page ' . intval($page) . ' of ' . intval($total_pages) . '</span>';
    if ($page < $total_pages) {
        echo '<a href="' . esc_url(home_url("/verses-page-" . ($page + 1) . "-sitemap.xml")) . '">Next &raquo;</a>';
    } else {
        echo '<a class="disabled">Next &raquo;</a>';
    }
    echo '</div>';

    echo '</body>';
    echo '</html>';
    exit;
}
