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
                                placeholder="Jon"
                                v-bind:class="[ errors.first_name ? 'border-danger text-danger' : '' ]">
                            </div>
                            <div class="form-group col-4">
                                <label for="middlename">Middle Name</label>
                                <input v-model="middleName" type="text" class="form-control" id="middlename"
                                placeholder="Elia"
                                v-bind:class="[ errors.middle_name ? 'border-danger text-danger' : '' ]">
                            </div>
                            <div class="form-group col-4">
                                <label for="lastname">Last Name</label>
                                <input v-model='lastName' type="text" class="form-control" id="lastname"
                                placeholder="Maged"
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
                                    <option v-for="(city, index) in cities" :key='index' value="Cairo">{{city.city}}</option>
                                    
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
                            <div class="form-group col-8">
                                <label for="email">Email</label>
                                <input v-model="email" type="email" class="form-control" id="email"
                                placeholder="account@serve.co">
                            </div>
                            <div class="form-group col-4">
                                <label for="socialStatus">Socail Status</label>
                                <select v-model="socialStatus" name="" id="socialStatus" class='form-control'>
                                    <option value="single">Single</option>
                                    <option value="married">Married</option>
                                    <option value="widower">Widower</option>
                                </select>
                            </div>
                        </div>

                        <!-- address and job data -->
                        <div class='form-row'>
                            <div class="form-group col-2">
                                <label for="area">Area</label>
                                <select v-model="area" name="" id="area" class='form-control'>
                                    <option value="Kozzika">Kozzika</option>
                                    <option value="Maasara">Maasara</option>
                                    <option value="Maadi">Maadi</option>
                                    <option value="Zahrah El-maadi">Zahrah El-maadi</option>
                                    <option value="other">other</option>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label for="inputAddress">Address</label>
                                <input v-model="address" type="text" class="form-control" id="inputAddress" placeholder="1234 Main St"
                                v-bind:class="[ errors.address ? 'border-danger text-danger' : '' ]">
                            </div>
                            <div class="form-group col-4">
                                <label for="inputJob">Job</label>
                                <input v-model="job" type="text" class="form-control" id="inputJib" placeholder="eg: Doctor"
                                v-bind:class="[ errors.job ? 'border-danger text-danger' : '' ]">
                            </div>
                        </div>

                        <!-- contect us -->
                        <div class='form-row'>
                            <div class='form-group col-4'>
                                <label for="home">Home Phone</label>
                                <input v-model="homePhone" type="text" class="form-control" id="home"
                                placeholder="0220000000"
                                v-bind:class="[ errors.home_phone ? 'border-danger text-danger' : '' ]">
                            </div>
                            <div class='form-group col-4'>
                                <label for="mobileNumber1">Mobile Number1</label>
                                <input v-model="mobile1" type="text" class="form-control" id="mobileNumber1"
                                placeholder="01200000000"
                                v-bind:class="[ errors.mobile_phone1 ? 'border-danger text-danger' : '' ]">
                            </div>
                            <div class='form-group col-4'>
                                <label for="mobileNumber2">Mobile Number2</label>
                                <input v-model="mobile2" type="text" class="form-control" id="mobileNumber2"
                                placeholder="01211111111"
                                v-bind:class="[ errors.mobile2 ? 'border-danger text-danger' : '' ]">
                            </div>
                        </div>
                        <div class='form-row' v-if="errors">
                            <div class='form-group col-12'>
                                <ul class='list-inline'>
                                    <li v-for="(error,index) in errors" :key='index' class='list-inline-item text-danger font-italic'>
                                        {{ error[0] }}
                                    </li>
                                </ul>
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
            }
        },
        computed: {

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
                        area: this.area,
                        address: this.address,
                        home_phone: this.homePhone,
                        mobile_phone1: this.mobile1,
                        mobile_phone2: this.mobile2,
                    }
                    axios.create({
                        baseUrl: BASE_URL
                    }).post("api/individual/add", data)
                    .then(response => {
                        
                        window.confirm('Do you want to save changes?')
                        location.reload();
                        
                        
                    }).catch(error => {
                        console.log(error.response.data.error)
                        this.errors = error.response.data.error
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