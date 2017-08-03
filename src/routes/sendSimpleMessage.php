<?php
$app->post('/api/OutlookMail/sendSimpleMessage', function ($request, $response, $args) {
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
    $query_str = $settings['api_url'] . 'me/sendmail';
    $post_data['args']['message']['Subject'] = $post_data['args']['subject'];
    $post_data['args']['message']['Body']['ContentType'] = $post_data['args']['contentType'];
    $post_data['args']['message']['Body']['Content'] = $post_data['args']['content'];
    foreach ($post_data['args']['toRecipients'] as $recipient) {
        $post_data['args']['message']['ToRecipients'][]['EmailAddress']['Address'] = $recipient;
    };
    $params = [
        'accessToken' => 'accessToken',
        'responseCode'=> '202',
        'Message' => 'message',
        'SavetoSentItems' => 'savetoSentItems'
    ];
    $result = \Models\ApiRequestFacade::makeRequest($params, $post_data, $query_str, 'POST', 'json');
    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);

});