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

/**
 * ModifyOutgoingFilterRulesRequest request class
 * Modify Filter rules
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @XmlRoot(name="ModifyOutgoingFilterRulesRequest")
 */
class ModifyOutgoingFilterRulesRequest extends ModifyFilterRulesRequest
{
    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof ModifyOutgoingFilterRulesEnvelope)) {
            $this->envelope = new ModifyOutgoingFilterRulesEnvelope(
                new ModifyOutgoingFilterRulesBody($this)
            );
        }
    }
}
