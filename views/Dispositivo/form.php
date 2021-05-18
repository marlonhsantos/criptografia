<form id="form_dispositivo" method="POST">
    <div class="form-group">
        <label for="hostname">Hostname</label>
        <input type="text" class="form-control" name="hostname" id="hostname" placeholder="Digite o hostname do dispositivo" value="<?=$hostname;?>" required>
    </div>
    <div class="form-group">
        <label for="ip">IP</label>
        <input type="text" class="form-control" name="ip" id="ip" placeholder="Digite o endereço IP do dispositivo" value="<?=$ip;?>" required>
    </div>
    <div class="form-group">
        <label for="tipo">Tipo</label>
        <input type="text" class="form-control" name="tipo" id="tipo" aria-describedby="tipoHelp" placeholder="Digite o tipo do dispositivo" value="<?=$tipo;?>" required>
        <small id="tipolHelp" class="form-text text-muted">(Servidor, Roteador, Switch...)</small>
    </div>
    <div class="form-group">
        <label for="nome_fabricante">Fabricante</label>
        <input type="text" class="form-control" name="nome_fabricante" id="nome_fabricante" placeholder="Digite o fabricante do dispositivo" value="<?=$nome_fabricante;?>">
    </div>
    <input type="hidden" name="id" id="id" value="<?=$id?>">
  <button type="submit" class="btn btn-primary">Salvar</button>
</form>