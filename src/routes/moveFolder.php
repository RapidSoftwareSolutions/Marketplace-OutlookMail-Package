<?php
$app->post('/api/OutlookMail/moveFolder', function ($request, $response, $args) {
    $settings = $this->settings;

    //checking properly formed json
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['accessToken', 'destinationId', 'folderId']);
    if (!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback'] == 'error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }
    //forming request to vendor API
    $folder = 'me/MailFolders/' . $post_data['args']['folderId'] . '/move';
    $query_str = $settings['api_url'] . $folder;
    $params = [
        'accessToken' => 'accessToken',
        'responseCode' => '201',
        'DestinationId' => 'destinationId'
    ];
    $result = \Models\ApiRequestFacade::makeRequest($params, $post_data, $query_str, 'POST', 'json');
    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);

});