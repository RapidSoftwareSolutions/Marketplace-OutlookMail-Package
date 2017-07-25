<?php
$app->post('/api/OutlookMail/updateAutoReplySettings', function ($request, $response, $args) {
    $settings = $this->settings;

    //checking properly formed json
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['accessToken', 'automaticRepliesSetting']);
    if (!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback'] == 'error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }
    //forming request to vendor API

    $query_str = $settings['api_url'] . 'me/MailboxSettings';
    $params = [
        'accessToken' => 'accessToken',
        'AutomaticRepliesSetting'=> 'automaticRepliesSetting'
    ];
    $result = \Models\ApiRequestFacade::makeRequest($params, $post_data, $query_str, 'PATCH', 'json');
    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);

});