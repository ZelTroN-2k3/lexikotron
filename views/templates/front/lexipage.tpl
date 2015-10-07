<h1>{$title}</h1>

{include file="$pagination_templates"}

<div class="list-group">
	{foreach from=$glossaries item=glossary}
	<div class="list-group-item">
	    <p class="list-group-item-heading"><b>{$glossary.name}</b></p>
	    <p class="list-group-item-text">{$glossary.description}</p>
	</div>
	{/foreach}
</div>

{include file="$pagination_templates"}