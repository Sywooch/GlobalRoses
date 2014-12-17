<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        //add "Create order" permission
        $createOrder = $auth->createPermission('');
//
//        $colorIndex = $auth->createPermission('indexColor');
//        $colorIndex->description = 'Color Index';
//        $auth->add($colorIndex);
//        $colorView = $auth->createPermission('viewColor');
//        $colorView->description = 'Color View';
//        $auth->add($colorView);
//        $colorCreate = $auth->createPermission('createColor');
//        $colorCreate->description = 'Color Create';
//        $auth->add($colorCreate);
//        $colorUpdate = $auth->createPermission('updateColor');
//        $colorUpdate->description = 'Color Update';
//        $auth->add($colorUpdate);
//        $colorDelete = $auth->createPermission('deleteColor');
//        $colorDelete->description = 'Color Delete';
//        $auth->add($colorDelete);
//
//
//
//        // add "author" role and give this role the "createPost" permission
//        $author = $auth->createRole('author');
//        $auth->add($author);
//        $auth->addChild($author, $createPost);
//
//        // add "admin" role and give this role the "updatePost" permission
//        // as well as the permissions of the "author" role
//        $admin = $auth->createRole('admin');
//        $auth->add($admin);
//        $auth->addChild($admin, $updatePost);
//        $auth->addChild($admin, $author);

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
//        $auth->assign($author, 2);
//        $auth->assign($admin, 1);
    }
}