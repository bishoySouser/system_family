<template>
    <div class="login-st container-fluid">
        <div class="box-login container-fluid">
            
            <div class="row full-height">
                <div class="image col-lg-6 d-none d-md-none d-lg-block p-5" id="imgBox">
                    <img src="/imgs/mary.png" width="80%" height="90%" />
                </div>
                <div class="form-login col-lg-6 p-5" id="formBox">
                    <div class="col-12 mb-5">
                        <h3 style='font-weight: bold;font-family: sans-serif;'>Log In</h3>
                    </div>
                    <div class="col-12">
                        <BeatLoader v-if='isLoading' class="text-center" :color='colorSpinner'  :size="50"></BeatLoader>
                        <form v-else action="">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input @blur="validEmail()" type="email" v-model="formLogin.email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="user@domain.com">
                                <small id="emailHelp" class="form-text text-muted pl-2" v-html="this.valid.email">{{ this.valid.email }}</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input @blur="validPass()" type="password" v-model="formLogin.password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                <small id="passHelp" class="form-text text-muted pl-2" v-html="this.valid.password">{{ this.valid.password }}</small>
                            </div>
                            

                            <p class="text-danger font-weight-bold" v-if="authError">
                                <i class="fas fa-times-circle"></i>{{authError}}
                            </p>
                            <button type="submit" class="btn btn-primary btn-lg mt-2" v-on:click.prevent='login()'>Login</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>
<script>
import {login} from '../helpers/auth'
import { BeatLoader } from '@saeris/vue-spinners'
export default {
    name: 'login',
    components: {
        BeatLoader
    },
    data(){
        return{
            formLogin: {
                email: '',
                password: ''
            },
            valid: {
                email: 'We\'ll never share your email with anyone else.',
                password: ''
            },
            error: null,
            colorSpinner: '#3490dc'
        }
    },
    computed:{
        authError(){
            return this.$store.getters.authError
        },
        isLoading(){
            return this.$store.getters.isLoading
        }
    },
    methods:{
        validEmail(){
            this.valid.email = 'We\'ll never share your email with anyone else.';
            let email = this.formLogin.email;
            const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if(!re.test(email)){
                this.valid.email = '<p class="text-danger font-weight-bold"><i class="fas fa-times-circle"></i> Email  can contain only latin letters, numbers, "@" and ".".</p>';
                return false;
            }
            // this.valid.email = `<p class="text-success font-weight-bold"><i class="fas fa-check-circle"></i> Email is valid.</p>`;
            return true;
            
        },
        validPass(){
            this.valid.password = '';
            let pass = this.formLogin.password;
            if(pass.length < 8){
                this.valid.password = `<p class="text-danger font-weight-bold"><i class="fas fa-times-circle"></i> Your password must be at least 8 characters long.</p>`;
                return false;
            }
            // this.valid.password = `<p class="text-success font-weight-bold"><i class="fas fa-check-circle"></i> Password is valid.</p>`;
            return true;
            
        },  
       login()
       {
           
        if(this.validEmail() && this.validPass()){
        //If Inputs value are True
            const data = {
                email: this.formLogin.email,
                password: this.formLogin.password
            }
            this.$store.dispatch('login');
            login(this.$data.formLogin)
            .then(res => {
                this.$store.commit("loginSuccess", res);
                this.$router.push({path: "/home"})
               
            })
            .catch(error => {
                this.$store.commit("loginFailed", {error});
            })
            
        }else{
            console.log('Did\'nt go');
            return false
        }
        //    if(!this.errors.length)
        //    {
        //        const data = {
        //            email: this.formLogin.email,
        //            password: this.formLogin.password
        //        }
        //         this.$store.dispatch('login');
        //         login(this.$data.formLogin)
        //         .then(res => {
        //             this.$store.commit("loginSuccess", res);
        //             console.log('login is sucssful!')
        //             this.$router.push({path: "/individual"});
        //         })
        //         .catch(error => {
        //             this.$store.commit("loginFailed", {error});
        //         })
                
               
                // axios.post("api/auth/login", data)
                // .then(response => { 
                //     const token = localStorage.setItem('token', response.data.access_token)
                //     const user = localStorage.setItem('user', response.data.user)
                //     this.$router.push("/");

                // }).catch(error => {
                //     this.errors.push(error.message)
                // })
        //    }
       }
    }
}
</script>
<style lang="scss" scoped>
    .login-st {
        background-color: #F8F8F8;
        width: 100%;
        max-height: 100vh;

    }
    .box-login{
        background-color: #fff;
        width: 75%;
        height: 80vh;
        margin: 2% auto 2% auto;
        border-radius: 1%;
        box-shadow: #e9ecef 5px 16px 10px 13px;
    }

    .full-height{
        height: 100%;
    }

    .login-st .image{
        background-color: #a7bed070;
        box-shadow: #c8d2da 1px 1px 2px 1px;
        padding: 1%;
    }

    .login-st .image img{
        display: block;
        margin: auto;
    }
// .login-st {
//     background: url('/imgs/login-background.jpg');
//     background-size: cover;
// }

// .vertical-center{
//     min-height: 100%;  /* Fallback for browsers do NOT support vh unit */
//     min-height: 100vh;
//     display: flex;
//     align-items: center;
// }

// form{
//     background: #ffffff96;
//     box-shadow: 1px 1px 1px 1px #212529;
//     border-radius: 3%;
// }

</style>