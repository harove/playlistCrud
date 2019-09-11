<template>

<div class="row">
    <div class="col-lg-5">
      <div class="card">
        <div class="card-body">
          <form class action="#">
            <div class="form-group row">
              <label for="example-text-input" class="col-sm-4 col-form-label">Nombre</label>
              <div class="col-sm-8">
                <input class="form-control" type="text" v-model= "nombre_playlist"  id="example-text-input" />
              </div>
            </div>
            <div class="form-group row">
              <label for="example-text-input" class="col-sm-4 col-form-label">Usuario</label>
              <div class="col-sm-8">
                <div class="form-group">
                  <select class="form-control" v-model="id_usuario">
                    <option value="0" disabled>Seleccione</option>
                    <option v-for="usuarios in arrayUsers" :key="usuarios.id" :value="usuarios.id" v-text="usuarios.nombre_usuario"
                    ></option>
                  </select>
                </div>
              </div>
            </div>

            <div class="form-group row">
              <label for="example-text-input" class="col-sm-4 col-form-label">Canal</label>
              <div class="col-sm-8">
                <select class="form-control" v-model="id_canal">
                  <option value="0" disabled>Seleccione</option>
                  <option v-for="canales in arrayCanales" :key="canales.id" :value="canales.id" v-text="canales.nombre_canal"
                  ></option>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label for="example-time-input" class="col-sm-4 col-form-label">Hora Inicio</label>
              <div class="col-sm-8">
                <input class="form-control" type="time" step="1" value="13:45:00" v-model= "hora_inicio" id="example-time-input" />
              </div>
            </div>

            <div class="form-group row">
              <label for="example-date-input" class="col-sm-4 col-form-label">Emisión</label>
              <div class="col-sm-8">
                <input class="form-control" type="date" value="2011-08-19" id="example-date-input" v-model= "fecha_emision"/>
              </div>
            </div>

            <div class="form-group row col-sm-12">
              <label for="example-time-input" class="col-form-label">Loop</label>

              <input type="checkbox" id="switch7" switch="info" checked />
              <label class="loop" for="switch7" data-on-label="Si" data-off-label="No"></label>

              <label for="example-time-input" class="col-form-label">AutoStart</label>

              <input type="checkbox" id="switch8" switch="info" checked />
              <label class="loop" for="switch8" data-on-label="Si" data-off-label="No"></label>

              <!--<button type="submit" class="btn btn-primary waves-effect waves-light mr-1">Crear</button>-->
            </div>
          </form>
        </div>
      </div>
                                    </div> 
                               
                                    <div class="col-lg-7">

                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="btn-group m-b-15" role="group" aria-label="Basic example">
                                                            <button type="button" class="btn btn-success">
                                                              <i class="ion ion-md-add-circle"></i> Agregar Live
                                                            </button>
                                                            <button type="submit" class="btn btn-primary dropdown-toggle">Categorias</button>
                                                                    <div id="DataTables_Table_0_filter" class="dataTables_filter m-t-10"><label>
                                                                    <input type="videos" class="form-control form-control-sm" placeholder="Buscar Vídeos" aria-controls="DataTables_Table_0"></label></div>

                                                          </div>
                                                        <div class="table-striped">
                                                                    <table class="table table-sm m-10 table-striped">
                                                                        <thead>
                                                                            <tr>
                                                                         
                                                                                <th>Nombre de Vídeo</th>
                                                                                <th>Duración</th>
                                                                                <th>Agregar</th>
                                                                                
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody class="table-striped">
                                                                             <tr v-for="videos in arrayVideos" :key="videos.id">
                                                                                <td v-text="videos.nombre_video"></td>
                                                                                <td v-text="videos.lenght"></td>
                                                                                <td>
                                                                                <button
                                                                                    @click="agregarDetalleVideo(videos)" class="btn btn-success btn-sm form-control btnagregar">
                                                                                    <i class="ti-plus"></i>
                                                                                </button>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                        <tfoot>
                                                                       
                                                                          </tfoot>
                                                                    </table>
                                                                </div>
                        
                                                                    <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                                                            Guardar Lista
                                                                        </button>   
                                                                        <button type="submit" class="btn btn-dark waves-effect waves-light mr-1">
                                                                                <i class="ti-control-play"></i> Preview
                                                                            </button>      
                                                
                                                </div>

                                          
                                    </div>

                                     <div class="card">
        <div class="card-body">
          <div class="table-striped">
            <table class="table table-sm m-10 table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Hora de Inicio</th>
                  <th>Hora Finaliza</th>
                  <th>Nombre Video</th>
                  <th>Duración</th>
                  <th><center>Borrar</center></th>
                </tr>
              </thead>
              <draggable
                v-model="arrayPlaylist"
                v-bind="dragOptions"
                @start="drag = true"
                @end="drag = false"
                tag="tbody"
              >
                <tr v-for="(playlist_detalle,index) in itemsWithSubTotal" :key="index">
                  <td scope="row">{{playlist_detalle.item1.id_video}}</td>
                  <td>{{ playlist_detalle.subinit }} </td>
                  <td>{{ playlist_detalle.subtotal }}</td>
                  <td>{{ playlist_detalle.item1.nombre_video }}</td>
                  <td>{{ playlist_detalle.item1.lenght }}</td>
           
                  
                 

                  <td><center>
                    <button
                      type="submit"
                      class="btn btn-danger waves-effect waves-light mx-auto"
                      @click="eliminarDetalleVideo(index)"
                    ><i class="ti-close"></i></button></center>
                  </td>
                </tr>
              </draggable>

              <tfoot>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>
                    <i class="ion ion-md-clock"></i>
                    {{ totalParcial = parseToHour(total()) }}
                  </td>
                  <td></td>
                </tr>
              </tfoot>
            </table>
          </div>

          <button type="submit" class="btn btn-primary waves-effect waves-light mr-1" @click="registrarPlaylist()"><i class="ti-save"></i> Guardar Lista</button>
          <button type="submit" class="btn btn-dark waves-effect waves-light mr-1">
            <i class="ti-control-play"></i> Preview
          </button>
        </div>
      </div>
                                    <div class="card">
                                    <div class="card-body">


                                                                    <div class="form-group">
                                                                            <label>Código Iframe</label>
                                                                            <div>
                                                                                <textarea required class="form-control" rows="5"><iframe></iframe></textarea>
                                                                            </div>
                                                                        </div>
 
                                    </div>
                                    </div>
                            </div>
                          </div>  
                    </template>

