<template>
    <div class='container mt-3'>
        
            <grid-loader v-if='loading' class="m-auto" :color="color" :loading="loading" :size="15"></grid-loader>
           <div v-else class="card">
               

               <div class="card-body" style='min-height: 50vh;'>
                        <button type="button" class="nav-item nav-link btn btn-primary" data-toggle="modal" data-target="#EditPersoneModal">
                            Edit <i class="fas fa-user-edit"></i>
                        </button>
                        <div class="row header justify-content-md-center mb-3">
                            <div class="col-6 text-center">
                                <h2 class="font-weight-bold">{{individual.first_name+' '+individual.middle_name+' '+individual.last_name}}</h2>
                                <h5 style="color: #bbbbbb">{{individual.job ? individual.job : 'Without job'}}</h5>
                            </div>
                        </div>
                        <div class="row down justify-content-md-center">
                            <div class="info col-6">
                                <ul style="list-style-type:none;">
                                    <li>
                                        <i class="fas fa-home"></i>
                                        <span>{{individual.address + ', ' + individual.area}}</span>
                                    </li>

                                    <li>
                                        <i class="fas fa-birthday-cake"></i>
                                        <span>{{individual.date_of_birth}} {{individual.place_of_birth ? " in " + individual.place_of_birth : null}}</span>
                                    </li>

                                    <li>
                                        <i class="fas fa-envelope"></i>
                                        <span>{{individual.email}}</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="contant col-6">
                                <ul style="list-style-type:none;">
                                    <li>
                                        <i class="fas fa-phone-alt"></i>
                                        <span>{{individual.home_phone}}</span>
                                    </li>

                                    <li>
                                        <i class="fas fa-mobile-alt"></i>
                                        <span>{{individual.mobile_phone1}}</span>
                                    </li>

                                    <li v-if="individual.mobile_phone2">
                                        <i class="fas fa-mobile-alt"></i>
                                        <span>{{individual.mobile_phone2}}</span>
                                    </li>
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
                this.individual =  res.data.individual[0]
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
    li{
        margin-bottom: 10px;
    }
    .down{
        font-size: 15px;
    }
    .info{
        border-right: 1px solid #000;
    }
</style>
