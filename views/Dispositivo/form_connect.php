<form id="form_connect" method="POST">
    <div class="form-row">
        <div class="form-group col-md-10">
            <label for="id">Dispositivos</label>
            <select class="form-control" name="id" id="id">
            <?php
            if (count($rows)) {
                foreach ($rows as $key => $row) {
                    echo "<option value='".$row->id."''>".$row->hostname."</option>";
                }
            }
            ?>
            </select>
        </div>
        <div class="form-group col-md-2">
            <label for="btn-connect">&nbsp;</label>
            <button type="submit" class="form-control btn btn-primary" id="btn-connect">Conectar</button>
        </div>
    </div>
    <div class="form-group">
        <label for="ssh_username">Usuário</label>
        <input type="text" class="form-control" name="ssh_username" id="ssh_username" placeholder="Digite um usuário para se conectar" required>
    </div>
    <div class="form-group">
        <label for="ssh_password">Senha</label>
        <input type="password" class="form-control" name="ssh_password" id="ssh_password" placeholder="Digite a senha de conexão" required>
    </div>
</form>
<form id="form_command" method="POST">
    <div class="form-row">
        <div class="form-group col-md-10">
            <label for="ssh_command">Comando</label>
            <input type="text" class="form-control" name="ssh_command" id="ssh_command" aria-describedby="commandHelp" placeholder="Digite um comando para execução" disabled>
            <small id="commandHelp" class="form-text text-muted">(ls, pwd...)</small>
        </div>
        <input type="hidden" name="connection_name" id="connection_name" value="">
        <div class="form-group col-md-2">
            <label for="btn-exec">&nbsp;</label>
            <button type="submit" class="form-control btn btn-success" id="btn-exec">Executar</button>
        </div>
    </div>
    <div class="form-group">
        <label for="ssh_output">Saída</label>
        <textarea class="form-control" name="ssh_output" id="ssh_output" rows="3" readonly></textarea>
    </div>
</form>