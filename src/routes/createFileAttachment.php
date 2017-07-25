<?php
$app->post('/api/OutlookMail/createFileAttachment', function ($request, $response, $args) {
    $settings = $this->settings;

    //checking properly formed json
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['accessToken', 'messageId', 'name', 'contentBytes']);
    if (!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback'] == 'error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }
    //forming request to vendor API
    $query_str = $settings['api_url'] . 'me/attachments/'.$post_data['args']['attachmentId'];
    $post_data['args']['dataType'] = '#Microsoft.OutlookServices.FileAttachment';
    $params = [
        'accessToken' => 'accessToken',
        'responseCode' => '201',
        '@odata.type' => 'dataType',
        'Name' => 'name',
        'ContentBytes' => 'contentBytes'
    ];
    $result = \Models\ApiRequestFacade::makeRequest($params, $post_data, $query_str, 'POST', 'json');
    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);

});