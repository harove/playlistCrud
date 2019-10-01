
<style src="../../../public/plugins/dropzone/dist/dropzone.css"></style>


<template>
    <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
            
                                            <h4 class="mt-0 header-title">Dropzone</h4>
                                            <p class="text-muted m-b-30">DropzoneJS is an open source library
                                                that provides drag’n’drop file uploads with image previews.
                                            </p>
            
                                            <div class="m-b-30">



                                                <vue-dropzone id="drop1" :options="dropOptions" >
                                                    

                                                </vue-dropzone>

                            


                                            </div>
            
                                            <div class="text-center m-t-15">
                                                <button type="button" class="btn btn-primary waves-effect waves-light">Send Files</button>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end col -->

                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
            
                                        <div class="table-responsive">
                                                                <table class="table table-striped mb-0">
                    
                                                                    <thead>
                                                                        <tr>

                                                                            <th>Nombre del Vídeo</th>
                                                                            <th>Tamaño</th>
                                                                            <th>Progreso</th>

                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <th scope="row">generacion_perdida.mp4</th>
                                                                            <td> 404 MB</td>
                                                                            <td><div class="progress m-b-15">
                                                <div class="progress-bar progress-bar-striped bg-primary" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div></td>
                                                                        </tr>
                                                                        
                                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->

                            
</template>

<script>
 
    import vueDropzone from "vue2-dropzone";
    import SparkMD5 from 'spark-md5';


    export default {

        data: () => ({
            dropOptions: {
                url: "/uploadFiles",
                paramName: 'file2',
                
                chunking: true,
                chunkSize: 1000000, // bytes
                retryChunks: true,
                retryChunksLimit: 3,
                maxFilesize: 100, // megabytes    
                acceptedFiles: ".mp4",
                addRemoveLinks: true,
                timeout: 5000,
                headers: {
                    "X-CSRF-TOKEN": document.head.querySelector("[name=csrf-token]").content
                },

                accept: function(file, done) {
                    var blobSlice = File.prototype.slice || File.prototype.mozSlice || File.prototype.webkitSlice,
                    file = this.files[0],
                    //chunkSize = 2097152,          
                    chunkSize = 1000000,
                    chunks = Math.ceil(file.size / chunkSize),
                    currentChunk = 0,
                    spark = new SparkMD5.ArrayBuffer(),
                    fileReader = new FileReader();
                    var finalHash = ""
            
                    fileReader.onload = function (e) {
                        console.log('read chunk nr', currentChunk + 1, 'of', chunks);
                        spark.append(e.target.result);                   // Append array buffer
                        currentChunk++;

                        if (currentChunk < chunks) {
                            loadNext();
                        } else {
                            console.log('finished loading');
                            finalHash = spark.end()
                            console.info('computed hash', finalHash);  // Compute hash

                        }
                    };

                    this.on("sending", function(file, xhr, formData) {
                                formData.append("hash", finalHash);
                                console.log(formData)
                    });


                    fileReader.onerror = function () {
                        console.warn('oops, something went wrong.');
                    };

                    function loadNext() {
                        var start = currentChunk * chunkSize,
                            end = ((start + chunkSize) >= file.size) ? file.size : start + chunkSize;

                        fileReader.readAsArrayBuffer(blobSlice.call(file, start, end));
                    }
                    loadNext();
                    done();
                }   //accept function

            }  //drop options

        }),    //data


        components: {
            vueDropzone
        }



    };
</script>






