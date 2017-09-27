<?php

namespace KilroyWeb\FilePile\API;

class Client{

    public function call($method, $uri, $data = []){
        $client = new \GuzzleHttp\Client([
            'base_uri' => config('filepile.baseURI'),
        ]);
        $requestOptions = [
            'headers' => [
                'Authorization' => 'Bearer '.config('filepile.apiKey'),
            ],
        ];
        if($method == 'GET'){
            $requestOptions['query'] = $data;
        }else{
            $requestOptions['form_params'] = $data;
        }
        $request = $client->request($method, $uri, $requestOptions);
        $response = $request->getBody();
        return $response->getContents();
    }

}