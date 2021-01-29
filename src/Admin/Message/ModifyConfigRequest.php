<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Message;

use JMS\Serializer\Annotation\XmlRoot;
use Zimbra\Admin\Struct\{AdminAttrs, AdminAttrsImplTrait};
use Zimbra\Soap\Request;

/**
 * ModifyConfigRequest class
 * Modify Configuration attributes
 * Note: an empty attribute value removes the specified attr
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @XmlRoot(name="ModifyConfigRequest")
 */
class ModifyConfigRequest extends Request implements AdminAttrs
{
    use AdminAttrsImplTrait;

    /**
     * Constructor method for ModifyConfigRequest
     * 
     * @param array $attrs
     * @return self
     */
    public function __construct(array $attrs = [])
    {
        $this->setAttrs($attrs);
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof ModifyConfigEnvelope)) {
            $this->envelope = new ModifyConfigEnvelope(
                new ModifyConfigBody($this)
            );
        }
    }
}
