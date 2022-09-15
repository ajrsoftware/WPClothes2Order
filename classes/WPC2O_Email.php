<?php

/**
 * WPC2O_Email File Doc Comment
 *
 * @category WPC2O_Email
 * @package  WPClothes2Order
 */
class WPC2O_Email
{

    /**
     * Every new instance of this class will attempt to build a new WPC2O email
     */
    public function __construct(string $to, string $subject, string $message) {
        $this->send($to, $subject, $this->body($message));
    }

    /**
     * Send the WP email
     * @param string $to 
     * @param string $subject 
     * @param string $message 
     * @return void 
     */
    private function send(string $to, string $subject, string $message): void
    {
        wp_mail($to, $subject, $message, array( 'Content-Type: text/html; charset=UTF-8' ));
    }

    /**
     * Build a nicely formatted email body
     * @param string $message 
     * @return string 
     */
    private function body(string $message): string
    {
        $body  = '<div>';
        $body .= '<p>' . $message . '</p>';
        $body .= '</div>';

        return $body;
    }
}
