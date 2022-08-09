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

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Admin\Struct\ZimletDeploymentStatus;
use Zimbra\Common\Struct\SoapResponse;

/**
 * DeployZimletResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DeployZimletResponse extends SoapResponse
{
    /**
     * Progress information on deployment to servers
     * 
     * @Accessor(getter="getProgresses", setter="setProgresses")
     * @Type("array<Zimbra\Admin\Struct\ZimletDeploymentStatus>")
     * @XmlList(inline=true, entry="progress", namespace="urn:zimbraAdmin")
     */
    private $progresses = [];

    /**
     * Constructor
     *
     * @param  array $progresses
     * @return self
     */
    public function __construct(array $progresses = [])
    {
        $this->setProgresses($progresses);
    }

    /**
     * Get progresses
     *
     * @return array
     */
    public function getProgresses(): array
    {
        return $this->progresses;
    }

    /**
     * Set progresses
     *
     * @param  array $progresses
     * @return self
     */
    public function setProgresses(array $progresses): self
    {
        $this->progresses = array_filter($progresses, static fn ($progress) => $progress instanceof ZimletDeploymentStatus);
        return $this;
    }
}
