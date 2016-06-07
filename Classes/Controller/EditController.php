<?php
/**
 * Created by PhpStorm.
 * User: davidsporer
 * Date: 05.02.16
 * Time: 07:39
 */
namespace Brainswarm\Vcard\Controller;

use Brainswarm\Vcard\Utility\Vcard;

class EditController extends \In2code\Femanager\Controller\EditController {

    /**
     * action update
     *
     * @param \Brainswarm\Vcard\Domain\Model\User $user
     * @validate $user In2code\Femanager\Domain\Validator\ServersideValidator
     * @validate $user In2code\Femanager\Domain\Validator\PasswordValidator
     * @validate $user In2code\Femanager\Domain\Validator\CaptchaValidator
     * @return void
     */
    public function updateAction(\Brainswarm\Vcard\Domain\Model\User $user) {
        $vcardUtility = new Vcard();
        $vcardUtility->updateContact($user);

        // make sure only one image is used
        if($user->getImage() !== "") {
            $images = \explode(',', $user->getImage());
            $user->setImage($images[0]);
        }

        parent::updateAction($user);
    }
}