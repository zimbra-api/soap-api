<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap;

use JMS\Serializer\Annotation\{Exclude, PreSerialize, PostDeserialize};

/**
 * Request class in Zimbra API PHP, not to be instantiated.
 * 
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2020 by Nguyen Van Nguyen.
 */
abstract class Request implements RequestInterface
{
    /**
     * @var EnvelopeInterface
     * @Exclude
     */
    protected $envelope;

    /**
     * Get Zimbra api soap envelope.
     *
     * @return EnvelopeInterface
     */
    public function getEnvelope(): EnvelopeInterface
    {
        return $this->envelope;
    }

    /**
     * @PreSerialize
     *
     * @return void
     */
    public function preSerialize()
    {
        $this->internalInit();
    }

    /**
     * @PostDeserialize
     *
     * @return void
     */
    public function postDeserialize()
    {
        $this->internalInit();
    }

    /**
     * Internal initialization of the soap request
     *
     * @return void
     */
    abstract protected function internalInit();
}
