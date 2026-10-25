<?php

function magical_get_cat($catName)
{
    $cat = get_term_by('name', $catName, 'category');
    if ($cat) {
        return $cat->term_id;
    } else {
        $cat_id = wp_insert_term($catName, 'category');
        return $cat_id['term_id'];
    }
}

function check_if_title_exists($title)
{
    // use sql $wpdb;
    global $wpdb;

    $query = $wpdb->prepare(
        "SELECT ID FROM $wpdb->posts WHERE post_title = %s AND post_type = %s",
        $title,
        'post'
    );

    $post_id = $wpdb->get_var($query);

    return $post_id;

}

function magical_crete_date()
{
    // randon date in 2024
    $year = 2024;

    $month = rand(1, 11);

    $day = rand(1, 28);

    $hour = rand(0, 23);

    $minute = rand(0, 59);

    $second = rand(0, 59);

    return "$year-$month-$day $hour:$minute:$second";
}

function magical_create_posts($posts)
{

    // check if title exists

    foreach ($posts as $post) {

        if (check_if_title_exists($post['title'])) {
            continue;
        }

        $postDate = magical_crete_date();

        $post_id = wp_insert_post([
            'post_title' => $post['title'],
            'post_content' => '',
            'post_status' => 'publish',
            'post_author' => 1,
            'post_type' => 'post',
            'post_category' => [magical_get_cat($post['category'])],
            'post_excerpt' => $post['excerpt'],
            'post_date' => $postDate,

        ]);

        if (!is_wp_error($post_id)) {
            update_field('summary', $post['summary'], $post_id);

            foreach ($post['tags'] as $tag) {
                wp_set_post_tags($post_id, $tag, true);
            }
        }
    }
}

