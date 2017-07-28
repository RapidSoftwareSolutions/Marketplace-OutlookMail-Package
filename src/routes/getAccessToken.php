<?php
$app->post('/api/OutlookMail/getAccessToken', function ($request, $response, $args) {
    $settings = $this->settings;

    //checking properly formed json
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['clientId', 'clientSecret', 'code', 'redirectUri']);
    if (!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback'] == 'error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }
    //forming request to vendor API
    $query_str ='https://login.microsoftonline.com/common/oauth2/v2.0/token';
    $post_data['args']['grant_type'] = 'authorization_code';
    $params = [
        'client_id' => 'clientId',
        'client_secret' => 'clientSecret',
        'code'=> 'code',
        'redirect_uri'=> 'redirectUri',
        'grant_type'=> 'grant_type'
    ];
    $result = \Models\ApiRequestFacade::makeRequest($params, $post_data, $query_str, 'POST', 'json');
    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);

});