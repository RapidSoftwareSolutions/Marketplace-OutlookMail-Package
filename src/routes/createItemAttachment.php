<?php
$app->post('/api/OutlookMail/createItemAttachment', function ($request, $response, $args) {
    $settings = $this->settings;

    //checking properly formed json
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['accessToken', 'messageId', 'name', 'item']);
    if (!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback'] == 'error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }
    //forming request to vendor API
    $query_str = $settings['api_url'] . 'me/messages/'.$post_data['args']['messageId'].'/attachments/';
    $post_data['args']['contentBytes'] = '#Microsoft.OutlookServices.ItemAttachment';
    $params = [
        'accessToken' => 'accessToken',
        'responseCode' => '201',
        '@odata.type' => 'dataType',
        'Name' => 'name',
        'Item' => 'item'
    ];
    $result = \Models\ApiRequestFacade::makeRequest($params, $post_data, $query_str, 'POST', 'json');
    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);

});