<template>
    

        <div id='EditPersoneModal' class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Persone</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- form -->
                     <form>
                        <!-- name data -->
                        <div class="form-row">
                            <div class="form-group col-4">
                                <label for="firstname">First Name</label>
                                <input v-model="firstName" type="text" class="form-control" id="firstname"
                                        :title="errors.first_name ? errors.first_name : ''"
                                        v-bind:class="[ errors.first_name ? 'border-danger text-danger' : '' ]">
                            </div>
                            <div class="form-group col-4">
                                <label for="middlename">Middle Name</label>
                                <input v-model="middleName" type="text" class="form-control" id="middlename"
                                :title="errors.middle_name ? errors.middle_name : ''"
                                v-bind:class="[ errors.middle_name ? 'border-danger text-danger' : '' ]">
                            </div>
                            <div class="form-group col-4">
                                <label for="lastname">Last Name</label>
                                <input v-model='lastName' type="text" class="form-control" id="lastname"
                                :title="errors.last_name ? errors.last_name : ''"
                                v-bind:class="[ errors.last_name ? 'border-danger text-danger' : '' ]">
                            </div>
                        </div>
                        <!-- other data -->
                        <div class="form-row">

                            <div class="form-group col-5">
                                <label for="birthday">Birthday</label>
                                <input v-model="birthday" type="date" class="form-control" id="birthday"
                                v-bind:class="[ errors.date_of_birth ? 'border-danger text-danger' : '' ]">
                            </div>

                            <div class="form-group col-4">
                                <label for="placeOfBirth">Place Of Birthday</label>
                                <select v-model="placeOfBirth" name="" id="placeOfBirth" class='form-control'>
                                    <option v-for="(city, index) in cities" :key='index'>{{city.city}}</option>
                                </select>
                            </div>
                            
                            <div class="form-group col-3">
                                <label for="gender">Gender</label>
                                <select v-model="gender" name="" id="gender" class='form-control'>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                        </div>
                        <!-- Email -->
                        <div class='form-row'>
                            <div class="form-group col-4">
                                <label for="area">Area</label>
                                <select v-model="area" name="" id="area" class='form-control'>
                                    <option value="Kozzika">Kozzika</option>
                                    <option value="Maasara">Maasara</option>
                                    <option value="Maadi">Maadi</option>
                                    <option value="Zahrah El-maadi">Zahrah El-maadi</option>
                                    <option v-if="visableArea" :value="area">{{area}}</option>
                                    
                                    <option value="other">other</option>
                                </select>
                            </div>
                            <div class="form-group col-4" :hidden='newArea'>
                                <label for="inputAddress">other area</label>
                                <input v-model="otherArea" type="text" class="form-control" id="inputAddress"
                                :title="errors.area ? errors.area : ''"
                                v-bind:class="[ errors.area ? 'border-danger text-danger' : '' ]">
                            </div>
                            
                        </div>

                        <!-- address and job data -->
                        <div class='form-row'>
                            <div class="form-group col-5">
                                <label for="inputAddress">Address</label>
                                <input v-model="address" type="text" class="form-control" id="inputAddress"
                                :title="errors.address ? errors.address : ''"
                                v-bind:class="[ errors.address ? 'border-danger text-danger' : '' ]">
                            </div>
                            <div class="form-group col-5">
                                <label for="email">Email</label>
                                <input v-model="email" type="email" class="form-control" id="email"
                                :title="errors.email ? errors.email : ''"
                                v-bind:class="[ errors.email ? 'border-danger text-danger' : '' ]">
                            </div>
                            <div class="form-group col-2">
                                <label for="inputJob">Job</label>
                                <input v-model="job" type="text" class="form-control" id="inputJob"
                                :title="errors.job ? errors.job : ''"
                                v-bind:class="[ errors.job ? 'border-danger text-danger' : '' ]">
                            </div>
                        </div>

                        <!-- contect us -->
                        <div class='form-row'>
                            <div class='form-group col-4'>
                                <label for="home">Home Phone</label>
                                <input v-model="homePhone" type="text" class="form-control" id="home"
                                :title="errors.home_phone ? errors.home_phone : ''"
                                v-bind:class="[ errors.home_phone ? 'border-danger text-danger' : '' ]">
                            </div>
                            <div class='form-group col-4'>
                                <label for="mobileNumber1">Mobile Number</label>
                                <input v-model="mobile1" type="text" class="form-control" id="mobileNumber1"
                                :title="errors.mobile_phone1 ? errors.mobile_phone1 : ''"
                                v-bind:class="[ errors.mobile_phone1 ? 'border-danger text-danger' : '' ]">
                            </div>

                            <div class='form-group col-4'>
                                <label for="mobileNumber2">Other Number</label>
                                <input v-model="mobile2" type="text" class="form-control" id="mobileNumber2"
                                :title="errors.mobile_phone2 ? errors.mobile_phone2 : ''"
                                v-bind:class="[ errors.mobile_phone2 ? 'border-danger text-danger' : '' ]">
                            </div>
                        </div>
                    </form>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click='onConfirm'>Edit</button>
                </div>
    
            </div>
        </div>
        </div>
   
