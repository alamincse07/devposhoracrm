<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'Admin Login';
$this->params['breadcrumbs'][] = $this->title;
$formURL=Yii::$app->urlManager->createUrl(['site/login']);
?>
<div class="site-login">
    <div class="row">
     
<div class="login-box">
   <div class="login-logo">
   <img src="<?= Yii::$app->urlManagerFrontEnd->baseUrl . '/img/logo.png' ?>" alt="" /><br>

   			<b>(Admin)</b> 
  		</div>
  <!-- /.login-logo -->
  <div class="login-box-body">
  <?php /*?>  <p class="login-box-msg">Sign in to start your session</p><?php */?>

    <form action="<?=$formURL?>" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Username" name="username" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
         <?php $session = Yii::$app->session; 
		 if($session->getFlash('loginerror') !=''){ ?>
         <div class="container-login100-form-btn" style="background-color:#EB6265; color:#FFFFFF; padding:7px;">                            
               <?=$session->getFlash('loginerror');?>
		 </div>
         <?php } ?>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
        
            <input type="submit" class="btn btn-primary btn-block btn-flat" value="Login" name="login">
        </div>
         
        <!-- /.col -->
      </div>
    </form>

    
  </div>
  <!-- /.login-box-body -->
</div>
     
    </div>
</div>
