<?php


namespace api\modules\v1\resources;


use common\models\User;

class UserResource extends User
{
    public function fields()
    {
        return ['id', 'username', 'access_token'];
    }
}