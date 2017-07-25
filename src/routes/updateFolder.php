<?php
$app->post('/api/OutlookMail/updateFolder', function ($request, $response, $args) {
    $settings = $this->settings;

    //checking properly formed json
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['accessToken', 'displayName', 'folderId']);
    if (!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback'] == 'error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }
    //forming request to vendor API
    $folder = 'me/MailFolders/' . $post_data['args']['folderId'];
    $query_str = $settings['api_url'] . $folder;
    $params = [
        'accessToken' => 'accessToken',
        'DisplayName' => 'displayName'
    ];
    $result = \Models\ApiRequestFacade::makeRequest($params, $post_data, $query_str, 'PATCH', 'json');
    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);

});