<?php
/**
 * Created by PhpStorm.
 * User: kv
 * Date: 1/17/19
 * Time: 2:17 PM
 */

namespace console\controllers;

use yii\console\Controller;
use common\models\Staff;
use yii\console\ExitCode;

class SetController extends Controller
{
    public $userName;
    public $password;

    public function options($actionID)
    {
        return ['userName', 'password'];
    }

    public function optionAliases()
    {
        return [
            'username' => 'userName',
            'passwd' => 'password'
        ];
    }

    public function actionIndex()
    {
        echo "Hi, I'm R2-D2! SAdmin Generator\n";

        if (!$this->confirm("I will create for you Super Admin account if isn't exist.")) {
            return ExitCode::OK;
        }

        if (Staff::find()->where(['role' => 'sadmin'])->exists()) {
            echo "Super Admin account already exist";
            return ExitCode::OK;
        } else {
            $superAdmin = new Staff();
            $superAdmin->username = $this->userName;
            $superAdmin->role = 'sadmin';
            $superAdmin->email = 'sadmin@test.com';
            $superAdmin->setPassword($this->password);
            $superAdmin->generateAuthKey();
            if ($superAdmin->save() ){
                echo "Account was created";
                return ExitCode::OK;
            } else {
               echo 'error on save';
            }
        }
    }
}