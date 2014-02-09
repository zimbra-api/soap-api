<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Request;

use Zimbra\Mail\Struct\ContentSpec;

/**
 * ImportAppointments request class
 * Import appointments
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ImportAppointments extends Base
{
    /**
     * Constructor method for ImportAppointments
     * @param  ContentSpec $content
     * @param  string $ct
     * @param  string $l
     * @return self
     */
    public function __construct(ContentSpec $content, $ct, $l = null)
    {
        parent::__construct();
        $this->child('content', $content);
        $this->property('ct', trim($ct));
        if(null !== $l)
        {
            $this->property('l', trim($l));
        }
    }

    /**
     * Get or set content
     * Content specification
     *
     * @param  ContentSpec $content
     * @return ContentSpec|self
     */
    public function content(ContentSpec $content = null)
    {
        if(null === $content)
        {
            return $this->child('content');
        }
        return $this->child('content', $content);
    }

    /**
     * Get or set ct
     * Content type
     * Only currently supported content type is "text/calendar" (and its nickname "ics")
     *
     * @param  string $ct
     * @return string|self
     */
    public function ct($ct = null)
    {
        if(null === $ct)
        {
            return $this->property('ct');
        }
        return $this->property('ct', trim($ct));
    }

    /**
     * Gets or sets l
     * Optional folder ID to import appointments into
     *
     * @param  string $l
     * @return string|self
     */
    public function l($l = null)
    {
        if(null === $l)
        {
            return $this->property('l');
        }
        return $this->property('l', trim($l));
    }
}
