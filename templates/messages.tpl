{if isset($message)}
    <div class="container theme-showcase">
        {foreach $message as $element}
            <div class="alert alert-{$element->getMessageTag()}"><strong>{$element->getMessage()}</strong></div>
        {/foreach}
    </div>
{/if}