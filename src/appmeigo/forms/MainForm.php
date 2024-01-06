<?php
namespace appmeigo\forms;

use std, gui, framework, meigo;


class MainForm extends AbstractForm
{

    /**
     * @event button.action 
     */
    function doButtonAction(UXEvent $e = null)
    {    
        $apikey = $this->passwordField->text;
        $request = $this->edit->text;
    $endpoint = 'https://api.openai.com/v1/chat/completions';
    $model = 'gpt-3.5-turbo';
        $body = [
            'model' => $model,
            'messages' => [
              [
                  'role' => 'user',
                  'content' => $request
              ]
            ],
              'temperature' => 0.7
        ];

             // Initialize cURL session
             $code = json_encode($body);
             pre($code);
             $ch = curl_init($endpoint);
             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
             curl_setopt($ch, CURLOPT_POST, true);
             curl_setopt($ch, CURLOPT_POSTFIELDS, $code);
             curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $apiKey
             ));
             curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
             // Execute the request
             var_dump($response = curl_exec($ch));          
             
             $result = json_decode($response, true);

             if (isset($result['choices'][0]['message']['content'])) {
                      $reply = $result['choices'][0]['message']['content'];
                      return $reply;
             }
             
             // $reply - ваш ответ, взаимодействуйте с ним!
             echo $reply."\n";
    }


}
