<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Request;

use Zimbra\Soap\Request;
use Zimbra\Struct\NamedElement;

/**
 * GetFreeBusyQueueInfo request class
 * Get Free/Busy provider information.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetFreeBusyQueueInfo extends Request
{
    /**
     * Constructor method for GetFreeBusyQueueInfo
     * @param  NamedElement $provider
     * @return self
     */
    public function __construct(NamedElement $provider = null)
    {
        parent::__construct();
        if($provider instanceof NamedElement)
        {
            $this->child('provider', $provider);
        }
    }

    /**
     * Gets or sets provider
     *
     * @param  NamedElement $provider
     * @return NamedElement|self
     */
    public function provider(NamedElement $provider = null)
    {
        if(null === $provider)
        {
            return $this->child('provider');
        }
        return $this->child('provider', $provider);
    }
}
