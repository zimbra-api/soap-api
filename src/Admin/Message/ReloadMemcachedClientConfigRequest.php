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

use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * ReloadMemcachedClientConfigRequest class
 * Reloads the memcached client configuration on this server.
 * Memcached client layer is reinitialized accordingly.
 * Call this command after updating the memcached server list, for example. 
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ReloadMemcachedClientConfigRequest extends SoapRequest
{
    /**
     * Initialize the soap envelope
     *
     * @return SoapEnvelopeInterface
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new ReloadMemcachedClientConfigEnvelope(
            new ReloadMemcachedClientConfigBody($this)
        );
    }
}
