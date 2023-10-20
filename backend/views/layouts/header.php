<?php
use yii\helpers\Html;
?>
<header class="main-header">
        <!-- Logo -->
        <a href="/poshoracrm/admin/" class="logo" style="background-color:#E5E5E5;">
         <img src="<?= Yii::$app->urlManagerFrontEnd->baseUrl . '/img/logo.png' ?>" alt="" height="48px"/>
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b><?=$title?></b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b><?=$title?></b> Admin</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation" style="background-color:#9F344E;">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          	<span class="login-logo" style="color:#FFFFFF;">POSHORA-CRM</span>
			
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
             
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="" ><span class="hidden-xs"><?=Yii::$app->apu->sesdata('username')?></span></a>                
              </li>
              <!-- Control Sidebar Toggle Button -->
               <?
					  
					  if (Yii::$app->apu->sesdata('username')) {
						  
						  ?>
                          <li>
                          <?
						  
						  echo Html::a('Logout', ['/site/logout'], ['data-method'=>'post']);	
						?>
                        </li>
                        <?
						} else {
							
							
						}
					  
					  ?>
             
            </ul>
          </div>
        </nav>
      </header>