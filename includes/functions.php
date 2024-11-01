<?php


class WEBIOTSTeamshowcase{



    function __construct(){

        // File upload allowed
        $whitelist_files[]      = array("mimetype"=>"image/jpeg","ext"=>"jpg") ;
        $whitelist_files[]      = array("mimetype"=>"image/jpg","ext"=>"jpg") ;
        $whitelist_files[]      = array("mimetype"=>"image/png","ext"=>"png") ;
        $whitelist_files[]      = array("mimetype"=>"text/plain","ext"=>"txt") ;
        $this->whitelist_files = $whitelist_files;
        add_action("plugins_loaded", array($this, "app_textdomain")); //load language/textdomain
        
        /** register post type **/
        add_action("init", array($this, "post_type_app_webiots_teamshowcase"));


        /** register metabox for admin **/
        // if(is_admin()){
        add_action("admin_head",array($this,"admin_head_app_webiotsTeamshowcase"),1);
        add_action("add_meta_boxes",array($this,"metabox_app_webiots_teamshowcase"));
        add_action("save_post",array($this,"metabox_app_webiots_teamshowcase_save"));
        // }
    }





    // Register textdomain
    
    function app_textdomain(){
        
    // load_plugin_textdomain("app-Teamshowcase", false, Teamshowcase_DIR . "/languages");
    
    }
   
    /** register post for table test **/


    /** register post for table teamshowcase **/
    public function post_type_app_webiots_teamshowcase()
    {
        $labels = array(
            "name" => _x("Teamshowcase", "post type general name", "app-Teamshowcase"),
            "singular_name" => _x("Teamshowcase", "post type singular name", "app-Teamshowcase"),
            "menu_name" => _x("Teamshowcase", "admin menu", "app-Teamshowcase"),
            "name_admin_bar" => _x("Teamshowcase", "add new on admin bar", "app-Teamshowcase"),
            "add_new" => _x("Add New Team Member", "item", "app-Teamshowcase"),
            "add_new_item" => __("Add New Team Member", "app-Teamshowcase"),
            "new_item" => __("new item", "app-Teamshowcase"),
            "edit_item" => __("Edit Teamshowcase", "app-Teamshowcase"),
            "view_item" => __("View Teamshowcase", "app-Teamshowcase"),
            "all_items" => __("All Team Members", "app-Teamshowcase"),
            "search_items" => __("Search Team Member", "app-Teamshowcase"),
            "parent_item_colon" => __("parent teamshowcase:", "app-Teamshowcase"),
            "not_found" => __("not found", "app-Teamshowcase"),
            "not_found_in_trash" => __("not found in trash", "app-Teamshowcase"));
        $args = array(
            "labels" => $labels,
            "public" => true,
            "menu_icon" => "dashicons-businessman",
            "publicly_queryable" => false,
            "show_ui" => true,
            "show_in_menu" => true,
            "query_var" => true,
            "capability_type" => "page",
            "has_archive" => true,
            "hierarchical" => true,
            "menu_position" => null,
            "taxonomies" => array(),
            "supports" => array("title","thumbnail"));
        register_post_type("app_teamshowcase", $args);
    }

    /** register metabox for teamshowcase **/
    public function metabox_app_webiots_teamshowcase($hook)
    {
        $allowed_hook = array("app_teamshowcase");
        if(in_array($hook, $allowed_hook))
        {
            add_meta_box("metabox_app_webiots_teamshowcase",
                __("teamshowcase","app-Teamshowcase"),
                array($this,"metabox_app_webiots_teamshowcase_callback"),
                $hook,
                "normal",
                "high");

        }


    }


