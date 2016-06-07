<?php
/**
 * Created by PhpStorm.
 * User: davidsporer
 * Date: 05.02.16
 * Time: 07:38
 */
namespace Brainswarm\Vcard\Controller;

use Brainswarm\Vcard\Utility\Vcard;

class NewController extends \In2code\Femanager\Controller\NewController {

    /**
     * action create
     *
     * @param \Brainswarm\Vcard\Domain\Model\User $user
     * @validate $user In2code\Femanager\Domain\Validator\ServersideValidator
     * @validate $user In2code\Femanager\Domain\Validator\PasswordValidator
     * @return void
     */
    public function createAction(\Brainswarm\Vcard\Domain\Model\User $user) {
        /*$settingsArray = $GLOBALS['TSFE']->tmpl->setup;
        $settingsArray = $settingsArray['plugin.']['tx_brainswarm_vcard.']['settings.']['cardDav.'];
*/
        $vcardUtility = new Vcard();
        $vcard_id = $vcardUtility->createContact($user);

        $user->setVcardId($vcard_id);

        parent::createAction($user);
    }
}