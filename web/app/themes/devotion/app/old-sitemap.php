<?php
function custom_shop_sitemap()
{

    // sitemap.xml a link to all the sitemaps of the website
    if (strpos($_SERVER['REQUEST_URI'], 'sitemap.xml') !== false) {

        // Set the content type to XML
        header('Content-Type: application/xml');

        // Start the XML output
        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        // Add the sitemap of the website
        echo '<sitemap>';
        echo '<loc>' . home_url('/wp-sitemap.xml') . '</loc>';
        echo '</sitemap>';

        // Add the sitemap of the website
        echo '<sitemap>';
        echo '<loc>' . home_url('/bible-sitemap.xml') . '</loc>';
        echo '</sitemap>';

        // Add the sitemap of the website
        echo '<sitemap>';
        echo '<loc>' . home_url('/bible-media-verses.xml') . '</loc>';
        echo '</sitemap>';

        // Add the sitemap of the website
        echo '<sitemap>';
        echo '<loc>' . home_url('/bible-verses.xml') . '</loc>';
        echo '</sitemap>';

        echo '</sitemapindex>';
        exit;
    }

    // Check if the current request is for your "bible-sitemap.xml"
    if (strpos($_SERVER['REQUEST_URI'], 'bible-sitemap.xml') !== false) {

        // Set the content type to XML
        header('Content-Type: application/xml');

        // Start the XML output
        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        $books = get_books_schema();

        $urls = [];
        $url = home_url('/bible');
        $current_time = current_time('c');

        foreach ($books as $bookSlug => $book) {
            $urls[] = $url . '/' . $bookSlug;

            foreach ($book['chapters'] as $chapter) {
                $chapterNumber = $chapter['chapter'];
                $urls[] = $url . '/' . $bookSlug . '/chapter-' . $chapterNumber;

                $totalVerses = $chapter['verses'];

                // for ($i = 1; $i <= $totalVerses; $i++) {
                //     $urls[] = $url . '/' . $bookSlug . '/chapter-' . $chapterNumber . '/verse-' . $i;
                // }
            }
        }

        foreach ($urls as $url) {
            echo '<url>';
            echo '<loc>' . $url . '/</loc>';
            echo '<lastmod>' . $current_time . '</lastmod>';
            // echo '<changefreq>weekly</changefreq>';
            // echo '<priority>0.8</priority>';
            echo '</url>';
        }

        echo '</urlset>';
        exit;
    }

    if (strpos($_SERVER['REQUEST_URI'], 'wp-sitemap.xml') !== false) {

        // Set the content type to XML
        header('Content-Type: application/xml');

        // Start the XML output
        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        $books = get_books_schema();

        $urls = [];
        $url = home_url('/bible');
        $current_time = current_time('c');

        foreach ($books as $bookSlug => $book) {
            $urls[] = $url . '/' . $bookSlug;

            foreach ($book['chapters'] as $chapter) {
                $chapterNumber = $chapter['chapter'];
                $urls[] = $url . '/' . $bookSlug . '/chapter-' . $chapterNumber;

                $totalVerses = $chapter['verses'];

                // for ($i = 1; $i <= $totalVerses; $i++) {
                //     $urls[] = $url . '/' . $bookSlug . '/chapter-' . $chapterNumber . '/verse-' . $i;
                // }
            }
        }

        // get all pages
        $pages = get_pages();

        foreach ($pages as $page) {
            echo '<url>';
            echo '<loc>' . get_permalink($page->ID) . '</loc>';
            echo '<lastmod>' . get_the_modified_date('c', $page->ID) . '</lastmod>';
            // echo '<changefreq>weekly</changefreq>';
            // echo '<priority>0.8</priority>';
            echo '</url>';
        }

        //Books
        foreach ($urls as $url) {
            echo '<url>';
            echo '<loc>' . $url . '/</loc>';
            echo '<lastmod>' . $current_time . '</lastmod>';
            // echo '<changefreq>weekly</changefreq>';
            // echo '<priority>0.8</priority>';
            echo '</url>';
        }

        echo '</urlset>';
        exit;
    }

    if (strpos($_SERVER['REQUEST_URI'], 'bible-media-verses.xml') !== false) {

        // Set the content type to XML
        header('Content-Type: application/xml');

        // Start the XML output
        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        $urls = [];
        $current_time = current_time('c');

        $args = array(
            'post_type' => 'bible_verse',
            'posts_per_page' => -1,
        );

        $query = new WP_Query($args);

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $urls[] = get_field('verse_url');
            }
        }

        wp_reset_postdata();

        //Books
        foreach ($urls as $url) {
            echo '<url>';
            echo '<loc>' . $url . '</loc>';
            echo '<lastmod>' . $current_time . '</lastmod>';
            // echo '<changefreq>weekly</changefreq>';
            // echo '<priority>0.8</priority>';
            echo '</url>';
        }

        echo '</urlset>';
        exit;
    }

    if (strpos($_SERVER['REQUEST_URI'], 'bible-verses.xml') !== false) {

        global $wpdb;

        // Set the content type to XML
        header('Content-Type: application/xml');

        // Start the XML output
        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        $total = $wpdb->get_row("SELECT COUNT(*) as count FROM wp_dev_verse;");

        $total = $total->count;

        $limit = 10000;

        $pages = ceil($total / $limit);

        for ($i = 1; $i <= $pages; $i++) {
            echo '<sitemap>';
            echo '<loc>' . home_url('/bible-verses-page-' . $i . '.xml') . '</loc>';
            echo '</sitemap>';
        }

        echo '</sitemapindex>';
        exit;
    }

    if (strpos($_SERVER['REQUEST_URI'], 'bible-verses-page-') !== false) {

        global $wpdb;

        $page = str_replace('bible-verses-page-', '', $_SERVER['REQUEST_URI']);
        $page = str_replace('.xml', '', $page);

        $limit = 10000;

        // $page = only number removee all other characters
        $page = preg_replace('/\D/', '', $page);

        $offset = ($page - 1) * $limit;

        $verses = $wpdb->get_results("SELECT * FROM wp_dev_verse LIMIT $limit OFFSET $offset;");

        // Set the content type to XML
        header('Content-Type: application/xml');

        // Start the XML output
        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        $urls = [];
        $current_time = current_time('c');
        $home_url = home_url('bible');

        foreach ($verses as $verse) {
            $url = sanitize_title($verse->book) . '/chapter-' . $verse->chapter;

            if (strpos($verse->verse, '-') !== false) {
                $url .= '/verses-' . $verse->verse;
            } else {
                $url .= '/verse-' . $verse->verse;
            }

            $urls[] = $home_url . '/' . $url . '/';
        }

        //Books
        foreach ($urls as $url) {
            echo '<url>';
            echo '<loc>' . $url . '</loc>';
            echo '<lastmod>' . $current_time . '</lastmod>';
            // echo '<changefreq>weekly</changefreq>';
            // echo '<priority>0.8</priority>';
            echo '</url>';
        }

        echo '</urlset>';
        exit;
    }

    // Posts Blog
    if (strpos($_SERVER['REQUEST_URI'], 'wp-posts.xml') !== false) {

        global $wpdb;

        // Set the content type to XML
        header('Content-Type: application/xml');

        // Start the XML output
        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        $total = $wpdb->get_row("SELECT COUNT(*) as count FROM wp_posts WHERE post_type = 'post' AND post_status = 'publish';");

        $total = $total->count;

        $limit = 10000;

        $pages = ceil($total / $limit);

        for ($i = 1; $i <= $pages; $i++) {
            echo '<sitemap>';
            echo '<loc>' . home_url('/wp-posts-page-' . $i . '.xml') . '</loc>';
            echo '</sitemap>';
        }

        echo '</sitemapindex>';
        exit;

    }

    if (strpos($_SERVER['REQUEST_URI'], 'wp-posts-page-') !== false) {

        global $wpdb;

        $page = str_replace('wp-posts-page-', '', $_SERVER['REQUEST_URI']);
        $page = str_replace('.xml', '', $page);

        $limit = 10000;

        // $page = only number removee all other characters
        $page = preg_replace('/\D/', '', $page);

        $offset = ($page - 1) * $limit;

        $posts = $wpdb->get_results("SELECT * FROM wp_posts WHERE post_type = 'post' AND post_status = 'publish' LIMIT $limit OFFSET $offset;");

        // Set the content type to XML
        header('Content-Type: application/xml');

        // Start the XML output
        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        $urls = [];
        $post_date = false;

        foreach ($posts as $post) {
            $urls[] = get_permalink($post->ID);
            $post_date = $post->post_modified;
            $post_date = mysql2date('c', $post_date);
        }

        //Books
        foreach ($urls as $url) {
            echo '<url>';
            echo '<loc>' . $url . '</loc>';
            echo '<lastmod>' . $post_date . '</lastmod>';
            echo '</url>';
        }

        echo '</urlset>';
        exit;
    }

    // Tags
    if (strpos($_SERVER['REQUEST_URI'], 'wp-tags.xml') !== false) {

        $tags = get_tags();

        // Set the content type to XML
        header('Content-Type: application/xml');

        // Start the XML output
        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        $urls = [];

        foreach ($tags as $tag) {
            $urls[] = get_tag_link($tag->term_id);
        }

        $current_time = current_time('c');

        foreach ($urls as $url) {
            echo '<url>';
            echo '<loc>' . $url . '</loc>';
            echo '<lastmod>' . $current_time . '</lastmod>';
            echo '</url>';
        }

        echo '</urlset>';

        exit;

    }

    // Categories
    if (strpos($_SERVER['REQUEST_URI'], 'wp-categories.xml') !== false) {

        $categories = get_categories();

        // Set the content type to XML
        header('Content-Type: application/xml');

        // Start the XML output
        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        $urls = [];

        foreach ($categories as $category) {
            $urls[] = get_category_link($category->term_id);
        }

        $current_time = current_time('c');

        foreach ($urls as $url) {
            echo '<url>';
            echo '<loc>' . $url . '</loc>';
            echo '<lastmod>' . $current_time . '</lastmod>';
            echo '</url>';
        }

        echo '</urlset>';

        exit;
    }

}

add_action('init', 'custom_shop_sitemap');
