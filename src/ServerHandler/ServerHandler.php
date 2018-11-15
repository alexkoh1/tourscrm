<?php

namespace App\ServerHandler;

use App\Entity\Client;
use App\Repository\ClientRepository;
use Symfony\Component\HttpFoundation\Response;
use VK\CallbackApi\Server\VKCallbackApiServerHandler;
use VK\Client\Enums\VKLanguage;
use VK\Client\VKApiClient;

class ServerHandler extends VKCallbackApiServerHandler {
    const SECRET = 'ab12aba';
    const GROUP_ID = 147463060;
    const CONFIRMATION_TOKEN = 'b07e0c93';
    CONST ACCESS_TOKEN = 'ad9edef1ced6202ca0ca431702916e084df0b259ad0b62238d6f25420819d03f82f703d84fb5d7a8f9d99';

    private $clientRepository;

    private $VKApiClient;

    public function __construct(
        ClientRepository $clientRepository
    ) {
        $this->clientRepository = $clientRepository;
        $this->VKApiClient = new VKApiClient('5.80', VKLanguage::RUSSIAN);
    }

    public function confirmation(int $group_id, ?string $secret) {
        if ($secret === static::SECRET && $group_id === static::GROUP_ID) {
            return static::CONFIRMATION_TOKEN;
        }
    }

    public function messageNew(int $group_id, ?string $secret, array $object) {
        $client = $this->clientRepository->findBy(['vkId' => $object['user_id']]);

        if ($client === []) {
            $response = $this->VKApiClient->users()->get(self::ACCESS_TOKEN, [
                'user_ids' => $object['user_id'],
                'fields' => ['contacts', 'bdate']
            ]);

            $client = new Client();
            $client->setName($response[0]['last_name'].' '.$response[0]['first_name'])
                ->setBday($this->formatDate($response[0]['bdate']))
                ->setVkId($response[0]['id']);

            $this->clientRepository->save($client);
        }
        return 'qwe';
    }

    private function formatDate($date)
    {
        if (\substr_count($date, '.') === 1) {
            return $date.'1900';
        }
    }
}