add_action('false', function () {
    if (isset($_GET['create_posts'])) {

        $posts = [
            [
                'title' => "God’s Unfailing Love: Exploring John 3:16",
                'category' => "John 3",
                'tags' => ['God’s Love', 'Faith', 'Salvation', 'Grace', 'John 3:16'],
                'summary' => "God revealed in John 3:16 and its promise of eternal life through faith in Jesus Christ.",
                'excerpt' => "Explore John 3:16 and learn about God's unfailing love and the gift of eternal life offered through Jesus Christ.",
            ],
            [
                'title' => "Finding Peace in Psalm 23: The Lord is My Shepherd",
                'category' => "Psalm 23",
                'tags' => ['God’s Guidance', 'Peace', 'Trust', 'Comfort', 'Psalm 23'],
                'summary' => "Psalm 23 reveals God as our shepherd, offering peace and guidance in life’s challenges.",
                'excerpt' => "Dive into Psalm 23 to uncover how God provides peace, protection, and guidance in every season of life.",
            ],
            [
                'title' => "The Creation Story: Lessons from Genesis 1",
                'category' => "Genesis 1",
                'tags' => ['Creation', 'God’s Power', 'Genesis', 'Genesis 1'],
                'summary' => "Genesis 1 shares the story of God’s creative power and the beginning of everything.",
                'excerpt' => "Explore Genesis 1 to understand God's role as Creator and His divine order in the world.",
            ],
            [
                'title' => "Living in the Spirit: Romans 8 Explained",
                'category' => "Romans 8",
                'tags' => ['Holy Spirit', 'Christian Life', 'God’s Love', 'Romans 8'],
                'summary' => "Romans 8 highlights life through the Spirit and assurance of God’s love.",
                'excerpt' => "Discover Romans 8 and its insights on living in the Spirit and experiencing God’s eternal love.",
            ],
            [
                'title' => "What is Love? A Study of 1 Corinthians 13",
                'category' => "1 Corinthians 13",
                'tags' => ['Love', 'Christian Living', 'Faith', '1 Corinthians 13'],
                'summary' => "1 Corinthians 13 defines true love and its role in Christian living.",
                'excerpt' => "Explore 1 Corinthians 13 to uncover what it means to love as God loves.",
            ],
            [
                'title' => "Plans for Hope and a Future: A Reflection on Jeremiah 29:11",
                'category' => "Jeremiah 29",
                'tags' => ['Hope', 'God’s Plan', 'Faith', 'Jeremiah 29:11'],
                'summary' => "Jeremiah 29:11 offers hope in God’s plans for our future.",
                'excerpt' => "Learn from Jeremiah 29:11 about God’s promise of hope, plans, and a future filled with His purpose.",
            ],
            [
                'title' => "Strength Through Christ: Unpacking Philippians 4:13",
                'category' => "Philippians 4",
                'tags' => ['Strength', 'Faith', 'Christ', 'Philippians 4:13'],
                'summary' => "Philippians 4:13 emphasizes strength through Christ in all circumstances.",
                'excerpt' => "Discover how Philippians 4:13 inspires believers to find strength in Christ for every challenge.",
            ],
            [
                'title' => "Trust and Submission: Wisdom from Proverbs 3:5-6",
                'category' => "Proverbs 3",
                'tags' => ['Trust', 'Wisdom', 'God’s Will', 'Proverbs 3:5-6'],
                'summary' => "Proverbs 3:5-6 encourages trust and submission to God’s guidance.",
                'excerpt' => "Explore Proverbs 3:5-6 to learn the power of trusting God and submitting to His will.",
            ],
            [
                'title' => "The Sermon on the Mount: Matthew 5-7 in Focus",
                'category' => "Matthew 5-7",
                'tags' => ['Jesus’ Teachings', 'Christian Living', 'Righteousness', 'Matthew 5-7'],
                'summary' => "Matthew 5-7 presents Jesus’ teachings on Christian living and righteousness.",
                'excerpt' => "Dive into Matthew 5-7 to explore the transformative teachings of the Sermon on the Mount.",
            ],
            [
                'title' => "The Suffering Servant: Insights from Isaiah 53",
                'category' => "Isaiah 53",
                'tags' => ['Jesus as Servant', 'Prophecy', 'Sacrifice', 'Isaiah 53'],
                'summary' => "Isaiah 53 foretells Jesus as the suffering servant who redeems humanity.",
                'excerpt' => "Unpack Isaiah 53 to understand the prophetic description of Jesus’ sacrifice for our redemption.",
            ],
            [
                'title' => "Under God’s Wing: Comfort from Psalm 91",
                'category' => "Psalm 91",
                'tags' => ['God’s Protection', 'Comfort', 'Faith', 'Psalm 91'],
                'summary' => "Psalm 91 reflects God’s protection and refuge in life’s dangers.",
                'excerpt' => "Find comfort in Psalm 91 as it illustrates God's shelter and protection for those who trust Him.",
            ],
            [
                'title' => "Spiritual Battle Gear: Understanding Ephesians 6:10-18",
                'category' => "Ephesians 6",
                'tags' => ['Spiritual Warfare', 'Faith', 'God’s Protection', 'Ephesians 6:10-18'],
                'summary' => "Ephesians 6 teaches about the Armor of God for spiritual battles.",
                'excerpt' => "Learn from Ephesians 6:10-18 how to put on the Armor of God and stand firm in faith.",
            ],
            [
                'title' => "Fruit of the Spirit: Galatians 5:22-23 Explained",
                'category' => "Galatians 5",
                'tags' => ['Holy Spirit', 'Christian Living', 'Virtues', 'Galatians 5:22-23'],
                'summary' => "Galatians 5:22-23 lists the fruit of the Spirit and their impact on Christian life.",
                'excerpt' => "Discover the qualities of the fruit of the Spirit in Galatians 5:22-23 and how they transform believers.",
            ],
            [
                'title' => "Being a Living Sacrifice: The Message of Romans 12",
                'category' => "Romans 12",
                'tags' => ['Christian Living', 'Sacrifice', 'Faith', 'Romans 12'],
                'summary' => "Romans 12 calls believers to live as living sacrifices in worship to God.",
                'excerpt' => "Explore Romans 12 to learn how to offer your life as a living sacrifice to God in daily worship.",
            ],
            [
                'title' => "Faith in Action: Learning from Hebrews 11",
                'category' => "Hebrews 11",
                'tags' => ['Faith', 'God’s Promises', 'Christian Living', 'Hebrews 11'],
                'summary' => "Hebrews 11 highlights the faith of heroes who trusted God’s promises.",
                'excerpt' => "Learn from Hebrews 11 how faith leads to action and trust in God’s promises.",
            ],
            [
                'title' => "Becoming a New Creation: Reflections on 2 Corinthians 5:17",
                'category' => "2 Corinthians 5",
                'tags' => ['New Life', 'Transformation', 'Faith', '2 Corinthians 5:17'],
                'summary' => "2 Corinthians 5:17 describes becoming a new creation through Christ.",
                'excerpt' => "Reflect on 2 Corinthians 5:17 and what it means to be a new creation in Christ.",
            ],
            [
                'title' => "The Great Commission: Applying Matthew 28:19-20",
                'category' => "Matthew 28",
                'tags' => ['Evangelism', 'Discipleship', 'Faith', 'Matthew 28:19-20'],
                'summary' => "Matthew 28:19-20 calls believers to make disciples of all nations.",
                'excerpt' => "Understand the Great Commission in Matthew 28:19-20 and its call to spread the Gospel.",
            ],
            [
                'title' => "Jesus the Way: Understanding John 14:6",
                'category' => "John 14",
                'tags' => ['Jesus as Savior', 'Truth', 'Eternal Life', 'John 14:6'],
                'summary' => "John 14:6 declares Jesus as the way, the truth, and the life.",
                'excerpt' => "Dive into John 14:6 to understand Jesus' exclusive role as the path to eternal life.",
            ],
            [
                'title' => "Lifting My Eyes: Finding Assurance in Psalm 121",
                'category' => "Psalm 121",
                'tags' => ['God’s Help', 'Assurance', 'Trust', 'Psalm 121'],
                'summary' => "Psalm 121 offers assurance of God’s help in life’s challenges.",
                'excerpt' => "Explore Psalm 121 and find comfort in God’s promise to be your helper and keeper.",
            ],
            [
                'title' => "God is Love: A Journey Through 1 John 4:7-21",
                'category' => "1 John 4",
                'tags' => ['Love', 'God’s Nature', 'Christian Living', '1 John 4:7-21'],
                'summary' => "1 John 4:7-21 highlights God’s nature as love and its call for believers to love others.",
                'excerpt' => "Discover in 1 John 4:7-21 how God’s love defines our faith and calls us to love one another.",
            ],
            [
                'title' => "Trials and Triumph: Insights from James 1",
                'category' => "James 1",
                'tags' => ['Trials', 'Faith', 'Perseverance', 'James 1'],
                'summary' => "James 1 explores faith in the face of trials and the growth it produces.",
                'excerpt' => "Learn from James 1 how trials refine faith and build perseverance in the Christian journey.",
            ],
            [
                'title' => "Casting Anxiety on Him: What 1 Peter 5:7 Teaches Us",
                'category' => "1 Peter 5",
                'tags' => ['Anxiety', 'God’s Care', 'Trust', '1 Peter 5:7'],
                'summary' => "1 Peter 5:7 calls believers to cast all anxieties on God, who cares for them.",
                'excerpt' => "Explore 1 Peter 5:7 to understand how to surrender worries and trust in God’s loving care.",
            ],
            [
                'title' => "Rest for the Weary: Matthew 11:28-30 Unpacked",
                'category' => "Matthew 11",
                'tags' => ['Rest', 'Comfort', 'Jesus’ Invitation', 'Matthew 11:28-30'],
                'summary' => "Matthew 11:28-30 invites the weary to find rest in Jesus’ care.",
                'excerpt' => "Discover the comfort of Matthew 11:28-30, where Jesus offers rest to the burdened and weary.",
            ],
            [
                'title' => "Hope in the Lord: The Promise of Isaiah 40:31",
                'category' => "Isaiah 40",
                'tags' => ['Hope', 'Strength', 'Renewal', 'Isaiah 40:31'],
                'summary' => "Isaiah 40:31 promises renewed strength for those who hope in the Lord.",
                'excerpt' => "Explore Isaiah 40:31 to learn how hope in God brings strength and perseverance.",
            ],
            [
                'title' => "All Have Sinned: Understanding Romans 3:23",
                'category' => "Romans 3",
                'tags' => ['Sin', 'Salvation', 'Faith', 'Romans 3:23'],
                'summary' => "Romans 3:23 reminds us of humanity’s need for salvation through Christ.",
                'excerpt' => "Dive into Romans 3:23 to understand the universal need for God’s grace and redemption.",
            ],
            [
                'title' => "Saved by Grace: Reflections on Ephesians 2:8-9",
                'category' => "Ephesians 2",
                'tags' => ['Grace', 'Faith', 'Salvation', 'Ephesians 2:8-9'],
                'summary' => "Ephesians 2:8-9 highlights salvation as a gift of God’s grace through faith.",
                'excerpt' => "Learn from Ephesians 2:8-9 about the unearned gift of salvation through grace alone.",
            ],
            [
                'title' => "Do Not Be Anxious: Wisdom from Philippians 4:6-7",
                'category' => "Philippians 4",
                'tags' => ['Anxiety', 'Peace', 'Prayer', 'Philippians 4:6-7'],
                'summary' => "Philippians 4:6-7 encourages prayer to overcome anxiety and find peace.",
                'excerpt' => "Discover in Philippians 4:6-7 how prayer and trust in God lead to peace beyond understanding.",
            ],
            [
                'title' => "Alive in Christ: Insights from Colossians 3:12-17",
                'category' => "Colossians 3",
                'tags' => ['Christian Living', 'Love', 'Forgiveness', 'Colossians 3:12-17'],
                'summary' => "Colossians 3:12-17 teaches how to live as those made alive in Christ.",
                'excerpt' => "Explore Colossians 3:12-17 to uncover how virtues like love and forgiveness define Christian life.",
            ],
            [
                'title' => "God Our Refuge: Lessons from Psalm 46",
                'category' => "Psalm 46",
                'tags' => ['God’s Protection', 'Peace', 'Strength', 'Psalm 46'],
                'summary' => "Psalm 46 portrays God as a refuge and strength in times of trouble.",
                'excerpt' => "Dive into Psalm 46 to learn how God provides unwavering strength and refuge in life’s storms.",
            ],
            [
                'title' => "The Word Became Flesh: Diving Into John 1:1-14",
                'category' => "John 1",
                'tags' => ['Jesus as the Word', 'Incarnation', 'Light', 'John 1:1-14'],
                'summary' => "John 1:1-14 introduces Jesus as the Word who became flesh and dwelt among us.",
                'excerpt' => "Explore John 1:1-14 to understand the profound mystery of the Word becoming flesh in Jesus.",
            ],
            [
                'title' => "The Coming of the Holy Spirit: Acts 2 Explored",
                'category' => "Acts 2",
                'tags' => ['Holy Spirit', 'Pentecost', 'Power', 'Acts 2'],
                'summary' => "Acts 2 describes the coming of the Holy Spirit at Pentecost.",
                'excerpt' => "Discover Acts 2 and the transformative power of the Holy Spirit at the birth of the church.",
            ],
            [
                'title' => "Rejoice Always: Unpacking 1 Thessalonians 5:16-18",
                'category' => "1 Thessalonians 5",
                'tags' => ['Joy', 'Prayer', 'Thankfulness', '1 Thessalonians 5:16-18'],
                'summary' => "1 Thessalonians 5:16-18 calls believers to rejoice, pray, and give thanks in all circumstances.",
                'excerpt' => "Explore 1 Thessalonians 5:16-18 to uncover the keys to living a life of joy, prayer, and gratitude.",
            ],
            [
                'title' => "A Woman of Noble Character: Lessons from Proverbs 31",
                'category' => "Proverbs 31",
                'tags' => ['Virtue', 'Wisdom', 'Character', 'Proverbs 31'],
                'summary' => "Proverbs 31 portrays the qualities of a virtuous and noble woman.",
                'excerpt' => "Dive into Proverbs 31 to learn about the timeless wisdom of living with virtue and integrity.",
            ],
            [
                'title' => "The Lord’s Prayer: A Deep Dive into Matthew 6:9-13",
                'category' => "Matthew 6",
                'tags' => ['Prayer', 'Faith', 'Guidance', 'Matthew 6:9-13'],
                'summary' => "Matthew 6:9-13 provides a model for prayer through the Lord’s Prayer.",
                'excerpt' => "Unpack the Lord’s Prayer in Matthew 6:9-13 and discover its profound meaning for daily life.",
            ],
            [
                'title' => "Search Me, Lord: Reflections on Psalm 139",
                'category' => "Psalm 139",
                'tags' => ['God’s Knowledge', 'Self-Reflection', 'Trust', 'Psalm 139'],
                'summary' => "Psalm 139 reflects on God’s intimate knowledge and care for each of us.",
                'excerpt' => "Discover the beauty of Psalm 139 and how it reveals God’s presence in every detail of life.",
            ],
            [
                'title' => "For Unto Us: Isaiah 9:6 and the Promise of Jesus",
                'category' => "Isaiah 9",
                'tags' => ['Prophecy', 'Jesus as Messiah', 'Hope', 'Isaiah 9:6'],
                'summary' => "Isaiah 9:6 foretells the birth of Jesus as the promised Messiah.",
                'excerpt' => "Explore Isaiah 9:6 to see how the promise of Jesus brings hope and peace to the world.",
            ],
            [
                'title' => "Abiding in the Vine: John 15 Explored",
                'category' => "John 15",
                'tags' => ['Discipleship', 'Faith', 'Fruitfulness', 'John 15'],
                'summary' => "John 15 describes Jesus as the true vine and believers as the branches.",
                'excerpt' => "Learn from John 15 how abiding in Jesus leads to fruitful and fulfilling discipleship.",
            ],
            [
                'title' => "Peace and Hope: Lessons from Romans 5:1-11",
                'category' => "Romans 5",
                'tags' => ['Peace', 'Hope', 'Grace', 'Romans 5:1-11'],
                'summary' => "Romans 5:1-11 reveals the peace and hope believers find in Christ.",
                'excerpt' => "Dive into Romans 5:1-11 to understand how faith in Christ brings peace and enduring hope.",
            ],
            [
                'title' => "Victory Over Death: The Power of 1 Corinthians 15",
                'category' => "1 Corinthians 15",
                'tags' => ['Resurrection', 'Hope', 'Victory', '1 Corinthians 15'],
                'summary' => "1 Corinthians 15 proclaims the resurrection and victory over death through Christ.",
                'excerpt' => "Explore 1 Corinthians 15 to understand the foundation of Christian hope in the resurrection.",
            ],
            [
                'title' => "God-Breathed Scripture: Insights from 2 Timothy 3:16-17",
                'category' => "2 Timothy 3",
                'tags' => ['Scripture', 'Wisdom', 'Teaching', '2 Timothy 3:16-17'],
                'summary' => "2 Timothy 3:16-17 affirms the inspiration and purpose of Scripture for teaching and training.",
                'excerpt' => "Learn from 2 Timothy 3:16-17 how God’s Word equips believers for every good work.",
            ],
            [
                'title' => "Running the Race: Hebrews 12:1-2 Explained",
                'category' => "Hebrews 12",
                'tags' => ['Perseverance', 'Faith', 'Christian Living', 'Hebrews 12:1-2'],
                'summary' => "Hebrews 12:1-2 encourages believers to run the race with perseverance, fixing their eyes on Jesus.",
                'excerpt' => "Explore Hebrews 12:1-2 and learn how to persevere in faith by focusing on Jesus as the ultimate example.",
            ],
            [
                'title' => "Act Justly, Love Mercy: What Micah 6:8 Means Today",
                'category' => "Micah 6",
                'tags' => ['Justice', 'Mercy', 'Humility', 'Micah 6:8'],
                'summary' => "Micah 6:8 calls for justice, mercy, and walking humbly with God as a way of life.",
                'excerpt' => "Discover the relevance of Micah 6:8 and its call to live with justice, mercy, and humility before God.",
            ],
            [
                'title' => "Be Strong and Courageous: Reflections on Joshua 1:9",
                'category' => "Joshua 1",
                'tags' => ['Courage', 'Faith', 'God’s Presence', 'Joshua 1:9'],
                'summary' => "Joshua 1:9 encourages believers to be strong and courageous, trusting in God’s presence.",
                'excerpt' => "Learn from Joshua 1:9 how God’s presence empowers us to face challenges with courage and faith.",
            ],
            [
                'title' => "The Lord is My Light: A Journey Through Psalm 27",
                'category' => "Psalm 27",
                'tags' => ['Light', 'Salvation', 'Faith', 'Psalm 27'],
                'summary' => "Psalm 27 portrays God as the source of light, salvation, and strength in troubled times.",
                'excerpt' => "Dive into Psalm 27 to find assurance and hope in God’s light and salvation.",
            ],
            [
                'title' => "Faith and Deeds: James 2 Explored",
                'category' => "James 2",
                'tags' => ['Faith', 'Works', 'Christian Living', 'James 2'],
                'summary' => "James 2 emphasizes the inseparable relationship between faith and deeds in a believer’s life.",
                'excerpt' => "Unpack James 2 to discover how genuine faith is demonstrated through good deeds.",
            ],
            [
                'title' => "A Chosen People: Reflections on 1 Peter 2:9",
                'category' => "1 Peter 2",
                'tags' => ['Identity', 'Holiness', 'Faith', '1 Peter 2:9'],
                'summary' => "1 Peter 2:9 declares believers as a chosen people called to declare God’s praises.",
                'excerpt' => "Explore 1 Peter 2:9 and discover the identity and purpose of God’s people in Christ.",
            ],
            [
                'title' => "The Greatest Commandment: Understanding Matthew 22:37-39",
                'category' => "Matthew 22",
                'tags' => ['Love', 'Commandments', 'Christian Living', 'Matthew 22:37-39'],
                'summary' => "Matthew 22:37-39 emphasizes loving God and loving others as the greatest commandments.",
                'excerpt' => "Learn from Matthew 22:37-39 how love for God and others forms the foundation of the Christian faith.",
            ],
            [
                'title' => "Declare and Believe: Romans 10:9 Explained",
                'category' => "Romans 10",
                'tags' => ['Salvation', 'Faith', 'Confession', 'Romans 10:9'],
                'summary' => "Romans 10:9 teaches that declaring faith in Jesus leads to salvation.",
                'excerpt' => "Explore Romans 10:9 to understand the simplicity and power of faith and confession for salvation.",
            ],
            [
                'title' => "A Heart of Repentance: Lessons from Psalm 51",
                'category' => "Psalm 51",
                'tags' => ['Repentance', 'Forgiveness', 'Mercy', 'Psalm 51'],
                'summary' => "Psalm 51 is a heartfelt prayer of repentance and a plea for God’s mercy.",
                'excerpt' => "Dive into Psalm 51 to learn how true repentance brings forgiveness and restoration.",
            ],
            [
                'title' => "A Time for Everything: Ecclesiastes 3:1-8 Explored",
                'category' => "Ecclesiastes 3",
                'tags' => ['Time', 'Season', 'Wisdom', 'Ecclesiastes 3:1-8'],
                'summary' => "Ecclesiastes 3:1-8 highlights the wisdom in recognizing life’s seasons and God’s timing.",
                'excerpt' => "Discover the profound truth of Ecclesiastes 3:1-8, where every moment has a purpose under heaven.",
            ],
            [
                'title' => "Abundant Life in Christ: Understanding John 10:10",
                'category' => "John 10",
                'tags' => ['Life', 'Jesus as Shepherd', 'Abundance', 'John 10:10'],
                'summary' => "John 10:10 describes Jesus’ purpose of giving abundant life to His followers.",
                'excerpt' => "Explore John 10:10 to uncover the promise of abundant life in Christ.",
            ],
            [
                'title' => "The Humility of Christ: Insights from Philippians 2:5-11",
                'category' => "Philippians 2",
                'tags' => ['Humility', 'Jesus as Example', 'Obedience', 'Philippians 2:5-11'],
                'summary' => "Philippians 2:5-11 highlights Christ’s humility and obedience as a model for believers.",
                'excerpt' => "Learn from Philippians 2:5-11 how Jesus’ humility shapes the Christian call to service.",
            ],
            [
                'title' => "Work with All Your Heart: Reflections on Colossians 3:23",
                'category' => "Colossians 3",
                'tags' => ['Work', 'Dedication', 'Faith', 'Colossians 3:23'],
                'summary' => "Colossians 3:23 calls believers to work wholeheartedly as serving the Lord.",
                'excerpt' => "Discover in Colossians 3:23 how dedication in work reflects a heart devoted to God.",
            ],
            [
                'title' => "Being an Example: Lessons from 1 Timothy 4:12",
                'category' => "1 Timothy 4",
                'tags' => ['Youth', 'Example', 'Faith', '1 Timothy 4:12'],
                'summary' => "1 Timothy 4:12 encourages young believers to set an example in speech and conduct.",
                'excerpt' => "Explore 1 Timothy 4:12 to learn how to be a model of faith and love, regardless of age.",
            ],
            [
                'title' => "If My People Pray: The Call of 2 Chronicles 7:14",
                'category' => "2 Chronicles 7",
                'tags' => ['Prayer', 'Repentance', 'God’s Promise', '2 Chronicles 7:14'],
                'summary' => "2 Chronicles 7:14 emphasizes the power of prayer and repentance to bring healing.",
                'excerpt' => "Learn from 2 Chronicles 7:14 how prayer and humility unlock God’s healing for His people.",
            ],
            [
                'title' => "You Are the Light: Understanding Matthew 5:14-16",
                'category' => "Matthew 5",
                'tags' => ['Light', 'Witness', 'Christian Living', 'Matthew 5:14-16'],
                'summary' => "Matthew 5:14-16 calls believers to shine their light before others for God’s glory.",
                'excerpt' => "Explore Matthew 5:14-16 and learn how to live as a light in the world for God’s glory.",
            ],
            [
                'title' => "The Heavens Declare: A Reflection on Psalm 19",
                'category' => "Psalm 19",
                'tags' => ['Creation', 'God’s Glory', 'Worship', 'Psalm 19'],
                'summary' => "Psalm 19 proclaims the heavens as a testimony to God’s glory and power.",
                'excerpt' => "Dive into Psalm 19 to see how creation reveals the majesty of God and inspires worship.",
            ],
            [
                'title' => "Come to the Waters: Isaiah 55’s Invitation",
                'category' => "Isaiah 55",
                'tags' => ['Invitation', 'God’s Provision', 'Grace', 'Isaiah 55'],
                'summary' => "Isaiah 55 invites everyone to come and receive God’s provision freely.",
                'excerpt' => "Unpack Isaiah 55 to understand God’s invitation to abundant life and His gracious provision.",
            ],
            [
                'title' => "A New Heaven and Earth: Exploring Revelation 21:1-4",
                'category' => "Revelation 21",
                'tags' => ['Heaven', 'Hope', 'God’s Kingdom', 'Revelation 21:1-4'],
                'summary' => "Revelation 21:1-4 describes the hope of a new heaven and earth where God dwells with His people.",
                'excerpt' => "Learn from Revelation 21:1-4 about the ultimate promise of renewal and God’s eternal presence.",
            ],
            [
                'title' => "Close to the Brokenhearted: Comfort in Psalm 34:18",
                'category' => "Psalm 34",
                'tags' => ['God’s Comfort', 'Brokenhearted', 'Faith', 'Psalm 34:18'],
                'summary' => "Psalm 34:18 reminds us that God is near to those who are brokenhearted.",
                'excerpt' => "Explore Psalm 34:18 to discover how God provides comfort to the brokenhearted and crushed in spirit.",
            ],
            [
                'title' => "God’s Living Word: Understanding Hebrews 4:12",
                'category' => "Hebrews 4",
                'tags' => ['God’s Word', 'Power', 'Truth', 'Hebrews 4:12'],
                'summary' => "Hebrews 4:12 describes God’s Word as living, active, and sharper than a sword.",
                'excerpt' => "Discover the power of Hebrews 4:12 and how God’s Word transforms hearts and lives.",
            ],
            [
                'title' => "Draw Near to God: Insights from James 4:7-8",
                'category' => "James 4",
                'tags' => ['Submission', 'God’s Presence', 'Faith', 'James 4:7-8'],
                'summary' => "James 4:7-8 calls for submission to God and promises His closeness when we draw near.",
                'excerpt' => "Explore James 4:7-8 to learn how drawing near to God brings peace and strength.",
            ],
            [
                'title' => "The Wages of Sin: Reflections on Romans 6:23",
                'category' => "Romans 6",
                'tags' => ['Sin', 'Salvation', 'Grace', 'Romans 6:23'],
                'summary' => "Romans 6:23 contrasts the wages of sin with the gift of eternal life in Christ.",
                'excerpt' => "Dive into Romans 6:23 to understand the consequences of sin and the gift of God’s grace.",
            ],
            [
                'title' => "Hear, O Israel: Lessons from Deuteronomy 6:4-9",
                'category' => "Deuteronomy 6",
                'tags' => ['Shema', 'Commandments', 'Faith', 'Deuteronomy 6:4-9'],
                'summary' => "Deuteronomy 6:4-9 emphasizes loving God with all your heart, soul, and strength.",
                'excerpt' => "Learn from Deuteronomy 6:4-9 about the importance of teaching and living out God’s commandments.",
            ],
            [
                'title' => "Do Not Grow Weary: Insights from Galatians 6:9",
                'category' => "Galatians 6",
                'tags' => ['Perseverance', 'Faith', 'Reward', 'Galatians 6:9'],
                'summary' => "Galatians 6:9 encourages perseverance in doing good, trusting in God’s reward.",
                'excerpt' => "Explore Galatians 6:9 to find strength in continuing good works for God’s glory.",
            ],
            [
                'title' => "Train Up a Child: Reflections on Proverbs 22:6",
                'category' => "Proverbs 22",
                'tags' => ['Parenting', 'Wisdom', 'Guidance', 'Proverbs 22:6'],
                'summary' => "Proverbs 22:6 highlights the importance of training children in the way of the Lord.",
                'excerpt' => "Discover in Proverbs 22:6 the wisdom of guiding children to follow God’s path.",
            ],
            [
                'title' => "Gathered in His Name: Understanding Matthew 18:20",
                'category' => "Matthew 18",
                'tags' => ['Community', 'Prayer', 'God’s Presence', 'Matthew 18:20'],
                'summary' => "Matthew 18:20 promises God’s presence when believers gather in His name.",
                'excerpt' => "Learn from Matthew 18:20 how the presence of God is experienced in Christian fellowship.",
            ],
            [
                'title' => "Grace is Sufficient: Insights from 2 Corinthians 12:9-10",
                'category' => "2 Corinthians 12",
                'tags' => ['Grace', 'Weakness', 'Strength', '2 Corinthians 12:9-10'],
                'summary' => "2 Corinthians 12:9-10 reveals God’s power made perfect in human weakness.",
                'excerpt' => "Explore 2 Corinthians 12:9-10 to see how God’s grace empowers us in our weakness.",
            ],
            [
                'title' => "Do Not Fear: The Assurance of Isaiah 41:10",
                'category' => "Isaiah 41",
                'tags' => ['Fear', 'God’s Presence', 'Strength', 'Isaiah 41:10'],
                'summary' => "Isaiah 41:10 assures believers of God’s presence and strength in all situations.",
                'excerpt' => "Discover Isaiah 41:10 and find encouragement to trust God’s strength and promises.",
            ],
            [
                'title' => "The Golden Rule: A Reflection on Luke 6:31",
                'category' => "Luke 6",
                'tags' => ['Love', 'Community', 'Kindness', 'Luke 6:31'],
                'summary' => "Luke 6:31 teaches the Golden Rule: treating others as you wish to be treated.",
                'excerpt' => "Explore Luke 6:31 and learn how to live out the Golden Rule in your daily interactions.",
            ],
            [
                'title' => "The Power of the Holy Spirit: Acts 1:8 Explained",
                'category' => "Acts 1",
                'tags' => ['Holy Spirit', 'Witness', 'Power', 'Acts 1:8'],
                'summary' => "Acts 1:8 promises the power of the Holy Spirit to empower believers to be witnesses.",
                'excerpt' => "Learn from Acts 1:8 how the Holy Spirit equips believers to spread the Gospel.",
            ],
            [
                'title' => "A Lamp to My Feet: Understanding Psalm 119:105",
                'category' => "Psalm 119",
                'tags' => ['God’s Word', 'Guidance', 'Light', 'Psalm 119:105'],
                'summary' => "Psalm 119:105 portrays God’s Word as a lamp guiding believers through life.",
                'excerpt' => "Discover the wisdom of Psalm 119:105 and how Scripture illuminates our path.",
            ],
            [
                'title' => "Blessed Are the Peacemakers: Reflections on Matthew 5:9",
                'category' => "Matthew 5",
                'tags' => ['Peace', 'Blessing', 'Christian Living', 'Matthew 5:9'],
                'summary' => "Matthew 5:9 blesses peacemakers as children of God.",
                'excerpt' => "Explore Matthew 5:9 to understand the role of peacemaking in the Christian life.",
            ],
            [
                'title' => "The Lord’s Return: Insights from 1 Thessalonians 4:16-17",
                'category' => "1 Thessalonians 4",
                'tags' => ['Second Coming', 'Hope', 'Resurrection', '1 Thessalonians 4:16-17'],
                'summary' => "1 Thessalonians 4:16-17 describes the return of the Lord and the resurrection of believers.",
                'excerpt' => "Dive into 1 Thessalonians 4:16-17 to learn about the hope of Christ’s second coming.",
            ],
            [
                'title' => "He Who Began a Good Work: A Study of Philippians 1:6",
                'category' => "Philippians 1",
                'tags' => ['Hope', 'God’s Plan', 'Faithfulness', 'Philippians 1:6'],
                'summary' => "Philippians 1:6 assures believers that God will complete the work He began in them.",
                'excerpt' => "Discover Philippians 1:6 and its promise of God’s faithfulness in fulfilling His plans for you.",
            ],
            [
                'title' => "Resisting Temptation: Lessons from 1 Corinthians 10:13",
                'category' => "1 Corinthians 10",
                'tags' => ['Temptation', 'Faith', 'God’s Strength', '1 Corinthians 10:13'],
                'summary' => "1 Corinthians 10:13 assures believers of God’s faithfulness in providing a way out of temptation.",
                'excerpt' => "Explore 1 Corinthians 10:13 to learn how God helps us overcome and resist temptation.",
            ],
            [
                'title' => "Delight in the Lord: Understanding Psalm 37:4",
                'category' => "Psalm 37",
                'tags' => ['Delight', 'God’s Will', 'Faith', 'Psalm 37:4'],
                'summary' => "Psalm 37:4 encourages delight in the Lord as He fulfills our heart’s desires.",
                'excerpt' => "Discover the promise of Psalm 37:4 and how delighting in God aligns our desires with His will.",
            ],
            [
                'title' => "Perfect Peace: A Reflection on Isaiah 26:3",
                'category' => "Isaiah 26",
                'tags' => ['Peace', 'Trust', 'Faith', 'Isaiah 26:3'],
                'summary' => "Isaiah 26:3 promises perfect peace to those whose minds are steadfast in trusting God.",
                'excerpt' => "Explore Isaiah 26:3 to learn how unwavering trust in God brings peace beyond understanding.",
            ],
            [
                'title' => "The Lord Will Fight for You: Insights from Exodus 14:14",
                'category' => "Exodus 14",
                'tags' => ['God’s Protection', 'Trust', 'Faith', 'Exodus 14:14'],
                'summary' => "Exodus 14:14 assures believers that God fights their battles when they trust in Him.",
                'excerpt' => "Learn from Exodus 14:14 how God’s presence and power provide victory in life’s challenges.",
            ],
            [
                'title' => "Ask, Seek, Knock: Exploring Matthew 7:7-8",
                'category' => "Matthew 7",
                'tags' => ['Prayer', 'Faith', 'God’s Promises', 'Matthew 7:7-8'],
                'summary' => "Matthew 7:7-8 encourages persistence in prayer and trust in God’s response.",
                'excerpt' => "Discover Matthew 7:7-8 and the importance of asking, seeking, and knocking in prayer.",
            ],
            [
                'title' => "God of Hope: Reflections on Romans 15:13",
                'category' => "Romans 15",
                'tags' => ['Hope', 'Joy', 'Faith', 'Romans 15:13'],
                'summary' => "Romans 15:13 highlights God as the source of hope, joy, and peace for believers.",
                'excerpt' => "Discover Romans 15:13 and learn how trusting in God fills us with joy, peace, and hope.",
            ],
            [
                'title' => "Always Be Ready: Understanding 1 Peter 3:15",
                'category' => "1 Peter 3",
                'tags' => ['Apologetics', 'Faith', 'Hope', '1 Peter 3:15'],
                'summary' => "1 Peter 3:15 urges believers to always be prepared to defend their faith with gentleness.",
                'excerpt' => "Explore 1 Peter 3:15 and learn the importance of defending faith while sharing hope in Christ.",
            ],
            [
                'title' => "Light of the World: Lessons from John 8:12",
                'category' => "John 8",
                'tags' => ['Light', 'Jesus as Savior', 'Guidance', 'John 8:12'],
                'summary' => "John 8:12 proclaims Jesus as the light of the world, leading us out of darkness.",
                'excerpt' => "Dive into John 8:12 to understand how Jesus brings guidance and hope as the light of the world.",
            ],
            [
                'title' => "Praise the Lord, My Soul: Reflections on Psalm 103",
                'category' => "Psalm 103",
                'tags' => ['Worship', 'Thankfulness', 'God’s Mercy', 'Psalm 103'],
                'summary' => "Psalm 103 praises God for His mercy, love, and forgiveness.",
                'excerpt' => "Discover Psalm 103 and its call to praise God for His abundant blessings and compassion.",
            ],
            [
                'title' => "Do Not Fear: Assurance in Isaiah 43:1-2",
                'category' => "Isaiah 43",
                'tags' => ['Fear', 'God’s Protection', 'Trust', 'Isaiah 43:1-2'],
                'summary' => "Isaiah 43:1-2 assures believers of God’s presence and protection in all circumstances.",
                'excerpt' => "Learn from Isaiah 43:1-2 how God’s promises give courage and peace in difficult times.",
            ],
            [
                'title' => "Guard Your Heart: Lessons from Proverbs 4:23",
                'category' => "Proverbs 4",
                'tags' => ['Heart', 'Wisdom', 'Christian Living', 'Proverbs 4:23'],
                'summary' => "Proverbs 4:23 emphasizes guarding your heart as the source of life.",
                'excerpt' => "Explore Proverbs 4:23 to understand the importance of protecting your heart and mind.",
            ],
            [
                'title' => "Love the Lord with All Your Heart: Insights from Luke 10:27",
                'category' => "Luke 10",
                'tags' => ['Love', 'Commandments', 'Faith', 'Luke 10:27'],
                'summary' => "Luke 10:27 calls believers to love God with all their heart, soul, and strength.",
                'excerpt' => "Dive into Luke 10:27 to understand the foundational commandment of loving God fully.",
            ],
            [
                'title' => "I Am the Resurrection: Exploring John 11:25-26",
                'category' => "John 11",
                'tags' => ['Resurrection', 'Hope', 'Eternal Life', 'John 11:25-26'],
                'summary' => "John 11:25-26 reveals Jesus as the resurrection and the source of eternal life.",
                'excerpt' => "Discover John 11:25-26 to understand Jesus’ promise of eternal life for all who believe in Him.",
            ],
            [
                'title' => "Take Up Your Cross: Reflections on Matthew 16:24",
                'category' => "Matthew 16",
                'tags' => ['Discipleship', 'Sacrifice', 'Faith', 'Matthew 16:24'],
                'summary' => "Matthew 16:24 calls believers to take up their cross and follow Jesus.",
                'excerpt' => "Explore Matthew 16:24 to learn the cost and reward of wholehearted discipleship.",
            ],
            [
                'title' => "Shout for Joy: Lessons from Psalm 100",
                'category' => "Psalm 100",
                'tags' => ['Worship', 'Joy', 'Thankfulness', 'Psalm 100'],
                'summary' => "Psalm 100 encourages joyful worship and thankfulness to God.",
                'excerpt' => "Learn from Psalm 100 how joyful worship reflects gratitude for God’s goodness and faithfulness.",
            ],
            [
                'title' => "Immeasurably More: A Study of Ephesians 3:20-21",
                'category' => "Ephesians 3",
                'tags' => ['God’s Power', 'Faith', 'Hope', 'Ephesians 3:20-21'],
                'summary' => "Ephesians 3:20-21 celebrates God’s ability to do far more than we can imagine.",
                'excerpt' => "Discover Ephesians 3:20-21 and learn how to trust God’s limitless power and love.",
            ],
            [
                'title' => "Rooted in Christ: Reflections on Colossians 2:6-7",
                'category' => "Colossians 2",
                'tags' => ['Faith', 'Growth', 'Christian Living', 'Colossians 2:6-7'],
                'summary' => "Colossians 2:6-7 urges believers to grow in faith, rooted in Christ.",
                'excerpt' => "Explore Colossians 2:6-7 to understand the importance of being firmly rooted in Jesus.",
            ],
            [
                'title' => "Whatever You Did for the Least: Insights from Matthew 25:40",
                'category' => "Matthew 25",
                'tags' => ['Service', 'Compassion', 'Faith', 'Matthew 25:40'],
                'summary' => "Matthew 25:40 calls believers to serve others as if serving Christ Himself.",
                'excerpt' => "Learn from Matthew 25:40 how acts of compassion reflect Christ’s love in action.",
            ],
            [
                'title' => "The Lord is Not Slow: Understanding 2 Peter 3:9",
                'category' => "2 Peter 3",
                'tags' => ['God’s Timing', 'Patience', 'Hope', '2 Peter 3:9'],
                'summary' => "2 Peter 3:9 reminds us of God’s patience, desiring everyone to come to repentance.",
                'excerpt' => "Discover 2 Peter 3:9 and learn to trust God’s perfect timing and His desire for all to be saved.",
            ],
            [
                'title' => "The Lord Delights Over You: A Reflection on Zephaniah 3:17",
                'category' => "Zephaniah 3",
                'tags' => ['God’s Love', 'Joy', 'Faith', 'Zephaniah 3:17'],
                'summary' => "Zephaniah 3:17 reveals God’s love and joy over His people.",
                'excerpt' => "Explore Zephaniah 3:17 to discover how God delights in and rejoices over His people.",
            ],
            [
                'title' => "I Stand at the Door: Lessons from Revelation 3:20",
                'category' => "Revelation 3",
                'tags' => ['Invitation', 'Repentance', 'Faith', 'Revelation 3:20'],
                'summary' => "Revelation 3:20 depicts Jesus knocking at the door, inviting fellowship with Him.",
                'excerpt' => "Learn from Revelation 3:20 about Jesus’ personal invitation to open your heart to Him.",
            ],
            [
                'title' => "The Lord is Near: Comfort from Psalm 145:18-19",
                'category' => "Psalm 145",
                'tags' => ['God’s Presence', 'Prayer', 'Faith', 'Psalm 145:18-19'],
                'summary' => "Psalm 145:18-19 assures us that God is near to all who call on Him in truth.",
                'excerpt' => "Discover Psalm 145:18-19 and learn how calling on God brings His presence and help.",
            ],
            [
                'title' => "Bring the Whole Tithe: Insights from Malachi 3:10",
                'category' => "Malachi 3",
                'tags' => ['Giving', 'Blessing', 'Faithfulness', 'Malachi 3:10'],
                'summary' => "Malachi 3:10 encourages faithful tithing and trusting God’s provision.",
                'excerpt' => "Explore Malachi 3:10 and learn about the blessings of faithfulness in giving to God.",
            ],
            [
                'title' => "The Prodigal Son: Reflections on Luke 15:11-32",
                'category' => "Luke 15",
                'tags' => ['Forgiveness', 'Grace', 'Repentance', 'Luke 15:11-32'],
                'summary' => "Luke 15:11-32 tells the story of the Prodigal Son, a parable of grace and forgiveness.",
                'excerpt' => "Discover Luke 15:11-32 and learn about the Father’s love and grace for all who return to Him.",
            ],
            [
                'title' => "Love God, Love Others: Understanding Mark 12:30-31",
                'category' => "Mark 12",
                'tags' => ['Love', 'Commandments', 'Faith', 'Mark 12:30-31'],
                'summary' => "Mark 12:30-31 calls believers to love God and others as the greatest commandments.",
                'excerpt' => "Explore Mark 12:30-31 and learn how love fulfills God’s will in our lives.",
            ],

        ];

        magical_create_posts($posts);
    }
});
