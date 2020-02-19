<template>  
    
       <div class='container mt-3'>
        <!-- navbar -->
        <navindividual v-on:childToParent="onChildClick"/>
           <div class="card">
               <div class="card-header">
                   Individuals
               </div>

               <div class="card-body">
                   <div class="col-12">
                       <!-- table -->
                       <div class="table-responsive" style='height: 50vh'>

                        <table class='table table-bordered text-center m-auto'>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Area</th>
                                    <th>Birthday</th>
                                    <th>Home phone</th>
                                    <th>Mobile number1</th>
                                    <th>Mobile number2</th>
                                    <th>Social Status</th>
                                </tr>
                            </thead>

                            <tbody v-if="individuals">
                                <!-- if individual.length > 0 -->
                                <tr  v-for="(individual, index) in filterList"
                                :key='index'>
                                    <td>{{ index+1 }}</td>
                                    <td class='font-weight-bold text-left'>{{ (individual.first_name+' '+individual.middle_name+' '+individual.last_name).toUpperCase() }}</td>
                                    <td>{{ individual.email }}</td>
                                    <td><a href="#" data-toggle="tooltip" :title="individual.address">{{ individual.area }}</a></td>
                                    <td>{{ individual.date_of_birth }}</td>
                                    <td class='font-italic'>{{ individual.home_phone }}</td>
                                    <td class='font-italic'>{{ individual.mobile_phone1 }}</td>
                                    <td class='font-italic'>{{ individual.mobile_phone2 ? individual.mobile_phone2 : 'empty'}}</td>
                                    <td>{{ individual.social_status }}</td>
                                </tr>
                            </tbody>
                            <!-- else -->
                            <tbody v-else>
                                <tr>
                                    <td class='text-center h5 text-danger' colspan='8'>click add persone</td>
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
import navindividual from '../components/navbars/NavbarIndividual'

export default {
    name:'individual',
    components: {
        navindividual,
    },
    data(){
        return{
            individuals: [],
            search: ''
        }
    },
    computed: {
        filterList() {
            return this.individuals.filter( individual => {
                return individual.middle_name.toLowerCase().includes(this.search.toLowerCase())
            })
        }
    },
    methods: {
        getIndividuals(){
            axios.get('/persone').then(res => {
                this.individuals = res.data.individuals
            }).catch(err => {
                console.log(err)
            })
        },
        onChildClick(value){
            this.search = value;
        }
    },
    created() {
        this.getIndividuals();
    },
}
</script>

<style>
    table{
        width: max-content !important;
    }

    th:nth-child(2), td:nth-child(2) {
        position:sticky;
        left:0px;
        background-color:grey;
    }
</style>