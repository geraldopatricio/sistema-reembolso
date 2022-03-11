<?php echo $this->render_table_name($mode); ?>
<div class="xcrud-top-actions btn-group">
    <?php 
    echo $this->render_button('Salvar e Voltar','save','list','btn btn-primary','','create,edit');
    echo $this->render_button('Salvar e Novo','save','create','btn btn-default','','create,edit');
    echo $this->render_button('Gravar','save','edit','btn btn-default','','create,edit');
    echo $this->render_button('Voltar','list','','btn btn-warning'); ?>
</div>
<div class="xcrud-view">
<?php echo $mode == 'view' ? $this->render_fields_list($mode,array('tag'=>'table','class'=>'table')) : $this->render_fields_list($mode,'div','div','label','div'); ?>
</div>
<div class="xcrud-nav">
    <?php echo $this->render_benchmark(); ?>
</div>
