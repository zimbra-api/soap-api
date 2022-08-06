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
use Zimbra\Admin\Struct\DirPathInfo;
use Zimbra\Common\Struct\SoapResponse;

/**
 * CheckDirectoryResponse request class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CheckDirectoryResponse extends SoapResponse
{
    /**
     * Information for directories
     * 
     * @Accessor(getter="getPaths", setter="setPaths")
     * @Type("array<Zimbra\Admin\Struct\DirPathInfo>")
     * @XmlList(inline=true, entry="directory", namespace="urn:zimbraAdmin")
     */
    private $paths = [];

    /**
     * Constructor
     *
     * @param  array $paths
     * @return self
     */
    public function __construct(array $paths = [])
    {
        $this->setPaths($paths);
    }

    /**
     * Add a directory
     *
     * @param  DirPathInfo $path
     * @return self
     */
    public function addPath(DirPathInfo $path): self
    {
        $this->paths[] = $path;
        return $this;
    }

    /**
     * Set directory array
     *
     * @param  array $paths
     * @return self
     */
    public function setPaths(array $paths): self
    {
        $this->paths = array_filter($paths, static fn ($path) => $path instanceof DirPathInfo);
        return $this;
    }

    /**
     * Get directory array
     *
     * @return array
     */
    public function getPaths(): array
    {
        return $this->paths;
    }
}
