<?php get_header(); ?>

<main>
  <div class="section">
    <div class="section_inner">

      <?php if (have_posts()): ?>
        <?php while (have_posts()): the_post(); ?>
          <article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
            <header class="section_header">
              <h1 class="heading heading-primary"><?php the_title(); ?></h1>
            </header>
            <div class="post_content">
              <time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y年m月d日'); ?></time>
              <div class="content">
                <?php the_content(); ?>
              </div>
            </div>
            <footer class="post_footer">
              <div class="category">
                <div class="category_list">

                  <?php
                  $categories = get_the_category();
                  if ($categories):
                  ?>
                    <?php foreach ($categories as $category): ?>
                      <div class="category_item">
                        <a href="<?= get_category_link($category); ?>" class="btn btn-sm is-active"><?= $category->name; ?></a>
                      </div>
                    <?php endforeach; ?>
                  <?php endif; ?>

                </div>
              </div>

              <div class="prevNext">
                <?php
                //前の投稿のオブジェクトデータ(WP_Post)
                $previous_post = get_previous_post();
                if ($previous_post):
                ?>
                  <div class="prevNext_item prevNext_item-prev">
                    <a href="<?php the_permalink($previous_post); ?>">
                      <svg width="20" height="38" viewBox="0 0 20 38">
                        <path d="M0,0,19,19,0,38" transform="translate(20 38) rotate(180)" fill="none" stroke="#224163" stroke-width="1" />
                      </svg>
                      <span><?= get_the_title($previous_post); ?></span>
                    </a>
                  </div>
                <?php endif; ?>

                <?php
                $next_post = get_next_post();
                if ($next_post):
                ?>
                  <div class="prevNext_item prevNext_item-next">
                    <a href="<?php the_permalink($next_post); ?>">
                      <span><?= get_the_title($next_post); ?></span>
                      <svg width="20" height="38" viewBox="0 0 20 38">
                        <path d="M1832,1515l19,19L1832,1553" transform="translate(-1832 -1514)" fill="none" stroke="#224163" stroke-width="1" />
                      </svg>
                    </a>
                  </div>
                <?php endif; ?>
              </div>
            </footer>
          </article>
        <?php endwhile; ?>
      <?php endif; ?>

    </div>
  </div>
</main>

<?php get_footer(); ?>