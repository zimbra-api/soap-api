<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use Zimbra\Enum\XmppComponentBy as XmppBy;
use Zimbra\Struct\Base;

/**
 * XmppComponentSelector struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class XmppComponentSelector extends Base
{
    /**
     * Constructor method for XmppComponentSelector
     * @param  XmppBy $by Select the meaning of {xmpp-comp-selector-key}
     * @param  string $value The key used to identify the XMPP component
     * @return self
     */
    public function __construct(XmppBy $by, $value = null)
    {
        parent::__construct(trim($value));
        $this->setProperty('by', $by);
    }

    /**
     * Gets by enum
     *
     * @return Zimbra\Enum\XmppBy
     */
    public function getBy()
    {
        return $this->getProperty('by');
    }

    /**
     * Sets by enum
     *
     * @param  Zimbra\Enum\XmppComponentBy $by
     * @return self
     */
    public function setBy(XmppBy $by)
    {
        return $this->setProperty('by', $by);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'xmppcomponent')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'xmppcomponent')
    {
        return parent::toXml($name);
    }
}
