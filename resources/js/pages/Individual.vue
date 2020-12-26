<template>  
       <div class='container mt-3'>
        <!-- navbar -->
        <navindividual v-on:childToParent="onChildClick" v-on:toSearchType='onSearchType'/>
           <div class="card">
               <div class="card-header" style="height: 60px">
                   <div class="row">
                       <div class="col-md-8">
                           Individuals
                       </div>
                       <!-- <div class="col-md-4 mx-auto">
                           <ul v-if="visableindividual" class="pagination">
                                <li class="page-item"><button class="page-link" v-on:click="previousPage()" :disabled="disabledPrevious">Previous</button></li>
                                <li v-if="lastPage" class="page-item"><button class="page-link" disabled>{{page+"-"+lastPage}}</button></li>
                                <li class="page-item"><button  class="page-link"  v-on:click="nextPage()" :disabled="disabledNext">Next</button ></li>
                            </ul>
                       </div> -->
                       <div class="col-md-4">
                           <button v-if="visableDelete" type="button" class="btn btn-outline-light float-right mr-3" @click="onDelete()">
                                <i class="text-danger fas fa-trash-alt fa-2x"></i>
                           </button>
                       </div>
                   </div>
                   
                   
               </div>

               <div class="card-body">
                   <div class="col-12">
                       <grid-loader v-if='loading' class="m-auto" :color="color" :loading="loading" :size="15"></grid-loader>
                       <!-- table -->
                       <div v-else style='direction: rtl;'>
                        <table v-if="visableindividual" class='table'>
                            <tbody>
                                <!-- if individual.length > 0 -->
                                <tr class="click-row"  v-for="(individual, index) in individuals" :key='index' @click="goToBlabla(individual.id)">
                                <!-- <router-link :to="{ name: 'individual_edit', params: { individualId: individual.id }}">  -->
                                    <td class="text-center" v-on:click.stop="">
                                        <input class="check-box" type="checkbox" :value="individual.id" v-model="selectedUsers" aria-label="Checkbox for following text input" >
                                    </td>
                                    <td class='font-weight-bold'>{{ (individual.first_name+' '+individual.middle_name+' '+individual.last_name).toUpperCase() }}</td>
                                    
                                       <!-- <router-link :to="{ name: 'individual_edit', params: { individualId: individual.id }}"> </router-link> -->
                                    
                                    <td>{{ individual.is_a_married ? "Married" : "Single" }}</td>
                                    <td><a href="#" data-toggle="tooltip" :title="individual.address">{{ individual.area }}</a></td>
                                    <td>{{ caluculateAge(individual.date_of_birth) }}</td>
                                    <!-- </router-link> -->
                                </tr>
                            </tbody>
                        </table>
                        

                        <div v-else class='text-center'>
                            
                            <div class="alert" role="alert">
                                No found
                            </div>
                        </div>

                       </div>
                   </div>
               </div>
           </div>
       </div>
</template>

<script>
import navindividual from '../components/navbars/NavbarIndividual'
import { GridLoader } from '@saeris/vue-spinners'
export default {
    name:'individual',
    components: {
        navindividual,
        GridLoader
    },
    data(){
        return{
            individuals: [],
            filterList: '',
            search: '',
            searchType: 'first_name',
            alertMsg: '',
            loading: false,
            color: '#343A40',
            page: 1,
            lastPage: null,
            selectedUsers: []
        }
    },
    computed: {
        emptyField(field) {
            if(field){
                return field
            }else{
                return 'empty'
            }
        },
        disabledNext(){
            if(this.lastPage == this.page){
                return true;
            }
        },
        disabledPrevious(){
            if(this.page == 1){
                return true;
            }
        },
        visableDelete(){
            if(this.selectedUsers.length == 0){
                return false;
            }
            return true
        },
        visableindividual(){
            // console.log(this.individuals)
            if(this.individuals == null){
                return false;
            }
            return true
        }
    },
    methods: {
        getIndividuals(){
            this.loading = true
            const token = "Bearer " + localStorage.getItem("token");
            axios.get('api/individual',  {headers: { Authorization: token }})
            .then(res => {
                this.individuals = res.data
                console.log(res.data)
                // this.lastPage = res.data.last_page
                this.loading = false;
            })
        },
        goToBlabla(id){
            this.$router.push({ path: `/individual/one/${id}` })
        },
        nextPage(){
            this.page += 1
            this.getIndividuals()
        },
        previousPage(){
            this.page -= 1
            this.getIndividuals()
        }
        ,onChildClick(value){
            
            if(value.length > 2){
                this.loading = true
                axios.get('/api/search/individual/'+value)
                .then(res => {
                    
                    const result = res.data.individuals
                    if(result == null){
                        this.alertMsg = res.data.msg
                    }
                        this.individuals = result
                        this.loading = false    
                        
                })
                return
            }else if(value.length === 0){
                this.getIndividuals()
                return
            }
        },
        onSearchType(value){
            this.searchType = value
        },
        onDelete(){
            this.loading = true
            const token = "Bearer " + localStorage.getItem("token");
            
            axios.patch('api/individual/delete/multiple', 
                        { ids: this.selectedUsers },  
                        { headers: { Authorization: token } })
            .then(res => {
                this.getIndividuals();
                this.selectedUsers = []
                
            })
            .catch((error) =>{

                console.log(error.response)
            })
        },
        caluculateAge(birthday){
            var birthday = new Date(birthday)
            var ageDifMs = Date.now() - birthday.getTime();
            var ageDate = new Date(ageDifMs); // miliseconds from epoch
            return Math.abs(ageDate.getUTCFullYear() - 1970);
        }
    },
    created() {
        this.getIndividuals();
    },
}
</script>

<style lang="scss" scoped>
    table{
        width: 100% !important;
        text-align: right;
    }

    .click-row:hover{
        box-shadow: 1px 1px 1px 2px #e0d6d68c;
        cursor: pointer;
    }

    thead th {
        position:sticky;
        top:0px;
        background-color:grey;
    }

    .check-box:hover{
        box-shadow: #a7b4c191 1px 1px 10px 5px;;
    }


    
</style>
