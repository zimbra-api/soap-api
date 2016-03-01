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
class SetCustomMetadata extends Base
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
        $this->setProperty('id', trim($id));
        if($meta instanceof MailCustomMetadata)
        {
            $this->setChild('meta', $meta);
        }
    }

    /**
     * Gets item id
     *
     * @return string
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets item id
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setProperty('id', trim($id));
    }

    /**
     * Gets metadata
     *
     * @return MailCustomMetadata
     */
    public function getMetadata()
    {
        return $this->getChild('meta');
    }

    /**
     * Sets metadata
     *
     * @param  MailCustomMetadata $metadata
     * @return self
     */
    public function setMetadata(MailCustomMetadata $metadata)
    {
        return $this->setChild('meta', $metadata);
    }
}
