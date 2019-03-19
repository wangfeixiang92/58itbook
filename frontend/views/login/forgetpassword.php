<div class="container">
    <form class="form-horizontal login-from" style="width: 50%" action="<?= Yii::$app->urlManager->createUrl(['login/register'])?>" method="post">
        <div class="form-group">
            <label  class="col-sm-2 control-label"></label>
            <div class="col-sm-10">
                <h2 class="form-signin-heading login-title">重置密码</h2>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label"></label>
            <div class="col-sm-10">
                <p class="login-label">想起密码？<a href="<?= Yii::$app->urlManager->createUrl(['login/index'])?>">前往登录</a></p>
            </div>
        </div>

        <div class="form-group">
            <label  class="col-sm-2 control-label">邮箱</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="account" placeholder="请输入邮箱">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">验证码</label>
            <div class="col-sm-10 input-group" style="    padding-left: 2.5%;padding-right: 2.5%;">
                <input type="text" class="form-control " name="account" placeholder="请输入验证码">
                <span class="input-group-addon login-verification-code-btn btn btn-success">获取验证码</span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">密码</label>
            <div class="col-sm-10">
                <input type="password" class="form-control"  name="password" placeholder="请输入密码">
            </div>
        </div>
        <div class="form-group">
            <label  class="col-sm-2 control-label">确认密码</label>
            <div class="col-sm-10">
                <input type="password" class="form-control"  name="password" placeholder="再次确认密码">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="hidden" name='<?=Yii::$app->request->csrfParam?>' value="<?=Yii::$app->request->csrfToken?>"/>
                <button type="submit" class="btn btn-default btn-block black" >重置密码</button>
            </div>
        </div>
    </form>
</div> <!-- /container -->
