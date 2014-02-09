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
    public function __construct(SectionAttr $meta = null)
    {
        parent::__construct();
        if($meta instanceof SectionAttr)
        {
            $this->child('meta', $meta);
        }
    }

    /**
     * Get or set meta
     *
     * @param  SectionAttr $meta
     * @return SectionAttr|self
     */
    public function meta(SectionAttr $meta = null)
    {
        if(null === $meta)
        {
            return $this->child('meta');
        }
        return $this->child('meta', $meta);
    }
}
