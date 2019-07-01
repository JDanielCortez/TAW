 <template>
        <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                <li class="breadcrumb-item active">Articulos</li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado --> 
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Articulos
                        <button @click="modoEditar=false" type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalNuevo">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" id="opcion" name="opcion">
                                      <option value="categoria">Categoria</option>
                                      <option value="codigo">Codigo</option>
                                      <option value="nombre">Nombre</option>
                                      <option value="condicion">Condicion</option>
                                    </select>
                                    <input type="text" id="texto" name="texto" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Categoria</th>
                                    <th>Codigo</th>
                                    <th>Nombre</th>
                                    <th>Precio de Venta </th>
                                    <th>Stock</th>
                                    <th>Descripcion</th>
                                    <th>Condicion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in articulos" :key="index">
                                    <td>
                                        <button v-on:click="editar(index)" type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalNuevo">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <button v-on:click="eliminado = index" type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalEliminar">
                                          <i class="icon-trash"></i>
                                        </button>
                                    </td>
                                    <td>{{item.categoria}}</td>
                                    <td>{{item.codigo}}</td>
                                    <td>{{item.nombre}}</td>
                                    <td>{{item.precio_venta}}</td>
                                    <td>{{item.stock}}</td>
                                    <td>{{item.descripcion}}</td>
                                     <td>
                                        <span class="badge badge-success" v-if="item.condicion == 1">Disponible</span>
                                        <span class="badge badge-danger" v-else="">Agotado</span>
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
            <div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-if="modoEditar">Editar articulo</h4>
                            <h4 class="modal-title" v-else>Agregar articulo</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form  @submit.prevent="accion" class="form-horizontal">
                            <div class="modal-body">
                                <input type="text" v-model="articulo.idarticulo" v-if="modoEditar">
                                <div class="form-group row">
                                     <label for="categoria" class="col-md-3 form-control-label">Categoria</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="" id="categoria" v-model="articulo.categoria">
                                            <option v-for="cat in categorias" v-bind:value="cat.id">{{cat.nombre}}</option>
                                        </select>
                                    </div>
                                </div> 

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="categoria">Codigo</label>
                                    <div class="col-md-9">
                                        <input type="text" id="categoria" name="nombre" class="form-control" placeholder="Nombre del producto" v-model="articulo.codigo">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="nombre">Nombre</label>
                                    <div class="col-md-9">
                                        <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre del producto" v-model="articulo.nombre">
                                        <span class="help-block">(*) Ingrese el nombre del articulo</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="pventa">Precio de Venta</label>
                                    <div class="col-md-9">
                                        <input type="text" id="pventa" name="descripcion" class="form-control" placeholder="Precio de Venta" v-model="articulo.precio_venta">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="stock">Stock</label>
                                    <div class="col-md-9">
                                        <input type="text" id="stock" name="categoria" class="form-control" placeholder="Stock" v-model="articulo.stock">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="descripcion">Descripcion</label>
                                    <div class="col-md-9">
                                        <input type="text" id="descripcion" name="precio" class="form-control" placeholder="Descripción" v-model="articulo.descripcion">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                     <label for="condicion" class="col-md-3 form-control-label">Condición</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="" id="condicion" v-model="articulo.condicion">
                                            <option value="0">Agotado</option>
                                            <option value="1">Disponible</option>
                                        </select>
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
                            <button v-on:click="eliminar" type="button" class="btn btn-danger">Eliminar</button>
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
                articulos: [],
                artCopia: [],
                categorias: [],
                modoEditar: false,
                error: false,
                eliminado: 0,
                edicion: 0,
                actualOrden:'nombre',
                actualDireccionOrden:'asc',
                tamPagina:5,
                pagActual:1,
                busqueda: '',
                filtro: 'nombre',
                articulo: {idarticulo: 0, categoria: 0, codigo:'', nombre:'', precio_venta: 0,stock: 0, descripcion : '', condicion:1}
            }
        },
        created(){
            axios.get('/articulos').then(res=>{
                    this.articulos = res.data;
                    this.artCopia = this.articulos;
                    console.log(res.data[0]);
            });
            axios.get('/articulos/categorias').then(res=>{
                    this.categorias = res.data;
                    console.log(res.data[0]);
            });
        },
        methods:{
            agregar(){
                if(this.articulo.categoria === 0 || this.articulo.nombre.trim() === '' || this.articulo.codigo.trim() === '' || this.articulo.precio_venta === 0 || this.articulo.stock === 0 || this.articulo.descripcion.trim() === '' ){
                    this.error = true;
                    alert('Debes completar todos los campos antes de guardar');
                    return;
                }
                const nuevArticulo = this.articulo;
                this.articulo = {idarticulo: 0, categoria: 0, codigo:'', nombre:'', precio_venta: 0,stock: 0, descripcion : '', condicion:1};
                axios.post('/articulos', nuevArticulo)
                    .then((res) =>{
                        const artServidor = res.data;
                        this.articulos.push(artServidor);
                        $('#modalNuevo').modal('hide');
                    });
                
            },
            editar(index){
                this.modoEditar = true;
                this.edicion = index;
                this.articulo.idarticulo = this.articulos[index].idarticulo;
                this.articulo.categoria = this.articulos[index].idcategoria;
                this.articulo.codigo = this.articulos[index].codigo;
                this.articulo.nombre = this.articulos[index].nombre;
                this.articulo.precio_venta = this.articulos[index].precio_venta;
                this.articulo.stock = this.articulos[index].stock;
                this.articulo.descripcion = this.articulos[index].descripcion; 
                this.articulo.condicion = this.articulos[index].condicion;               
            },
            actualizar(){
                const modArticulo = this.articulo;
                this.articulo = {idarticulo: 0, categoria: 0, codigo:'', nombre:'', precio_venta: 0,stock: 0, descripcion : '', condicion:1};
                axios.put(`/articulos/${modArticulo.idarticulo}`, modArticulo)
                .then(res=>{
                    this.modoEditar = false;
                    const index = this.articulos.findIndex(item => item.idarticulo === modArticulo.idarticulo);
                    this.articulos[index] = res.data;
                    //this.buscar();
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
                console.log(this.articulos[this.eliminado].idarticulo);
                axios.delete(`/articulos/${this.articulos[this.eliminado].idarticulo}`)
                .then(()=>{
                    this.articulos.splice(this.eliminado, 1);
                    $('#modalEliminar').modal('hide');
                })
            }
        },
        mounted() {
            console.log('Categorias Component mounted.');
        }
    }
</script>