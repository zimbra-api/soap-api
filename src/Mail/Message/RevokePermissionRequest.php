<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Message;

use Zimbra\Common\Struct\SoapEnvelopeInterface;

/**
 * RevokePermissionRequest class
 * Revoke account level permissions
 * RevokePermissionResponse returns permissions that are successfully revoked.
 * Note: to be deprecated in Zimbra 9.  Use zimbraAccount RevokeRights instead.
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class RevokePermissionRequest extends GrantPermissionRequest
{
    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new RevokePermissionEnvelope(
            new RevokePermissionBody($this)
        );
    }
}
