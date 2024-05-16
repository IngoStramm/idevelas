<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasMinicart" aria-labelledby="offcanvasMinicartLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasMinicartLabel"><?php _e('Carrinho', 'iv'); ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="widget_shopping_cart_content"><?php woocommerce_mini_cart(); ?></div>
    </div>
</div>