    /** callback metabox for teamshowcase **/
    public function metabox_app_webiots_teamshowcase_callback($post)
    {
        $this->webiots_teamshowcase_enqueue();
        wp_enqueue_style("thickbox");
        wp_nonce_field("metabox_app_webiots_teamshowcase_save","metabox_app_webiots_teamshowcase_nonce");
        printf("<table class=\"form-table\">");
        $value_teamshowcase_designation = get_post_meta($post->ID, "_teamshowcase_designation", true);
        printf("<tr><th scope=\"row\"><label for=\"teamshowcase_designation\">%s</label></th><td><input class=\"widefat\" type=\"text\" id=\"teamshowcase_designation\" name=\"teamshowcase_designation\" value=\"%s\" /></td></tr>",__("Designation", "app-Teamshowcase"), esc_attr($value_teamshowcase_designation));
        $value_teamshowcase_fb_url = get_post_meta($post->ID, "_teamshowcase_fb_url", true);
        printf("<tr><th scope=\"row\"><label for=\"teamshowcase_fb_url\">%s</label></th><td><input class=\"widefat\" placeholder=\"\" type=\"url\" id=\"teamshowcase_fb_url\" name=\"teamshowcase_fb_url\" value=\"%s\" /></td></tr>",__("Facebook", "app-Teamshowcase"), esc_attr($value_teamshowcase_fb_url));
        $value_teamshowcase_linkedin_url = get_post_meta($post->ID, "_teamshowcase_linkedin_url", true);
        printf("<tr><th scope=\"row\"><label for=\"teamshowcase_linkedin_url\">%s</label></th><td><input class=\"widefat\" placeholder=\"\" type=\"url\" id=\"teamshowcase_linkedin_url\" name=\"teamshowcase_linkedin_url\" value=\"%s\" /></td></tr>",__("Linkedin", "app-Teamshowcase"), esc_attr($value_teamshowcase_linkedin_url));
        $value_teamshowcase_twitter = get_post_meta($post->ID, "_teamshowcase_twitter", true);
        printf("<tr><th scope=\"row\"><label for=\"teamshowcase_twitter\">%s</label></th><td ><input class=\"widefat\" placeholder=\"\" type=\"url\" id=\"teamshowcase_twitter\" name=\"teamshowcase_twitter\" value=\"%s\" /></td></tr>",__("Twitter", "app-Teamshowcase"), esc_attr($value_teamshowcase_twitter));
        printf("</table>");
    }

    public function metabox_app_webiots_teamshowcase_save($post_id)
    {
        //  var_dump($_REQUEST);
        // Check if our nonce is set.
        
        if (!isset($_POST["metabox_app_webiots_teamshowcase_nonce"]))
            return $post_id;
        $nonce = $_POST["metabox_app_webiots_teamshowcase_nonce"];
      
        // Verify that the nonce is valid.
        
        if(!wp_verify_nonce($nonce, "metabox_app_webiots_teamshowcase_save"))
            return $post_id;
        
        // If this is an autosave, our form has not been submitted,
        // so we don't want to do anything.
        
        if (defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
            return $post_id;
        
        // Check the user's permissions.
        
        if ("page" == $_POST["post_type"])
        {
            if (!current_user_can("edit_page", $post_id))
                return $post_id;
        } else
        {
            if (!current_user_can("edit_post", $post_id))
                return $post_id;
        }
        // Sanitize the user input.
        $post_teamshowcase_designation = sanitize_text_field($_POST["teamshowcase_designation"] );
        // Update the meta field.
        update_post_meta($post_id, "_teamshowcase_designation", $post_teamshowcase_designation);
        // Sanitize the user input.
        $post_teamshowcase_fb_url = sanitize_text_field($_POST["teamshowcase_fb_url"] );
        // Update the meta field.
        update_post_meta($post_id, "_teamshowcase_fb_url", $post_teamshowcase_fb_url);
        // Sanitize the user input.
        $post_teamshowcase_linkedin_url = sanitize_text_field($_POST["teamshowcase_linkedin_url"] );
        // Update the meta field.
        update_post_meta($post_id, "_teamshowcase_linkedin_url", $post_teamshowcase_linkedin_url);
        // Sanitize the user input.
        $post_teamshowcase_twitter = sanitize_text_field($_POST["teamshowcase_twitter"] );
        // Update the meta field.
        update_post_meta($post_id, "_teamshowcase_twitter", $post_teamshowcase_twitter);
    }


    // TODO: register routes app_teamshowcase
   public function register_rest_route_app_teamshowcase(){
        register_rest_route("Teamshowcase/v2","app_teamshowcase",array(
            "methods" => "GET",
            "callback" =>array($this, "app_webiots_teamshowcase_callback"),
            "permission_callback" => function (WP_REST_Request $request){return true;}
        ));
    }




    public function admin_head_app_webiotsTeamshowcase($hooks){
        echo "<style type=\"text/css\">";
        echo ".app_Teamshowcase_ionicons .ion{cursor:pointer;text-align:center;border:1px solid #eee;font-size:32px;width:32px;height:32px;padding:6px;}";
        echo "</style>";
    }



    /*
     *  Get All the teamshowcase
     */

    /*
     * Registering Scripts and styles
     */



    /** register css/js Teamshowcase **/

    function webiots_teamshowcase_enqueue()
    {
        wp_enqueue_media();
        wp_register_style("ionicon", "//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css",array(),"1.2.4" );
        wp_enqueue_style("ionicon");
        wp_enqueue_script("app_Teamshowcase", plugins_url("/",__FILE__) . "/js/admin.js", array("jquery","thickbox"),"1",true );
        wp_register_style( 'stylecss',plugins_url( 'assets/css/style.css', dirname(__FILE__) ));
        wp_enqueue_style("stylecss");
        wp_register_style("font-awesome", "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css",array(),"1.2.4" );
        wp_enqueue_style("font-awesome");


    }

}


new WEBIOTSTeamshowcase();

function webiots_teamshowcase_department() {

    register_taxonomy(
        'team-department',
        'app_teamshowcase',
        array(
            'label' => __( 'Deparment' ),
            'rewrite' => array( 'slug' => 'team-department' ),
            'hierarchical' => true,
        )
    );
}
add_action( 'init', 'webiots_teamshowcase_department' );


/**
 * Display a custom taxonomy dropdown in admin
 */
add_action('restrict_manage_posts', 'teamshowcase_filter_posttype_taxonomy');
function teamshowcase_filter_posttype_taxonomy() {
    global $typenow;
    $post_type = 'app_teamshowcase'; // change to your post type
    $taxonomy  = 'team-department'; // change to your taxonomy
    if ($typenow == $post_type) {
        $selected      = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
        $info_taxonomy = get_taxonomy($taxonomy);
        wp_dropdown_categories(array(
            'show_option_all' => __("Show All {$info_taxonomy->label}"),
            'taxonomy'        => $taxonomy,
            'name'            => $taxonomy,
            'orderby'         => 'name',
            'selected'        => $selected,
            'show_count'      => true,
            'hide_empty'      => true,
        ));
    };
}


/**
 * Filter posts by taxonomy in admin
 */
add_filter('parse_query', 'teamshowcase_convert_idtoterm_query');
function teamshowcase_convert_idtoterm_query($query) {
    global $pagenow;
    $post_type = 'app_teamshowcase'; // change to your post type
    $taxonomy  = 'team-department'; // change to your taxonomy
    $q_vars    = &$query->query_vars;
    if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0 ) {
        $term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
        $q_vars[$taxonomy] = $term->slug;
    }
}




 function webiots_shortcode_teamshowcase( $atts ) {

if(isset($atts['style'])) {

    $slide = $atts['style'];//Getting Slide Templates
}
    global $wp_query,$post;

    $atts = shortcode_atts( array(
        'teamshowcase_name' => ''
    ), $atts );

    $loop = new WP_Query( array(
        'posts_per_page'    => -1,
        'post_type'         => 'app_teamshowcase',

    ) );


    if( ! $loop->have_posts() ) {
        return false;
    }
    ob_start();
    if($slide=="gridfilter"){
        include_once(WEBIOTSTEAMSHOWCASEPATH.'/templates/slider/slide1.php');
    }else if($slide=="grid"){
        include_once(WEBIOTSTEAMSHOWCASEPATH.'/templates/slider/slide2.php');
    }else if($slide=="carousel"){
        include_once(WEBIOTSTEAMSHOWCASEPATH.'/templates/slider/slide3.php');
    }else{
        include_once(WEBIOTSTEAMSHOWCASEPATH.'/templates/slider/slide2.php');
    }
    $output = ob_get_clean();
    //print $output; // debug
    return $output;



    wp_reset_postdata();
}


