<?php
$app->post('/api/OutlookMail/createSimpleDraftMessage', function ($request, $response, $args) {
    $settings = $this->settings;

    //checking properly formed json
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['accessToken', 'subject', 'contentType', 'content', 'toRecipients']);
    if (!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback'] == 'error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }
    //forming request to vendor API
    $folder = isset($post_data['args']['folderId']) ? 'me/MailFolders/' . $post_data['args']['folderId'] . '/messages' : 'me/messages';
    $query_str = $settings['api_url'] . $folder;

    $body['Subject'] = $post_data['args']['subject'];
    $body['Body']['ContentType'] = $post_data['args']['contentType'];
    $body['Body']['Content'] = $post_data['args']['content'];
    foreach ($post_data['args']['toRecipients'] as $recipient) {
        $body['ToRecipients'][]['EmailAddress']['Address'] = $recipient;
    };

    $client = new \GuzzleHttp\Client();

    $headers = [
        'Authorization' => 'Bearer ' . $post_data['args']['accessToken'],
        'Accept' => 'application/json'
    ];


    try {
        $resp = $client->request('POST', $query_str, [
            'headers' => $headers,
            'json' => $body
        ]);

        $responseBody = $resp->getBody()->getContents();
        $rawBody = json_decode($resp->getBody());
        $all_data[] = $rawBody;
        if ($resp->getStatusCode() == '201') {
            $result['callback'] = 'success';
            $result['contextWrites']['to'] = is_array($all_data) ? $all_data : json_decode($all_data);
        } else {
            $result['callback'] = 'error';
            $result['contextWrites']['to']['status_code'] = 'API_ERROR';
            $result['contextWrites']['to']['status_msg'] = is_array($responseBody) ? $responseBody : json_decode($responseBody);
        }

    } catch (\GuzzleHttp\Exception\ClientException $exception) {
        $responseBody = $exception->getResponse()->getBody()->getContents();
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = $responseBody;

    } catch (ServerException $exception) {

        $responseBody = $exception->getResponse()->getBody(true);
        $result['callback'] = 'error';
        $result['contextWrites']['to'] = json_decode($responseBody);

    } catch (BadResponseException $exception) {

        $responseBody = $exception->getResponse()->getBody(true);
        $result['callback'] = 'error';
        $result['contextWrites']['to'] = json_decode($responseBody);

    }

    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);

});