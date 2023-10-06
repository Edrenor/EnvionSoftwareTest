<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetUsersRequest;
use App\Service\UserServiceInterface;
use App\Traits\ConverterTrait;
use Exception;
use SimpleXMLElement;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Response as HttpResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class UserController extends Controller
{

    private int $countOfRequests = 10;

    use ConverterTrait;

    public function __construct(private readonly UserServiceInterface $userService){}
    public function getUsers(GetUsersRequest $request): HttpResponse
    {
        try {
            $data = [];
            //The assignment says to make 10 queries
            //I did that, but in the api you can specify a parameter that can be used to get 10 records at once. I would do it that way
            $limit = $request->limit?:$this->countOfRequests;
            for ($i=0; $i<$limit; $i++)
            {
                $randomUser = $this->userService->getRandomUser();
                $last = array_key_exists('last', $randomUser['name']) ? $randomUser['name']['last'] : '';
                $data[$last] = $this->generateRandomUserData($randomUser);
            }
            krsort($data);
            dd($data);
            $xml = new SimpleXMLElement('<data value=""/>');
            $this->arrayToXml($data, $xml);
            $xmlString = $xml->asXML();

            return Response::make($xmlString, '200')
                ->header('Content-Type', 'application/xml');
        }
        catch (Exception $exception) {
            return new HttpResponse($exception->getMessage(), ResponseAlias::HTTP_BAD_REQUEST);
        }
    }

    private function generateRandomUserData(array $randomUser): array
    {
        $data = [];
        $title = array_key_exists('title', $randomUser['name']) ? $randomUser['name']['title'] . ' ' : '';
        $first = array_key_exists('first', $randomUser['name']) ? $randomUser['name']['first'] . ' ' : '';
        $last = array_key_exists('last', $randomUser['name']) ? $randomUser['name']['last'] : '';

        $data['fullName'] = $title . $first . $last;
        $data['phone'] = array_key_exists('phone', $randomUser) ? $randomUser['phone'] : '';
        $data['email'] = array_key_exists('email', $randomUser) ? $randomUser['email'] : '';
        $data['country'] =
            array_key_exists('country', $randomUser['location']) ? $randomUser['location']['country'] : '';

        return $data;
    }
}
