<template>  
    
       <div class='container mt-3'>
        <!-- navbar -->
        <navindividual v-on:childToParent="onChildClick" v-on:toSearchType='onSearchType'/>
           <div class="card">
               <div class="card-header">
                   Individuals
               </div>

               <div class="card-body" style='min-height: 70vh;'>
                   <div class="col-12">
                       <grid-loader v-if='loading' class="m-auto" :color="color" :loading="loading" :size="15"></grid-loader>
                       <!-- table -->
                       <div v-else class="table-responsive" style='height: 70vh; direction: rtl;'>

                        <table v-if="individuals" class='table table-bordered text-center m-auto'>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Handle</th>
                                    <th>Email</th>
                                    <th>Area</th>
                                    <th>Birthday</th>
                                    <th>Age(year)</th>
                                    <th>Home phone</th>
                                    <th>Mobile number1</th>
                                    <th>Mobile number2</th>
                                    <th>Social Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                <!-- if individual.length > 0 -->
                                <tr  v-for="(individual, index) in individuals"
                                :key='index'>
                                    <td>{{ index+1 }}</td>
                                    <td class='font-weight-bold'>{{ (individual.first_name+' '+individual.middle_name+' '+individual.last_name).toUpperCase() }}</td>
                                    <td>
                                       <router-link :to="{ name: 'individual_edit', params: { individualId: individual.id }}"> <i class="fas fa-edit"></i> </router-link>
                                    </td>
                                    <td>{{ individual.email }}</td>
                                    <td><a href="#" data-toggle="tooltip" :title="individual.address">{{ individual.area }}</a></td>
                                    <td>{{ individual.date_of_birth }}</td>
                                    <td>{{ caluculateAge(individual.date_of_birth) }}</td>
                                    <td class='font-italic'>{{ phoneReal(individual.home_phone) }}</td>
                                    <td class='font-italic'>{{ phoneReal(individual.mobile_phone1) }}</td>
                                    <td class='font-italic'>{{ individual.mobile_phone2 ? phoneReal(individual.mobile_phone2) : 'empty'}}</td>
                                    <td>{{ individual.social_status }}</td>
                                </tr>
                            </tbody>
                            <!-- else -->
                            <!-- <tbody>
                                <tr>
                                    
                                    <td class='text-center h5 text-danger' colspan='10'>click add persone</td>
                                </tr>
                            </tbody> -->
                            
                        </table>
                        <div v-else class='text-center'>
                            <div v-if='alertMsg' class="alert alert-light" role="alert">
                                {{alertMsg}}
                            </div>
                            <div v-else class="alert alert-warning" role="alert">
                                You did't add any individual
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
            color: '#343A40'
        }
    },
    computed: {

        emptyField(field) {
            if(field){
                return field
            }else{
                return 'empty'
            }
        }
    },
    methods: {
        getIndividuals(){
            this.loading = true
            axios.get('/api/individual/all')
            .then(res => {
                this.individuals = res.data.individuals
                this.loading = false;
            }).catch(err => {
                console.log(err)
            })
        },
        caluculateAge(birthday){
            var birthday = new Date(birthday)
            var ageDifMs = Date.now() - birthday.getTime();
            var ageDate = new Date(ageDifMs); // miliseconds from epoch
            return Math.abs(ageDate.getUTCFullYear() - 1970);
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
        phoneReal(value){
            value = 0+value
            return value
        }
    },
    created() {
        this.getIndividuals();
    },
}
</script>

<style lang="scss" scoped>
    table{
        width: max-content !important;
    }

    thead th {
        position:sticky;
        top:0px;
        background-color:grey;
    }
    
</style>
