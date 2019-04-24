<?php
/*
Plugin Name: three Widget
Plugin URI: https://thachpham.com
Description: Thực hành tạo widget item.
Author: Thach Pham
Version: 1.0
Author URI: http://google.com
*/
add_action( 'widgets_init', 'create_thachpham_widget' );
function create_thachpham_widget() {
        register_widget('Thachpham_Widget');
}
class Thachpham_Widget extends WP_Widget {
 
    /**
     * Thiết lập widget: đặt tên, base ID
     */
    function __construct() {
        parent::__construct (
            'thachpham_widget', // id của widget
            'ThachPham Widget', // tên của widget
       
            array(
                'description' => 'Mô tả của widget' // mô tả
            )
          );
    }


    function widget( $args, $instance ) {

        $args = array(
            'post_type'      => 'product',
            'posts_per_page' => 4,
            'orderby' =>'date',
            'order' => 'DESC'
        );
    
        $loop = new WP_Query( $args );
    
    ?>
    
    <section class="section-60">
            <div class="shell text-left">
              <div class="range">
                <div class="cell-md-4">
                  <h3 class="text-center text-sm-left">
                    <span class="text-spacing-40 text-bold">SẢN PHẨM </span>
                    <span class="text-italic text-regular">Mới</span>
                  </h3>
                  <hr class="divider divider-sm-left divider-base divider-bold">
                  <div class="range offset-top-20" id="newProducts">
                      <?php 
        while ( $loop->have_posts() ) : $loop->the_post();
            global $product;?>
                  <div class="cell-md-12 cell-sm-4">
            <div class="unit unit-horizontal unit-spacing-21">
                <div class="unit-left">
                    <a type="image" href="<?php echo get_permalink() ;?>">
                    <?php echo woocommerce_get_product_thumbnail() ;?>
                    </a>
                </div>
            <div class="unit-body">
              <div class="p">
              <?php global $post, $product; $cat_count = sizeof( get_the_terms( $post->ID, 'product_cat' ) ); echo $product->get_categories( ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', $cat_count, 'woocommerce' ) . ' ', '</span>' ); ?>
              </div>
              <div class="big offset-top-4">
                <a type="name" href="<?php echo get_permalink() ;?>" class="text-base">
                <?php echo get_the_title(); ?>
                </a>
              </div>
              <div class="offset-top-4">
                <div class="product-price text-bold">
                  <span type="priceAfter">
                  <?php echo wc_price(get_post_meta( get_the_ID(), '_regular_price', true )); ?>
                </span>
                <span type="priceBefore" class="font-default text-light text-muted text-strike small">
                  <?php
                    $sale_pr = get_post_meta( get_the_ID(), '_sale_price', true );
                        if($sale_pr!=0) echo wc_price($sale_pr);
                        else  ?>  
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
    
            <?php
                endwhile;
    
                wp_reset_query();
                $query_args = array(
                    'posts_per_page'    => 4,
                    'post_status'       => 'publish',
                    'post_type'         => 'product',
                    'meta_query'        => WC()->query->get_meta_query(),
                    'post__in'          => array_merge( array( 0 ), wc_get_product_ids_on_sale() )
                );
                $loop = new WP_Query( $query_args );
    
            ?>
                </div>
                </div>
                <div class="cell-md-4">
                  <h3 class="text-center text-sm-left">
                  <span class="text-spacing-40 text-bold">ĐANG </span>
                    <span class="text-italic text-regular">Khuyến Mãi</span>
                  </h3>
                  <hr class="divider divider-sm-left divider-base divider-bold">
                  <div class="range offset-top-20" id="newProducts">
                      <?php 
        while ( $loop->have_posts() ) : $loop->the_post();
            global $product;?>
                  <div class="cell-md-12 cell-sm-4">
            <div class="unit unit-horizontal unit-spacing-21">
                <div class="unit-left">
                    <a type="image" href="<?php echo get_permalink() ;?>">
                    <?php echo woocommerce_get_product_thumbnail() ;?>
                    </a>
                </div>
            <div class="unit-body">
              <div class="p">
              <?php global $post, $product; $cat_count = sizeof( get_the_terms( $post->ID, 'product_cat' ) ); echo $product->get_categories( ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', $cat_count, 'woocommerce' ) . ' ', '</span>' ); ?>
              </div>
              <div class="big offset-top-4">
                <a type="name" href="<?php echo get_permalink() ;?>" class="text-base">
                <?php echo get_the_title(); ?>
                </a>
              </div>
              <div class="offset-top-4">
                <div class="product-price text-bold">
                  <span type="priceAfter">
                  <?php
                  
                  echo wc_price(get_post_meta( get_the_ID(), '_regular_price', true )); ?>
                </span>
                  <span type="priceBefore" class="font-default text-light text-muted text-strike small">
                  <?php
                    $sale_pr = get_post_meta( get_the_ID(), '_sale_price', true );
                        if($sale_pr!=0) echo wc_price($sale_pr);
                        else  ?>  
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php 
         endwhile;
    
         wp_reset_query();?>
        
        </div>
    </div>
                <?php
        $args = array(
          'post_type'      => 'product',
          'posts_per_page' => 4,
          'orderby' =>'rand',
          'order' => 'DESC'
      );
    
      $h = new WP_Query( $args );
                
                ?>
                <div class="cell-md-4 offset-top-45 offset-md-top-0">
                  <h3 class="text-center text-sm-left">
                    <span class="text-spacing-40 text-bold text-uppercase">MUA </span>
                    <span class="text-italic text-regular"> Nhiều Nhất</span>
                  </h3>
                  <hr class="divider divider-sm-left divider-base divider-bold">
                  <div class="range offset-top-20" id="hotProducts">
    
    
                  <?php 
        while ( $h->have_posts() ) : $h->the_post();
            global $product;?>
            <div class="cell-md-12 cell-sm-4">
            <div class="unit unit-horizontal unit-spacing-21">
                <div class="unit-left">
                    <a type="image" href="<?php echo get_permalink() ;?>">
                    <?php echo woocommerce_get_product_thumbnail() ;?>
                    </a>
                </div>
            <div class="unit-body">
              <div class="p">
              <?php global $post, $product; $cat_count = sizeof( get_the_terms( $post->ID, 'product_cat' ) ); echo $product->get_categories( ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', $cat_count, 'woocommerce' ) . ' ', '</span>' ); ?>
              </div>
              <div class="big offset-top-4">
                <a type="name" href="<?php echo get_permalink() ;?>" class="text-base">
                <?php echo get_the_title(); ?>
                </a>
              </div>
              <div class="offset-top-4">
                <div class="product-price text-bold">
                  <span type="priceAfter">
                  <?php echo wc_price(get_post_meta( get_the_ID(), '_regular_price', true )); ?>
                </span>
                <span type="priceBefore" class="font-default text-light text-muted text-strike small">
                  <?php
                    $sale_pr = get_post_meta( get_the_ID(), '_sale_price', true );
                        if($sale_pr!=0) echo wc_price($sale_pr);
                        else  ?>  
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
    
            <?php
                endwhile;
    
                wp_reset_query();?>
                </div>
                </div>
          </section>
        <?php
    
    }

}
