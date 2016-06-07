<?php
/**
 * Created by PhpStorm.
 * User: davidsporer
 * Date: 05.02.16
 * Time: 07:44
 */
namespace Brainswarm\Vcard\Utility;

use Sabre\DAV\Client;
use Sabre\VObject;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Service\TypoScriptService;

class Vcard
{

    /**
     * @var array
     */
    protected $vcardSettings;

    /**
     * @var array
     */
    protected $settings;

    function __construct()
    {
        $this->setUpVCardSettings();
    }

    /**
     * Creates a VCard using the given user
     *
     * @param \Brainswarm\VCard\Domain\Model\User $user
     * @return string
     */
    public function createContact($user)
    {
        $vcard_id = $this->guid();

        $vcard = $this->createVcard($user, $vcard_id);

        $client = new Client($this->createSettingsArray());
        $client->request('PUT', $vcard_id . '.vcf', $vcard->serialize());

        return $vcard_id;
    }

    /**
     * @param \Brainswarm\VCard\Domain\Model\User $user
     */
    public function updateContact($user)
    {

        $vcard = $this->createVcard($user);
        $client = new Client($this->createSettingsArray());
        $response = $client->request('PUT', $user->getVcardId() . '.vcf', $vcard->serialize());

        //die(print_r($response));
    }

    /**
     * @param \Brainswarm\VCard\Domain\Model\User $user
     * @param string $vcardId
     * @return VObject\Component\VCard
     */
    protected function createVcard($user, $vcardId = "")
    {
        $vcard = new VObject\Component\VCard([
            'FN' => $user->getFirstName() . ' ' . $user->getLastName(),
            'TEL' => $user->getTelephone(),
            'EMAIL' => $user->getEmail(),
            'UID' => ($vcardId === "" ? $user->getVcardId() : $vcardId)
        ]);

        if ($user->getImage() !== null && $user->getImage() !== "") {
            $images = \explode(',', $user->getImage());

            $image = file_get_contents($GLOBALS['TSFE']->tmpl->setup['config.']['baseURL'] . 'uploads/pics/' . $images[0]);
            $imageData = base64_encode($image);
            $vcard->add('PHOTO',
                $imageData, ['TYPE' => 'PNG', 'VALUE' => 'BINARY', 'ENCODING' => 'b']);
        }

        //die($vcard->serialize());

        return $vcard;
    }

    protected function createSettingsArray()
    {
        return array(
            'baseUri' => $this->vcardSettings['baseUri'],
            'userName' => $this->vcardSettings['userName'],
            'password' => $this->vcardSettings['password']
        );
    }

    protected function setUpVCardSettings()
    {
        $this->settings = $GLOBALS['TSFE']->tmpl->setup;
        $this->settings = $this->settings['plugin.']['tx_brainswarm_vcard.']['settings.']['cardDav.'];

        $this->vcardSettings = array(
            'baseUri' => $this->settings['baseUri'],
            'userName' => $this->settings['username'],
            'password' => $this->settings['password']
        );
    }

    private function guid($opt = true)
    {       //  Set to true/false as your default way to do this.
        mt_srand((double)microtime() * 10000);    // optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);    // "-"
        $left_curly = $opt ? chr(123) : "";     //  "{"
        $right_curly = $opt ? chr(125) : "";    //  "}"
        $uuid = substr($charid, 0, 8) . $hyphen
            . substr($charid, 8, 4) . $hyphen
            . substr($charid, 12, 4) . $hyphen
            . substr($charid, 16, 4) . $hyphen
            . substr($charid, 20, 12);
        return $uuid;
    }
}