<?php

add_action('init', function () {
    if (!isset($_GET['post-on-backlink'])) {
        return;
    }

// Your WordPress site URL
    $site_url = 'https://whosoever.org/';

// The data you want to post
    $post_data = [
        'title' => 'Your Post Title',
        'content' => 'Your post content goes here.',
        'status' => 'publish', // or 'draft', 'pending', etc.
    ];

// Convert data to JSON format
    $json_data = json_encode($post_data);

// Initialize cURL
    $ch = curl_init();

// Set the cURL options
    curl_setopt($ch, CURLOPT_URL, $site_url . 'wp-json/wp/v2/posts');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);

// Execute the request
    $response = curl_exec($ch);

// Check for errors
    if (curl_errno($ch)) {
        dd('Error:' . curl_error($ch));
    } else {
        // Decode the response
        $response_data = json_decode($response, true);
        // Print the response
        dd($response_data, 'abv');
    }

// Close the cURL session
    curl_close($ch);
});
