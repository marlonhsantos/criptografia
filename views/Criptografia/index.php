<form id="form_criptografia" method="POST">
    <div class="form-row">
        <div class="form-group col-md-10">
            <label for="user_input">Texto</label>
            <input type="text" class="form-control" name="user_input" id="user_input" placeholder="Digite um texto a ser criptografado" required>
        </div>
        <div class="form-group col-md-2">
            <label for="btn-encrypt">&nbsp;</label>
            <button type="submit" class="form-control btn btn-primary" id="btn-encrypt">Criptografar</button>
        </div>
    </div>
    <hr>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="cifra_cesar">Cifra de César</label>
            <input type="text" class="form-control" name="cifra_cesar" id="cifra_cesar" placeholder="" readonly>
        </div>
        <div class="form-group col-md-6">
            <label for="cifra_cesar_desc">&nbsp;</label>
            <input type="text" class="form-control" name="cifra_cesar_desc" id="cifra_cesar_desc" placeholder="" readonly>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="cifra_aes256">AES256 com SALT</label>
            <input type="text" class="form-control" name="cifra_aes256" id="cifra_aes256" placeholder="" readonly>
        </div>
        <div class="form-group col-md-6">
            <label for="cifra_aes256_desc">&nbsp;</label>
            <input type="text" class="form-control" name="cifra_aes256_desc" id="cifra_aes256_desc" placeholder="" readonly>
        </div>
    </div>
    <!--
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="cifra_extra">???</label>
            <input type="text" class="form-control" name="cifra_extra" id="cifra_extra" placeholder="" readonly>
        </div>
        <div class="form-group col-md-6">
            <label for="cifra_extra_desc">&nbsp;</label>
            <input type="text" class="form-control" name="cifra_extra_desc" id="cifra_extra_desc" placeholder="" readonly>
        </div>
    </div>
    -->
    <input type="hidden" name="encrypt_decrypt" id="encrypt_decrypt" value="encrypt">
    <input type="hidden" name="aes256_random_key" id="aes256_random_key" value="">
</form>