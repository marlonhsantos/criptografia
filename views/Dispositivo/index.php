    <table id="dispositivos" class="table table-sm table-hover">
        <thead>
            <th>#</th> 
            <th>Hostname</th> 
            <th>IP</th> 
            <th>Tipo</th> 
            <th>Fabricante</th> 
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </thead>
        <tbody>
            <?php
            if (count($rows)) {
                foreach ($rows as $key => $row) {
            ?>
            <tr>
                <td><?php echo $row->id;?></td>
                <td><?php echo $row->hostname;?></td>
                <td><?php echo $row->ip;?></td>
                <td><?php echo $row->tipo;?></td>
                <td><?php echo $row->nome_fabricante;?></td>
                <td><button type="button" class="btn btn-outline-primary btn-sm editar" data-id="<?php echo $row->id;?>">Editar</button></td>
                <td class="celula-apagar"><button type="button" class="btn btn-outline-danger btn-sm btn-tabela-apagar" data-id="<?php echo $row->id;?>">Apagar</button></td>
            </tr>
            <?php
                }
            } else {
            ?>
            <tr>
                <td colspan="7" class='td_centered'>Não existem dispositivos cadastrados</td>
            </tr>
            <?php    
            }
            ?>
        </tbody>
    </table>
    <div style="text-align: right"><button type="button" class="btn btn-success novo">Novo Dispositivo</button></div>
