{extends file="base.tpl"}
{block name="body"}
    <h1>Change user info:</h1>
    <form class="form-horizontal col-xs-offset-2 col-sm-offset-2 col-md-offset-2 col-lg-offset-3"
          action="change_user.php"
          method="post">
        <input>
        <div class="form-group">
            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-8 ">
                <label for="name">Username:</label>
                <input class="form-control" required="required" type="text" maxlength=20 name="name"
                       id="name" placeholder="username"/>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-8 ">
                <label for="password">Old password:</label>
                <input class="form-control" required="required" type="password" maxlength="16"
                       name="old_password" id="old_password" placeholder="old_password"/>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-8 ">
                <label for="password">New password:</label>
                <input class="form-control" required="required" type="password" maxlength="16"
                       name="new_password" id="new_password" placeholder="password"/>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-5 col-sm-5 col-md-5 col-lg-4">
                <input type="submit" class="btn btn-block btn-primary" value="submit"/>
            </div>
        </div>
    </form>
{/block}
{block name="scripts"}
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