<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Usuários
        <small>Listagem</small>
      </h1>
      <ol class="breadcrumb">
        <li class="">
            <a href="<?= $basePath.'dashboard' ?>">Dashboard</a>
        </li>
        <li class="active">Usuários</li>
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

        <a href="<?= $basePath.'usuarios/criar' ?>" class="btn btn-primary pull-right col-md-2">
            Adicionar Usuário
        </a>
        <div class="row">
            <div class="col-xs-12" style="margin-top: 20px;">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="usuarios" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Telefone</th>
                                <th>Sexo</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Telefone</th>
                                <th>Sexo</th>
                                <th>Ações</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

  </div>

<script>
    $(function () {
        table = $('#usuarios').DataTable({
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "order": [],

            "ajax": {
                "url": "<?= $basePath.'usuarios/getList' ?>",
                "type": "POST"
            }

        });
        $('#usuarios tbody').on('click', 'tr', function () {
            var data = table.row( this ).data();
            window.location = '<?= $basePath.'usuarios/atualizar/' ?>' + data[0];
        } );
    });
</script>

<style>
    #usuarios > tbody{
        cursor: pointer;
    }
    #usuarios > tbody :hover{
        background-color: #3c8dbc;
        color: white;
    }
</style>