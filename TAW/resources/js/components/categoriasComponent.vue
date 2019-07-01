 <template>
        <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Categorías
                        <button @click="modoEditar=false" type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalNuevo" >
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" id="opcion" name="opcion">
                                      <option value="nombre" v-model=>Nombre</option>
                                      <option value="descripcion">Descripción</option>
                                    </select>
                                    <input type="text" id="texto" name="texto" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" class="btn btn-primary" ><i class="fa fa-search" ></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in categorias" :key="index">
                                    <td>
                                        <button v-on:click="editar(index)" type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalNuevo">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <button v-on:click="eliminado = index" type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalEliminar">
                                          <i class="icon-trash"></i>
                                        </button>
                                    </td>
                                    <td>{{item.nombre}}</td>
                                    <td>{{item.descripcion}}</td>
                                    <td>
                                        <span class="badge badge-success" v-if="item.condicion == 1">Activo</span>
                                        <span class="badge badge-danger" v-else>Inactivo</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <nav>
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#">Ant</a>
                                </li>
                                <li class="page-item active">
                                    <a class="page-link" href="#">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">3</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">4</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Sig</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true" >

                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"  v-if="modoEditar">Editar categoría</h4>
                            <h4 class="modal-title"  v-else>Agregar categoría</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form @submit.prevent="accion" class="form-horizontal" id="datos">
                            <div class="modal-body"> 
                                <div class="form-group row">
                                    <input type='hidden' v-model="categoria.id" v-if="modoEditar">
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                    <div class="col-md-9">
                                        <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre de categoría" v-model="categoria.nombre" requiered>
                                        <span class="help-block">(*) Ingrese el nombre de la categoría</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Descripción</label>
                                    <div class="col-md-9">
                                        <input type="text" id="descripcion" name="descripcion" class="form-control" placeholder="Descripcion" v-model="categoria.descripcion" requiered>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Condicion</label>
                                    <div class="col-md-9">
                                        <input type="text" id="condicion" name="condicion" class="form-control" placeholder="Condicion" v-model="categoria.condicion" requiered>
                                    </div>
                                </div>
                               
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
            <!-- Inicio del modal Eliminar -->
            <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-danger" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Eliminar Categoría</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Estas seguro de eliminar la categoría?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-danger" v-on:click="eliminar">Eliminar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <!-- Fin del modal Eliminar -->
        </main>
        <!-- /Fin del contenido principal -->
</template>

<script>
    export default {
        data(){
            return {
                categorias: [],
                modoEditar: false,
                error: false,
                eliminado: 0,
                edicion: 0,
                categoria: {id: 0, nombre: '', descripcion: '', condicion: 1}
            }
        },
        created(){
            axios.get('/categorias').then(res=>{
                    this.categorias = res.data;
                    //console.log(res.data[0]['nombre']);
            });
        },
        methods:{
            agregar(){
                
                if(this.categoria.nombre.trim() === '' || this.categoria.descripcion.trim() === ''){
                    this.error = true;
                    alert('Debes completar todos los campos antes de guardar');
                    return;
                }
                const nuevaCategoria = this.categoria;
                this.categoria = {id:0, nombre: '', descripcion: '', condicion:1};
                axios.post('/categorias', nuevaCategoria)
                    .then((res) =>{
                        const catServidor = res.data;
                        this.categorias.push(catServidor);
                        $('#modalNuevo').modal('hide');
                    });
                
            },
            editar(index){
                this.modoEditar = true;
                this.edicion = index;
                this.categoria.nombre = this.categorias[index].nombre;
                this.categoria.descripcion = this.categorias[index].descripcion;
                this.categoria.id = this.categorias[index].id;
                this.categoria.condicion = this.categorias[index].condicion;
            },
            actualizar(){
                const modCategoria = this.categoria;
                this.categoria = {id:0, nombre: '', descripcion: '', condicion:1};
                axios.put(`/categorias/${modCategoria.id}`, modCategoria)
                .then(res=>{
                    this.modoEditar = false;
                    const index = this.categorias.findIndex(item => item.id === modCategoria.id);
                    this.categorias[index] = res.data;
                    $('#modalNuevo').modal('hide');
                })
            },
            accion(){
                if(!this.modoEditar){
                    this.agregar();
                }else{
                    this.actualizar();
                }
            },
            eliminar(){
                console.log(this.categorias[this.eliminado].id);
                axios.delete(`/categorias/${this.categorias[this.eliminado].id}`)
                .then(()=>{
                    this.categorias.splice(this.eliminado, 1);
                    $('#modalEliminar').modal('hide');
                })
            }
        },
        mounted() {
            console.log('Categorias Component mounted.');
        },
    }
</script>