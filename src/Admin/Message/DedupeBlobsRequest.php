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
use Zimbra\Soap\{EnvelopeInterface, Request};

/**
 * DedupeBlobsRequest class
 * Dedupe the blobs having the same digest.
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class DedupeBlobsRequest extends Request
{
    /**
     * Action to perform - one of start|status|stop
     * @Accessor(getter="getAction", setter="setAction")
     * @SerializedName("action")
     * @Type("Zimbra\Common\Enum\DedupAction")
     * @XmlAttribute
     */
    private DedupAction $action;

    /**
     * Volumes
     * @Accessor(getter="getVolumes", setter="setVolumes")
     * @Type("array<Zimbra\Admin\Struct\IntIdAttr>")
     * @XmlList(inline=true, entry="volume", namespace="urn:zimbraAdmin")
     */
    private $volumes = [];

    /**
     * Constructor method for DedupeBlobsRequest
     * 
     * @param  DedupAction $action
     * @param  array $volumes
     * @return self
     */
    public function __construct(?DedupAction $action = NULL, array $volumes = [])
    {
        $this->setAction($action ?? DedupAction::STATUS())
             ->setVolumes($volumes);
    }

    /**
     * Gets action
     *
     * @return DedupAction
     */
    public function getAction(): DedupAction
    {
        return $this->action;
    }

    /**
     * Sets action
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
     * Gets volumes
     *
     * @return array
     */
    public function getVolumes(): array
    {
        return $this->volumes;
    }

    /**
     * Sets volumes
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
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new DedupeBlobsEnvelope(
            new DedupeBlobsBody($this)
        );
    }
}
