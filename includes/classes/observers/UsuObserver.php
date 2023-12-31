<?php
/**
 * Part of Ultimate URLs for Zen Cart.
 *
 * @copyright Copyright 2019 Cindy Merkin (vinosdefrutastropicales.com)
 * @license http://www.gnu.org/licenses/gpl.txt GNU GPL V3.0
 */
if (!defined('IS_ADMIN_FLAG') || IS_ADMIN_FLAG === true) {
    die('Illegal Access');
}

class UsuObserver extends base
{
    public function __construct()
    {
        $enabled = (defined('USU_ENABLED') && USU_ENABLED == 'true');
        if ($enabled) {
            if (!class_exists('usu')) {
                require DIR_WS_CLASSES . 'usu.php';
            }
            $this->usu = new usu();
            
            $this->attach (
                $this,
                array(
                    /* From /includes/functions/html_output.php */
                   'NOTIFY_SEFU_INTERCEPT',
                )
            );
        }
    }

    public function update(&$class, $eventID, $p1, &$p2, &$p3, &$p4, &$p5, &$p6, &$p7, &$p8)
    {
        switch ($eventID) {
            // -----
            // Issued at the top of the zen_href_link function to allow us to override the href-link
            // returned.
            //
            // On entry:
            //
            // $p1 ... n/a
            // $p2 ... A reference to the to-be-returned $link; set this to a non-null value to override.
            // $p3 ... A reference to the page associated with the to-be-generated link
            // $p4 ... A reference to the parameters associated with the to-be-generated link
            // $p5 ... A reference to the (input) connection type (either 'SSL' or 'NONSSL') to be used for the link
            // $p6 ... A reference to the boolean input identifying whether/not to include the current session ID.
            // $p7 ... A reference to the boolean input identifying whether/not to use the URL as specified
            // $p8 ... A reference to the boolean input identifying whether/not to include the store's subdirectory in the link.
            //
            case 'NOTIFY_SEFU_INTERCEPT':
                $p2 = $this->usu->href_link($p3, $p4, $p5, $p6, true, $p7, $p8);
                break;

            default:
                break;
        }
    }
 }
