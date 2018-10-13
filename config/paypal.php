<?php
return array(
    // set your paypal credential
    'client_id' => 'AXd2MUVq5bvsI423XBijMgJQmBJMghvUzEeQkWK5r7eH6df_FMjwOXvEyDT6iC-O3zx6sVp41FauYGCw',
    'secret' => 'EPgmrhtHd0fGxfvEIsf0ONBcKN-SF1Z6zVUArhRBnZVwU26MIqvMbvWQ4c8WxyeiUGwyqRK2x3san4ts',

    /**
     * SDK configuration 
     */
    'settings' => array(
        /**
         * Available option 'sandbox' or 'live'
         */
        'mode' => 'sandbox',

        /**
         * Specify the max request time in seconds
         */
        'http.ConnectionTimeOut' => 30,

        /**
         * Whether want to log to a file
         */
        'log.LogEnabled' => true,

        /**
         * Specify the file that want to write on
         */
        'log.FileName' => storage_path() . '/logs/paypal.log',

        /**
         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the 'FINE' level and decreases as you
         * proceed towards ERROR
         */
        'log.LogLevel' => 'FINE'
    ),
);