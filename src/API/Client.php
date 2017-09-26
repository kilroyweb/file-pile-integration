<?php

namespace KilroyWeb\FilePile\API;

class Client{

    public function call($method, $uri, $data = []){
        $client = new \GuzzleHttp\Client([
            'base_uri' => config('filepile.baseURI'),
        ]);
        $request = $client->request($method, $uri, [
            'headers' => [
                'Authorization' => 'Bearer '.config('filepile.apiKey'),
            ],
        ]);
        $response = $request->getBody();
        return $response->getContents();
    }

}