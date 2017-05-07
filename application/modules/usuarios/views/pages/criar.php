<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Usuários
            <small>Formulário</small>
        </h1>
        <ol class="breadcrumb">
            <li class="">
                <a href="<?= $basePath.'dashboard' ?>">Dashboard</a>
            </li>
            <li class="">
                <a href="<?= $basePath.'usuarios/listagem' ?>">Usuários</a>
            </li>
            <li class="active">Listagem</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <?php if(is_array($this->session->flashdata('status'))): ?>
            <div class="alert alert-<?= @$this->session->flashdata('status')['type'] ?> alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> <?= @$this->session->flashdata('status')['title'] ?></h4>
                <?= @$this->session->flashdata('status')['message'] ?>
            </div>
        <?php endif; ?>

        <a href="<?= $basePath.'usuarios/listagem' ?>" class="btn btn-default pull-right col-md-2">
            Voltar a Listagem
        </a>
        <form role="form" action="<?= $basePath.'usuarios/doAction' ?>" method="post" >
        <div class="row">
            <div class="col-xs-12" style="margin-top: 20px;">

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">

                            <input name="usuario[id]" value="<?= @$id ?>" type="hidden">

                            <!-- text input -->
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Nome</label>
                                    <input value="<?= @$usuario['nome'] ?>" required name="usuario[nome]" type="text" class="form-control" placeholder="Nome do Usuário">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>E-Mail</label>
                                    <input value="<?= @$usuario['email'] ?>" required name="usuario[email]" type="email" class="form-control" placeholder="E-Mail">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Telefone</label>
                                    <input value="<?= @$usuario['telefone'] ?>" name="usuario[telefone]" type="text" class="form-control mascara-fone" placeholder="Telefone">
                                </div>

                                <!-- radio -->
                                <div class="form-group col-md-6">
                                    <label>Sexo</label>
                                    <div class="radio">
                                        <label>
                                            <input <?php if(@$usuario['sexo'] == 'M'):?>checked<?php endif; ?> required name="usuario[sexo]" type="radio" value="M" >
                                           Masculino
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input <?php if(@$usuario['sexo'] == 'F'):?>checked<?php endif; ?> required name="usuario[sexo]" type="radio" value="F">
                                            Feminino
                                        </label>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if(@$id != null): ?>
        <button type="submit" name="meta[action]" onclick="return confirm('Deseja realmente exluir esse item ?')" value="apagar" class="btn btn-danger col-md-2 pull-left">
            Excluir
        </button>
        <?php endif; ?>

        <button type="submit" name="meta[action]" value="salvar-voltar" class="btn btn-primary col-md-2 pull-right">
            Salvar e Voltar
        </button>

        <button type="submit" name="meta[action]" value="salvar" class="btn btn-primary col-md-2 pull-right" style="margin-right: 20px">
            Salvar
        </button>
        </form>
    </section>
    <!-- /.content -->

</div>

<script>
    var SPMaskBehavior = function (val) {
            return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
        },
        spOptions = {
            onKeyPress: function(val, e, field, options) {
                field.mask(SPMaskBehavior.apply({}, arguments), options);
            }
        };

    $('.mascara-fone').mask(SPMaskBehavior, spOptions);
</script>