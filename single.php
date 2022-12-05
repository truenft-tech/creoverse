<?php

/**
 * The template for displaying single page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package euronews
 */

get_header();
wpb_set_post_views(get_the_ID());
?>

<section id="article">
    <div class="container">
        <div class="row">
            <div class="col-md-8 content">

                <ul class="categories">
                    <?php if (get_field('is_live', get_the_ID()) == 1) : ?>
                        <li class="live-article">Live<span></span></li>
                    <?php endif; ?>
                    <?php foreach (get_the_category(get_the_ID()) as $category) {
                    ?>
                        <li><a href="<?= get_term_link($category) ?>" class="category"><?= $category->name; ?></a></li>
                    <?php
                    } ?>
                </ul>
                <h1><?= the_title(); ?></h1>

                <p class="post-info">By <strong><a href="/author/<?= get_user_by('id', get_post_field('post_author', get_the_ID()))->user_nicename; ?>"><?php the_author_meta('display_name', get_post_field('post_author', get_the_ID())); ?></a></strong> • <?= get_the_date('d F Y'); ?> • <?= get_the_date('G:i'); ?></p>
                <img src="<?= get_the_post_thumbnail_url(get_the_ID()); ?>" alt="" class="d-none">
                <div class="image-block" style="background-image: url('<?= get_the_post_thumbnail_url(get_the_ID()); ?>')"></div>
                <p class="img-desc">
                    <?php
                    $thumbnail_id    = get_post_thumbnail_id(get_the_ID());
                    $thumbnail_image = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));

                    if ($thumbnail_image && isset($thumbnail_image[0])) {
                        echo $thumbnail_image[0]->post_excerpt;
                    }
                    ?>
                </p>
                <div class="wordpress-content">
                    <?= the_content(); ?>
                </div>
                <p class="mt-2 share-story">Share this story</p>
                <div class="share-links"></div>
                <hr class="share-delimeter">
                <a href="/" class="go-back">Go Back</a>
                <div class="subscribe-for-news">
                    <h3>Sign up for personalised news</h3>
                    <p class="subtitle">Subscribe to our Euro Weekly News alerts to get the latest stories into your inbox!</p>
                    <?php echo do_shortcode('[newsletter_form list="2"]'); ?>
                    <p class="note">
                        By signing up, you will create a Euro Weekly News account if you don’t already have one. Review our
                        <a href="/privacy-policy">Privacy Policy</a> for more information about our privacy practices.
                    </p>
                </div>
            </div>
            <div class="col-md-4 right-sidebar d-none d-sm-block ps-lg-5">
                <h2 class="title black">Related News</h2>
                <hr>
                <ul class="posts related">
                    <?php $related = codeless_get_related_posts(get_the_ID(), 6)->posts;
                    foreach ($related as $post) :
                    ?>
                        <li class="main-post">
                            <?php if (get_the_post_thumbnail_url($post->ID)) : ?>
                                <div class="image-wrapper">
                                    <a href="<?= get_permalink($post->ID); ?>">
                                        <div class="image-block" style="background-image: url('<?= get_the_post_thumbnail_url($post->ID); ?>')"></div>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <div class="p-0 list-unstyled d-flex">
                                <?php if (get_field('is_live', $post->ID) == 1) : ?>
                                    <div class="live-article">Live<span></span></div>
                                <?php endif; ?>
                                <a href="<?= get_term_link(get_the_category($post->ID)[0]) ?>" class="category"><?= get_the_category($post->ID)[0]->name; ?></a>
                            </div>
                            <a href="<?= get_permalink($post->ID); ?>">
                                <h3><?= mb_strimwidth($post->post_title, 0, 500, "..."); ?> </h3>
                            </a>
                        </li>
                    <?php
                    endforeach;
                    wp_reset_query();
                    ?>


                </ul>
                <?php if (get_field('disable_ads', get_the_ID()) != 1) : ?>
                    <div class="text-center">
                        <div class="widget text-center">
                            <ins data-revive-zoneid="113" data-revive-id="a83880e4853dd0b4bb671b17b1ba696b"></ins>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php if (get_field('disable_ads', get_the_ID()) != 1) : ?>
    <div id="banner-970">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="widget text-center">
                        <ins data-revive-zoneid="68" data-revive-id="a83880e4853dd0b4bb671b17b1ba696b"></ins>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<section id="comments">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="author-info">
                    <?php
                    $author_id = get_post_field('post_author', get_the_ID());
                    $author_badge = get_field('user_avatar', 'user_' . $author_id);
                    if ($author_badge) {
                    ?>
                        <img src="<?php echo $author_badge['sizes']['thumbnail']; ?>" alt="<?php echo $author_badge['alt']; ?>" />
                    <?php
                    } else {
                    ?>
                        <img src="/wp-content/themes/euronews/assets/images/comment-image.png" alt="" />
                    <?php
                    }

                    ?>

                    <div class="content">
                        <span>Written by</span>
                        <a href="/author/<?= get_user_by('id', get_post_field('post_author', get_the_ID()))->user_nicename; ?>">
                            <h3><?php the_author_meta('display_name', get_post_field('post_author', get_the_ID())); ?></h3>
                        </a>
                        <p class="about">
                            <?php the_author_meta('user_description', get_post_field('post_author', get_the_ID())); ?>
                        </p>
                    </div>
                </div>
                <h2 class="title-2 black">Comments</h2>
                <hr>
                <ul class="comments">
                    <?php if (comments_open()) {
                        comments_template();
                    } ?>
                </ul>
            </div>
            <div class="col-md-4 right-sidebar text-center">
                <?php if (get_field('disable_ads', get_the_ID()) != 1) : ?>

                <?php endif; ?>
            </div>

        </div>
    </div>
