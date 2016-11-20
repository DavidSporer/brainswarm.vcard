<?php
/**
 * Created by PhpStorm.
 * User: davidsporer
 * Date: 05.02.16
 * Time: 07:38
 */
namespace Brainswarm\Vcard\Controller;

use Brainswarm\Vcard\Utility\Vcard;
use In2code\Femanager\Domain\Model\User;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository;
use TYPO3\CMS\Extbase\Object\ObjectManager;

class NewController extends \In2code\Femanager\Controller\NewController {

    /**
     * action create
     *
     * @param User $user
     * @validate $user In2code\Femanager\Domain\Validator\ServersideValidator
     * @validate $user In2code\Femanager\Domain\Validator\PasswordValidator
     * @return void
     */
    public function createAction(User $user) {
        $vcardUtility = new Vcard();
        $vcard_id = $vcardUtility->createContact($user);

        $user->setName($vcard_id);

        parent::createAction($user);
    }
}