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
use Zimbra\Soap\{EnvelopeInterface, RequestInterface};

/**
 * ComputeAggregateQuotaUsageRequest class
 * Computes the aggregate quota usage for all domains in the system. 
 * The request handler issues GetAggregateQuotaUsageOnServerRequest
 * to all mailbox servers and computes the aggregate quota used by each domain.
 * The request handler updates the zimbraAggregateQuotaLastUsage domain attribute
 * and sends out warning messages for each domain having quota usage greater than a defined percentage threshold. 
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @XmlRoot(name="ComputeAggregateQuotaUsageRequest")
 */
class ComputeAggregateQuotaUsageRequest implements RequestInterface
{
    /**
     * Get soap envelope.
     *
     * @return EnvelopeInterface
     */
    public function getEnvelope(): EnvelopeInterface
    {
        return new ComputeAggregateQuotaUsageEnvelope(
            new ComputeAggregateQuotaUsageBody($this)
        );
    }
}
