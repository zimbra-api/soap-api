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
 * SetMailboxMetadata request class
 * Set Mailbox Metadata
 * Setting a mailbox metadata section but providing no key/value pairs will remove the section from mailbox metadata 
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class SetMailboxMetadata extends Base
{
    /**
     * Constructor method for SetMailboxMetadata
     * @param  MailCustomMetadata $meta
     * @return self
     */
    public function __construct(MailCustomMetadata $meta = null)
    {
        parent::__construct();
        if($meta instanceof MailCustomMetadata)
        {
            $this->setChild('meta', $meta);
        }
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
