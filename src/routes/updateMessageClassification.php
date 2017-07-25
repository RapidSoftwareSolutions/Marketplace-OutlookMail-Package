<?php
$app->post('/api/OutlookMail/updateMessageClassification', function ($request, $response, $args) {
    $settings = $this->settings;

    //checking properly formed json
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['accessToken', 'messageId', 'inferenceClassification']);
    if (!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback'] == 'error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }
    //forming request to vendor API
    $folder = isset($post_data['args']['folderId']) ? 'Users/' . $post_data['args']['userId'] . '/messages' : 'me/messages';
    $query_str = $settings['api_url'] . $folder . '(\'' . $post_data['args']['messageId'] . '\')';
    $params = [
        'accessToken' => 'accessToken',
        'InferenceClassification' => 'inferenceClassification'
    ];
    $result = \Models\ApiRequestFacade::makeRequest($params, $post_data, $query_str, 'PATCH', 'json');
    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);

});