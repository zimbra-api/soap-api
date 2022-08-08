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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};
use Zimbra\Admin\Struct\IntIdAttr;
use Zimbra\Common\Enum\DedupAction;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * DedupeBlobsRequest class
 * Dedupe the blobs having the same digest.
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DedupeBlobsRequest extends SoapRequest
{
    /**
     * Action to perform - one of start|status|stop
     * @Accessor(getter="getAction", setter="setAction")
     * @SerializedName("action")
     * @Type("Enum<Zimbra\Common\Enum\DedupAction>")
     * @XmlAttribute
     * @var DedupAction
     */
    private $action;

    /**
     * Volumes
     * @Accessor(getter="getVolumes", setter="setVolumes")
     * @Type("array<Zimbra\Admin\Struct\IntIdAttr>")
     * @XmlList(inline=true, entry="volume", namespace="urn:zimbraAdmin")
     */
    private $volumes = [];

    /**
     * Constructor
     * 
     * @param  DedupAction $action
     * @param  array $volumes
     * @return self
     */
    public function __construct(?DedupAction $action = NULL, array $volumes = [])
    {
        $this->setAction($action ?? new DedupAction('start'))
             ->setVolumes($volumes);
    }

    /**
     * Get action
     *
     * @return DedupAction
     */
    public function getAction(): DedupAction
    {
        return $this->action;
    }

    /**
     * Set action
     *
     * @param  DedupAction $action
     * @return self
     */
    public function setAction(DedupAction $action): self
    {
        $this->action = $action;
        return $this;
    }

    /**
     * Get volumes
     *
     * @return array
     */
    public function getVolumes(): array
    {
        return $this->volumes;
    }

    /**
     * Set volumes
     *
     * @param  array $volumes
     * @return self
     */
    public function setVolumes(array $volumes): self
    {
        $this->volumes = array_filter($volumes, static fn ($volume) => $volume instanceof IntIdAttr);
        return $this;
    }

    /**
     * Add a volume
     *
     * @param  IntIdAttr $volume
     * @return self
     */
    public function addVolume(IntIdAttr $volume): self
    {
        $this->volumes[] = $volume;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new DedupeBlobsEnvelope(
            new DedupeBlobsBody($this)
        );
    }
}
