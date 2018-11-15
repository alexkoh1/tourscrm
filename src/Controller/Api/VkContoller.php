<?php


namespace App\Controller\Api;


use App\ServerHandler\ServerHandler;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use VK\OAuth\Scopes\VKOAuthUserScope;
use VK\OAuth\VKOAuth;
use VK\OAuth\VKOAuthDisplay;
use VK\OAuth\VKOAuthResponseType;

/**
 * @Route("/vk")
 */
class VkContoller
{
    /**
     * @var ServerHandler
     */
    private $serverHandler;

    public function __construct(
        ServerHandler $serverHandler
    ) {
        $this->serverHandler = $serverHandler;
    }

    /**
     * @Route("/auth", name="vk_auth", methods="GET")
     */
    public function auth()
    {
        //'72d8d96d8d48bf43a6'
        //ad9edef1ced6202ca0ca431702916e084df0b259ad0b62238d6f25420819d03f82f703d84fb5d7a8f9d99

        /*$oauth = new VKOAuth();
        $client_id = 6643311;
        $redirect_uri = 'https://innoactive.tk/login';
        $display = VKOAuthDisplay::PAGE;
        $scope = [VKOAuthUserScope::WALL, VKOAuthUserScope::GROUPS];
        $state = 'secret_state_code';

        $browser_url = $oauth->getAuthorizeUrl(VKOAuthResponseType::CODE, $client_id, $redirect_uri, $display, $scope, $state);
        return new RedirectResponse($browser_url);*/
        $oauth = new VKOAuth();
        $client_id = 6643311;
        $client_secret = 'WaK2a1u0b4vFt64rtnG7';
        $redirect_uri = 'https://innoactive.tk/login';
        $code = '72d8d96d8d48bf43a6';

        $response = $oauth->getAccessToken($client_id, $client_secret, $redirect_uri, $code);
        $access_token = $response['access_token'];
    }

    /**
     * @Route("/callback", name="vk_callback", methods="POST")
     */
    public function execute(Request $request)
    {
        $data = json_decode(file_get_contents('php://input'));
        if ($data->type === 'confirmation') {
            return new Response($this->serverHandler->confirmation($data->group_id, $data->secret));
        }

        $this->serverHandler->parse($data);

        return new Response();
    }
}