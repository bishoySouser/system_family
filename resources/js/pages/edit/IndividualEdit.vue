<template>
    <div class='container mt-3'>
        
            <grid-loader v-if='loading' class="m-auto" :color="color" :loading="loading" :size="15"></grid-loader>
           <div v-else class="card">
               <div class="card-header text-right" style='direction: rtl'>
                   <button class='btn btn-primary'>
                        {{individual.first_name}} <span class='badge badge-light'>{{caluculateAge(individual.date_of_birth) + 'years '}}</span>
                   </button>
               </div>

               <div class="card-body" style='min-height: 70vh;'>
                        <button type="button" class="nav-item nav-link btn btn-primary" data-toggle="modal" data-target="#EditPersoneModal">
                            Edit <i class="fas fa-user-edit"></i>
                        </button>
                       <div class="row">
                        <div class="col-12 col-md-4 text-center">
                            <h5>Full Name</h5>
                            <p>{{individual.first_name+' '+individual.middle_name+' '+individual.last_name}}</p>
                        </div>
                        <div class="col-12 col-md-6 text-center">
                            <h5>Address</h5>
                            <p>{{individual.area+', '+individual.address}}</p>
                        </div>
                        <div class="col-12 col-md-2 text-center">
                            <h5>Gander</h5>
                            <p>{{individual.gander}}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12 col-md-4 text-center">
                            <h5>Birthday</h5>
                            <p>{{individual.date_of_birth}}</p>
                        </div>
                        <div class="col-12 col-md-6 text-center">
                            <h5>Place of Birthday</h5>
                            <p>{{individual.place_of_birth}}</p>
                        </div>
                        <div class="col-12 col-md-2 text-center">
                            <h5>Job</h5>
                            <p>{{individual.job}}</p>
                        </div>
                    </div>
                    <hr>
                    <!-- contact -->
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <h5>Contact Info:</h5>
                            <ul class='list-group list-group-flush'>
                                <li class='list-group-item'><i class='fas fa-home'></i>{{individual.home_phone}}</li>
                                <li class='list-group-item'><i class='fas fa-phone'></i>{{individual.mobile_phone1}}</li>
                                <li class='list-group-item' v-if="individual.mobile_phone2"><i class='fas fa-phone'></i>{{individual.mobile_phone2}}</li>
                                <li class='list-group-item' v-if="individual.email"><i class='fas fa-at'></i>{{individual.email}}</li>
                            </ul>
                        </div>
                    </div>
               </div>
           </div>
           <editModal :individual='individual' />
    </div>
</template>

<script>
import editModal from '../../components/modals/EditPersoneModal'
export default {
    name: 'IndividualEdit',
    props: ['individualId'],
    components: {
        editModal,
    },
    data(){
        return{
            individual: [],
            loading: false,
            color: '#343A40'
        }
    },
    methods:{
        getIndividualInfo(){
            this.loading = true
            const token = "Bearer " + localStorage.getItem("token");
            axios.get('/api/individual/'+this.individualId, {headers: { Authorization: token }})
            .then(res => {
                console.log(res.data);
                this.individual =  res.data.individual
                this.loading = false
            })
        },
        caluculateAge(birthday){
            var birthday = new Date(birthday)
            var ageDifMs = Date.now() - birthday.getTime();
            var ageDate = new Date(ageDifMs); // miliseconds from epoch
            return Math.abs(ageDate.getUTCFullYear() - 1970);
        }
    },
    created(){
        this.getIndividualInfo()
    }
}
</script>

<style lang="scss" scoped>

</style>
