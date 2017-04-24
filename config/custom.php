<?php

return [

    /*
     * @ticket_limit: time limit expiration, set in hours, for ticket submit (applies only to new tickets, not replying).
     */
    'ticket_limit' => 0,

    /*
     * @screenshot_limit : time limit expiration, set in hours, for image uploads. e.g. => 4 would allow user to upload
     * image every for hours.
     *
     * @screenshot_size : image size in kbs.
     */
    'screenshot_limit' => 0,
    'screenshot_size' => 1000,


    /*
     * Screenshot thumbnail dimensions
     */
    'thumbnail_x' => 300,
    'thumbnail_y' => 250,


    /*
     * @vote_limit : daily vote limit
     */

    'vote_limit' => 3,
    'vote_hour_limit' => 1,
    ];