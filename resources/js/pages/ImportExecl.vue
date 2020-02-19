<template>  
       <div class='container mt-3'>
           <div class="card">
               <div class="card-header">
                   Import
               </div>

               <div class="card-body">
                    <form action="" enctype='multipart/form-data'>
                        <div class="form-row justify-content-md-center">
                            <div class="custom-file col-6">
                                <input type="file" class='custom-file-input' id='file' @change="previewFile" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                                <label class="custom-file-label" for="file">{{file}}</label>
                                <label v-if='error' class="form-check-label" for="invalidCheck3">
                                    {{error}}
                                </label>
                            </div>
                        </div>
                        <button class="btn btn-primary float-right" type="submit">Import File</button>
                    </form>
               </div>
           </div>
       </div>
</template>

<script>

export default {
    name:'import-excel',
    components: {
        
    },
    data(){
        return{
            file: 'Choose File....',
            error: ''
        }
    },
    methods:{
        previewFile(event){
            this.file = event.target.files[0].name
            let type = this.file.split('.')
            if(type[1] != 'xlsx' && type[1] != 'xls'){
                this.error = 'upload valid file, Only xlsx are allowed.'
            }else{
                console.log(type[1])
            }
        }
    }
}
</script>

<style>
    
</style>