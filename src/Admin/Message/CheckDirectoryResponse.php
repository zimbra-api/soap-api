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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlList};
use Zimbra\Admin\Struct\DirPathInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * CheckDirectoryResponse request class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class CheckDirectoryResponse implements ResponseInterface
{
    /**
     * Information for directories
     * 
     * @Accessor(getter="getPaths", setter="setPaths")
     * @SerializedName("directory")
     * @Type("array<Zimbra\Admin\Struct\DirPathInfo>")
     * @XmlList(inline = true, entry = "directory")
     */
    private $paths = [];

    /**
     * Constructor method for CheckDirectoryResponse
     *
     * @param  array  $paths
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
     * Sets directory array
     *
     * @param  array $volumes
     * @return self
     */
    public function setPaths(array $paths): self
    {
        $this->paths = [];
        foreach ($paths as $path) {
            if ($path instanceof DirPathInfo) {
                $this->paths[] = $path;
            }
        }
        return $this;
    }

    /**
     * Gets directory array
     *
     * @return array
     */
    public function getPaths(): array
    {
        return $this->paths;
    }
}