</section>
<?php if (get_field('disable_ads', get_the_ID()) != 1) : ?>
    <!--<section id="news-grid">-->
    <!--    <div class="container">-->
    <!--        <div class="row">-->
    <!--            <div class="col-md-12">-->
    <!--                <script type="text/javascript">-->
    <!--                    window._taboola = window._taboola || [];-->
    <!--                    _taboola.push({flush: true});-->
    <!--                </script>-->
    <!--                <div id="taboola-homepage-thumbnails-desktop"></div>-->
    <!--                <script type="text/javascript">-->
    <!--                    window._taboola = window._taboola || [];-->
    <!--                    _taboola.push({-->
    <!--                    mode: 'thumbnails-hp-desktop',-->
    <!--                    container: 'taboola-homepage-thumbnails-desktop',-->
    <!--                    placement: 'Homepage Thumbnails Desktop',-->
    <!--                    target_type: 'mix'-->
    <!--                });-->
    <!--                </script>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
<?php endif; ?>
<section id="world-news" class="no-ads">
    <div class="container">
        <div class="row">
            <?php if (get_field('disable_ads', get_the_ID()) != 1) : ?>
                <div class="col-md-4 pe-lg-5 text-center">
                    <div class="widget text-center">
                        <ins data-revive-zoneid="113" data-revive-id="a83880e4853dd0b4bb671b17b1ba696b"></ins>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-md-8 mt-4 md-0 posts">
                <h2 class="title black">Continue Reading</h2>
                <hr>
                <?php
                $args = array(
                    'numberposts' => 7,
                    'offset' => 0,
                    'post__not_in' => array(get_the_ID())
                );
                $other_posts = get_posts($args);
                ?>
                <div class="news">
                    <div class="left-column">
                        <ul class="posts">
                            <?php $other_posts = new WP_Query(['posts_per_page' => 5, 'post__not_in' => array(get_the_ID())]);
                            $count_other_posts = 0;
                            foreach ($other_posts->posts as $post) {
                                $count_other_posts++;
                                if ($count_other_posts == 1) {
                            ?>
                                    <li class="main-post">
                                        <div class="image-wrapper">
                                            <a href="<?= get_permalink($post->ID); ?>">
                                                <div class="image-block" style="background-image: url('<?= get_the_post_thumbnail_url($post->ID); ?>');"></div>
                                            </a>
                                        </div>
                                        <div class="content">
                                            <div class="p-0 list-unstyled d-flex">
                                                <?php if (get_field('is_live', $post->ID) == 1) : ?>
                                                    <div class="live-article">Live<span></span></div>
                                                <?php endif; ?>
                                                <a href="<?= get_term_link(get_category_by_slug('world-news')) ?>" class="category">World News</a>
                                            </div>
                                            <a href="<?= get_permalink($post->ID); ?>">
                                                <h3><?= mb_strimwidth($post->post_title, 0, 500, "..."); ?></h3>
                                            </a>
                                            <p class="desc d-none d-sm-block"><?= $post->post_excerpt; ?></p>
                                        </div>
                                    </li>
                            <?php }
                            } ?>
                        </ul>
                    </div>
                    <div class="right-column d-none d-sm-block">
                        <div class="two-column d-block d-sm-flex">
                            <div class="column-1">
                                <ul class="posts">
                                    <?php
                                    $other_posts_count = 0;
                                    foreach ($other_posts->posts as $post) {
                                        $other_posts_count++;
                                        if ($other_posts_count % 2 == 0) {
                                    ?>
                                            <li class="post d-flex d-sm-block">
                                                <div class="image-wrapper">
                                                    <a href="<?= get_permalink($post->ID); ?>">
                                                        <div class="image-block" style="background-image: url('<?= get_the_post_thumbnail_url($post->ID); ?>');"></div>
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <div class="p-0 list-unstyled d-flex">
                                                        <?php if (get_field('is_live', $post->ID) == 1) : ?>
                                                            <div class="live-article">Live<span></span></div>
                                                        <?php endif; ?>
                                                        <a href="<?= get_term_link(get_category_by_slug('world-news')) ?>" class="category">World News</a>
                                                    </div>
                                                    <a href="<?= get_permalink($post->ID); ?>">
                                                        <h3><?= mb_strimwidth($post->post_title, 0, 500, "..."); ?></h3>
                                                    </a>
                                                </div>
                                            </li>
                                    <?php }
                                    } ?>
                                </ul>
                            </div>
                            <div class="column-2">
                                <ul class="posts">
                                    <?php
                                    $other_posts_count = 0;
                                    foreach ($other_posts->posts as $post) {
                                        $other_posts_count++;
                                        if ($other_posts_count !== 1 && $other_posts_count % 2 !== 0) {
                                    ?>
                                            <li class="post d-flex d-sm-block">
                                                <div class="image-wrapper">
                                                    <a href="<?= get_permalink($post->ID); ?>">
                                                        <div class="image-block" style="background-image: url('<?= get_the_post_thumbnail_url($post->ID); ?>');"></div>
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <div class="p-0 list-unstyled d-flex">
                                                        <?php if (get_field('is_live', $post->ID) == 1) : ?>
                                                            <div class="live-article">Live<span></span></div>
                                                        <?php endif; ?>
                                                        <a href="<?= get_term_link(get_category_by_slug('world-news')) ?>" class="category">World News</a>
                                                    </div>
                                                    <a href="<?= get_permalink($post->ID); ?>">
                                                        <h3><?= mb_strimwidth($post->post_title, 0, 500, "..."); ?></h3>
                                                    </a>
                                                </div>
                                            </li>
                                    <?php }
                                    } ?>
                                </ul>
                            </div>
                        </div>

                    </div>
                    <div class="right-column d-block d-md-none">
                        <div class="two-column d-block d-sm-flex">
                            <div class="column-1">
                                <ul class="posts">
                                    <?php $other_posts_col_1 = new WP_Query(['posts_per_page' => 2, 'offset' => '1', 'post__not_in' => array(get_the_ID())]);
                                    foreach ($other_posts_col_1->posts as $post) {
                                    ?>
                                        <li class="post d-flex d-sm-block">
                                            <a href="<?= get_permalink($post->ID); ?>">
                                                <div class="image-wrapper">
                                                    <div class="image-block" style="background-image: url('<?= get_the_post_thumbnail_url($post->ID); ?>');"></div>
                                                </div>
                                            </a>
                                            <div class="content">
                                                <div class="p-0 list-unstyled d-flex">
                                                    <?php if (get_field('is_live', $post->ID) == 1) : ?>
                                                        <div class="live-article">Live<span></span></div>
                                                    <?php endif; ?>
                                                    <a href="<?= get_term_link(get_category_by_slug('world-news')) ?>" class="category">World News</a>
                                                </div>
                                                <a href="<?= get_permalink($post->ID); ?>">
                                                    <h3><?= mb_strimwidth($post->post_title, 0, 500, "..."); ?></h3>
                                                </a>
                                            </div>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <div class="column-2">
                                <ul class="posts">
                                    <?php $other_posts_col_2 = new WP_Query(['posts_per_page' => 2, 'offset' => '3', 'post__not_in' => array(get_the_ID())]);
                                    foreach ($other_posts_col_2->posts as $post) {
                                    ?>
                                        <li class="post d-flex d-sm-block">
                                            <a href="<?= get_permalink($post->ID); ?>">
                                                <div class="image-wrapper">
                                                    <div class="image-block" style="background-image: url('<?= get_the_post_thumbnail_url($post->ID); ?>');"></div>
                                                </div>
                                            </a>
                                            <div class="content">
                                                <div class="p-0 list-unstyled d-flex">
                                                    <?php if (get_field('is_live', $post->ID) == 1) : ?>
                                                        <div class="live-article">Live<span></span></div>
                                                    <?php endif; ?>
                                                    <a href="<?= get_term_link(get_category_by_slug('world-news')) ?>" class="category">World News</a>
                                                </div>
                                                <a href="<?= get_permalink($post->ID); ?>">
                                                    <h3><?= mb_strimwidth($post->post_title, 0, 500, "..."); ?></h3>
                                                </a>
                                            </div>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>