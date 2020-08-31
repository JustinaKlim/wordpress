<?php
/**
* Plugin Name: Very First Plugin
* Plugin URI: https://www.yourwebsiteurl.com/
* Description: This is the very first plugin I ever created.
* Version: 1.0
* Author: Your Name Here
* Author URI: http://yourwebsiteurl.com/
**/
add_action( 'admin_menu', function(){
    add_menu_page('event title', 'Event menu', 'manage_options', 'event_slug', 'render_event_function');
    // add_menu_page( string $page_title, string $menu_title, string $capability, string $menu_slug, callable $function = '', string $icon_url = '', int $position = null );
    add_menu_page('idea title', 'Ideas page', 'manage_options', 'ideas', 'render_idea_function');
    // add_submenu_page('bebras', 'Edit', null, 'manage_options', 'bebras3', 'bebro_funkcija3');
});
function your_login_function()
{
    if (isset($_POST['event_new'])) {
        $post = [
            'post_title'   => $_POST['title'],
            'post_content' => '',
            'post_status'  => 'publish',
            'post_author'  => 1, //get_current_user_id()
            'post_type'     => 'Event',
            // 'post_category' => array( 8,39 ),
            'meta_input'   => [
                'text' => $_POST['text'],
                'date' => $_POST['date']
            ],
        ];
        wp_insert_post($post);
        // exit;
        // $_POST['event'] = null;
    }
    elseif (isset($_POST['event_update'])) {
        $post = get_post((int)$_POST['event_id']); 
        $post->post_content = $_POST['content'];
        $post->meta_input = [
            'text' => $_POST['text'],
            'date' => $_POST['date'],
            'title' => $_POST['title'],
        ];
        wp_update_post($post);
    }
    elseif (isset($_POST['event_delete'])) {
        wp_delete_post($_POST['event_id']);
    }
}
add_action('init', 'your_login_function');
function render_event_function()
{
    // echo count(get_posts()) . ' count <br><br>';
    $posts = get_posts([
        'post_type' => 'Event',
        'post_status' => 'publish',
        'numberposts' => -1
        // 'order'    => 'ASC'
    ]);
    foreach ($posts as $post) {
         '<br><br>';
         'ID: ' . $post->ID . '<br>';
         'post_type: ' . $post->post_type . '<br>';
         'post_title: ' . $post->post_title . '<br>';
         'post_name: ' . $post->post_name . '<br>';
         'post_author: ' . $post->post_author . '<br>';
         'post_date: ' . $post->post_date . '<br>';
         'post_modified: ' . $post->post_modified . '<br>';
         'guid: <a href="' . $post->guid . '">' . $post->guid . '</a><br>';
         'post_content: ' . $post->post_content . '<br><br>';
        $metas = get_post_meta($post->ID);
        // print_r($metas);
        //  $metas['text'] . '<br>';
        //  $metas['date'] . '<br>';
        //ADMIN INTERFACE------------------------------------------------------------->
        foreach ($metas as $meta) {
             $meta[0] . '<br>';
        }
        echo '<br>
        <div class="lenteles">
        <form class="forma" method="POST" action="">
            <input type="hidden" name="event_update" value="update event">
            <input type="hidden" name="event_id" value="' . $post->ID . '">
            <div class="form-group">
                <label class="admin-label">Įvykio pavadinimas</label><br>
                <input type="text" name="title" value="' . $metas['title'][0] . '" class="admin-input">
            </div>
            <div class="form-group">
                <label class="admin-label">Tekstas</label><br>
                <input type="text" name="text" value="' . $metas['text'][0] . '" class="admin-input">
            </div>
            <div class="form-group">
                <label class="admin-label">Data</label><br>
                <input type="datetime-local" value="' . $metas['date'][0] . '" name="date" class="admin-input">
            </div>
            <div class="mygtukai">
                <button type="submit" class="admin-button">Redaguoti</button>
                
            </div>
        </form>
        <form class="trinti" method="POST" action="">
            <div class="mygtukai" style="padding: 0 0 15px 0;">
                <input type="hidden" name="event_delete" value="event_id">
                <input type="hidden" name="event_id" value="' . $post->ID . '">
                <button type="submit" class="admin-button">Trinti</button>
            </div>
        </form>
    </div>
   
    
    <br>';
        // WP_Post Object ( [ID] => 7 [post_author] => 1 [post_date] => 2020-08-21 13:46:27 [post_date_gmt] => 2020-08-21 13:46:27 [post_content] => post_content [post_title] => testing [post_excerpt] => [post_status] => publish [comment_status] => closed [ping_status] => closed [post_password] => [post_name] => testing [to_ping] => [pinged] => [post_modified] => 2020-08-21 13:46:27 [post_modified_gmt] => 2020-08-21 13:46:27 [post_content_filtered] => [post_parent] => 0 [guid] => http://localhost/wordpress/event/testing/ [menu_order] => 0 [post_type] => event [post_mime_type] => [comment_count] => 0 [filter] => raw )
    }

    //-----------ADMIN IVYKIO PRIDEJIMAS---------------------------//
    echo '<br>
    <div class="lenteles">
        <form class="forma" method="POST" action="">
            <input type="hidden" name="event_new" value="new event">
            <div class="form-group">
                <label class="admin-label">Įvykio pavadinimas</label><br>
                <input type="text" name="title" value="" placeholder="Įrašykite įvykio pavadinimą..." class="admin-input">
            </div>
            <div class="form-group">
                <label class="admin-label">Tekstas</label><br>
                <input type="text" name="text" placeholder="Jūsų tekstas..." class="admin-input">
            </div>
            <div class="form-group">
                <label class="admin-label">Data</label><br>
                <input type="datetime-local" name="date" class="admin-input">
            </div>
            <div class="mygtukai">
                <button type="submit" class="admin-button">Pridėti</button>
            </div>
        </form>
    <div>
    <br>';
}
add_action( 'admin_enqueue_scripts', 'load_admin_styles' );
function load_admin_styles() {
    wp_register_style( 'admin.css', plugin_dir_url( __FILE__ ) . 'css/admin.css');
    wp_enqueue_style( 'admin.css');
}  
// add_action('init', 'create_event_post_type');
// function create_event_post_type() {
//     $labels = [
//         'name'               => 'Event',
//         'singular_name'      => 'Event',
//         'add_new'            => 'new Event',
//         'add_new_item'       => __( 'Add New Event' ),
//         'edit_item'          => __( 'Edit Event' ),
//         'new_item'           => __( 'New Event' ),
//         'all_items'          => __( 'All Events' ),
//         'view_item'          => __( 'View Event' ),
//         'search_items'       => __( 'Search Events' ),
//         'not_found'          => __( 'No Events found' ),
//         'not_found_in_trash' => __( 'No Events found in the Trash' ), 
//         'menu_name'          => 'Events'
//     ];
//     $args = [
//         'labels'        => $labels,
//         'description'   => 'Event Type Posts',
//         'public'        => true,
//         'menu_position' => 15,
//         'supports'      => [],
//         'has_archive'   => true,
//     ];
//     register_post_type('event', $args); 
// }
// function my_login_function()
// {
//     if (isset($_POST['idea_new'])) {
//         $post = [
//             'post_title'   => $_POST['title'],
//             'post_content' => '',
//             'post_status'  => 'publish',
//             'post_author'  => 1, //get_current_user_id()
//             'post_type'     => 'Idea',
//             'meta_input'   => [
//                 'description' => $_POST['description'],
//                 'field' => $_POST['field']
//             ],
//         ];
//         wp_insert_post($post);
//     }
//     elseif (isset($_POST['idea_update'])) {
//         $post = get_post((int)$_POST['idea_id']); 
//         $post->post_content = $_POST['content'];
//         $post->meta_input = [
//             'description' => $_POST['description'],
//             'field' => $_POST['field'],
//         ];
//         wp_update_post($post);
//     }
//     elseif (isset($_POST['idea_delete'])) {
//         wp_delete_post($_POST['idea_id']);
//     }
// }
// add_action('init', 'my_login_function');
// function render_idea_function() {
//     $posts = get_posts([
//         'post_type' => 'Idea',
//         'post_status' => 'publish',
//         'numberposts' => -1
//     ]);
//     foreach ($posts as $post) {
//         $metas = get_post_meta($post->ID);
//         foreach ($metas as $meta) {
//             echo '<h2>' . $meta[0] . '</h2>';
//         }
//         echo '<div class="name"> By user no.' . $post->post_author . '</div>';
//         echo '<div class="title">' . $post->post_title . '</div>';
//         echo '<br>
//         <form class="forma" method="POST" action="">
//             <input type="hidden" name="idea_update" value="update idea">
//             <input type="hidden" name="idea_id" value="' . $post->ID . '">
//             <div class="form-group">
//                 <label>Idea title</label>
//                 <input type="text" name="content" value="' . $post->post_content . '" class="">
//             </div>
//             <div class="form-group">
//                 <label>Idea description</label>
//                 <input type="text" name="description" value="' . $metas['description'][0] . '" class="">
//             </div>
//             <div class="form-group">
//                 <label>Date</label>
//                 <input type="text" name="field" value="' . $metas['field'][0] . '" class="">
//             </div>
//             <button type="submit" class="admin-button">EDIT</button>
//         </form>
//         <form method="POST" action="">
//             <input type="hidden" name="idea_delete" value="delete idea">
//             <input type="hidden" name="idea_id" value="' . $post->ID . '">
//             <button type="submit" class="admin-button">DELETE</button>
//         </form><br>';
// }
//     echo '<br>
//     <div class="form-admin">
//         <form class="forma" method="POST" action="">
//             <input type="hidden" name="idea_new" value="new idea">
//             <div class="form-group">
//                 <label>Idea title</label>
//                 <input class="admin-input" type="text" name="title" value="title" class="">
//             </div>
//             <div class="form-group">
//                 <label>Idea description</label>
//                 <input class="admin-input" type="text" name="text" value="description" class="">
//             </div>
//             <div class="form-group">
//                 <label>Field</label>
//                 <input class="admin-input" type="text" name="field" value="field" class="">
//             </div>
//             <button type="submit" class="button-admin">ADD</button>
//         </form>
//     <div>
//     <br>';
// }
// add_action('init', 'create_idea_post_type');
// function create_idea_post_type() {
//     $labels = [
//         'name'               => 'Idea',
//         'singular_name'      => 'Idea',
//         'add_new'            => 'new Idea',
//         'add_new_item'       => __( 'Add New Idea' ),
//         'edit_item'          => __( 'Edit Idea' ),
//         'new_item'           => __( 'New Idea' ),
//         'all_items'          => __( 'All Ideas' ),
//         'view_item'          => __( 'View Idea' ),
//         'search_items'       => __( 'Search Ideas' ),
//         'not_found'          => __( 'No Ideas found' ),
//         'not_found_in_trash' => __( 'No Ideas found in the Trash' ), 
//         'menu_name'          => 'Ideas'
//     ];
//     $args = [
//         'labels'        => $labels,
//         'description'   => 'Idea Type Posts',
//         'public'        => true,
//         'menu_position' => 15,
//         'supports'      => [],
//         'has_archive'   => true,
//     ];
//     register_post_type('idea', $args); 
// }