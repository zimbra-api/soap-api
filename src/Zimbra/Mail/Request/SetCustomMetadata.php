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

use Zimbra\Mail\Struct\MailCustomMetadata;
use Zimbra\Soap\Request;

/**
 * SetCustomMetadata request class
 * Set Custom Metadata 
 * Setting a custom metadata section but providing no key/value pairs will remove the sction from the item
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class SetCustomMetadata extends Request
{
    /**
     * Constructor method for SetCustomMetadata
     * @param  string $id
     * @param  MailCustomMetadata $meta
     * @return self
     */
    public function __construct($id, MailCustomMetadata $meta = null)
    {
        parent::__construct();
        $this->property('id', trim($id));
        if($meta instanceof MailCustomMetadata)
        {
            $this->child('meta', $meta);
        }
    }

    /**
     * Gets or sets id
     *
     * @param  string $id
     * @return string|self
     */
    public function id($id = null)
    {
        if(null === $id)
        {
            return $this->property('id');
        }
        return $this->property('id', trim($id));
    }

    /**
     * Get or set meta
     *
     * @param  MailCustomMetadata $meta
     * @return MailCustomMetadata|self
     */
    public function meta(MailCustomMetadata $meta = null)
    {
        if(null === $meta)
        {
            return $this->child('meta');
        }
        return $this->child('meta', $meta);
    }
}