</template>

<script>
import cities from '../../assest/files/eg.json'
    export default {
        name: 'EditPersoneModal',
        props:['individual'],
        data(){
            return{
                cities: cities,
                firstName: '',
                middleName: '',
                lastName: '',
                birthday: new Date().toISOString().slice(0,10),
                placeOfBirth: 'Cairo',
                gender: 'male',
                email: '',
                socialStatus: 'single',
                area: 'Kozzika',
                address: '',
                job: '',
                homePhone: '',
                mobile1: '',
                mobile2: '',
                errors: [],
                otherArea: ''
            }
        },
        computed: {
            newArea(){
                if(this.area == 'other'){
                    return false
                }
                return true
            },
            //visable option in selecte
            visableArea(){
                
                let arrayArea = ["Kozzika", "Maasara", "Maadi", "Zahrah El-maadi", 'other']
                let is_exist = arrayArea.includes(this.area)
                if(!is_exist){
                    return true
                }else{
                    return false
                }
            }
            
        },
        methods: {
            onConfirm(){
                    const data = {
                        first_name: this.firstName,
                        middle_name: this.middleName,
                        last_name: this.lastName,
                        date_of_birth: this.birthday,
                        place_of_birth: this.placeOfBirth,
                        gander: this.gender,
                        email: this.email,
                        social_status: this.socialStatus,
                        area: this.area == 'other' ? this.otherArea : this.area,
                        address: this.address,
                        home_phone: this.homePhone,
                        mobile_phone1: this.mobile1,
                        mobile_phone2: this.mobile2,
                    }
                    const token = "Bearer " + localStorage.getItem("token");
                    const id = this.$route.params.individualId;
                    axios.patch(BASE_URL+"/api/individual/" + id, data,{headers: { Authorization: token }})
                    .then(response => {
                        
                        location.reload();
                        
                        
                    }).catch(error => {
                        
                        console.log(error.response.data.errors)
                        this.errors = error.response.data.errors
                    })
                    
                // }
                
            }
        },
        mounted() {
                const self = this
                // simulating an async call:
                setTimeout(function() {
                    self.firstName = self.individual.first_name
                    self.middleName = self.individual.middle_name
                    self.lastName = self.individual.last_name
                    self.birthday = self.individual.date_of_birth
                    self.placeOfBirth = self.individual.place_of_birth
                    self.gender = self.individual.gander
                    self.email = self.individual.email
                    self.socialStatus = self.individual.social_status
                    self.area = self.individual.area
                    self.address = self.individual.address
                    self.job = self.individual.job
                    self.homePhone = self.individual.home_phone
                    self.mobile1 = self.individual.mobile_phone1
                    self.mobile2 = self.individual.mobile_phone2
                }, 3000)
            }
    }
</script>

<style>
    .text-error{
        color: red;
    }
    label{
        font-family: inherit;
        font-weight: bold;
    }
</style>