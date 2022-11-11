<?php

/**
 * WPC2O_Notice File Doc Comment
 *
 * @category WPC2O_Notice
 * @package  WPClothes2Order
 */
class WPC2O_Notice
{
    protected string $servierty;
    protected string $message;
    protected bool $dissmissible;

    /**
     * Add notice action
     * @param string $servierty 
     * @param string $message 
     * @param bool $dissmissible 
     * @return void 
     */
    public function __construct(string $servierty, string $message, bool $dissmissible)
    {
        $this->servierty    = $servierty;
        $this->message      = $message;
        $this->dissmissible = $dissmissible;
        add_action('admin_notices', array($this, 'wpc2o_build'));
    }

    /**
     * Build notice
     * @return void 
     */
    public function wpc2o_build(): void
    {
?>
        <div class="notice notice-<?php echo esc_html($this->servierty); ?> <?php esc_html($this->dissmissible) ?: 'is-dismissible'; ?>">
            <p><?php echo $this->message; ?></p>
        </div>
<?php
    }
}
