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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * AdminDestroyWaitSet request class
 * Use this to close out the waitset.
 * Note that the server will automatically time out a wait set if there is no reference to it for (default of) 20 minutes.
 * WaitSet: scalable mechanism for listening for changes to one or more accounts
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AdminDestroyWaitSetRequest extends SoapRequest
{
    /**
     * Waitset ID
     * 
     * @var string
     */
    #[Accessor(getter: 'getWaitSetId', setter: 'setWaitSetId')]
    #[SerializedName(name: 'waitSet')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $waitSetId;

    /**
     * Constructor
     * 
     * @param string $waitSetId
     * @return self
     */
    public function __construct(string $waitSetId = '')
    {
        $this->setWaitSetId($waitSetId);
    }

    /**
     * Get WaitSet ID
     *
     * @return string
     */
    public function getWaitSetId(): string
    {
        return $this->waitSetId;
    }

    /**
     * Set WaitSet ID
     *
     * @param  string $waitSetId
     * @return self
     */
    public function setWaitSetId(string $waitSetId): self
    {
        $this->waitSetId = $waitSetId;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new AdminDestroyWaitSetEnvelope(
            new AdminDestroyWaitSetBody($this)
        );
    }
}
