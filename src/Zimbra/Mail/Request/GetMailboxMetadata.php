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

use Zimbra\Mail\Struct\SectionAttr;

/**
 * GetMailboxMetadata request class
 * Get Mailbox metadata
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetMailboxMetadata extends Base
{
    /**
     * Constructor method for GetMailboxMetadata
     * @param  SectionAttr $meta
     * @return self
     */
    public function __construct(SectionAttr $metadata = null)
    {
        parent::__construct();
        if($metadata instanceof SectionAttr)
        {
            $this->setChild('meta', $metadata);
        }
    }

    /**
     * Gets metadata section specification
     *
     * @return SectionAttr
     */
    public function getMetadata()
    {
        return $this->getChild('meta');
    }

    /**
     * Sets metadata section specification
     *
     * @param  SectionAttr $metadata
     * @return self
     */
    public function setMetadata(SectionAttr $metadata)
    {
        return $this->setChild('meta', $metadata);
    }
}
