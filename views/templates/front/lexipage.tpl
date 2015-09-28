<h2>{l s='Glossary' mod='lexikotron'}</h2>

<dl>
{foreach from=$glossaries item=glossary}
	<dt>{$glossary->name}</dt>
	<dd>{$glossary->description}</dd>
{/foreach}
</dl>