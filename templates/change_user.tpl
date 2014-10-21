{extends file="base.tpl"}
{block name="body"}
    <h1>Change user info:</h1>
    <form class="form-horizontal col-xs-offset-2 col-sm-offset-2 col-md-offset-2 col-lg-offset-3"
          action="/change_user.php"
          method="post">
        <input type="hidden" value="{$user_id}" name="user_id" id="user_id"/>

        <div class="form-group">
            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-8 ">
                <label for="name">Username:</label>
                <input class="form-control" required="required" type="text" maxlength=20 name="name"
                       id="name" placeholder="username"/>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-5 col-sm-5 col-md-5 col-lg-4">
                <label for="old_password">Old password:</label>
                <input class="form-control" required="required" type="password" maxlength="16"
                       name="old_password" id="old_password" placeholder="old_password"/>
            </div>
            <div class="col-xs-5 col-sm-5 col-md-5 col-lg-4">
                <label for="new_password">New password:</label>
                <input class="form-control" required="required" type="password" maxlength="16"
                       name="new_password" id="new_password" placeholder="password"/>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-8">
                <input type="submit" class="btn btn-block btn-primary" value="submit"/>
            </div>
        </div>
    </form>
{/block}