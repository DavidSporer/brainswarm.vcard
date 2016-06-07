<?php
/**
 * Created by PhpStorm.
 * User: davidsporer
 * Date: 05.02.16
 * Time: 07:36
 */
namespace Brainswarm\Vcard\Domain\Model;

class User extends \In2code\Femanager\Domain\Model\User {

    /**
     * twitterId
     *
     * @var string
     */
    protected $vcardId;

    /**
     * @return string
     */
    public function getVcardId()
    {
        return $this->vcardId;
    }

    /**
     * @param string $vcardId
     */
    public function setVcardId($vcardId)
    {
        $this->vcardId = $vcardId;
    }
}