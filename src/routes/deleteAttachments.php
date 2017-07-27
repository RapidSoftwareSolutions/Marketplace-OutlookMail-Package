<?php
$app->post('/api/OutlookMail/deleteAttachments', function ($request, $response, $args) {
    $settings = $this->settings;

    //checking properly formed json
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['accessToken', 'messageId', 'attachmentId']);
    if (!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback'] == 'error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }
    //forming request to vendor API
    $query_str = $settings['api_url'] . '/me/messages/'.$post_data['args']['messageId'].'/attachments/'.$post_data['args']['attachmentId'];
    $params = [
        'accessToken' => 'accessToken',
        'responseCode' => '204'
    ];
    $result = \Models\ApiRequestFacade::makeRequest($params, $post_data, $query_str, 'DELETE');
    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);

});