<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

class NotifikasiComposer
{
	public function compose(View $view)
	{
        $data = [];
        if (\Auth::check()) {
            $email = \Auth::user()->email;
            $datapost = ['email' => $email, 'status_id' => 3];
            //$event_waiting = $this->getRespApiWithParam($datapost, 'member/event/waiting');

            $client = new \GuzzleHttp\Client(['verify' => false]);
            $endpoint = env('API_EVENT').'member/event/totalbystatus';
            $request = $client->post($endpoint, [
                'form_params' => $datapost,
                'headers' => [
                    'Authorization'  => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjEiLCJ1c2VybmFtZSI6ImFkbWluaXN0cmF0b3IiLCJ1c2VyX2dyb3VwIjoiYWRtaW4iLCJpYXQiOjE2NTg4MzQzMzN9.dhoLWPcm4cpXOUouX4GEMFrQBmIz5-RRaMACMUW0wxs',
                    'Cookie' => 'ci_session=e40e0d7d948983435b6949a4df8efbfaf2238c4b'
                ]
            ]);

            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
        }		
        $view->with([
            'vc_notifikasi' => $data
        ]);
    }
}
