<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Titre</title>
       
    </head>

    <body>
    <?= $this->Html->css('register')?>
    <?= $this->Html->script('js/register')?>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <div class="foret">
    <h1>Web Arena <small>Let's play</small></h1>
    </div>
    <div class="container">
       <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <div class="panel panel-login">
            <div class="panel-body">
              <div class="row">
                <div class="col-lg-12">
                  <form id="login-form" action="#" method="post" role="form" style="display: none;">
                    <h2>LOGIN</h2>
                      <div class="form-group">
                        <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email" value="">
                      </div>
                      <div class="form-group">
                        <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
                      </div>
                  </form>
                  <form id="register-form" action="#" method="post" role="form" style="display: block;">
                    <h2>REGISTER<span><?php echo $this->Html->link("Home", array('controller' => 'Arenas','action'=> 'header'), array( 'class' => 'button'))?></span></h2>
                      <div class="form-group">
                        <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="">
                      </div>
                      <div class="form-group">
                        <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
                      </div>
                      <div class="form-group">
                        <input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password">
                      </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-6 tabs">
                  <a href="http://localhost/webarena_group_si-03-AG/arenas/login" class="active" id="login-form-link"><div class="login">LOGIN</div></a>
                </div>
                <div class="col-xs-6 tabs">
                  <a href="#" id="register-form-link"><div class="register">REGISTER</div></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <footer>
        <div class="container">
              
        </div>
    </footer>
    </body>
</html>