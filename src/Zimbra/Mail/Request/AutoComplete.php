<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Request;

use Zimbra\Enum\GalSearchType;

/**
 * AutoComplete request class
 * Auto complete
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class AutoComplete extends Base
{
    /**
     * Constructor method for AutoComplete
     * @param  string $name
     * @param  GalSearchType $t
     * @param  bool   $needExp
     * @param  string $folders
     * @param  bool   $includeGal
     * @return self
     */
    public function __construct(
        $name,
        GalSearchType $t = null,
        $needExp = null,
        $folders = null,
        $includeGal = null
    )
    {
        parent::__construct();
        $this->setProperty('name', trim($name));
        if($t instanceof GalSearchType)
        {
            $this->setProperty('t', $t);
        }
        if(null !== $needExp)
        {
            $this->setProperty('needExp', (bool) $needExp);
        }
        if(null !== $folders)
        {
            $this->setProperty('folders', trim($folders));
        }
        if(null !== $includeGal)
        {
            $this->setProperty('includeGal', (bool) $includeGal);
        }
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getProperty('name');
    }

    /**
     * Sets name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        return $this->setProperty('name', trim($name));
    }

    /**
     * Gets search type
     *
     * @return GalSearchType
     */
    public function getType()
    {
        return $this->getProperty('t');
    }

    /**
     * Sets search type
     *
     * @param  GalSearchType $type
     * @return self
     */
    public function setType(GalSearchType $type)
    {
        return $this->setProperty('t', $type);
    }

    /**
     * Gets need expand
     *
     * @return bool
     */
    public function getNeedCanExpand()
    {
        return $this->getProperty('needExp');
    }

    /**
     * Sets need expand
     *
     * @param  bool $needExp
     * @return self
     */
    public function setNeedCanExpand($needExp)
    {
        return $this->setProperty('needExp', (bool) $needExp);
    }

    /**
     * Gets comma separated list of folder IDs
     *
     * @return string
     */
    public function getFolderList()
    {
        return $this->getProperty('folders');
    }

    /**
     * Sets comma separated list of folder IDs
     *
     * @param  string $folderList
     * @return self
     */
    public function setFolderList($folderList)
    {
        return $this->setProperty('folders', trim($folderList));
    }

    /**
     * Gets include Gal
     *
     * @return bool
     */
    public function getIncludeGal()
    {
        return $this->getProperty('includeGal');
    }

    /**
     * Sets include Gal
     *
     * @param  bool $includeGal
     *     Flag whether to include Global Address Book (GAL)
     * @return self
     */
    public function setIncludeGal($includeGal)
    {
        return $this->setProperty('includeGal', (bool) $includeGal);
    }
}
