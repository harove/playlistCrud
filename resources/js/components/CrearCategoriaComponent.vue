<template>
    
                        <div class="row">
                                        <div class="col-lg-4">
                                            <div class="card">
                                                <div class="card-body">
                                                        <div class="form-group">
                                                            <label>Agregar Categoria</label>
                                                            <input type="text" v-model="nombre_categoria" class="form-control" required placeholder="Ingrese nombre de la categoría"/>
                                                        </div>
                                                
                                                        <div class="form-group mb-0">
                                                            <div>
                                                                <button type="submit" class="btn btn-primary waves-effect waves-light mr-1" @click="registrarCategoria()">
                                                                    Crear
                                                                </button>
                                                            </div>
                                                        </div>
                                                </div>             
                                            </div> 
                                        </div> 
                               
                                        <div class="col-lg-8">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="table mb-0">
                                                            <thead>
                                                                <tr>
                                                                    <th>ID</th>
                                                                    <th>Nombre de categoría</th>
                                                      
                                                                    <th><center>Opciones</center></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr v-for="(categorias, index) in arrayCategoria" :key="categorias.id">
                                                                     <th v-text="categorias.id"></th>
                                                                    <th v-text="categorias.nombre_categoria"></th>
                                                                     <td><center>
                                                                        <button
                                                                        type="submit"
                                                                        class="btn btn-danger waves-effect waves-light mx-auto"
                                                                        @click="borrarRegistro(categorias,index)"
                                                                        ><i class="ti-close"></i></button></center>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            </div>


</template>
<script>
import VueSweetalert2 from 'vue-sweetalert2';
Vue.use(VueSweetalert2);


export default {
    data() {
        return {
            nombre_categoria: '',
            id_categoria: '',
            arrayCategoria: []
        }
    },
    methods: {
        listarCategoria() {
            let esto = this;
            var url = "/categorias/listarCategorias";
            axios.get(url).then(function(response) {
                let respuesta = response.data;
                esto.arrayCategoria = respuesta.categorias;
                console.log(response);
            })
                .catch(function(error) {
                console.log(error);
            });
          

        },
        borrarRegistro(categorias,index){
            axios.delete(`/categoria/${categorias.id}`).then(()=> { // lo borra en el servidor enviado la id al controlador PlaylistController funcion delete
            this.arrayCategoria.splice(index, 1); // borra la columna segun el indice..lo borra visualmente
            Vue.swal({
                toast: true,
                type: 'info',
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000,
                title: 'Borrado'
            });
         
            })
            .catch(function(error) {
            console.log(error);
            });


        },
        registrarCategoria(data) {
            let esto = this;
            axios.post("/categoria/registrar", {
                id_categoria: esto.id_categoria,
                nombre_categoria: esto.nombre_categoria,
                })
                .then(function(response) {
                Vue.swal({
                        toast: true,
                        type: 'success',
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        title: 'Ingresado Exitosamente'
                    });
                    esto.listarCategoria();
                })
                .catch(function(error) {
                console.log(error);
                });
    },
    },
     mounted() {
        this.listarCategoria();
        }
}
</script>