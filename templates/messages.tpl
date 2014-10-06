{if isset($smarty.cookies.message)}
    <div class="container theme-showcase" role="messages">
        {$message=$smarty.cookies.message|@stripslashes}
        {$message=$message|@json_decode:true}
        {foreach from=$message item=element}
            <div class="alert {$element.messageTag}"><strong>{$element.message|capitalize}</strong></div>
        {/foreach}
    </div>
    {$smarty.cookies.message=[]}
{/if}