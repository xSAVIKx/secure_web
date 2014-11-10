{extends file="base.tpl"}
{block name="body"}
    <h1>Create user</h1>
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
                <label for="name">Email:</label>
                <input class="form-control" type="email" name="email"
                       id="email" placeholder="example@example.com"/>
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
            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-8">
                <input type="submit" class="btn btn-block btn-primary" value="submit" formaction="create_user.php"/>
            </div>
        </div>
    </form>
{/block}
{block name="scripts"}
    <script> $(document).ready(function () {
            $("form").submit(function (event) {
                var username = $("#name");
                var password = $("#password");
                if (!username || username.val().trim().length == 0) {
                    alert("Username should not be empty and cannot consist of only whitespace.");
                    event.preventDefault();
                    return false;
                }
                if (!password || password.val().length < 4) {
                    alert("Password should be at least 4 symbols length");
                    event.preventDefault();
                    return false;
                }
                event.process();
            });
        });
    </script>
{/block}