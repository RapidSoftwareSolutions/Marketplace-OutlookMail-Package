<?php
$app->post('/api/OutlookMail/createOverrideForSender', function ($request, $response, $args) {
    $settings = $this->settings;

    //checking properly formed json
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['accessToken', 'classifyAs', 'senderEmailAddress']);
    if (!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback'] == 'error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }
    //forming request to vendor API
    $folder = isset($post_data['args']['folderId']) ? 'Users/' . $post_data['args']['userId'] . '/InferenceClassification/Overrides' : 'me/InferenceClassification/Overrides';
    $query_str = $settings['api_url'] . $folder;
    $post_data['args']['senderEmailAddress'] = ['Address' => $post_data['args']['senderEmailAddress']];
    $params = [
        'accessToken' => 'accessToken',
        'responseCode' => '201',
        'ClassifyAs' => 'classifyAs',
        'SenderEmailAddress' => 'senderEmailAddress'
    ];
    $result = \Models\ApiRequestFacade::makeRequest($params, $post_data, $query_str, 'POST', 'json');
    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);

});