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

use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * EmptyDumpsterRequest class
 * Empty dumpster
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class EmptyDumpsterRequest extends SoapRequest
{
    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new EmptyDumpsterEnvelope(
            new EmptyDumpsterBody($this)
        );
    }
}
