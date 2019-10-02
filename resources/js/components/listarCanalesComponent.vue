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
                                    <th><center>Editar</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(canal, index) in arrayCanales" :key="canal.id" >
                                    <td v-text="canal.id"></td>  
                                    <td v-text="canal.nombre_canal"></td>                
                                    <td>  
                                        <center>
                                        <!-- <a class="btn btn-success waves-effect waves-light mx-auto" ><i class="ti-pencil"></i></a> -->
                                        <!-- <router-link :to="{name: 'playlist_editar', params: {id: playlist.id}}" class="btn btn-success waves-effect waves-light mx-auto"><i class="ti-pencil"></i></router-link>
                                        <button type="submit" class="btn btn-danger waves-effect waves-light mx-auto" @click='borrarRegistro(playlist,index)'><i class="ti-trash"></i></button> -->
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

import VueSweetalert2 from 'vue-sweetalert2'; 
Vue.use(VueSweetalert2);


export default {
    data() {
        return {
            arrayCanales: []

        }
    },

    methods: {
        listarCanal() {
            axios
                .get("/canales_ok")
                .then( (response) => {
                    console.log(response);
                    this.arrayCanales = response.data.canales;
                    debugger
                })
                .catch(function(error) {
                    console.log(error);
                });
        }
    },

    mounted() {
        this.listarCanal();
    }
}

</script>
