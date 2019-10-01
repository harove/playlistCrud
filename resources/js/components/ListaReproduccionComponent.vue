<template>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>  
 
                                    <th>ID</th>
                                    <th>Nombre Lista</th>
                                    <th>Tiempo Total</th>
                                    <th>Fecha Emision</th>
                                    <th>Canal</th>
                                    <th><center>Editar</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(playlist, index) in arrayPlaylist" :key="playlist.id" >
                                    <td v-text="playlist.id"></td>  
                                    <td v-text="playlist.nombre_playlist"></td>     
                                    <td v-text="playlist.hora_final"></td>
                                    <td v-text="playlist.fecha_emision"></td>
                                    <td v-text="playlist.nombre_canal"></td>
                              
                                    <td>
                                        
                                        <center>

                                        <!-- <a class="btn btn-success waves-effect waves-light mx-auto" ><i class="ti-pencil"></i></a> -->
                                        <router-link :to="{name: 'playlist_editar', params: {id: playlist.id}}" class="btn btn-success waves-effect waves-light mx-auto"><i class="ti-pencil"></i></router-link>
                                        
                                        <button type="submit" class="btn btn-danger waves-effect waves-light mx-auto" @click='borrarRegistro(playlist,index)'><i class="ti-trash"></i></button>

                                        </center>
                                                                           
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
var moment = require('moment');

import VueSweetalert2 from 'vue-sweetalert2';
Vue.use(VueSweetalert2);
export default {
        data() {
            return {
                arrayPlaylist: []
        

        }
    },
        methods: {
 
        listarPlaylist() {
        let esto = this;
        var url = "/playlist/listarPlaylist";
        axios.get(url).then(function(response) {
             let respuesta = response.data;
            esto.arrayPlaylist = respuesta.playlist;
            console.log(response);
            })
            .catch(function(error) {
            console.log(error);
            });
        },
         formatoHMS(hora){
             var input = hora;
             var result = moment(hora);
             return result.format('LTS')
         },
         borrarRegistro(playlist,index){

            axios.delete(`/playlist/${playlist.id}`).then(()=> { // lo borra en el servidor enviado la id al controlador PlaylistController funcion delete
            this.arrayPlaylist.splice(index, 1); // borra la columna segun el indice..lo borra visualmente
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


        }
    },
       
     mounted() {
        this.listarPlaylist();
         
    }
}


</script>