<script>

import draggable from "vuedraggable";
var moment = require('moment');

import VueSweetalert2 from 'vue-sweetalert2';
Vue.use(VueSweetalert2);

const message = [
  "vue.draggable",
  "draggable",
  "component",
  "for",
  "vue.js 2.0",
  "based",
  "on",
  "Sortablejs"
];

export default {
    data(){
        return{
            id_video: 0,
            id_usuario: 0,
            id_canal: 0,
            nombre_video: '',
            lenght: 0,
            nombre_playlist: '',
            arrayVideos: [],
            arrayPlaylist: [],
            arrayCanales: [],
            arrayUsers: [],
            subTotalAcum: 0,
            subInitAcum: 0,
            hora_inicio: 0,
            testduration: 0,
            testinit: 0,
            totalParcial: 0,
            hora_inicio: 0,
            fecha_emision: 0,
       
            
        }
    },
methods: {
    mostrarDetallePlaylist(){
        //Capturamos la id del sistema de vou-route dentro de $route y parametros
        var url = "mostrar/detalle_playlist/lista/";
        axios.get(url + this.$route.params.id).then(response =>{
           
          let respuesta = response.data;
         console.log(respuesta); 
          this.arrayPlaylist = respuesta.playlist_detalle;

        }).catch(error =>{
            console.log(error.response.data);
        })
    },
     mostrarPlaylist(){
        //Capturamos la id del sistema de vou-route dentro de $route y parametros
        var arrayTemporal = [];
        var url = "mostrar/playlist/lista/";
        axios.get(url + this.$route.params.id).then(response =>{

          let respuesta = response.data;
          arrayTemporal = respuesta.playlist;

          this.nombre_playlist  = arrayTemporal[0]['nombre_playlist'];
          this.hora_inicio      = arrayTemporal[0]['hora_inicio'];
          this.fecha_emision    = arrayTemporal[0]['fecha_emision'];
          this.id_usuario       = arrayTemporal[0]['id_usuario'];
          this.id_canal         = arrayTemporal[0]['id_canal'];



        }).catch(error =>{
            console.log(error.response.data);
        })
    },
    selectUsuarios() {
      let esto = this;
      var url = "/usuarios/selectUsuarios";
      axios
        .get(url)
        .then(function(response) {
          //console.log(response);
          let respuesta = response.data;
          esto.arrayUsers = respuesta.usuarios;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    selectCanales() {
      let esto = this;
      var url = "/canales/selectCanales";
      axios
        .get(url)
        .then(function(response) {
          //console.log(response);
          let respuesta = response.data;
          esto.arrayCanales = respuesta.canales;
        })
        .catch(function(error) {
          console.log(error);
          
        });
    },
    agregarDetalleVideo(data) {
      const {id, nombre_video, lenght } = data;
      console.log(id);
      console.log(nombre_video);
      console.log(lenght);
      

      this.arrayPlaylist.push({
        id_video: data["id"],
        nombre_video: data["nombre_video"],
        lenght: lenght, //data["length"], 
    // convierte la hora de video de entrada a segundos
          //moment(data["lenght"], 'HH:mm:ss: A').diff(moment().startOf('day'), 'seconds'),
       
      });
      console.log(this.arrayPlaylist);
      //debugger;

      
    },
    listarVideo() {
      let esto = this;
      var url = "/videos/listarVideos";
      axios.get(url).then(function(response) {
         
          //console.log(response);
          let respuesta = response.data;
          esto.arrayVideos = respuesta.videos;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
      eliminarDetalleVideo(index) {
      let esto = this;
      esto.arrayPlaylist.splice(index, 1);
    },
     sort() {
      this.list = this.list.sort((a, b) => a.order - b.order);
    },

    computeSubTotal: function(item) {
      //formatPrice is removed here because its not defined in the question
      this.subTotalAcum = this.subTotalAcum + item.lenght;
      return this.subTotalAcum;
    },
    parseToHour(seconds){
        return moment().startOf('day').seconds(seconds).format('H:mm:ss');
    },

    total(){
      return this.subTotalAcum;
    }
},
computed: {
    calcularParcialLengthVideo: function() {
      var resultado = 0;
      for (var i = 0; i < this.arrayDetallePlaylist.length; i++) {
        resultado = resultado + parseInt(this.arrayDetallePlaylist[i].lenght);
      }
      return resultado;
    },

    itemsWithSubTotal() {
      //var itemsx = [];
      
      //  console.log(this.hora_inicio); 
      //  console.log(moment(this.hora_inicio, 'HH:mm:ss: A').diff(moment().startOf('day'), 'seconds'));
      
      this.subTotalAcum = moment(this.hora_inicio, 'HH:mm:ss: A').diff(moment().startOf('day'), 'seconds')

      //this.subTotalAcum = moment(this.hora_inicio, 'HH:mm:ss A').diff(moment().startOf('day'), 'seconds');
      //this.subTotalAcum=this.hora_inicio;
      //console.log(this.arrayDetallePlaylist)
      //itemsx = this.arrayDetallePlaylist.map(item1 => ({item1,subtotal: this.computeSubTotal(item1),subinit: this.computeInit(item1)}))
      //this.arrayDetallePlaylist.testinit = 22;
      //console.log(itemsx)
      return this.arrayPlaylist.map(item1 => ({
        item1,
        subinit: this.subTotalAcum,
        subtotal: this.computeSubTotal(item1)
        
      }));

    },

    dragOptions() {
      return {
        animation: 200,
        group: "description",
        disabled: false,
        ghostClass: "ghost"
      };
    }
  },

    mounted() {
    this.listarVideo();
    this.mostrarDetallePlaylist();
    this.mostrarPlaylist();
    this.selectUsuarios();
    this.selectCanales();

  }
}


</script>

