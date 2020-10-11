# lazada-api
    Lazada API
    This is the Open Platform LAzada API Client for PHP.   Register an Account in https://open.lazada.com/ and get App Data

# installation
    composer require rayleenj/lazadaapi

# usage

    <?php

    $api = [
      'apiLink' => API_LINK,
      'apiKey' => API_KEY,
      'apiSecret' => 'API_SECRET',
      'apiAccessToken' => 'API_ACCESS_TOKEN'
    ];

    $lazada = new LazadaAPI($api);
    $content = $lazada->api_connect(API_NAME, METHOD, PARAMETER);
    
