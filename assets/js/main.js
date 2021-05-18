'use strict';

var Dispositivo = {};

Dispositivo.functions = {
    edit: (id,input_data) => {
        console.log("edit "+id);
        const url = './?action=update&id='+id;
        $.post(url, input_data, (data) => {
            if (data.err == undefined || data.err == false) {
                alert("Dispositivo atualizado com sucesso!");
            } else {
                alert("Erro ao tentar atualizar o dispositivo!");
            }
        });
    },
    add: (input_data) => {
        console.log("add");
        const url = './?action=add';
        $.post(url, input_data, (data) => {
            if (data.id != undefined) {
                alert("Dispositivo cadastrado com sucesso!");
                location.href = './?action=get&id='+data.id;
            } else {
                alert('Erro ao tentar cadastrar o novo dispositivo');
            }
        });
    },
    delete: (id, btn) => {
        console.log("delete "+id);
        const url = './?action=delete&id='+id;
        $.post(url, (data) => {
            if (data.err == undefined || data.err == false) {
                //apagar linha da tabela
                if (btn.closest('td').attr('class')=="celula-apagar") {
                    btn.closest('tr').remove();
                } else {
                    location.reload();
                }
            } else {
                alert('Erro ao tentar apagar o dispositivo');
            }
        });
    },
    connect: (connect_data) => {
        console.log("connect");
        $('#btn-connect').prop('disabled',true);
        const url = './?action=sshConnect';
        $.post(url, connect_data, (data) => {
            if (data.connected !== undefined && data.connected == true) {
                //alert("Dispositivo conectado com sucesso!");
                $('#connection_name').val(data.ssh_connection_name);

                $('#ssh_username').prop('disabled',true);
                $('#ssh_password').prop('disabled',true);
                $('#ssh_command').prop('disabled',false);
                $('#ssh_command').focus();
            } else {
                alert('Erro ao tentar conectar com o dispositivo');
                $('#btn-exec').prop('disabled',false);
            }
        });
    },
    command: (command_data) => {
        console.log("command:"+command_data.ssh_command);
        $('#btn-exec').prop('disabled',true);
        const url = './?action=sshCommand';
        $.post(url, command_data, (data) => {
            let output_value = data+"\n";
            $('textarea#ssh_output').val(output_value);
            $('#btn-exec').prop('disabled',false);
        });
    }
};

var Criptografia = {};

Criptografia.functions = {
    encrypt: (input_data) => {
        const url = './?controller=Criptografia&action=encrypt';
        $.post(url, input_data, (data) => {
            if (data.err !== undefined && data.err == false) {
                $('#encrypt_decrypt').val('decrypt');
                $('#btn-encrypt').text('Descriptografar');

                $('#cifra_cesar').val(data.cifra_cesar);
                $('#cifra_aes256').val(data.cifra_aes256);
                //$('#cifra_extra').val(data.cifra_extra);
                $('#aes256_random_key').val(data.aes256_random_key);

                $('#cifra_cesar_desc').val('');
                $('#cifra_aes256_desc').val('');
                //$('#cifra_extra_desc').val('');
            }
        });
    },
    decrypt: (input_data) => {
        const url = './?controller=Criptografia&action=decrypt';
        $.post(url, input_data, (data) => {
            if (data.err !== undefined && data.err == false) {
                $('#encrypt_decrypt').val('encrypt');
                $('#btn-encrypt').text('Criptografar');

                $('#cifra_cesar_desc').val(data.cifra_cesar_desc);
                $('#cifra_aes256_desc').val(data.cifra_aes256_desc);
                //$('#cifra_extra_desc').val(data.cifra_extra_desc);
            }
        });
    }
};

var Hash = {};

Hash.functions = {
    generate: (input_data) => {
        const url = './?controller=Hash&action=generate';
        $.post(url, input_data, (data) => {
            if (data.err !== undefined && data.err == false) {
                $('#hash_sha512').val(data.hash_sha512);
                $('#hash_hmac').val(data.hash_hmac);

                let hash_sha512_equals = '';
                if (data.hash_sha512_equals == true) {
                    hash_sha512_equals = 'Igual';
                } else if (data.hash_sha512_equals == false) {
                    hash_sha512_equals = 'Diferente';
                }
                $('#hash_sha512_equals').val(hash_sha512_equals);

                let hash_hmac_equals = '';
                if (data.hash_hmac_equals == true) {
                    hash_hmac_equals = 'Igual';
                } else if (data.hash_hmac_equals == false) {
                    hash_hmac_equals = 'Diferente';
                }
                $('#hash_hmac_equals').val(hash_hmac_equals);
                //$('#cifra_extra').html(data.cifra_extra);
            }
        });
    }
};


$(document).ready(function(){
    $('.editar').on('click',function(){
        let id = $(this).data('id');
        location.href = './?action=get&id='+id;
    });
    
    $('.novo').on('click',function(){
        location.href = './?action=create';
    });
    
    $('#form_dispositivo').on('submit',function(e){
        e.preventDefault();
        
        const input_data = $('#form_dispositivo').serialize();
        if ($('#id').val() != undefined && $.isNumeric($('#id').val())) {
            let id = $('#id').val();
            Dispositivo.functions.edit(id,input_data);
        } else {
            Dispositivo.functions.add(input_data);
        }

    });

    $('.btn-tabela-apagar').on("click",function(){
        const id = $(this).data("id");
        const btn = $(this);
        if (confirm('Tem certeza que deseja apagar o registro?\nEssa operação não tem volta!')) {
            Dispositivo.functions.delete(id, btn);
        }
    });

    $('#form_connect').on('submit',function(e){
        e.preventDefault();
        
        if ($('#id').val() != undefined && $.isNumeric($('#id').val())) {
            const connect_data = {
                id: $('#id').val(),
                ssh_username: $('#ssh_username').val(),
                ssh_password: $('#ssh_password').val()
            };
            Dispositivo.functions.connect(connect_data);
        }

    });

    $('#form_command').on('submit',function(e){
        e.preventDefault();
        
        const command_data = {
            ssh_connection_name: $('#connection_name').val(),
            ssh_command: $('#ssh_command').val()
        };
        Dispositivo.functions.command(command_data);
    });

    $('#form_criptografia').on('submit',function(e){
        e.preventDefault();

        if ($('#encrypt_decrypt').val() == 'encrypt') {
            const encrypt_data = {
                user_input: $('#user_input').val()
            };
            Criptografia.functions.encrypt(encrypt_data);
        } else {
            const decrypt_data = {
                cifra_cesar: $('#cifra_cesar').val(),
                cifra_aes256: $('#cifra_aes256').val(),
                cifra_extra: $('#cifra_extra').val(),
                aes256_random_key: $('#aes256_random_key').val()
            };
            Criptografia.functions.decrypt(decrypt_data);
        }
        
    });

    $('#form_hash').on('submit',function(e){
        e.preventDefault();

        const input_data = {
            user_text: $('#user_text').val(),
            user_hash: $('#user_hash').val()
        };
        Hash.functions.generate(input_data);
        
    });
});


