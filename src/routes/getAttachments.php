<?php
$app->post('/api/OutlookMail/getAttachments', function ($request, $response, $args) {
    $settings = $this->settings;

    //checking properly formed json
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['accessToken', 'messageId']);
    if (!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback'] == 'error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }
    //forming request to vendor API
    $folder = isset($post_data['args']['folderId']) ? 'me/MailFolders/' . $post_data['args']['folderId'] . '/messages' : 'me/messages';
    $query_str = $settings['api_url'] . $folder.'/attachments';
    $params = [
        'accessToken' => 'accessToken',
        '$select' => 'select'
    ];
    $result = \Models\ApiRequestFacade::makeRequest($params, $post_data, $query_str);
    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);

});