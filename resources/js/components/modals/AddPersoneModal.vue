<template>
    

        <div id='addPersoneModal' class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Persone</h5>
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
                                v-bind:class="[ errors.firstName ? 'border-danger text-danger' : '' ]">
                            </div>
                            <div class="form-group col-4">
                                <label for="middlename">Middle Name</label>
                                <input v-model="middleName" type="text" class="form-control" id="middlename"
                                v-bind:class="[ errors.middleName ? 'border-danger text-danger' : '' ]">
                            </div>
                            <div class="form-group col-4">
                                <label for="lastname">Last Name</label>
                                <input v-model='lastName' type="text" class="form-control" id="lastname"
                                v-bind:class="[ errors.lastName ? 'border-danger text-danger' : '' ]">
                            </div>
                        </div>
                        <!-- other data -->
                        <div class="form-row">

                            <div class="form-group col-5">
                                <label for="birthday">Birthday</label>
                                <input v-model="birthday" type="date" class="form-control" id="birthday"
                                v-bind:class="[ errors.birthday ? 'border-danger text-danger' : '' ]">
                            </div>

                            <div class="form-group col-4">
                                <label for="placeOfBirth">Place Of Birthday</label>
                                <select v-model="placeOfBirth" name="" id="placeOfBirth" class='form-control'>
                                    <option value="Cairo">Cairo</option>
                                    <option value="">Assuot</option>
                                </select>
                            </div>
                            
                            <div class="form-group col-3">
                                <label for="gender">Gender</label>
                                <select v-model="gender" name="" id="gender" class='form-control'>
                                    <option value="male">Male</option>
                                    <option value="">Woman</option>
                                </select>
                            </div>
                        </div>
                        <!-- Email -->
                        <div class='form-row'>
                            <div class="form-group col-8">
                                <label for="email">Email</label>
                                <input v-model="email" type="email" class="form-control" id="email"
                                v-bind:class="[ errors.email ? 'border-danger text-danger' : '' ]">
                            </div>
                            <div class="form-group col-4">
                                <label for="socialStatus">Socail Status</label>
                                <select v-model="socialStatus" name="" id="socialStatus" class='form-control'>
                                    <option value="single">Single</option>
                                    <option value="">Married</option>
                                </select>
                            </div>
                        </div>

                        <!-- address data -->
                        <div class='form-row'>
                            <div class="form-group col-4">
                                <label for="area">Area</label>
                                <select v-model="area" name="" id="area" class='form-control'>
                                    <option value="Kozzika">Kozzika</option>
                                    <option value="">Masara</option>
                                </select>
                            </div>
                            <div class="form-group col-8">
                                <label for="inputAddress">Address</label>
                                <input v-model="address" type="text" class="form-control" id="inputAddress" placeholder="1234 Main St"
                                v-bind:class="[ errors.address ? 'border-danger text-danger' : '' ]">
                            </div>
                        </div>

                        <!-- contect us -->
                        <div class='form-row'>
                            <div class='form-group col-4'>
                                <label for="home">Home Phone</label>
                                <input v-model="homePhone" type="text" class="form-control" id="home"
                                v-bind:class="[ errors.homePhone ? 'border-danger text-danger' : '' ]">
                            </div>
                            <div class='form-group col-4'>
                                <label for="mobileNumber1">Mobile Number1</label>
                                <input v-model="mobile1" type="text" class="form-control" id="mobileNumber1"
                                v-bind:class="[ errors.mobile1 ? 'border-danger text-danger' : '' ]">
                            </div>
                            <div class='form-group col-4'>
                                <label for="mobileNumber2">Mobile Number2</label>
                                <input v-model="mobile2" type="text" class="form-control" id="mobileNumber2"
                                v-bind:class="[ errors.mobile2 ? 'border-danger text-danger' : '' ]">
                            </div>
                        </div>
                        <div class='form-row' v-if="errors.length">
                            <div class='form-group col-12'>
                                <span class="text-danger font-italic">{{ errors[0] }}</span>
                            </div>
                        </div>
                    </form>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click='onConfirm'>Confirm</button>
                </div>
    
            </div>
        </div>
        </div>
   
</template>

<script>
    export default {
        name: 'addPersoneModal',
        data(){
            return{
                firstName: '',
                middleName: '',
                lastName: '',
                birthday: '',
                placeOfBirth: '',
                gender: '',
                email: '',
                socialStatus: '',
                area: '',
                address: '',
                homePhone: '',
                mobile1: '',
                mobile2: '',
                errors: [],
            }
        },
        methods: {
            onConfirm(){
                this.errors = []
                if(!this.firstName){
                    this.errors.firstName = true;
                    this.errors.push('First Name is Required.')
                }
                if(!this.middleName){
                    this.errors.middleName = true;
                    this.errors.push('Middle Name is Required.')
                }
                if(!this.lastName){
                    this.errors.lastName = true;
                    this.errors.push('Last Name is Required.')
                }
                if(!this.birthday){
                    this.errors.birthday = true;
                    this.errors.push('Birthday Name is Required.')
                }else{
                    const date = new Date(this.birthday)
                    if(date > Date.now()){
                        this.errors.birthday = true;
                        this.errors.push('Date is must be today or before day.')
                    }
                }
                if(this.email){
                    if(!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.email)){
                        this.errors.email = true;
                        this.errors.push('Email is Not valid.')
                    }
                }
                if(!this.address){
                    this.errors.address = true;
                    this.errors.push('Adress is Required.')
                }
                if(!this.homePhone){
                    this.errors.homePhone = true;
                    this.errors.push('Home Phone is Required.')
                }else if(this.homePhone.charAt(0) != 0 || !/^\d{10}$/.test(this.homePhone)){
                    this.errors.homePhone = true;
                    this.errors.push('Home Phone is not valid.')
                }
                if(!this.mobile1){
                    this.errors.mobile1 = true;
                    this.errors.push('Mobile Number1 is Required.')
                }else if(this.mobile1.charAt(0) != 0 || !/^\d{11}$/.test(this.mobile1)){
                    this.errors.mobile1 = true;
                    this.errors.push('Mobile Number1 is not valid.')
                }
                if(this.mobile2){
                    if(!/^\d{11}$/.test(this.mobile2)) {
                        this.errors.mobile2 = true;
                        this.errors.push('Mobile Number2 is not valid.')
                    }
                }
                if(!this.errors.length){
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
                    }).post("persone", data)
                    .then(response => {
                        
                        window.confirm('Do you want to save changes?')
                        location.reload();
                        
                        
                    }).catch(error => {
                        console.log(error)
                    })
                    
                }
                
            }
        }
    }
</script>

<style>
    .text-error{
        color: red;
    }
</style>