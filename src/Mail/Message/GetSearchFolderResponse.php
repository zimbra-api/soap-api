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

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Mail\Struct\SearchFolder;
use Zimbra\Common\Soap\ResponseInterface;

/**
 * GetSearchFolderResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetSearchFolderResponse implements ResponseInterface
{
    /**
     * Search folder information
     * 
     * @Accessor(getter="getSearchFolders", setter="setSearchFolders")
     * @Type("array<Zimbra\Mail\Struct\SearchFolder>")
     * @XmlList(inline=true, entry="search", namespace="urn:zimbraMail")
     */
    private $searchFolders = [];

    /**
     * Constructor method for GetSearchFolderResponse
     *
     * @param  array $searchFolders
     * @return self
     */
    public function __construct(array $searchFolders = [])
    {
        $this->setSearchFolders($searchFolders);
    }

    /**
     * Add search folder
     *
     * @param  SearchFolder $searchFolder
     * @return self
     */
    public function addSearchFolder(SearchFolder $folder): self
    {
        $this->searchFolders[] = $folder;
        return $this;
    }

    /**
     * Sets search folders
     *
     * @param  array $folders
     * @return self
     */
    public function setSearchFolders(array $folders): self
    {
        $this->searchFolders = array_filter($folders, static fn ($folder) => $folder instanceof SearchFolder);
        return $this;
    }

    /**
     * Gets search folders
     *
     * @return array
     */
    public function getSearchFolders(): array
    {
        return $this->searchFolders;
    }
}
