<h1>{$title}</h1>
<p>
  <div class="accordion" id="accordion">
    {for $i=0 to count($entries)-1}
    <div class="accordion-group">
      <div class="accordion-heading">
        <a class="accordion-toggle" data-toggle="collapse" href="#collapse{$i}" data-parent="#accordion">{$entries[$i]->title}</a>
      </div>
      <div class="accordion-body collapse" id="collapse{$i}">
        <div class="accordion-inner">
          <p>
            {$entries[$i]->description}
          </p>
        </div>
      </div>
    </div>
    {/for}
  </div>
</p>
