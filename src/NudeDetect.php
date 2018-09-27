<?php

namespace NudeDetect;

use Dotenv\Dotenv;

class NudeDetect
{
    private $api_user;
    private $api_secret;
    private $endpoint;
    private $http;

    /**
     * NudeDetect constructor.
     */
    function __construct() {
        $dotenv = new Dotenv(__DIR__);
        $dotenv->load();
        $dotenv->getEnvironmentVariableNames();
        $this->api_user = getenv('API_USER');
        $this->api_secret = getenv('API_SECRET');
        $this->endpoint = getenv('API_ENDPOINT');
        $this->http = new \GuzzleHttp\Client(['base_uri' => $this->endpoint, 'User-Agent' => 'SE-SDK-PHP' . '1.0']);
    }

    /**
     * @param $model
     * @param $modelClass
     * @param $image
     * @return mixed
     */
    public function feedback($model, $modelClass, $image) {
        $url = '1.0/feedback.json';
        if (filter_var($image, FILTER_VALIDATE_URL)) {
            try {
                $r = $this->http->request('GET',
                    $url,
                    [
                        'query' =>
                            [
                                'api_user' => $this->api_user,
                                'api_secret' => $this->api_secret,
                                'model' => $model,
                                'class' => $modelClass, 'url' => $image
                            ]
                    ]
                );
            } catch (\GuzzleHttp\Exception\GuzzleException $e) {
                var_dump($e);
                exit;
            }
            return json_decode($r->getBody());
        }
        else {
            $file = fopen($image, 'r');
            try {
                $r = $this->http->request('POST',
                    $url,
                    [
                        'query' =>
                            [
                                'api_user' => $this->api_user,
                                'api_secret' => $this->api_secret,
                                'model' => $model,
                                'class' => $modelClass],
                                'multipart' =>
                                    [
                                        [
                                            'name' => 'media',
                                            'contents' => $file
                                        ]
                                    ]
                    ]
                );
            } catch (\GuzzleHttp\Exception\GuzzleException $e) {
                var_dump($e);
                exit;
            }
            return json_decode($r->getBody());
        }
    }

    /**
     * @param $models
     * @return Check
     */
    public function check($models) {
        return new Check($models);
    }
}