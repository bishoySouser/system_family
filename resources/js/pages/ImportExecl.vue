<template>  
       <div class='container mt-3'>
           <div class="card">
               <div class="card-header">
                   Import
               </div>

               <div class="card-body">
                    <form action="" enctype='multipart/form-data' class='mb-5'>
                        <div class="form-row justify-content-md-center">
                            <div class="custom-file col-6">
                                <input type="file" class='custom-file-input' id='file' @change="previewFile" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                                <label class="custom-file-label" for="file">{{fileName}}</label>
                                <label v-if='errors.length != 0' class="form-check-label" for="invalidCheck3">
                                    <ul class='text-danger' v-for='(error, name, index) in errors[0]' :key='index'>
                                        <li>{{ name }}: <span class='font-weight-bold'>{{ error }}</span></li>
                                    </ul>
                                </label>
                            </div>
                        </div>
                        <button class="btn btn-primary float-right" type="submit" v-on:click.prevent='importFile()' :disabled='disableImportButton()'>Import File</button>
                    </form>
                    <SyncLoader class="text-center" :color="color" :loading="loading" :size="15"></SyncLoader>
                    <div v-if="individuals.length != 0" class="table-responsive" style='height: 50vh; direction:rtl'>
                        <table class='table table-bordered text-center m-auto'>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Area</th>
                                    <th>Home phone</th>
                                    <th>Mobile number1</th>
                                    <th>Mobile number2</th>
                                    <th>Social Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                <!-- if individual.length > 0 -->
                                <tr  v-for="(individual, index) in individuals[0]"
                                :key='index'>
                                    <td>{{ index+1 }}</td>
                                    <td class='font-weight-bold text-left'>{{ (individual.first_name+' '+individual.middle_name+' '+individual.last_name).toUpperCase() }}</td>
                                    <td>{{ individual.email }}</td>
                                    <td><a href="#" data-toggle="tooltip" :title="individual.address">{{ individual.area }}</a></td>
                                    <td class='font-italic'>{{ '0'+individual.home_phone }}</td>
                                    <td class='font-italic'>{{ '0'+individual.mobile_phone1 }}</td>
                                    <td class='font-italic'>{{ individual.mobile_phone2 ? '0'+individual.mobile_phone2 : 'empty'}}</td>
                                    <td>{{ individual.social_status }}</td>
                                </tr>
                            </tbody>
                            
                        </table>
                    </div>
               </div>
           </div>
       </div>
</template>

<script>
import { SyncLoader } from '@saeris/vue-spinners'
export default {
    name:'import-excel',
    components: {
        SyncLoader
    },
    data(){
        return{
            fileName: 'Choose File....',
            file: null,
            errors: [],
            individuals: [],
            loading: false,
            color: '#343A40'
        }
    },
    methods:{
        disableImportButton(){
            if(this.fileName === 'Choose File....'){
                return true
            }
            return false
        },
        previewFile(event){
            this.fileName = event.target.files[0].name //file name
            this.file = event.target.files[0] // 
        },
        importFile(){
            this.errors = []
            if(!this.file){
                alert('Where\'s a excel file?');
            }else{
                this.loading = true
                let formData = new FormData();
                formData.append('file', this.file)
                axios.post("/api/individual/excel/import", formData)
                .then(res => {
                    this.loading = false
                    this.individuals = []
                    
                    this.individuals.push(res.data.all_data);
                    this.fileName = 'Choose File....'
                })
                .catch(err => {
                    this.loading = false
                    this.errors.push(err.response.data)
                    this.individuals = []
                })
            }
            
        }
    }
}
</script>

<style lang="scss" scoped>
    table{
        width: max-content !important;
    }

    th:nth-child(2), td:nth-child(2) {
        position:sticky;
        left:0px;
        background-color:grey;
    }
</style>