//load scripts
function webiots_teamshowcase_scripts_styles() {
//Register Styles

    wp_register_style( 'wi-bootstrap', plugins_url( 'assets/css/wi-bootstrap.css', dirname(__FILE__) ) );
    wp_register_style( 'font-awesome', 'http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' );
    wp_register_style( 'showcase',plugins_url( 'assets/css/showcase.css', dirname(__FILE__) ));
    wp_register_style( 'owlcarousel',plugins_url( 'assets/css/owl.carousel.min.css', dirname(__FILE__) ));
    wp_register_style( 'owltheme',plugins_url( 'assets/css/owl.theme.default.min.css', dirname(__FILE__) ));

    wp_enqueue_style( 'wi-bootstrap' );
    wp_enqueue_style( 'font-awesome' );
    wp_enqueue_style( 'showcase' );
    wp_enqueue_style( 'owlcarousel' );
    wp_enqueue_style( 'owltheme' );

//Register Scripts

    wp_register_script( 'owlcarouseljs', plugins_url( 'assets/js/owl.carousel.js', dirname(__FILE__) ),array(),'1.0',true);
    wp_register_script( 'teamshowcasejs', plugins_url( 'assets/js/teamshowcase.js', dirname(__FILE__) ),array(),'1.0',true);
    wp_enqueue_script('jquery');
    wp_enqueue_script( 'owlcarouseljs' );
    wp_enqueue_script( 'teamshowcasejs' );


}




/*
 * Addon Visual Composer
 */
function addon_vc_with_webiots_teamshowcase(){
    vc_map( array(
        "name" => __("Webiots Teamshowcase"),
        "base" => "webiots-team",
        "category" => __('Teamshowcase'),
        "icon"=> "vc_teamshowcase_icon",
        "params" => array(
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Layouts"),
                "param_name" => "style",
                "value" => __(array("blank","gridfilter","grid","carousel"),"app_teamshowcase"),
                "description" => __("Select the layout suitable according to your need")
            )
        )
    ));
}