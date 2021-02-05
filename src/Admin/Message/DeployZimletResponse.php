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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlList, XmlRoot};
use Zimbra\Admin\Struct\ZimletDeploymentStatus;
use Zimbra\Soap\ResponseInterface;

/**
 * DeployZimletResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @XmlRoot(name="DeployZimletResponse")
 */
class DeployZimletResponse implements ResponseInterface
{
    /**
     * Progress information on deployment to servers
     * @Accessor(getter="getProgresses", setter="setProgresses")
     * @SerializedName("progress")
     * @Type("array<Zimbra\Admin\Struct\ZimletDeploymentStatus>")
     * @XmlList(inline = true, entry = "progress")
     */
    private $progresses;

    /**
     * Constructor method for DeployZimletResponse
     *
     * @param  array $progresses
     * @return self
     */
    public function __construct(array $progresses = [])
    {
        $this->setProgresses($progresses);
    }

    /**
     * Gets progresses
     *
     * @return array
     */
    public function getProgresses(): array
    {
        return $this->progresses;
    }

    /**
     * Sets progresses
     *
     * @param  array $progresses
     * @return self
     */
    public function setProgresses(array $progresses): self
    {
        $this->progresses = [];
        foreach ($progresses as $progress) {
            if ($progress instanceof ZimletDeploymentStatus) {
                $this->progresses[] = $progress;
            }
        }
        return $this;
    }

    /**
     * Add a progress
     *
     * @param  ZimletDeploymentStatus $progress
     * @return self
     */
    public function addProgress(ZimletDeploymentStatus $progress): self
    {
        $this->progresses[] = $progress;
        return $this;
    }
}