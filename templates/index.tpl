{extends file="base.tpl"}
{block name="body"}
    <form class="form-horizontal col-xs-offset-2 col-sm-offset-2 col-md-offset-2 col-lg-offset-3" action=""
          method="post">
        <div class="form-group">
            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-8 ">
                <label for="name">Username</label>
                <input class="form-control" type="text" maxlength=20 name="name"
                       id="name" placeholder="username"/>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-8 ">
                <label for="password">Password</label>
                <input class="form-control" type="password" maxlength="16"
                       name="password" id="password" placeholder="password"/>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-5 col-sm-5 col-md-5 col-lg-4">
                <input type="submit" class="btn btn-block btn-primary" value="submit" formaction="login.php"/>
            </div>
            <div class="col-xs-5 col-sm-5 col-md-5 col-lg-4">
                <input type="submit" value="create user" formaction="create_user.php"
                       class="btn btn-block btn-primary"/>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-8 ">
                <a class="btn btn-block btn-warning" href="/lucky.php">I'm lucky</a>
            </div>
        </div>
    </form>
{/block}
{block name="script"}
    <script src="/static/global/js/sha3.js"></script>
    <script src="/static/global/js/jquery-1.11.1.min.js"></script>
    <script>
        $(":submit").click(function () {
            var password = $('#password');
            var hash = CryptoJS.SHA3(password.val(), {outputLength: 256});
            password.val(hash);
            var formaction = $(this).attr("formaction");
            var form = $('form');
            form.get(0).setAttribute('action', formaction);
            form.submit();
        });
    </script>
{/block}