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

use Zimbra\Account\Struct\Attr;
use Zimbra\Account\Struct\DistributionListSelector as DistList;
use Zimbra\Common\TypedSequence;

/**
 * GetDistributionList request class
 * Get a distribution list, optionally with ownership information an granted rights. 
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetDistributionList extends Base
{
    /**
     * The attribute
     * @var TypedSequence<Attr>
     */
    private $_attr;

    /**
     * Constructor method for getDistributionList
     * @param  DistList $dl Specify the distribution list
     * @param  bool     $needOwners Whether to return owners, default is 0 (i.e. Don't return owners)
     * @param  string   $needRights return grants for the specified (comma-seperated) rights. e.g. needRights="sendToDistList,viewDistList"
     * @param  array    $attrs Attributes
     * @return self
     */
    public function __construct(
        DistList $dl,
        $needOwners = null,
        $needRights = null,
        array $attrs = array())
    {
        parent::__construct();
        $this->child('dl', $dl);
        if(null !== $needOwners)
        {
            $this->property('needOwners', (bool) $needOwners);
        }
        if(null !== $needRights)
        {
            $this->property('needRights', trim($needRights));
        }
        $this->_attr = new TypedSequence('Zimbra\Account\Struct\Attr', $attrs);

        $this->on('before', function(Base $sender)
        {
            if($sender->attr()->count())
            {
                $sender->child('a', $sender->attr()->all());
            }
        });
    }

    /**
     * Gets or sets dl
     *
     * @param  DistList $dl
     * @return DistList|self
     */
    public function dl(DistList $dl = null)
    {
        if(null === $dl)
        {
            return $this->child('dl');
        }
        return $this->child('dl', $dl);
    }

    /**
     * Gets or sets needOwners
     *
     * @param  bool $ownerOf
     * @return bool|self
     */
    public function needOwners($needOwners = null)
    {
        if(null === $needOwners)
        {
            return $this->property('needOwners');
        }
        return $this->property('needOwners', (bool) $needOwners);
    }

    /**
     * Gets or sets needRights
     *
     * @param  string $needRights
     * @return string|self
     */
    public function needRights($needRights = null)
    {
        if(null === $needRights)
        {
            return $this->property('needRights');
        }
        return $this->property('needRights', trim($needRights));
    }

    /**
     * Add an attr
     *
     * @param  Attr $attr
     * @return self
     */
    public function addAttr(Attr $attr)
    {
        $this->_attr->add($attr);
        return $this;
    }

    /**
     * Gets attr sequence
     *
     * @return Sequence
     */
    public function attr()
    {
        return $this->_attr;
    }
}
