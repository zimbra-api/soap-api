<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Request;

use Zimbra\Enum\GalSearchType as SearchType;

/**
 * AutoCompleteGal request class
 * Perform an autocomplete for a name against the Global Address List.
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class AutoCompleteGal extends Base
{
    /**
     * Constructor method for AutoCompleteGal
     * @param  string $name The name to test for autocompletion
     * @param  bool   $needExp Flag whether the {exp} flag is needed in the response for group entries.
     * @param  string $type Type of addresses to auto-complete on
     * @param  string $galAcctId GAL Account ID
     * @param  int    $limit An integer specifying the maximum number of results to return
     * @return self
     */
    public function __construct(
        $name,
        $needExp = null,
        SearchType $type = null,
        $galAcctId = null,
        $limit = null)
    {
        parent::__construct();
        if(null !== $needExp)
        {
            $this->setProperty('needExp', (bool) $needExp);
        }
        $this->setProperty('name', trim($name));
        if($type instanceof SearchType)
        {
            $this->setProperty('type', $type);
        }
        if(null !== $galAcctId)
        {
            $this->setProperty('galAcctId', trim($galAcctId));
        }
        if(null !== $limit)
        {
            $this->setProperty('limit', (int) $limit);
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
     * Gets needExp
     *
     * @return string
     */
    public function getNeedExp()
    {
        return $this->getProperty('needExp');
    }

    /**
     * Sets needExp
     *
     * @param  string $needExp
     * @return self
     */
    public function setNeedExp($needExp)
    {
        return $this->setProperty('needExp', (bool) $needExp);
    }

    /**
     * Gets type
     *
     * @return string
     */
    public function getType()
    {
        return $this->getProperty('type');
    }

    /**
     * Sets type
     *
     * @param  string $type
     * @return self
     */
    public function setType(SearchType $type)
    {
        return $this->setProperty('type', $type);
    }

    /**
     * Gets GAL account Id
     *
     * @return string
     */
    public function getGalAccountId()
    {
        return $this->getProperty('galAcctId');
    }

    /**
     * Sets GAL account Id
     *
     * @param  string $galAcctId
     * @return self
     */
    public function setGalAccountId($galAcctId)
    {
        return $this->setProperty('galAcctId', trim($galAcctId));
    }

    /**
     * Gets the maximum number of results to return
     *
     * @return string
     */
    public function getLimit()
    {
        return $this->getProperty('limit');
    }

    /**
     * Sets the maximum number of results to return
     *
     * @param  string $limit
     * @return self
     */
    public function setLimit($limit)
    {
        return $this->setProperty('limit', (int) $limit);
    }
}
