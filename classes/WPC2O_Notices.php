<?php

class WPC2O_Notice
{
    protected string $servierty;
    protected string $message;
    protected bool $dissmissible;

    public function __construct(string $servierty, string $message, bool $dissmissible)
    {
        $this->servierty = $servierty;
        $this->message = $message;
        $this->dissmissible = $dissmissible;
        add_action('admin_notices', array($this, 'wpc2o_build'));
    }

    public function wpc2o_build(): void
    {
?>
        <div class="notice notice-<?php echo $this->servierty; ?> <?php $this->dissmissible ?: 'is-dismissible'; ?>">
            <p><?php _e($this->message, 'wpc2o'); ?></p>
        </div>
<?php
    }
}
