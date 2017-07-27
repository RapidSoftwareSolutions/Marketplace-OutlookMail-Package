<?php
$app->post('/api/OutlookMail/createDraftForwardMessage', function ($request, $response, $args) {
    $settings = $this->settings;

    //checking properly formed json
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['accessToken', 'messageId', 'toRecipients']);
    if (!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback'] == 'error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }
    //forming request to vendor API
    $query_str = 'https://outlook.office.com/api/beta/me/messages/' . $post_data['args']['messageId'] . '/createforward';
    $params = [
        'accessToken' => 'accessToken',
        'responseCode' => '201',
        'Comment' => 'comment',
        'ToRecipients' => 'toRecipients'
    ];
    $result = \Models\ApiRequestFacade::makeRequest($params, $post_data, $query_str, 'POST', 'json');
    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);

});