<?php
/**
 * Created by PhpStorm.
 * User: iurii
 * Date: 06.10.14
 * Time: 11:51
 */
include_once("utils/include_dependencies.php");
if (is_logged_in()) {
    print "<a href='/logout.php'>logout</a><br/>";
}
print "<form action=''
      method='get'>
            <label for='name'>Username</label>
            <input required='required' type='text' maxlength=20 name='name'
                   id='name' placeholder='username'/>
                   <br/>
            <label for='password'>Password</label>
            <input required='required' type='password' maxlength='16'
                   name='password' id='password' placeholder='password'/>
                   <br/>
            <input type='submit'  value='submit' formaction='login.php'/>
            <a  href='/lucky.php'>I'm lucky</a>
</form>";
