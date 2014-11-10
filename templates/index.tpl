{extends file="base.tpl"}
{block name="body"}
    <h1>Login</h1>
    <form class="form-horizontal col-xs-offset-2 col-sm-offset-2 col-md-offset-2 col-lg-offset-3" action=""
          method="post">
        <div class="form-group">
            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-8 ">
                <label for="name">Username:</label>
                <input class="form-control" required="required" type="text" maxlength=20 name="name"
                       id="name" placeholder="username"/>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-8 ">
                <label for="password">Password:</label>
                <input class="form-control" required="required" type="password" maxlength="16"
                       name="password" id="password" placeholder="password"/>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-5 col-sm-5 col-md-5 col-lg-4">
                <input type="submit" class="btn btn-block btn-primary" value="submit" formaction="login.php"/>
            </div>
            <div class="col-xs-5 col-sm-5 col-md-5 col-lg-4">
                <a class="btn btn-block btn-warning" href="/lucky.php">I'm lucky</a>
            </div>
        </div>
    </form>
{/block}
{block name="scripts"}
    <script>
        $(document).ready(function () {
            $("form").submit(function (event) {
                var username = $("#name");
                var password = $("#password");
                if (!username || username.val().trim().length == 0) {
                    alert("Username should not be empty and cannot consist of only whitespace.");
                    event.preventDefault();
                    return false;
                }
                if (!password) {
                    alert("Password should not be empty")
                    event.preventDefault();
                    return false;
                }
                event.process();
            });
        });
    </script>
{/block}