<section>
<?php

$terms = get_terms( array(
    'taxonomy' => 'team-department',
    'hide_empty' => false,
));

if ( $terms && !is_wp_error( $terms ) ) :
    ?>
<div class="wi-container">
    <div>
        <button class="wi-filter-button" data-filter="all">All</button>
        <?php

        foreach ( $terms as $term ) { ?>
            <button class="wi-filter-button" data-filter="<?php echo $term->name; ?>"><?php echo $term->name; ?></button>
        <?php } ?>
    </div>
    <br/>
<?php endif;?>
    <div class="row">
            <div id="wi-ts-filter">
        <?php

        while( $loop->have_posts() ) {
        $loop->the_post();
/*
 *  Getting All Departments of different posts
 */
            $taxonomies = 'team-department';
            $types = get_the_terms($post->ID, $taxonomies);
            $department = " ";
            if($types) {
                foreach ($types as $type) {
                    $department .= " " . $type->name;
                }
            }
        ?>
        <div class="wi-col-xs-12 wi-col-sm-12 wi-col-md-3 wi-ts-filter-grid filter<?php echo $department; ?>">
           
                <div class="wi-s-card">
                    <?php
                    if (has_post_thumbnail( $post->ID ) ) {
                        $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail');
                        ?>
                        <div class="wi-s-card-image" style="background-image:url('<?php echo $image[0]; ?>');"></div>
                        <?php
                    }
                    ?>
                    <div class="wi-s-card-content">
                        <div class="wi-s-card-title"><?php echo get_the_title($post->ID); ?></div>
                        <p class="wi-s-card_text"><?php echo get_post_meta($post->ID, "_teamshowcase_designation", true); ?></p>
                        <div class="wi-social-icons">
                            <ul class="list-inline">
                                <?php
                                $fburl = get_post_meta($post->ID, "_teamshowcase_fb_url", true);
                                if(strlen($fburl)>0){
                                    ?>
                                    <li><a href="<?php echo $fburl; ?>" target="_blank"> <i class="fa fa-facebook" aria-hidden="true" ></i></a></li>
                                    <?php
                                }
                                $linkedurl = get_post_meta($post->ID, "_teamshowcase_linkedin_url", true);
                                if(strlen($linkedurl)>0){
                                    ?>
                                    <li><a href="<?php echo $linkedurl; ?>" target="_blank"> <i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                    <?php
                                }
                                $twitterurl = get_post_meta($post->ID, "_teamshowcase_twitter", true);
                                if(strlen($twitterurl)>0){
                                    ?>
                                    <li><a href="<?php echo $twitterurl; ?>" target="_blank"> <i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        
<?php
}
?>

    </div>
     </div>
</div>
</section>

