<?php
namespace Eventin\Admin;

use Eventin\Interfaces\HookableInterface;
use Wpeventin;

class TemplateRender implements HookableInterface {
    /**
     * Register service
     *
     * @return  void
     */
    public function register_hooks(): void {
        add_action( 'template_redirect', [$this, 'render_checkout_template'] );
    }

    /**
     * Render eventin checkout page template
     *
     * @return  void
     */
    public function render_checkout_template() {

        $query_var = get_query_var( 'eventin-purchase' );

        if ( 'checkout' !== $query_var ) {
            return;
        }

        include_once Wpeventin::templates_dir() . '/checkout-template.php';
        exit;
    }
}
