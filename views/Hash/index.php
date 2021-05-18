<form id="form_hash" method="POST">
    <div class="form-row">
        <div class="form-group col-md-10">
            <label for="user_text">Texto</label>
            <input type="text" class="form-control" name="user_text" id="user_text" placeholder="Digite um texto a ser criptografado" required>
        </div>
        <div class="form-group col-md-2">
            <label for="btn-hash">&nbsp;</label>
            <button type="submit" class="form-control btn btn-primary" id="btn-encrypt">Gerar Hash</button>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-10">
            <label for="user_hash">Hash para comparação</label>
            <input type="text" class="form-control" name="user_hash" id="user_hash" placeholder="">
        </div>
    </div>        
    
    <hr>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="hash_sha512">SHA512</label>
            <input type="text" class="form-control" name="hash_sha512" id="hash_sha512" placeholder="" readonly>
        </div>
        <div class="form-group col-md-6">
            <label for="hash_sha512_equals">&nbsp;</label>
            <input type="text" class="form-control" name="hash_sha512_equals" id="hash_sha512_equals" placeholder="" readonly>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="hash_hmac">HMAC</label>
            <input type="text" class="form-control" name="hash_hmac" id="hash_hmac" placeholder="" readonly>
        </div>
        <div class="form-group col-md-6">
            <label for="hash_hmac_equals">&nbsp;</label>
            <input type="text" class="form-control" name="hash_hmac_equals" id="hash_hmac_equals" placeholder="" readonly>
        </div>
    </div>
    <!--
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="hash_extra">???</label>
            <input type="text" class="form-control" name="hash_extra" id="hash_extra" placeholder="" readonly>
        </div>
        <div class="form-group col-md-6">
            <label for="hash_extra_equals">&nbsp;</label>
            <input type="text" class="form-control" name="hash_extra_equals" id="hash_extra_equals" placeholder="" readonly>
        </div>
    </div>
    -->
    
</form>
<!--
<table class="table" id="hash_table">
    <thead>
        <th>&nbsp;</th>
        <th>Hash Gerado</th>
        <th>Hash do Usuário</th>
    </thead>
    <tbody>
        <tr>
            <td>SHA512</td>
            <td id="hash_sha512">&nbsp;</td>
            <td id="hash_sha512_equals">&nbsp;</td>
        </tr>
        <tr>
            <td>HMAC</td>
            <td id="hash_hmac">&nbsp;</td>
            <td id="hash_hmac_equals">&nbsp;</td>
        </tr>
        <tr>
            <td>???</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
    </tbody>
</table>
-->