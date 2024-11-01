<div class="wi-container">
    <div class="row">
        
            <div class="owl-carousel owl-theme">
            <?php

            while( $loop->have_posts() ) {
                $loop->the_post();
                ?>
                <div class="wi-item">
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


